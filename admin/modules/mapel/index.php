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
<br><br>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Data Mapel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Data Mapel</li>
        </ol>
    </section>
    <section class="content">
        <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Data Mata Pelajaran
            <form class="navbar-form navbar-right" method="POST" action="?admin=cari_mapel">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" name="cari" class="tultip form-control" placeholder="Cari Pelajaran..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIP">
                </div>
            </form></h3>
            <div class="row-fluid placeholders">
                <div class="col-md-12 text-left">
                    <div class="col-md-12 text-left">
                        <p>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-plus-circle fa-lg"></i> Tambah Data <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" data-toggle="modal" data-target="#Tambah"><i class="fa fa fa-book  fa-lg"></i> Data Mata Pelajaran</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#import"><i class="fa fa-upload fa-lg"></i> Import Mapel</a></li>
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
                        $jumlah_record = mysqli_query ($link,"SELECT * FROM tbl_mapel");
        //$jum = mysql_result($jumlah_record,0);
                        $jmldata    = mysqli_num_rows($jumlah_record);
                        $halaman = ceil($jmldata/$per_hal);
                        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                        $start = ($page - 1) * $per_hal;

                        $sql_mapel = mysqli_query($link, "SELECT * from tbl_mapel order by kd_mapel asc");
                        $j = mysqli_num_rows($sql_mapel);
                        if ($j > 0) {
                            ?>
                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading"><i class="fa fa fa-book  fa-fw fa-2x"></i> Data Mata Pelajaran</div>
                                <div class="panel-body">
                                <table id="example1" class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="2%">#</th>
                                            <th width="10%">Kode Mapel</th>
                                            <th width="25%">Mata Pelajaran</th>
                                            
                                            <th width="10%">KKM</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($data_mapel = mysqli_fetch_assoc($sql_mapel)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data_mapel['kd_mapel']; ?></a></td>
                                                <td><?php echo $data_mapel['nama_mapel']; ?></td>
                                               
                                                <td><?php echo $data_mapel['kkm']; ?></td>
                                                </td>
                                                
                                                <td>

                                                   <a href="#" class="edit-record" data-id="<?php echo $data_mapel['kd_mapel'];?>" title="" data-original-title="">
                                                    <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                                </a>
                                                <a href="#" data-href="?admin=del_mapel&kd_mapel=<?php echo $data_mapel['kd_mapel']; ?>" data-toggle="modal" data-target="#confirm-delete">
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
                                        Belum Ada Data Mata Pelajaran Yang di Inputkan. . .
                                    </div>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
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
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Tambah Mata Pelajaran</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="?admin=add_mapel" >
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Kode Pelajaran</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="nama_mhs" type="text" name="kd_mapel" />
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Nama Mapel</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="nama_mhs" type="text" name="mapel" />
                                    
                                </div>
                            </div>
                           <!--  <div class="form-group">
                             <label class="col-lg-3 control-label">Nip Guru</label>
                             <div class="col-lg-8">
                                <select name="nip" id="nip" multiple="multiple" style="width: 370px" class="form-control">
                                    <?php
                                    include "../../../config/config.php";
                                    $q = mysqli_query($link,"SELECT nip, nama_guru from tbl_guru");
                                    while($r = mysqli_fetch_array($q)) {
                                        ?>
                                        <option value="<?php echo $r['nip'] ?>">
                                            <?php echo $r['nip']." ".$r['nama_guru'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                       <!--  
                        <div class="form-group">
                             <label class="col-lg-3 control-label">Kelas</label>
                             <div class="col-lg-8">
                                <select name="kelas" id="kelas" multiple="multiple" style="width: 370px" class="form-control">
                                    <?php
                                    //include "../../../config/config.php";
                                    $q = mysqli_query($link,"SELECT id_kelas, kelas from tbl_kelas group by kelas");
                                    while($r = mysqli_fetch_array($q)) {
                                        ?>
                                        <option value="<?php echo $r['id_kelas'] ?>">
                                            <?php echo $r['id_kelas']." ".$r['kelas'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                         <div class="form-group">
                                <label class="col-lg-3 control-label">KKM</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="nama_mhs" type="number" name="kkm" />
                                    
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
<!--modal import siswa-->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Import Data Mata Pelajaran</h4>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" action="?admin=import_mapel" method="POST">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" name="filemapel">

                   <p class="help-block">Import File Excel Format .xls (Excel 2003)</p>
                      <small><p color="Red">*Silahkan Download Format disini <b><strong><a href="../admin/file-excel/mapel_temp1.xls"><span class="fa fa-file-excel-o fa-2x fa-fw"></span>Download File »</a></strong></b></p></small>
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

    <div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Ubah Data Pelajaran</h4>
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

    <script src="http://127.0.0.1/e-raport/admin/js/select2.js" type="text/javascript"></script>
    <script src="http://127.0.0.1/e-raport/admin/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#nip").select2({
                placeholder: 'Pilih Guru',
                allowClear: true
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#kelas").select2({
                placeholder: 'Pilih Kelas',
                allowClear: true
            });
        });
    </script>

   
    <script>
      $(function(){
        $(document).on('click','.edit-record',function(e){
            e.preventDefault();
            $("#myEdit").modal('show');
            $.post('modules/mapel/hasil.php',
                {kd_mapel:$(this).attr('data-id')},

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
 <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        
        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>