<?php
if (!isset($_SESSION['admin-siswa'])and ! isset($_SESSION['login-siswa'])) {
    header("location:../");

}
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
?>
<h3 class="page-header"><i class="fa fa-user fa-fw fa-2x"></i> Identitas Pribadi Siswa</h3>
<div class="row-fluid placeholders">
    <?php
    if (isset($_SESSION['info-login'])) {
        echo $_SESSION['info-login'];
    }
    unset($_SESSION['info-login']);
    ?>
    <div class="col-md-5 text-left">
        <?php
        $query = "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_siswa.alamat,tbl_siswa.jk,tbl_siswa.agama,
        tbl_siswa.tempat_lahir,tbl_siswa.tgl_lahir,tbl_siswa.telpon,tbl_siswa.email,tbl_siswa.nama_ayah,
        tbl_siswa.nama_ibu,tbl_kelas.kelas FROM tbl_siswa,tbl_kelas
        where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "'";
        $hasil = mysqli_query($link, $query);
        $i_m = mysqli_fetch_array($hasil);
        ?>
        
    </div>
    <div class="col-md-12 text-left">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-user fa-lg"></span> Profil Siswa</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-7">
                        <table class="table table-condensed table-responsive">
                            <tr>
                                <td>NIS</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['nis']; ?></big></strong></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['nama_lengkap']; ?></big></strong></td>
                            </tr>
                            <!-- <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><strong><big><?php //echo $i_m['kelas']; ?></big></strong></td>
                            </tr> -->
                            <tr>
                                <td>Tempat/Tanggal Lahir</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['tempat_lahir']?>, <?php echo (DateToIndo("$i_m[tgl_lahir]")); ?></big></strong></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['jk']; ?></big></strong></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['alamat']; ?></big></strong></td>
                            </tr>

                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['agama']; ?></big></strong></td>
                            </tr>
                            <tr>
                                <td>No Telpon</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['telpon']; ?></big></strong></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['email']; ?></big></strong></td>
                            </tr>
                            <tr>
                                <td>Nama Ayah</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['nama_ayah']?></big></strong></td>
                            </tr>
                            <tr>
                                <td>Nama Ibu</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['nama_ibu']; ?></big></strong></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ubahPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o fa-fw fa-lg"></i> Ubah Profil</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="?mhs=ubah_password">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputNim" class="col-lg-4 control-label">Password Lama</label>
                            <div class="col-lg-7">
                                <input class="form-control" id="inputNim" type="password" name="pass_lama" placeholder="Ketikkan Password Lama Anda">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNim" class="col-lg-4 control-label">Password Baru</label>
                            <div class="col-lg-7">
                                <input class="form-control" id="inputNim" type="password" name="pass_baru" placeholder="Ketikkan Password Baru Anda">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNim" class="col-lg-4 control-label">Ulangi Password Baru</label>
                            <div class="col-lg-7">
                                <input class="form-control" id="inputNim" type="password" name="ulangi_pass" placeholder="Ulangi Password Baru Anda">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar <i class="fa fa-times fa-fw fa-lg"></i></button>
                        <button type="submit" class="btn btn-success" name="ubah_p">Ubah Password <i class="fa fa-refresh fa-fw fa-lg"></i></button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </div><!-- /.modal -->