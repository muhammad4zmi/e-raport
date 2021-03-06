<?php
if (!isset($_SESSION['admin-username']))
    header("location:../../login.php");
function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
     // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
    $BulanIndo = array("Januari", "Februari", "Maret",
       "April", "Mei", "Juni",
       "Juli", "Agustus", "September",
       "Oktober", "November", "Desember");
    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
    $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    return($result);
    
}
include "lap_user.php";
?>

<link rel="stylesheet" href="../css/datepicker/datepicker3.css">

<style>
    .datepicker{z-index:1151;}
</style>
<script>
    $(function(){
        $("#tanggal").datepicker({
            dateFormat : "dd/mm/yy",

            changeMonth : true,
            changeYear : true
        });
    });


</script>
<style>
  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
}
.example-modal .modal {
    background: transparent !important;
}
</style>
<br><br>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Pengaturan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Pengaturan</li>
        </ol>
    </section>
    <section class="content">
 <section class="content">
        <h3 class="page-header"><i class="fa fa-gear fa-fw fa-2x"></i> Halaman Pengaturan
            <form class="navbar-form navbar-right" method="POST" action="?admin=cari_guru">
             <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" name="cari" class="tultip form-control" placeholder="Cari Akun Siswa..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIS">
            </div>
        </form></h3>

<div class="row-fluid">
    <div class="col-md-offset-2 col-md-7">
        <?php
        if (isset($_SESSION['alert'])) {
            echo $_SESSION['alert'];
        } unset($_SESSION['alert']);
        ?>
    </div>
</div>
<div class="col-md-8 text-left">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"><i class="fa fa-users fa-fw fa-2x"></i> 
                Data Akun Siswa
            </div>
            <div class="panel-body">
                <table id="example1" class='table table-striped'>
                    <thead>
                        <tr style="font-size:small;">
                            <td><b><i class='icon-file icon-white'></i></b></td>
                            <td><b><i class='icon-user icon-white'></i>Username</b></td>
                            <td><b><i class='icon-barcode icon-white'></i>Email</b></td>
                            <td><b><i class='icon-barcode icon-white'></i>NIS</b></td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <?php
                    $query = "select akun.username,akun.email,akun.password,tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_siswa.nisn,tbl_siswa.alamat,
                    tbl_kelas.kelas,akun.status FROM akun,tbl_kelas,tbl_siswa
                    where tbl_siswa.nis=akun.nis group by tbl_siswa.nis";
                    $hasil = mysqli_query($link, $query);
                    $num = mysqli_num_rows($hasil);
                    $id = 1;
                    while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                        <tr <?php echo ($data['status'] != 1) ? "class='danger'" : "class='success'"; ?> style="font-size:small;">
                            <td><?php echo $id; ?></td>
                            <td><?php echo $data['username']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><a class="btn <?php echo ($data['status'] != 1) ? "btn-danger" : "btn-success"; ?> btn-xs" data-toggle="modal" data-target="#<?php echo $data['nis']; ?>"><?php echo $data['nis']; ?></a></td>
                        <div class="modal fade" id="<?php echo $data['nis']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Identitas Siswa <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                                            <div class="panel-body">
                                                NISN     : <?php echo $data['nisn']; ?><br/>
                                                Nama     : <?php echo $data['nama_lengkap']; ?><br/>
                                                Kelas    : <?php echo $data['kelas']; ?><br/>
                                                Alamat   : <?php echo $data['alamat']; ?><br/>
                                                
                                                Password : <?php echo $data['password']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <td>
                            <a href="?admin=hapus_akun&id_user=<?php echo $data['nis']; ?>" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Hapus :  <?php echo $data['nama_lengkap']; ?>" onclick="return confirm('Anda yakin menghapus Akun dengan Nama <?php echo $data['nama_lengkap']; ?> ?');">
                                <i class='fa fa-trash-o fa-lg'></i>
                            </a>&nbsp;
                            <a href="?admin=reset_akun&id_user=<?php echo $data['username']; ?>" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Reset Password" onclick="return confirm('Anda yakin ingin reset password Akun dengan Nama <?php echo $data['nama_lengkap']; ?> ?');">
                                <i class='fa fa-refresh fa-lg'></i>
                            </a>
                            <?php if ($data['status'] != 1) { ?>
                                &nbsp;<a href="?admin=aktivasi&id_user=<?php echo $data['username']; ?>" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Aktifkan Akun" onclick="return confirm('Anda yakin ingin mengaktifkan Akun dengan Nama <?php echo $data['nama_lengkap']; ?> ?');">
                                    <i class='fa fa-unlock-alt fa-lg'></i>
                                </a> 
                            </td>
                            <?php
                        }
                        $id++;
                    }
                    ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 text-left">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-cogs fa-2x"></i> Manajemen Akun Administrator</div>
            <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed btn">
                                    <i class="fa fa-refresh fa-lg"></i> Ubah Email
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                            <?php
                            $q_akun = mysqli_query($link, "SELECT email from admin where username = '" . $_SESSION['admin-username'] . "'");
                            $dt = mysqli_fetch_assoc($q_akun);
                            ?>
                            <div class="panel-body">
                                <form role="form" action="?admin=ubah_admin_email" method="POST">
                                    <div class="form-group">
                                        <label>Email Lama</label>
                                        <input type="email" class="form-control" value="<?php echo $dt['email']; ?>" name="email_lama" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Perubahan</label>
                                        <input type="email" class="form-control" placeholder="Email Baru" name="email_baru" required="">
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="ubah_email"><i class="fa fa-check-square-o"></i> Ubah Email</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed btn">
                                    <i class="fa fa-unlock-alt fa-lg"></i> Ubah Password
                                </a>
                            </h4>
                        </div>
                        
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalEmail">
                                    Ganti Password <strong><?php echo $_SESSION['admin-username'];?></strong> <i class="fa fa-edit fa-fw fa-lg"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o fa-fw fa-lg"></i> Ubah Password</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" method="POST" action="?admin=ubah_pass">
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <label for="inputNim" class="col-lg-4 control-label">Password Lama</label>
                                                            <div class="col-lg-7">
                                                                <input class="form-control" id="inputNim" type="password" name="pass_lama">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputNim" class="col-lg-4 control-label">Password Baru</label>
                                                            <div class="col-lg-7">
                                                                <input class="form-control" id="inputNim" type="password" name="pass_baru">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputNim" class="col-lg-4 control-label">Ulangi Password Baru</label>
                                                            <div class="col-lg-7">
                                                                <input class="form-control" id="inputNim" type="password" name="ulangi_pass">
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar <i class="fa fa-times fa-fw fa-lg"></i></button>
                                                            <button type="submit" class="btn btn-success" name="ubah_p">Ubah Password <i class="fa fa-refresh fa-fw fa-lg"></i></button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     </section>
</aside>


<div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock fa-fw fa-lg"></i> Ubah reCaptcha</h4>
                </div>
                <div class="modal-body">

                </div>
                
                
                
            </div>
        </div>
    </div>


    <script>
  $(function(){
    $(document).on('click','.edit-record',function(e){
        e.preventDefault();
        $("#myEdit").modal('show');
        $.post('modules/pengaturan/hasil.php',
            {id:$(this).attr('data-id')},

            function(html){
                $(".modal-body").html(html);
            }   
            );
    });
});

</script>
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
                    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
                    <!-- AdminLTE App -->
                    <script src="js/AdminLTE/app.js" type="text/javascript"></script>
                    
                    <!-- AdminLTE for demo purposes -->

                    <!-- page script -->
                   <script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>