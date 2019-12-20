<?php
if (!isset($_SESSION['admin-siswa'])and ! isset($_SESSION['login-siswa'])) {
    header("location:../");
}
//include "../../../config/config.php";

$query = "SELECT akun.username,akun.email,akun.password,tbl_siswa.nis,tbl_siswa.nama_lengkap,
          tbl_siswa.jk,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM akun,tbl_siswa,tbl_kelas
          where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=akun.nis and 
          tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "'";
        $hasil = mysqli_query($link, $query);
?>
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        
        <div class="row">

            <div class="col-md-12">
                        <?php
            if (isset($_SESSION['info-login'])) {
                echo $_SESSION['info-login'];
            }
            unset($_SESSION['info-login']);
            ?>
                <div class="row">

                    <div class="profile-information">
                        <div class="col-md-2">
                            <?php
                            $data = mysqli_fetch_array($hasil);
                            $pwd=$data['password'];
                            $pswd=$cipher->decrypt($pwd, $kunci)
                            ?>
                            <div class="profile-pic text-center">
                                <?php if ($data['jk'] == 'L') { ?>
                                    <img src="../assets/img/male.png" width="23px" height="23px"/>
                                <?php } else { ?>
                                    <img src="../assets/img/female.png" width="23px" height="23px"/>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="profile-desk">
                                <h1><?php echo $data['nama_lengkap']; ?></h1>
                                <!--<div class="caption">--><br>
                                <p><span class="fa fa-check-square-o fa-lg"></span> <b>Nis</b> : <?php echo $data['nis']; ?></p>
                                <p><span class="fa fa-tags fa-lg"></span> <b>Kelas</b> : <?php echo $data['kelas']?></p>
                               
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="profile-statistics">
                                <div class="panel-body">
                                    <h1>INFORMASI AKUN</h1>
                                    <table class="table">
                                        <tr>
                                            <td><span class="fa fa-envelope fa-lg"></span></td>
                                            <td>:</td>
                                            <td><?php echo $data['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><span class="fa fa-user fa-lg"></span></td>
                                            <td>:</td>
                                            <td><?php echo $data['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><span class="fa fa-lock fa-lg"></span></td>
                                            <td>:</td>
                                            <td><?php echo $data['password']; ?>&nbsp;</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 well">
                        <ul id="myTab" class="nav nav-tabs">
                           
                            <li class="active"><a href="#pengaturan" data-toggle="tab" class="btn"><i class="fa fa-gear"></i> Pengaturan</a></li>
                        </ul>
                        <!--bagian isi-->
                        <div id="myTabContent" class="tab-content">
                            
                            <div class="tab-pane fade in active" id="pengaturan">
                                <!--Isi Riwayat Upload-->
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3><i class="fa fa-gear"></i> Pengaturan Password</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-lg-offset-1 col-lg-9">
                                            <form role="form" class="form-horizontal" method="POST" action="?siswa=ubah_password">
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
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-danger btn-sm" >Keluar <i class="fa fa-times fa-fw fa-lg"></i></button>
                                                    <button type="submit" class="btn btn-primary btn-sm" name="ubah_p">Ubah Password <i class="fa fa-refresh fa-fw fa-lg"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
        </div>
    </section>
</section>