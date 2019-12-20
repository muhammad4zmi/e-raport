<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Raport SMPN 1 Mataram</title>
        <meta name="description" content="Sebuah situs Aplikasi untuk memanajemen pendataan laporan hasil belajar siswa SMPN 1 Mataram." />
        <meta name="keywords" content="laporan, Nilai Semester, Raport,Online" />
        <meta name="author" content="@muhammad4zmy" />
        <!--style bootstrap-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/animate.css">
        <!-- favicon Smp -->
        <link rel="shortcut icon" href="style/ico/tutwuri.png">
        <!-- Custom js for page-scroll -->
        <script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <header class="main-header"> 
            <nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <img src="assets/img/tutwuri.png" width="50px" height="50px" style="margin-top: 0px;" class="pull-left">
                    <a href="index.php" class="navbar-brand" style="margin-top: -10px;">
                        <b><strong>Laporan Hasil Belajar Siswa E-Raport</strong></b> <br>SMPN 1 Mataram
                    </a>
                    </div>
                </div>
            </nav>
        </header>
        <section class="container-fluid" id="section2">
            <div class="row animated fadeIn">
                <?php
                include "config/config.php";
                if (isset($_GET['akun'])) {
                    $a_akun = antiinjection($_GET['akun']);
                    $a_token = antiinjection($_GET['token']);
                    $aktif = mysqli_query($link, "UPDATE akun set status = 1 where username='$a_akun' and 
                            `password` = '$a_token'");
                    if ($aktif) {
                        ?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-check-square-o fa-lg"></i> Verifikasi Sukses . . .</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Akun Anda Berhasil di aktifkan, Silahkan lakukan proses Login Kembali.</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="index.php"><button type="button" class="btn btn-primary">Login &nbsp;<big><i class="fa fa-sign-in fa-lg"></i></big></button></a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                        <?php
                    } else {
                        ?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-times fa-lg"></i> Verifikasi Gagal . . .</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Mohon Maaf. Akun Anda Gagal di aktifkan, Silahkan Hubungi Bagian Kemahasiswaan untuk Layanan Pengaktifan Akun.</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="index.php"><button type="button" class="btn btn-primary">Kembali &nbsp;<big><i class="fa fa-sign-in fa-lg"></i></big></button></a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                        <?php
                    }
                }
                ?>
            </div>
        </section>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            (function() {
                $('.tultip').tooltip();
                $('#pesan').fadeOut(7000);
            })();
        </script>
    </body>
</html>