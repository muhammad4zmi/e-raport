<?php
function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
     // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
    $BulanIndo = array("Januari", "Februari", "Maret",
     "April", "Mei", "Juni",
     "Juli", "Agustus", "September",
     "Oktober", "November", "Desember");
    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
    $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    return($result);
  }
if (!isset($_SESSION['admin-username'])) {
    header("location:login.php");

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cari = antiinjection($_POST['cari']);
    $sql_laporan = mysqli_query($link, "SELECT * from tbl_guru where nip  LIKE '%" . $cari . "%'
					order by nip");
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
    <h3 class="page-header"><i class="fa fa-users fa-fw fa-2x"></i> Halaman Pencarian Data Guru
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
                        <a type="button" class="btn btn-warning" href="?admin=dt_guru"><i class="fa fa-backward"></i> Kembali Ke Menu Guru</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CariLagi"><i class="fa fa-search-plus"></i> Pencarian Baru</button>
                    </p>
                </div>
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="fa fa-users fa-fw fa-2x"></i> Data Guru</div>
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                    <th width="20">NIP</th>
                                    <th width="20%">Nama Guru</th>
                                    <th width="12%">Jenis Kelamin</th>
                                    <th width="20%">Tanggal Lahir</th>
                                    <th width="10%">Agama</th>
                                    <th width="20%">Alamat</th>

                                    <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($data_guru = mysqli_fetch_assoc($sql_laporan)) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                <td><?php echo $data_guru['nip']; ?></a></td>
                                <td><?php echo $data_guru['nama_guru']; ?></td>
                                <td><?php echo $data_guru['jk']; ?></td>
                                <td><?php echo (DateToIndo("$data_guru[tgl_lahir]")); ?></td>
                                
                                <td><?php echo $data_guru['agama']; ?></td>
                                <td><?php echo $data_guru['alamat']; ?></td>
                                <td>

                                    <a href="index.php?modul=ubah_staf&kd_staf=<?php echo $data['kd_staf']; ?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Ubah Data Staf <?php echo $data['nama_staf'];?>">
                                        <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                    </a>
                                    <a href="index.php?admin=del_guru&nip=<?php echo $data_guru['nip']; ?>" title="" data-toggle="tooltip" data-original-title="Hapus Data" onclick="return confirm('Anda yakin menghapus Data Guru dengan Nama : <?php echo $data_guru['nama_guru']; ?> ?');">
                                        <button type="button" class="btn btn-danger btn-flat btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

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
                                <a type="button" class="btn btn-danger" href="?admin=dt_guru"><i class="fa fa-backward"></i> Kembali Ke Menu Lihat Guru</a>
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
                    <a type="button" class="btn btn-warning" href="?admin=dt_guru"><i class="fa fa-backward"></i> Kembali Ke Menu Lihat Laporan</a>
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
                <h4 class="modal-title" id="myModalLabel">Pencarian Data Guru</h4>
            </div>
            <div class="modal-body">
                Isi Data Pencarian : <form class="navbar-form" method="POST" action="?admin=cari_guru">
                    <img src="../style/img/search-ico.png" alt="search-ico" width="45px" height="45px"> 
                    <input type="text" class="tultip form-control" name="cari" placeholder="Cari Guru..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIP">
                </form>
            </div>
            <div class="modal-footer text-left">
                <i>Cari Data Berdasarkan NIP . .</i>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->