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
                    <h1 class="page-header"><i class="fa fa-comments-o fa-fw fa-lg"></i> Contact
                        <small>Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li class="active">Contact</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <!-- Content Row -->
            <div class="row">
                <!-- Map Column -->
                <div class="col-md-8">
                    <!-- Embedded Google Map -->
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.145006245167!2d116.10082451478328!3d-8.58205349383167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdc0a0ed8ffd51%3A0xfede8fa4d23fbcda!2sSekolah+Menengah+Pertama+Negeri+1+Mataram!5e0!3m2!1sid!2sid!4v1550430521533" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <!-- Contact Details Column -->
                <div class="col-md-4">
                    <h3>SMPN 1 Mataram</h3>
                    <p>
                        Pejanggik No.3, Mataram Bar., Selaparang, Kota Mataram, Nusa Tenggara Barat. 83126<br>
                    </p>
                    <p><i class="fa fa-phone"></i> 
                        <abbr title="Phone">P</abbr>: (0370) 631508 &nbsp;&nbsp;&nbsp;
                        
                    <p><i class="fa fa-envelope-o"></i> 
                        <abbr title="Email">E</abbr>: <a href="mailto:info@eraport.portofolioku.web.id">info@eraport.portofolioku.web.id</a>
                    </p>
                    <p><i class="fa fa-clock-o"></i> 
                        <abbr title="Hours">H</abbr>: Monday - Saturday: 7:30 AM to 4:30 PM</p>
                    
                </div>
            </div>
            <!-- /.row -->

            <!-- Contact Form -->
            <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
            <div class="row">
                <div class="col-md-8">
                    <h3>Send us a Message</h3>
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Full Name:</label>
                                <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Email Address:</label>
                                <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Message:</label>
                                <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary tultip" data-placement="right" title="" data-toggle="tooltip" data-original-title="Kirim Pesan Anda">Send Message &nbsp;<i class="fa fa-paper-plane fa-lg"></i></button>
                    </form>
                </div>

            </div>
            <!-- /.row -->

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <small>
                            <p class="pull-right">Copyright &COPY 2019 <b>SMPN 1 Mataram</b> <i class="fa fa-university fa-fw fa-lg"></i><br>
                                <small style="color:white;">Powered By : <b>Bootstrap</b> | <b>Font Awesome</b> | <b>JQuery</b></small>
                            </p>
                            <p class="pull-left">
                                <a href="index.php"><b>Panduan Aplikasi</b></a> | 
                                <a href="contact.php"><b>Contact</b></a> | 
                                
                            </p>
                        </small>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="../assets/js/jQuery-2.1.4.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>

        <!-- Contact Form JavaScript -->
        <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <script src="jqBootstrapValidation.js"></script>
        <script src="contact_me.js"></script>
        <script type="text/javascript">
            (function() {
                $('.tultip').tooltip();
            })();
        </script>

    </body>

</html>
