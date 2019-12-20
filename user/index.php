<?php
//session_start();
//include("../config/config.php");
                  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Login User E-Raport</title>
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
           <script src='https://www.google.com/recaptcha/api.js'></script>
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
                <a href="../"><i class="glyphicon glyphicon-education"></i><b>E-Raport</b>User</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">- Sliahkan masuk untuk memulai aktifitas -</p>
                

                
               
                <form action="login.php" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" name="username" required=""/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <small>*Gunakan NIP Sebagai Username</small>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" required=""/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                     
                    <div class="social-auth-links text-center">
                        <button type="submit" class="btn btn-primary btn-block btn-social btn-flat" name="login"><i class="fa fa-sign-in"></i> Log In</button>
                    </div><!-- /.col -->
                </form>
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="/eraport"><button class="btn btn-block btn-success btn-flat"><i class="fa  fa-arrow-left"></i>  Kembali Ke Beranda</button></a>
                </div><!-- /.social-auth-links -->

                
                
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

