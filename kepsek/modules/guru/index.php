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
            <small>Data Guru</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Data Guru</li>
        </ol>
    </section>
    <section class="content">
        <h3 class="page-header"><i class="fa fa-users fa-fw fa-2x"></i> Halaman Data Guru
            <form class="navbar-form navbar-right" method="POST" action="?admin=cari_guru">
             <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" name="cari" class="tultip form-control" placeholder="Cari Guru..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIP">
            </div>
        </form></h3>
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
        
                    $sql_guru = mysqli_query($link, "SELECT * from tbl_guru order by nip asc");
                    $j = mysqli_num_rows($sql_guru);
                    if ($j > 0) {
                        ?>
                        <div class="panel panel-primary">
                            <!-- Default panel contents -->
                            <div class="panel-heading"><i class="fa fa-users fa-fw fa-2x"></i> Data Guru</div><br/>
                            <div class="panel-body">
                            <table id="example1" class="table table-striped table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="20">NIP</th>
                                        <th width="20%">Nama Guru</th>
                                        <th width="12%">Jenis Kelamin</th>
                                        <th width="20%">Tanggal Lahir</th>
                                        <th width="10%">Agama</th>
                                        <th width="20%">Alamat</th>

                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($data_guru = mysqli_fetch_assoc($sql_guru)) {

                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data_guru['nip']; ?></a></td>
                                            <td><?php echo $data_guru['nama_guru']; ?></td>
                                            <td><?php echo $data_guru['jk']; ?></td>
                                            <td><?php echo (DateToIndo("$data_guru[tgl_lahir]")); ?></td>

                                            <td><?php echo $data_guru['agama']; ?></td>
                                            <td><?php echo $data_guru['alamat']; ?></td>
                                           

                                            
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-dismissable alert-info">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Belum Ada Data Guru Yang di Inputkan. . .
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






<script src="../js/bootstrap-transition.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script>
  $(function(){
    $(document).on('click','.edit-record',function(e){
        e.preventDefault();
        $("#myEdit").modal('show');
        $.post('modules/guru/hasil.php',
            {nip:$(this).attr('data-id')},

            function(html){
                $(".modal-body").html(html);
            }   
            );
    });
});

</script>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>
 <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
                    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
                    <!-- AdminLTE App -->
                    <script src="js/AdminLTE/app.js" type="text/javascript"></script>
                    <!-- AdminLTE for demo purposes -->

                    <!-- page script -->
                  <!--  <script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script> -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>


