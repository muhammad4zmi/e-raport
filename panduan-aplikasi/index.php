<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="description" content="Sebuah situs Aplikasi untuk memanajemen pendataan laporan hasil belajar siswa SMPN 1 Mataram." />
        <meta name="keywords" content="laporan, Nilai Semester, Raport,Online" />
       
        <meta name="author" content="SMPN 1 Mataram" />

        <title>E-Raport SMPN 1 Mataram</title>

        <!-- Bootstrap Core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <!--<link href="../assets/css/AdminLTE.min.css" rel="stylesheet">-->

        <!-- Custom CSS -->
        <link href="modern-business.css" rel="stylesheet">
        <!-- favicon STMIK -->
        <link rel="shortcut icon" href="../style/ico/tutwuri.png">
        <!-- Custom Fonts -->
        <link href="../assets/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><span class="fa fa-graduation-cap fa-lg fa-fw"></span> E-Raport SMPN 1 Mataram</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li>
                            <a href="contact.php"><span class="fa fa-comments-o fa-lg fa-fw"></span> Contact</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-thumbs-o-up fa-lg fa-fw"></span> Mulai <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="../index.php#section2"><span class="fa fa-sign-in fa-lg fa-fw"></span> Login</a>
                                </li>
                                <li>
                                    <a href="../index.php#section3"><span class="fa fa-group fa-lg fa-fw"></span> Daftar Akun</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">

            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span class="fa fa-paste fa-lg fa-fw"></span> Panduan
                        <small>Aplikasi</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Beranda</a>
                        </li>
                        <?php
                        if (empty($_GET['panduan']))
                            echo "<li class=\"active\">Panduan Aplikasi</li>";
                        else if ($_GET['panduan'] == 'daftar')
                            echo "<li class=\"active\">Membuat Akun Baru</li>";
                        else if ($_GET['panduan'] == 'view-raport')
                            echo "<li class=\"active\">Melihat dan Mencetak Raport</li>";
                        else if ($_GET['panduan'] == 'faq')
                            echo "<li class=\"active\">FAQ</li>";
                        ?>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <!-- Content Row -->
            <div class="row">
                <!-- Sidebar Column -->
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="?panduan=daftar" class="list-group-item <?php echo ($_GET['panduan'] == 'daftar') ? 'active' : ''; ?>"><span class="fa fa-pencil-square-o fa-lg fa-fw"></span> Membuat Akun Baru</a>
                        <a href="?panduan=view-raport" class="list-group-item <?php echo ($_GET['panduan'] == 'view-raport') ? 'active' : ''; ?>"><span class="fa fa-eye fa-lg fa-fw"></span> Melihat dan Mencetak Raport</a>
                        <a href="?panduan=faq" class="list-group-item <?php echo ($_GET['panduan'] == 'faq') ? 'active' : ''; ?>"><span class="fa fa-bullhorn fa-lg fa-fw"></span> FAQ</a>
                    </div>
                </div>
                <!-- Content Column -->
                <div class="col-md-9">
                    <?php
                    if (isset($_GET['panduan'])) {
                        $page = $_GET['panduan'];
                        $module = $page;
                    } else {
                        $module = "";
                    }
                    switch ($module) {
                        //------------Route Untuk Halaman Beranda------------//
                        case '':
                            require("front.php");
                            break;
                        case 'daftar':
                            require("buat-akun.php");
                            break;
                        case 'view-raport': case '':
                            require("view_raport.php");
                            break;
                        case 'faq': case '':
                            require("frequently.php");
                            break;
                        default :
                            require("404.php");
                            break;
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->

            <hr>

            <!-- Footer -->
            <footer>
                <small>
                    <p class="pull-right">Copyright &COPY 2019 <b>SMPN 1 Mataram</b> <i class="fa fa-university fa-fw fa-lg"></i><br>
                        <small style="color:white;">Powered By : <b>Bootstrap</b> | <b>Font Awesome</b> | <b>JQuery</b></small>
                    </p>
                    <p class="pull-left">
                        <a href="index.php"><b>Panduan Aplikasi</b></a> | 
                        <a href="contact.php"><b>Contact</b></a> | 
                       
                    </p>
                </small>
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="../assets/js/jquery-1.11.3.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>

    </body>

</html>
