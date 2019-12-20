<?php
// ob_start();
session_start();
include "config/config.php";
// $result = query_chart_angkatan($link);
// $qBarUnsur = query_chart_unsur($link);
// $qPieUnsur = query_chart_unsur($link);
// $qPieJurusan = query_chart_jurusan($link);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>E-Raport SMPN 1 Mataram</title>
        <meta name="description" content="Sebuah situs Aplikasi untuk memanajemen pendataan laporan hasil belajar siswa SMPN 1 Mataram." />
        <meta name="keywords" content="laporan, Nilai Semester, Raport,Online" />
        <meta name="author" content="@muhammad4zmy" />
        <!--style bootstrap-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!--font awesome 4.4.0-->
        <link href="assets/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <!--style and animate-->
        <link href="assets/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/animate.css">
        <!-- favicon STMIK -->
        <link rel="shortcut icon" href="style/ico/tutwuri.png">
        <!-- Custom js for page-scroll -->
        <script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="daftar-user.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        
    </head>
    <body id="page-top" data-spy="scroll">
        <!-- Preloader -->
	<div id="preloader">
	  <div id="load"></div>
	</div>
        <!--<header class="main-header">--> 
        <nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <!--  <img src="assets/img/logo-stmik.png" width="50px" height="50px" style="margin-top: 0px;" class="pull-left"> -->
                    <img src="assets/img/tutwuri.png" width="50px" height="50px" style="margin-top: 0px;" class="pull-left">
                    <a href="index.php" class="navbar-brand" style="margin-top: -10px;">
                        <b><strong>Laporan Hasil Belajar Siswa E-Raport</strong></b> <br>SMPN 1 Mataram
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-collapsible">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#section1" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Beranda">
                                <i class="fa fa-home fa-lg"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#section2" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Login User">
                                <i class="fa fa-sign-in fa-lg"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#section3" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Buat Akun">
                                <i class="fa fa-pencil-square fa-lg"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#section4" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Panduan">
                                <i class="fa fa-book fa-lg"></i>
                            </a>
                        </li>
                        <li>
                            <a href="../eraport/user" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Users">
                                <i class="fa fa-user fa-lg"></i>
                            </a>
                        </li>
                        <!--<li>&nbsp;</li>-->
                    </ul>
                </div>
            </div>
        </nav>
        <!--</header>-->
        <section class="container-fluid" id="section1">
            <div id="overlay"></div>
            <div class="container">
                <div id="cover">
                    <h1 class="v-center animated bounceInDown">
                        Laporan Hasil Belajar Siswa E-Raport
                    </h1>
                    <br>
                    <div class="row">
                        <div class="col-sm-4 text-center wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1 text-center">
                                    <h4 style="text-shadow: -4px 3px 9px black;"><i class="fa fa-cloud-upload fa-5x"></i></h4>
                                    <h3>Login</h3>
                                    <p>Menggunakan NIK dan Password yang telah di daftarkan pada aplkasi ini.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1 text-center">
                                    <h4 style="text-shadow: -4px 3px 9px black;"><i class="fa fa-pencil-square fa-5x"></i></h4>
                                    <h3>Buat Akun Anda</h3>
                                    <p>Cukup dengan memasukkan NIK Anda & Password untuk Akun baru.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center wow fadeInRight" data-wow-delay="0.4s">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1 text-center">
                                    <h4 style="text-shadow: -4px 3px 9px black;"><i class="fa fa-book fa-5x"></i></h4>
                                    <h3>Panduan Lengkap</h3>
                                    <p>Penggunaan Aplikasi Laporan Hasil Belajar Siswa SMPN 1 Mataram</b>.</p>
                                </div>    
                            </div>
                        </div>
                    </div><!--/row-->
                    <div class="row"><br></div>
                </div>
            </div><!--/container-->
        </section>
        <!--section Login-->
        <section class="container-fluid" id="section2">
            <div class="row wow fadeInDown" data-wow-delay="0.4s" style="margin-top: 20px;-webkit-margin-top: 20px;-moz-margin-top: 20px;-o-margin-top: 20px;">
                <div class="well col-md-4 col-md-offset-1 effect2">
                    <form class="form-horizontal" method="POST" action="login-siswa.php">
                        <fieldset>
                            <legend><i class="fa fa-graduation-cap fa-fw fa-2x"></i> Form Login Siswa</legend>
                            <div class="alert alert-info">Inputkan Username dan Password sesuai dengan data pendaftaran akun.</div>
                            <div class="form-group">
                                <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="inputUsername" placeholder="Username (NIS Siswa)" type="text" name="user-siswa" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="pass-siswa" required="">
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-success" name="login-siswa">Masuk <i class="fa fa-sign-in fa-fw fa-lg"></i>
                                    </button>
                                    <a class="btn btn-default" data-toggle="modal" data-target="#lupaPass"><i class="fa fa-history fa-fw fa-lg"></i>Lupa Password ?</a>
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION['info-login'])) {
                                echo $_SESSION['info-login'];
                            }
                            unset($_SESSION['info-login']);
                            ?>
                        </fieldset>
                    </form>
                </div>
                <!-- col-md-5-->
                <div class="col-md-5 col-md-offset-1" style="margin-top: 60px;">
                    <h1 style="color:#2064ff; font-size: 50px">
                        <i class="fa fa-cloud-upload fa-fw fa-2x"></i>Login
                    </h1>
                    <p style="text-align: left">
                        Aplikasi ini membantu Siswa melihat Laporan hasil belajar atau Raport secara daring (Online).
                    </p>
                </div>
            </div>
        </section>

        <section class="container-fluid" id="section3">
            <div class="row wow fadeInDown" data-wow-delay="0.4s" style="margin-top: 20px;-webkit-margin-top: 20px;-moz-margin-top: 20px;-o-margin-top: 20px;">
                <div class="well col-md-4 col-md-offset-1 effect2">
                    <form class="form-horizontal" method="POST" action="daftar-baru.php">
                        <fieldset>
                            <legend><i class="fa fa-pencil-square-o fa-fw fa-2x"></i> Daftar Akun Siswa</legend>
                           
                            <div class="form-group">
                                        <div class="col-lg-12" id="pesan">        
                                        </div>
                                    </div>
                            <div class="form-group">
                                <label for="inputNim" class="col-lg-3 control-label text-left">NIS</label>
                                <div class="col-lg-8">
                                            <div class="input-group">
                                                <input type="text" class="tultip form-control" id="inputNis" value="" placeholder="NIS Anda" name="nis" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Gunakan NIS Anda untuk Membuat Akun" required />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" id="cek_nis" type="button"><i class="fa fa-arrow-circle-o-right fa-fw fa-lg"></i></button>
                                                </span>
                                            </div>
                                        </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNama" class="col-lg-3 control-label text-right">Nama</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="inputNama" placeholder="Nama Siswa" name="nama_siswa" type="text" readonly="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-3 control-label text-right">Email</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="inputEmail" placeholder="Email Siswa" name="emailsiswa" type="text" readonly="" required>
                                    <input class="form-control" id="inputGender" name="gender" type="hidden" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-3 control-label text-right">Password</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="inputPassword" placeholder="Password" name="pass1" type="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword2" class="col-lg-3 control-label text-right" style="margin-top: -10px;">Ulangi Password</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="inputPassword2" placeholder="Ulangi Password" name="pass2" type="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8 col-lg-offset-3 text-right">
                                    <button type="reset" class="btn btn-default"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                                    <button type="submit" class="btn btn-primary" name="s_user"><i class="fa fa-pencil-square-o fa-fw fa-lg"></i>Proses</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!-- col-md-5-->
                <div class="col-md-5 col-md-offset-1" style="margin-top: 60px;">
                    <h1 style="color:white;font-size: 50px"><i class="fa fa-pencil-square-o fa-fw fa-2x"></i>Buat Akun Anda</h1>
                    <p style="color:white; text-align: left">
                        Cukup dengan memasukkan ID Mahasiswa Anda & membuat Password untuk Akun yang dibuat.
                    </p>
                </div>
            </div>
        </section>

        <section class="container-fluid" id="section4">
            <div class="row wow fadeInDown" data-wow-delay="0.4s" style="margin-top: 20px;-webkit-margin-top: 20px;-moz-margin-top: 20px;-o-margin-top: 20px;">
                <div class="col-md-5 col-sm-offset-1" style="margin-top: 100px;">
                    <br/><br/>
                    
                    <a class="btn btn-primary btn-lg" href="panduan-aplikasi/" target="_blank"><span class="fa fa-paper-plane fa-2x fa-fw"></span>Panduan Aplikasi »</a>
                </div>
                <!-- col-md-5-->
                <div class="col-md-5" style="margin-top: 60px;">
                    <h1 style="color:#2064ff; font-size: 49.5px"><i class="fa fa-file-text fa-fw fa-2x"></i>Panduan Lengkap</h1>
                    <p align="justify">Berdasarkan Surat Keputusan Kepala SMPN 1 Mataram nomor : 0119/S.KEP/ tentang Laporan hasil belajar siswa.
                    </p>
                </div>

            </div>
        </section>

        

        <footer id="footer">
            <div class="container">
                <div class="row wow fadeInLeftBig" data-wow-delay="0.4s">    
                    <div class="col-xs-6 col-sm-6 col-md-3 column">          
                        <h4>Informasi</h4>
                        <ul class="nav">
                            
                            <li><a href="panduan-aplikasi/"><i class="fa fa-file-text"></i> Panduan Aplikasi</a></li>
                        </ul> 
                    </div>
                    <div class="col-xs-6 col-md-3 column">          
                        <h4>Ikuti Kami</h4>
                        <ul class="nav">
                            <li><a href="#"><i class="fa fa-globe"></i> Situs Resmi</a></li>
                            <li><a href="https://www.facebook.com/spensaaaa/"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                        </ul> 
                    </div>
                    <div class="col-xs-6 col-md-3 column">          
                        <h4>Kontak</h4>
                        <ul class="nav">
                            <li><a href="#"><i class="fa fa-phone"></i> Telp (0370)-634498</a></li>
                            <li><a href="#"><i class="fa fa-phone-square"></i> Fax (0370)-638369</a></li>
                            <li><a href="mailto:mail@smpn1mataram.sch.id"><i class="fa fa-envelope"></i> Email</a></li>
                        </ul> 
                    </div>
                    <div class="col-xs-6 col-md-3 column">          
                        <div style="margin-top:40px;text-align: right;">
                            <p>
                                Copyright &COPY 2019 <br>
                                <b style="letter-spacing: 1px;">SMPN 1 Mataram</b>&nbsp;<i class="fa fa-university fa-fw fa-lg"></i><br/>
                                <small>Powered By : <b>Bootstrap</b> | <b>Font Awesome</b></small>
                            </p>
                        </div>
                    </div>
                </div><!--/row-->
            </div>
        </footer>


 <!-- Modal Lupa Password -->
        <div class="modal fade" id="lupaPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-power-off fa-fw fa-lg"></i> Lupa Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <fieldset>
                                <legend><i class="fa fa-pencil-square-o fa-fw fa-2x"></i> Masukkan Email Anda</legend>
                                <div class="form-group">
                                    <label for="inputNim" class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="inputNis" placeholder="nis@student.smpn1mataram.sch.id" type="text" name="email_to">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="kirim">Kirim<i class="fa fa-send fa-fw fa-lg"></i></button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- script references -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <!-- FastClick -->
        <script src='assets/js/fastclick.min.js'></script>
        <!--JS for Scroll-->
        <!--<script src="assets/js/jquery.easing.min.js" type="text/javascript"></script>-->
        <script src="assets/js/wow.min.js" type="text/javascript"></script>
        <script src="assets/js/custom.js" type="text/javascript"></script>
        <!--JS for Chart-->
        <script src="assets/js/highcharts.js" type="text/javascript"></script>
        <script src="assets/js/grid.js" type="text/javascript"></script>
        <script src="assets/js/exporting.js" type="text/javascript"></script>
        <script src="assets/js/offline-exporting.js" type="text/javascript"></script>
        <!--Fungsi untuk tultip dan menghilangkan pesan-->
        <script type="text/javascript">
            (function() {
                $('.tultip').tooltip();
                $('#pesan').fadeOut(10100);
            })();
        </script>

    </body>
