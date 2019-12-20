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
            <small>Informasi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Informasi</li>
        </ol>
    </section>
    <section class="content">
        <h3 class="page-header"><i class="fa fa-info-circle fa-fw fa-2x"></i> Halaman Informasi
           </h3>
        <div class="row-fluid placeholders">
            <div class="col-md-12 text-left">
                <div class="col-md-12 text-left">
                    <p>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-edit fa-lg"></i> Tambah Data <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="?admin=tulis_info" ><i class="fa fa-info-circle fa-lg"></i> Informasi</a></li>
                            </ul>
                        </div>
                        <br/>
                    </p>
                    <?php
                    if (isset($_SESSION['alert'])) {
                        echo $_SESSION['alert'];
                    } unset($_SESSION['alert']);
                    ?>
                    <?php
        //             $per_hal = 10;
        //             $jumlah_record = mysqli_query ($link,"SELECT * FROM tbl_guru");
        // //$jum = mysql_result($jumlah_record,0);
        //             $jmldata    = mysqli_num_rows($jumlah_record);
        //             $halaman = ceil($jmldata/$per_hal);
        //             $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        //             $start = ($page - 1) * $per_hal;
                     $sql_info = mysqli_query($link, "SELECT * from tbl_info order by tgl_post desc");
                    $j = mysqli_num_rows($sql_info);
                    if ($j > 0) {
                        ?>
                        <div class="panel panel-primary">
                            <!-- Default panel contents -->
                            <div class="panel-heading"><i class="fa fa-gears fa-fw fa-2x"></i> Setting Informasi</div><br/>
                            <div class="panel-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Informasi</th>
                                        <th>Tanggal Post</th>
                                        <th>Jenis</th>
                                        

                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($data_info = mysqli_fetch_assoc($sql_info)) {

                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data_info['judul']; ?></a></td>
                                            <td><?php echo $data_info['isi']; ?></td>
                                            
                                            <td><?php echo (DateToIndo("$data_info[tgl_post]")); ?></td>

                                            <td><?php echo $data_info['tipe']; ?></td>
                                            
                                            <td>

                                                <a href="index.php?admin=ubah_berita&id_info=<?php echo $data_info['id_info']; ?>">
                                                    <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                                </a>
                                                <a href="#" data-href="index.php?admin=del_info&id_info=<?php echo $data_info['id_info']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <button type="button" class="btn btn-danger btn-flat btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

                                                </a>


                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-dismissable alert-info">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Belum Ada Informasi Yang di Inputkan. . .
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



<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="example-modal">
       <div class="modal modal-danger">
        <div class="modal-dialog">

            <div class="modal-content">

                <!-- <div class="modal-header">
                    
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-question-circle fa-fw fa-lg"></i>Konfirmasi Hapus</h4>
                </div> -->

                <div class="modal-body">
                    <h3 align="center"><i class="fa  fa-times-circle-o fa-fw fa-4x"></i></h3>
                    <h4 align="center"><strong><p>Yakin Hapus Data ini.??</p></strong></h4>
                    <!--  <p class="debug-url"></p> -->
                </div>
                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                    <a class="btn btn-danger btn-ok" >Ya, Hapus <i class="fa fa-sign-out fa-fw fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




<script src="../js/bootstrap-transition.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script>
  $(function(){
    $(document).on('click','.edit-record',function(e){
        e.preventDefault();
        $("#myEdit").modal('show');
        $.post('modules/info/hasil.php',
            {id_info:$(this).attr('data-id')},

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
                   <script type="text/javascript">
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
</script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>

