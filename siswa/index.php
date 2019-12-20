<?php
session_start();
//cek session untuk Admin
include "cek_login.php";
include "../config/config.php";
//connectToDB(); //fungsi koneksi ke database
if (isset($_GET['siswa']))
    $menu = antiinjection ($_GET['siswa']);
else
    $menu = "";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Aplikasi Penilaian Hasil Belajar Siswa">
        <meta name="author" content="el_masrul">

        <title>E-Raport SMPN 1 Mataram</title>

        <!-- Bootstrap core CSS -->
        <!-- <link href="../style/super-hero/bootstrap.css" rel="stylesheet"> -->
        <!-- Custom styles for this template -->
        <!-- <link href="../style/super-hero/dashboard.css" rel="stylesheet"> -->
        <!-- Custom styles for font-awesome -->
        <!-- <link rel="stylesheet" href="../style/font-awesome-4.1.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="../style/ico/tutwuri.png">
        <script src="../style/super-hero/js/jquery-1.9.1.js"></script>
        <script src="../style/super-hero/js/jquery.form.js"></script> -->
         <link href="../assets/css/bootstrap-cerulean.css" rel="stylesheet">
        <link href="../assets/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../assets/super-hero/dashboard.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">
        
        <script src="../assets/js/jquery-1.11.3.min.js"></script>
        <script src="../assets/js/jquery.form.js"></script>
        <link rel="shortcut icon" href="../style/ico/tutwuri.png">
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" style="font-family:'Century Gothic';font-size:20px;letter-spacing:-1px;"><i class="fa fa-file-text-o fa-fw "></i> Penilaian Hasil Belajar (E-Raport) SMPN 1 Mataram</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <?php if (isset($_SESSION['jk']) == 'L') { ?>
                                    <img src="../style/img/male.png" width="23px" height="23px"/>
                                <?php } else { ?>
                                    <img src="../style/img/female.png" width="23px" height="23px"/>
<?php } ?>
                                <b><?php echo $_SESSION['nama_siswa']; ?></b>
                            </a>
                        </li>
                        <li class="dropdown">
<?php //include "modules/beranda/pemberitahuan.php"; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!--Bagian Kiri-->
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar nav-stacked">
                        <li <?php echo ($menu == 'beranda' or $menu == '') ? "class=\"active\"" : ""; ?>><a href="index.php?siswa=beranda"><i class="fa fa-home fa-fw fa-2x"></i> Beranda</a></li>
                        <li <?php echo ($menu == 'profil') ? "class=\"active\"" : ""; ?>><a href="index.php?siswa=profil"><i class="fa fa-user fa-fw fa-2x"></i> Profil</a></li>
                        <li <?php echo ($menu == 'laporan') ? "class=\"active\"" : ""; ?>><a href="index.php?siswa=laporan"><i class="fa fa-list-ol fa-fw fa-2x"></i> Laporan Hasil Belajar</a></li>
                        <li <?php echo ($menu == 'pengaturan') ? "class=\"active\"" : ""; ?>><a href="index.php?siswa=pengaturan"><i class="fa fa-gears fa-fw fa-2x"></i> Pengaturan</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#keluarModal"><i class="fa fa-sign-out fa-fw fa-2x"></i> Logout</a></li>
                    </ul>
                </div>
                <!--Batas Bagian Kiri-->
                <!--Bagian Kanan-->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <!-- <div class="jumbotron effect2">
                        <img src="../style/ico/tutwuri.png" width="120px" height="120px" align="left" style="position:static;margin-top:10px;">
                        <h2 style="color:white;font-size:37px;font-weight:bolder;text-shadow: 1px 3px 4px black;margin-left:130px;font-family:Impact;">Penilaian Hasil Belajar Siswa (E-Raport)</h2>
                        <p style="line-height:19px; letter-spacing:10px;margin-left:130px;font-family:'Century Gothic';">SMPN 1 Mataram</p>
                        <address style="line-height:19px;margin-left:130px;font-family:Calibri;">JL.Mataram, <i>Telp. 0370-634498; Fax. 0370-638369</i></address>
                    </div> -->
<?php include "modules/load-modules.php"; ?>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <small>
                    <p align="right">Copyright &COPY 2016 <b>SMPN 1 Mataram</b> <i class="fa fa-university fa-fw fa-lg"></i></p>
                    <p align="right">Created By : <b><i>Anonymous</i></b> <i class="fa fa-graduation-cap fa-fw fa-lg"></i></p>
                </small>
            </div>
        </footer>

        <!-- Modal -->
        <div class="modal fade" id="keluarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                        Anda Yakin ingin Keluar dari Aplikasi ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a href="../logout.php" type="button" class="btn btn-primary"><i class="fa fa-sign-out fa-fw fa-lg"></i>Ya, Keluar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../style/super-hero/js/bootstrap.min.js"></script>
        <script src="../style/super-hero/js/docs.min.js"></script>
         <script src="assets/libs/jquery-wizard/jquery.easyWizard.js"></script>
    <script src="assets/js/form-wizard.js"></script>
        <script type="text/javascript">
            (function() {
                $('.tultip').tooltip();
            })();
        </script>
    </body>
</html>