</html>

 <?php
    if (isset($_POST['kirim'])) {
        include 'config/config.php';
        $m = $_POST['email_to'];
        $m_sql = mysqli_query($link, "SELECT email,username,password2 from akun where email = '$m'");
        $c_m = mysqli_num_rows($m_sql);
        if ($c_m > 0) {
            $mail_to = mysqli_fetch_assoc($m_sql);
            $rpass1 = $cipher->decrypt($mail_to['password2'], $kunci);
            $rusername = $mail_to['username'];
            $mail_from = mail_server();
            $subject = "Reset Password";
            $pesan = "<div style='margin: 20px 0; padding: 20px; border-left: 3px solid #eee;background-color: #f4f8fa; border-color: #bce8f1;'>
            <h4><strong>Hai $username</strong>, Password Anda Berhasil Dirubah</h4>
            <p>Username : $rusername</p>
            <p>Password : $rpass1</p>
        </div>";
        $message = $pesan;
        $headers = "From: $mail_from\r\n";
        $headers .= "Reply-To: $mail_from\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        if (mail($mail_to['email'], $subject, $message, $headers)) {
//        mail($mail_to['email'], $subject, 
//                "<div style='margin: 20px 0; padding: 20px; border-left: 3px solid #eee;background-color: #f4f8fa; border-color: #bce8f1;'>
//                    <h4>Password Anda Berhasil Dirubah</h4>
//                    <p>Username : $rusername</p>
//                    <p>Password : $rpass1</p>
//                  </div>", 
//                "To: $mail_to[email]\n" .
//                "From: webmaster@gmail.com>\n" .
//                "MIME-Version: 1.0\n" .
//                "Content-type: text/html; charset=iso-8859-1");
            ?>
            <!-- Modal -->
            <div class="modal fade" id="ModalCek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success fade in">
                                <h4>Sukses!</h4>
                                <p>Pemeberitahuan Pengingat Password Berhasil Terkirim.\n Silahkan Buka Email Anda</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script type="text/javascript">
                $('#ModalCek').modal('show');
            </script>
            <?php
        } else {
            ?>
            <!-- Modal -->
            <div class="modal fade" id="ModalCek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning fade in">
                                <h4>Gagal!</h4>
                                <p>Pemeberitahuan Pengingat Password Gagal Terkirim.<br/> Silahkan Cek Alamat Email Anda</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script type="text/javascript">
                $('#ModalCek').modal('show');
            </script>
            <?php
        }
    } else {
        ?>
        <!-- Modal -->
        <div class="modal fade" id="ModalCek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger fade in">
                            <h4>Gagal!</h4>
                            <p>Pemeberitahuan Pengingat Password Gagal Terkirim.<br/> Email Anda Tidak Ditemukan di Server</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script type="text/javascript">
            $('#ModalCek').modal('show');
        </script>
        <?php
    }
}