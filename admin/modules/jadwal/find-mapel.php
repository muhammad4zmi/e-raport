<?php
// function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
//      // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
//     $BulanIndo = array("Januari", "Februari", "Maret",
//      "April", "Mei", "Juni",
//      "Juli", "Agustus", "September",
//      "Oktober", "November", "Desember");
//     $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
//     $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
//     $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
//     $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
//     return($result);
//   }
if (!isset($_SESSION['admin-username'])) {
    header("location:login.php");

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cari = antiinjection($_POST['cari']);
    $sql_laporan = mysqli_query($link, "SELECT tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_mapel.nip,tbl_guru.nama_guru
                     from tbl_mapel INNER JOIN tbl_guru ON tbl_mapel.nip=tbl_guru.nip where tbl_mapel.nama_mapel  LIKE '%" . $cari . "%'
					order by nama_mapel");
    ?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
    <h3 class="page-header"><i class="fa fa-users fa-fw fa-2x"></i> Halaman Pencarian Data Pelajaran
        <!-- <form class="navbar-form navbar-right" method="POST" action="?admin=cari_guru">
            <img src="../style/img/search-ico.png" alt="search-ico" width="45px" height="45px"> <input type="text" name="cari" class="form-control" placeholder="Cari Guru..." required="">
        </form> -->
    </h3>
    <div class="row-fluid placeholders">
        <div class="col-md-12 text-left">
            <?php
            $hsl = mysqli_num_rows($sql_laporan);
            if ($hsl > 0) {
                $no = 1;
                ?>
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Berhasil!</h4>
                    <p>Hasil Pencarian : <big><strong><?php echo $hsl; ?></strong></big> Data Ditemukan.</p>
                    <p>
                        <a type="button" class="btn btn-warning" href="?admin=dt_mapel"><i class="fa fa-backward"></i> Kembali Ke Menu Mapel</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CariLagi"><i class="fa fa-search-plus"></i> Pencarian Baru</button>
                    </p>
                </div>
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="fa fa-users fa-fw fa-2x"></i> Data Pelajaran</div>
                    <table class="table table-striped table-hover table-condensed">
                       <thead>
                        <tr>
                            <th width="2">#</th>
                            <th width="10">Kode Mapel</th>
                            <th width="20%">Mata Pelajaran</th>
                            <th width="30%">Guru</th>
                            

                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            while ($data_mapel = mysqli_fetch_assoc($sql_laporan)) {
                                ?>
                                <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data_mapel['kd_mapel']; ?></a></td>
                                <td><?php echo $data_mapel['nama_mapel']; ?></td>
                                <td><?php echo $data_mapel['nip']."  ".$data_mapel['nama_guru']; ?></td>
                                
                                <td>

                                    <a href="index.php?modul=ubah_staf&kd_staf=<?php echo $data['kd_staf']; ?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Ubah Data Staf <?php echo $data['nama_staf'];?>">
                                        <button type="button" class="btn btn-info btn-xs btn-flat"><i class="glyphicon glyphicon-edit"></i></button>
                                    </a>
                                    <a href="index.php?modul=hapus_staf&kd_staf=<?php echo $data['kd_staf']; ?>" title="" data-toggle="tooltip" data-original-title="Hapus Data" onclick="return confirm('Anda yakin menghapus Data staf dengan Nama : <?php echo $data['nama_staf']; ?> ?');">
                                        <button type="button" class="btn btn-danger btn-xs btn-flat"><i class="glyphicon glyphicon-trash"></i></button>

                                    </a>
                                     
                                </td>
                            </tr>
                                <?php
                                $no++;
                            }
                        } else {
                            // Data Mahasiswa Tidak Ditemukan. . .
                            ?>
                        <div class="alert alert-danger fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Mohon Maaf!</h4>
                            <p>Data yang Anda Cari Tidak Ada.</p>
                            <p>
                                <a type="button" class="btn btn-danger" href="?admin=dt_mapel"><i class="fa fa-backward"></i> Kembali Ke Menu Lihat Pelajaran</a>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CariLagi"><i class="fa fa-search-plus"></i> Ulangi Pencarian</button>
                            </p>
                        </div>

                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
        } else {
            //jika tidak melaliu POST
            ?>
            <div class="alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Mohon Maaf!</h4>
                <p>Anda Belum Menginputkan Data Pencarian.</p>
                <p>
                    <a type="button" class="btn btn-warning" href="?admin=dt_mapel"><i class="fa fa-backward"></i> Kembali Ke Menu Lihat Laporan</a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CariLagi"><i class="fa fa-search-plus"></i> Ulangi Pencarian</button>
                </p>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</section>
</aside>

<!-- Modal -->
<div class="modal fade" id="CariLagi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pencarian Data Pelajaran</h4>
            </div>
            <div class="modal-body">
                Isi Data Pencarian : <form class="navbar-form" method="POST" action="?admin=cari_mapel">
                    <img src="../style/img/search-ico.png" alt="search-ico" width="45px" height="45px"> 
                    <input type="text" class="tultip form-control" name="cari" placeholder="Cari Pelajaran..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIP">
                </form>
            </div>
            <div class="modal-footer text-left">
                <i>Cari Data Berdasarkan Nama Pelajaran . .</i>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->