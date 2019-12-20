<?php
if (!isset($_SESSION['admin-username']))
    header("location:../../login.php");
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
            <small>Data Ekstrakurikuler</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Ekstrakurikuler</li>
        </ol>
    </section>
    <section class="content">
        <h3 class="page-header"><i class="fa fa-smile-o fa-fw fa-2x"></i> Halaman Ekstrakurikuler
            </h3>
        <div class="row-fluid placeholders">
            <div class="col-md-12 text-left">
                <div class="col-md-12 text-left">
                    <p>
                        <div class="btn-group">
                            <a href="#" data-toggle="modal" data-target="#Tambah"><button type="button" class="btn btn-success btn-flat">
                                <i class="fa fa-plus-circle fa-lg"></i> Tambah Data
                            </button></a>
                           
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
                    $sql_ekskul = mysqli_query($link, "SELECT * from tbl_ekskul order by id_ekskul asc");
                    $j = mysqli_num_rows($sql_ekskul);
                    if ($j > 0) {
                        ?>
                        <div class="panel panel-primary">
                            <!-- Default panel contents -->
                            <div class="panel-heading"><i class="fa fa-list fa-fw fa-2x"></i> Data Ekskul</div><br/>
                            <div class="panel-body">
                            <table id="example1" class="table table-striped table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="3%">#</th>
                                        <th width="30%">Nama Ekskul</th>
                                        
                                        
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($data_ekskul = mysqli_fetch_assoc($sql_ekskul)) {

                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data_ekskul['nama_ekskul']; ?></a></td>
                                            

                                            
                                            <td>

                                                <a href="#" class="edit-record" data-id="<?php echo $data_ekskul['id_ekskul'];?>" title="" data-original-title="">
                                                    <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                                </a>
                                                <a href="#" data-href="index.php?admin=del_ekskul&id_ekskul=<?php echo $data_ekskul['id_ekskul']; ?>" data-toggle="modal" data-target="#confirm-delete">
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

<!-- Modal Tambah Alternatif-->
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Tambah Data Ekstrakurikuler</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="?admin=add_ekskul" >
                    <fieldset>
                       <div class="form-group">
                        <label class="col-lg-3 control-label">Nama Ekstrakurikuler</label>
                        <div class="col-lg-8">
                            <input class="form-control" id="nama_mhs" type="text" name="ekskul" placeholder="Nama Ekstrakurikuler" required/>

                        </div>
                    </div>
                    
              
            

        </fieldset>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Keluar</button>
        <button type="submit" class="btn btn-primary btn-flat" name="tambah"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
    </div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Ubah Data Ekstrakurikuler</h4>
            </div>
            <div class="modal-body">

            </div>



        </div>
    </div>
</div>


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
        $.post('modules/ekskul/hasil-ekskul.php',
            {id_ekskul:$(this).attr('data-id')},

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


