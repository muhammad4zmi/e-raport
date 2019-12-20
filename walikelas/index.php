<?php
session_start();
//cek session untuk Admin
//include "cek_login.php";
include "../config/config.php";
//connectToDB(); //fungsi koneksi ke database
if (isset($_GET['wali'])) {
    $menu = antiinjection($_GET['wali']);
} else {
    $menu = '';
}
 $cek_user = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_walikelas.id_wali,
tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru,tbl_guru.jk from tbl_kelas,tbl_walikelas,
tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas and tbl_walikelas.nip=tbl_guru.nip and tbl_walikelas.nip='" . $_SESSION['admin-wali'] . "'");
$hasil=mysqli_fetch_array($cek_user);
$nama_guru = $hasil['nama_guru'];
$nip = $hasil['nip'];
$kelas = $hasil['kelas'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="refresh" content="20; url=<?php $_SERVER['PHP_SELF']; ?>">-->
    <title>E-Raport SMPN 1 Mataram | Wali Kelas</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="css/ionicons.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="css/iCheck/flat/flat.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <link href="css/select2.css" rel="stylesheet"  type="text/css"/>
    <link href="css/select2.min.css" rel="stylesheet" type="text/css"/>
    <!-- favicon STMIK -->
    <link rel="shortcut icon" href="style/ico/tutwuri.png">
       <!--   <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> 
        <link href="assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />
        <!-- Code Highlighter for Demo -->
        
        
        <!-- Extra CSS Libraries Start -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/costum.css" rel="stylesheet" type="text/css" />
      <!--   <link href="assets/css/style-responsive.css" rel="stylesheet" />
         
      <!-- Custom js for page-scroll -->
      <script type="text/javascript" src="style/super-hero/js/jquery-1.9.1.js"></script>
      <script type="text/javascript" src="style/super-hero/js/jquery.onepage-scroll.js"></script>
      <script type="text/javascript" src="rapot.js"></script>

      <script src="add-master.js"></script>
      <script src="cek_nomer.js"></script>
      <script src ="modules/mod_ortu/coba.js"></script>
      <script src="js/jquery.min.js"></script>
      
      
      
      <!--<script src="js/bootstrap.js"></script>-->
      <script src="js/jquery.js"></script>
      
      <script>

        /*autocomplete muncul setelah user mengetikan minimal2 karakter */
        $(function() {
            $("#mahasiswa").autocomplete({
                source: "source.php",
                minLength: 2,
            });
        });
    </script>

    <script src="js/jquery-ui.min.js"></script>

    <script src="js/bootstrap.min.js" type="text/javascript"></script>


    
</head>
<body class="skin-blue fixed">
    <?php
        //include_once ('./config/koneksi.php');
    ?>
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="index.php" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->

            <span class="fa fa-graduation-cap"></span>
            E-Raport Online
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="done tasks-menu">
                        <a href="#" >
                            <strong>Laporan Hasil Belajar Siswa (Raport Online)</strong>
                            <span>SMPN 1 Mataram</span>
                        </a>
                    </li>
                    
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-warning"></i>
                            <span class="label label-warning"></span>
                        </a>
                       
                    </li>
                    
                    
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span> User <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                 <?php if ($hasil['jk'] == 'Laki-Laki') { ?>
                                    <img src="img/male.png" class="img-circle" alt="User Image" />
                                <?php } else { ?>
                                    <img src="img/female.png" class="img-circle" alt="User Image" / >
                                    <?php } ?>
                                <p>
                                    <?php echo $nama_guru; ?>
                                    <small><?php echo $_SESSION['jabatan']?><br/><?php echo $kelas;?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <!-- <div class="pull-left">
                                    <a href="index.php?modul=profil" class="btn btn-default btn-flat"><i class="fa fa-user"> Profil</i></a>
                                </div> -->
                                <div class="pull-right">
                                    <a href="#" data-toggle="modal" data-target="#keluarModal" class="btn btn-default btn-flat"><i class="fa fa-power-off"> Logout</i></a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php
    include "load-modules.php";
    ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <?php if ($hasil['jk'] == 'Laki-Laki') { ?>
                                    <img src="img/male.png" class="img-circle" alt="User Image" / >
                                <?php } else { ?>
                                    <img src="img/female.png" class="img-circle" alt="User Image" />
                                    <?php } ?>
                                
                    </div>
                    <div class="pull-left info">
                        <p>
                                    <?php echo $nama_guru; ?><br/>
                                    <small><?php echo $_SESSION['jabatan']?> <?php echo $kelas;?></small>
                                </p>
                        
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a><br/><br/>
                        <p> <?php //echo $online;?>
                        </div>
                    </div>
                    <!-- search form -->
                    
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php">
                                <i class="fa fa-home"></i> <span>Beranda</span>
                            </a>
                        </li>
                       

                     <li class="active">
                        <a href="?admin=dt_kelas">
                            <i class="fa fa-users fa-fw"></i> <span>Daftar Siswa</span>
                        </a>
                    </li>
                    
                    
                    <li class="active">
                        <a href="?admin=nilai">
                            <i class="fa fa-list-ol fa-fw"></i> <span>Nilai</span>
                        </a>
                    </li>
                     <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book fa-fw"></i>
                            <span>Raport</span> 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="?admin=leger"><i class="fa fa-circle-o"></i> Leger</a></li>
                        <li><a href="?admin=raport">
                            <i class="fa fa-circle-o"></i> <span>Nilai Raport</span>
                        </a>
                    </li>
                </ul>
            </li>
                    
                   
                    <li class="active">
                        <a href="#"  data-toggle="modal" data-target="#keluarModal">
                            <i class="fa fa-power-off"></i> <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </section>
            
        </aside>

    </div><!-- ./wrapper -->

    <!--modal keluar-->
    <div class="modal fade" id="keluarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-power-off fa-fw fa-lg"></i> Konfirmasi</h4>
                </div>
                <div class="modal-body">
                    Anda Yakin ingin Keluar dari Aplikasi ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a href="logout-wali.php" type="button" class="btn btn-primary">Ya, Keluar <i class="fa fa-sign-out fa-fw fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/AdminLTE/app.js" type="text/javascript"></script>
    
    
    <!-- Page Specific JS Libraries -->
    <script src="assets/libs/jquery-wizard/jquery.easyWizard.js"></script>
    <script src="assets/js/form-wizard.js"></script>
    
    

</body>
</html>
