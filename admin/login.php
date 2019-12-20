<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Login Admin E-Raport</title>
        <meta name="description" content="Sebuah situs Aplikasi laporan hasil belajar siswa." />
        <meta name="keywords" content="e-raport, Permilaian, login, login admin" />
        <meta name="author" content="@elmasrul" />
        <!-- Bootstrap 3.3.4 -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="../assets/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../assets/css/animate.css" />
          <link rel="shortcut icon" href="../style/ico/tutwuri.png">
        <!-- iCheck -->
        <!--<link href="../../plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div id="overlay"></div>
        <div class="login-box">
            <div class="login-logo">
                <a href="../"><i class="glyphicon glyphicon-education"></i><b>E-Raport</b>Admin</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">- Sliahkan masuk untuk memulai aktifitas -</p>
                <?php
                if (isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } unset($_SESSION['alert']);
                ?>
                <form action="login-admin.php" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" name="user-admin" required=""/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="pass-admin" required=""/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="social-auth-links text-center">
                        <button type="submit" class="btn btn-primary btn-block btn-social btn-flat"><i class="fa fa-sign-in"></i> Log In</button>
                    </div><!-- /.col -->
                </form>
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <button type="button" data-toggle="collapse" data-target="#forgot" class="btn btn-block btn-social btn-danger btn-flat"><i class="fa fa-envelope-o"></i> Lupa Password?</button>
                </div><!-- /.social-auth-links -->
                <div class="collapse" id="forgot">
                    <div class="well">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email Administrator" name="email_to" title="Gunakan Email Admin" required=""/>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-danger btn-flat tultip" value="Kirim Konfirmasi" name="forgot_pass" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Kirim"><i class="fa fa-send-o"></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                    </div>
                </div>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="../assets/js/jquery-1.11.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <!--<script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>-->
<!--        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>-->
        <script type="text/javascript">
            (function() {
                $('#pesan').fadeOut(7000);
                $('.tultip').tooltip();
            })();
        </script>
    </body>
</html>

<?php
if (isset($_POST['forgot_pass']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../config/config.php';
    $m = $_POST['email_to'];
    $m_sql = mysqli_query($link, "SELECT email,username,pass2 from admin where email = '$m'");
    $c_m = mysqli_num_rows($m_sql);
    if ($c_m > 0) {
        $mail_to = mysqli_fetch_assoc($m_sql);
        $rpass1 = $cipher->decrypt($mail_to['pass2'], $kunci);
        $rusername = $mail_to['username'];
        $mail_from = mail_server();
        $subject = "Permintaan Perubahan Password Admin";
        $pesan = "<div style='margin: 20px 0; padding: 20px; border-left: 3px solid #eee;background-color: #f4f8fa; border-color: #bce8f1;'>
                    <h4><strong>Hai $username</strong>, Password Anda Berhasil Dirubah</h4>
                    <p>Silahkan Login menggunakan Username dan Password dibawah ini :</p>
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
            $alert = "<div class=\"alert alert-success\" id='pesan'>
                     <strong>Berhasil!</strong><br/> Permintaan Perubahan Password Berhasil Terkirim Ke Email Anda.
                  </div>";
            $_SESSION['alert'] = $alert;
        } else {
            $alert = "<div class=\"alert alert-danger\" id='pesan'>
                     <strong>Gagal!</strong><br/> Permintaan Perubahan Password Gagal Terkirim Ke Email Anda.
                  </div>";
            $_SESSION['alert'] = $alert;
        }
    } else {
        $alert = "<div class=\"alert alert-warning\" id='pesan'>
                     <strong>Gagal!</strong><br/> Email Anda Tidak Ditemukan Di Server.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
    ?>
    <script>
        window.location = "login.php";
    </script>
    <?php
}