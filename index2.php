<?php
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Raport SMPN 1 Mataram</title>
    <meta name="description" content="The plugin will detect your mouse wheel and swipe gestures to determine which way the page should scroll." />
    <meta name="keywords" content="ekstrakurikuler, kegiatan ekskul mahasiswa, stmik bumigora, mataram" />
    <meta name="author" content="kemahasiswaan stmik bumigora mataram" />
    <!-- Bootstrap core CSS -->
    <link href="style/super-hero/bootstrap.css" rel="stylesheet">
    <!-- CSS Pagescroll-->
    <link rel="stylesheet" type="text/css" href="style/super-hero/onepage-scroll.css" />
    <link rel="stylesheet" href="style/super-hero/style.css">
    <!-- Custom styles for font-awesome -->
    <link rel="stylesheet" href="style/font-awesome-4.1.0/css/font-awesome.min.css">
    <!-- favicon STMIK -->
    <link rel="shortcut icon" href="style/ico/tutwuri.png">
    <!-- Custom js for page-scroll -->
    <script type="text/javascript" src="style/super-hero/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="style/super-hero/js/jquery.onepage-scroll.js"></script>
    <script type="text/javascript" src="daftar-user.js"></script>
</head>
<body>

    <header>
        <img src="style/ico/tutwuri.png" alt="logo STMIK Bumigora" width="100" height="100">
        <h1><a href="#">Penilaian Hasil Belajar Siswa</a></h1>
        <small>SMPN 1 Mataram</small>
        <a class="tultip btn btn-info" href="admin/" data-placement="left" title="" data-toggle="tooltip" data-original-title="Login Administrator" style="position:absolute; right:85px;margin-top:-10px;"><img src="style/img/admin.png" alt="logo STMIK Bumigora" width="30" height="30"></a>
        <img src="style/img/toga1.png" alt="toga" width="80" height="78" style="position:absolute; left:150px;margin-top:-19px;">
        
        <i class="fa fa-user"></i><a class="tultip btn btn-info" href="user/" data-placement="left" title="" data-toggle="tooltip" data-original-title="Login Kepsek/Wali Kelas" style="position:absolute; right:20px;margin-top:-10px;"><img src="style/img/male.png" alt="logo STMIK Bumigora" width="30" height="30"></a>
        
    </header>
    <div class="main">

        <section class="page one">
            <div class="page-container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="well">
                            <form class="form-horizontal" method="POST" action="login-siswa.php">
                                <fieldset>
                                    <legend><i class="fa fa-user fa-fw fa-2x"></i> Form Login SISWA</legend>
                                    <div class="form-group">
                                        <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="inputUsername" placeholder="Username NIS" type="text" name="user-siswa">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="pass-siswa">
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
                    </div>
                    <div class="col-md-7 col-md-offset-1">
                        <h2 style="color:#2064ff;"><i class="fa fa-key fa-fw fa-2x"></i>Login</h2>
                        <p style="color:#4e5d6c;">
                            Aplikasi ini membantu Siswa dalam Mengakses Hasil Belajar Siswa .
                        </p>
                    </div>
                </div>
                <div style="position:absolute;bottom:-200px;float:left;">
                    <footer>
                            <!-- <p style="width:100%;color:#4e5d6c;">
                                Copyright &COPY 2014 <b>STMIK Bumigora Mataram</b> <i class="fa fa-university fa-fw fa-lg"></i><br/>
                                Created By : <b><i>Rahmat Hidayat</i> & <i>Sapri</i></b> <i class="fa fa-graduation-cap fa-fw fa-lg"></i>
                            </p> -->
                        </footer>
                    </div>
                </div>
            </section>

            <section class="page two">
                <div class="page-container">
                    <div class="row">
                        <div class="col-md-4">
                            <form class="form-horizontal well" method="POST" action="daftar-baru.php">
                                <fieldset>
                                    <legend><i class="fa fa-pencil-square-o fa-fw fa-2x"></i> Daftar Akun SISWA</legend>
                                    <div class="form-group">
                                        <div class="col-lg-12" id="pesan">        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNim" class="col-lg-2 control-label">NIS</label>
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
                                        <label for="inputNama" class="col-lg-2 control-label">Nama</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="inputNama" placeholder="Nama siswa" name="nama_siswa" type="text" readonly="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="inputEmail" placeholder="Email Siswa" name="emailsiswa" type="text" readonly="" required>
                                            <input class="form-control" id="inputGender" name="gender" type="hidden" readonly="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="inputPassword" placeholder="Password" name="pass1" type="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-2 control-label">Ulangi Password</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="inputPassword2" placeholder="Ulangi Password" name="pass2" type="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="reset" class="btn btn-default"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                                            <button type="submit" class="btn btn-primary" name="s_user"><i class="fa fa-pencil-square-o fa-fw fa-lg"></i>Proses</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <!-- col-md-5-->
                        <div class="col-md-7 col-md-offset-1">
                            <h2 style="color:#2064ff;"><i class="fa fa-pencil-square-o fa-fw fa-2x"></i>Buat Akun Anda</h2>
                            <p style="color:#4e5d6c;">
                                Cukup dengan memasukkan NIS Anda & membuat Password untuk Akun yang dibuat.
                            </p>
                        </div>

                    </div>
                    <div style="position:absolute;bottom:20px;text-align:right;margin-left:900px">
                        <footer>
                            <!-- <p style="width:97%;color:white;">
                                Copyright &COPY 2014 <b>STMIK Bumigora Mataram</b> <i class="fa fa-university fa-fw fa-lg"></i><br/>
                                Created By : <b><i>Rahmat Hidayat</i> & <i>Sapri</i></b> <i class="fa fa-graduation-cap fa-fw fa-lg"></i>
                            </p> -->
                        </footer>
                    </div>
                </div>
            </section>

            
        </div>

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

        <script type="text/javascript">
            $(".main").onepage_scroll({
                sectionContainer: "section",
                easing: "cubic-bezier(0.180, 0.900, 0.410, 1.210)"
            });
        </script>
        <script type="text/javascript" src="style/super-hero/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            (function() {
                $('.tultip').tooltip();
                $('#pesan').fadeOut(8000);
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