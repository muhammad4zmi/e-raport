<?php
if (!isset($_SESSION['admin-kepsek'])){
    header("location:../user/index.php");
  
}
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
<br><br>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Data Siswa</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Data Siswa</li>
        </ol>
    </section>
    <section class="content">
        <h4 class="page-header"><i class="fa fa-users fa-fw fa-2x"></i> Halaman Data Siswa
            <form class="navbar-form navbar-right" method="POST" action="?admin=cari_siswa">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" name="cari" class="tultip form-control" placeholder="Cari Siswa..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIS">
                </div>
            </form></h4>
            <div class="row-fluid placeholders">
                <div class="col-md-12 text-left">
                    <div class="col-md-12 text-left">
                        <p>
                            
                            <br/>
                        </p>
                        <?php
                        if (isset($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } unset($_SESSION['alert']);
                        ?>
                        <?php
                        $per_hal = 10;
        //                 $jumlah_record = mysqli_query ($link,"SELECT * FROM tbl_siswa");
        // //$jum = mysql_result($jumlah_record,0);
        //                 $jmldata    = mysqli_num_rows($jumlah_record);
        //                 $halaman = ceil($jmldata/$per_hal);
        //                 $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        //                 $start = ($page - 1) * $per_hal;
                        $sql_siswa = mysqli_query($link, "SELECT * from tbl_siswa order by nis asc ");
                        $j = mysqli_num_rows($sql_siswa);
                        if ($j > 0) {
                            ?>
                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading"><i class="fa fa-users fa-fw fa-2x"></i> Data Siswa</div>
                                <div class="panel-body">
                                <table id="example1" class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="10">NIS</th>
                                            <th width="10">NISN</th>
                                            <th width="20%">Nama Lengkap</th>
                                            <th width="10%">Kelamin</th>
                                            <th width="15%">Tgl Lahir</th>
                                            <th width="10%">Agama</th>
                                            <th width="20%">Alamat</th>
                                            <th width="10%">Telpon</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($data_siswa = mysqli_fetch_assoc($sql_siswa)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data_siswa['nis']; ?></a></td>
                                                <td><?php echo $data_siswa['nisn']; ?></a></td>
                                                <td><?php echo $data_siswa['nama_lengkap']; ?></a></td>
                                                <td><?php echo $data_siswa['jk']; ?></a></td>
                                                <td><?php echo (DateToIndo("$data_siswa[tgl_lahir]")); ?></td>
                                                <td><?php echo $data_siswa['agama']; ?></a></td>
                                                <td><?php echo $data_siswa['alamat']; ?></td>
                                                <td><?php echo $data_siswa['telpon']; ?></td>
                                                
                                                
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-dismissable alert-info">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Belum Ada Data Siswa Yang di Inputkan. . .
                                    </div>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>









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

   