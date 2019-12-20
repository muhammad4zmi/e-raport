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
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa  fa-plus-circle fa-lg"></i> Tambah Data <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="?admin=form_siswa"><i class="fa fa-user fa-lg"></i> Data Siswa</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#import"><i class="fa fa-upload fa-lg"></i> Upload Data Siswa</a></li>

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
                                            
                                            <th width="15%">Aksi</th>
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
                                                
                                                <td>
                                                    <a href="?admin=detail_siswa&nis=<?php echo $data_siswa['nis']; ?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Siswa <?php echo $data_siswa['nis']?>">
                                                       <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                   </a>

                                                   <a href="?admin=form_ubah&nis=<?php echo $data_siswa['nis']; ?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Ubah Siswa <?php echo $data_siswa['nis']?>">
                                                       <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                                   </a>
                                                   <a href="#" data-href="?admin=del_siswa&nis=<?php echo $data_siswa['nis']; ?>" data-toggle="modal" data-target="#confirm-delete">
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
                                        Belum Ada Data Siswa Yang di Inputkan. . .
                                    </div>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        <!-- <nav>
                            <ul class="pagination">

                                <li class="disabled"><a href="?admin=dt_siswa&page=<?php echo $page -1 ?>" aria-label="Previous"> <span aria-hidden="true">«</span></a></li>
                            </ul>
                            <?php 
                            //for($x=1;$x<=$halaman;$x++)
                            {
                                ?>
                                <ul class="pagination">
                                    <li class="active"><a href="?admin=dt_siswa&page=<?php echo $x ?>"><?php echo $x ?><span class="sr-only">(current)</span></a></li>
                                </ul>
                                <?php
                            }
                            ?>
                            <ul class="pagination">
                                <li><a href="?admin=dt_siswa&page=<?php echo $page +1 ?>" aria-label="Next"> <span aria-hidden="true">»</span></a></li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>

<!--modal import siswa-->
<!--modal import siswa-->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Import Data Siswa</h4>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" action="?admin=import_siswa" method="POST">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" name="filesiswa">

                   <p class="help-block">Import File Excel Format .xls (Excel 2003)</p>
                      <small><p color="Red">*Silahkan Download Format disini <b><strong><a href="../admin/file-excel/siswa_temp.xls"><span class="fa fa-file-excel-o fa-2x fa-fw"></span>Download File »</a></strong></b></p></small>
                </div>
                
              </div>
              <!-- /.box-body -->

               <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="upload"><i class="fa fa-cloud-upload fa-fw fa-lg"></i> Import Data</button>
                </div>
            </form>
            </div>
            </div>
            
            
            
        </div>
    </div>

<!-- Modal Tambah Alternatif-->
<div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Ubah Data Siswa</h4>
            </div>
            <div class="modal-body">
               
            </div>
            
            
            
        </div>
    </div>
</div>




<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
                
                
                <div class="modal-body">
                    <h3 align="center"><i class="fa  fa-times-circle-o fa-fw fa-4x"></i></h3>
                    <h4 align="center"><strong><p>Yakin Hapus Data ini.??</p></strong></h4>
                    <!--  <p class="debug-url"></p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                    <a class="btn btn-danger btn-ok btn-flat" >Ya, Hapus <i class="fa fa-sign-out fa-fw fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
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

    <script src="../js/bootstrap-transition.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script>
      $(function(){
        $(document).on('click','.edit-record',function(e){
            e.preventDefault();
            $("#myEdit").modal('show');
            $.post('modules/siswa/hasil.php',
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