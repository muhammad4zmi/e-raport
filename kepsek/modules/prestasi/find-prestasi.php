<?php
if (!isset($_SESSION['admin-username']))
    header("location:../../login.php");
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cari = antiinjection($_POST['cari']);
    $sql_laporan = mysqli_query($link, "SELECT tbl_prestasi.nama_prestasi,tbl_prestasi.jenis,
                                        tbl_prestasi.waktu,tbl_prestasi.lokasi,tbl_prestasi.tingkat,tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.kelas
                                        from tbl_prestasi INNER JOIN tbl_siswa ON tbl_prestasi.nis=tbl_siswa.nis INNER JOIN
                                        tbl_kelas ON tbl_prestasi.id_kelas=tbl_kelas.id_kelas where tbl_prestasi.nis  LIKE '%" . $cari . "%'
                    					order by tbl_prestasi.nis");
    
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
    <h3 class="page-header"><i class="fa fa-trophy fa-fw fa-2x"></i> Halaman Pencarian Data Prestasi Siswa
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
                        <a type="button" class="btn btn-warning" href="?admin=prestasi"><i class="fa fa-backward"></i> Kembali Ke Menu Prestasi</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CariLagi"><i class="fa fa-search-plus"></i> Pencarian Baru</button>
                    </p>
                </div>
                <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading"><i class="fa  fa-trophy fa-fw fa-2x"></i> Data Prestasi</div>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="5">#</th>
                            <th width="35">Prestasi</th>
                            <th width="10%">Jenis</th>
                            <th width="20">Pelaksanaan</th>
                            <th width="30">Lokasi</th>
                            <th width="10%">Tingkat</th>
                            <th width="20%">Siswa</th>
                            <th width="5%">Kelas</th>
                            

                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data_prestasi = mysqli_fetch_assoc($sql_laporan)) {
                            
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data_prestasi['nama_prestasi']; ?></a></td>
                                <td><?php echo $data_prestasi['jenis']; ?></td>
                                <td><?php echo (DateToIndo("$data_prestasi[waktu]")); ?></td>
                                <td><?php echo $data_prestasi['lokasi']; ?></td>
                                <td><?php echo $data_prestasi['tingkat']; ?></td>
                                <td><?php echo $data_prestasi['nis']."  ".$data_prestasi['nama_lengkap']; ?></td>
                                
                                <td><?php echo $data_prestasi['kelas']; ?></td>
                                
                                <td>
                                    <a href="?admin=detail_siswa&nis=<?php echo $data_prestasi['nis']; ?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Prestasi Siswa <?php echo $data_prestasi['nis']?>">
                                     <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </a>

                                    <a href="#" class="edit-record" data-id="<?php echo $data_guru['nip'];?>" title="" data-original-title="">
                                        <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                    </a>
                                    <a href="#" data-href="index.php?admin=del_guru&nip=<?php echo $data_guru['nip']; ?>" data-toggle="modal" data-target="#confirm-delete">
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
                                <a type="button" class="btn btn-danger" href="?admin=prestasi"><i class="fa fa-backward"></i> Kembali Ke Menu Lihat Prestasi</a>
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
                    <a type="button" class="btn btn-warning" href="?admin=prestasi"><i class="fa fa-backward"></i> Kembali Ke Menu Lihat Laporan</a>
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
                <h4 class="modal-title" id="myModalLabel">Pencarian Data Prestasi</h4>
            </div>
            <div class="modal-body">
                Isi Data Pencarian : <form class="navbar-form" method="POST" action="?admin=cari_prestasi">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="tultip form-control" name="cari" placeholder="Cari Siswa..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIS">
                </div>
                </form>
            </div>
            <div class="modal-footer text-left">
                <i>Cari Data Berdasarkan NIS Siswa . .</i>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->