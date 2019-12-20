<?php
if (!isset($_SESSION['admin-wali'])) {
    header("location:../../login-form.php");
}
//include "lap_kelas.php";
?>
<br><br>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Data Kelas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Data Kelas</li>
        </ol>
    </section>
    <section class="content">
 <h3 class="page-header"><i class="fa fa-bank fa-fw fa-2x"></i> Halaman Data Kelas
    <form class="navbar-form navbar-right" method="POST" action="?admin=cari_siswa">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" name="cari" class="tultip form-control" placeholder="Cari Siswa..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIS">
                </div>
            </form>
            </h3>
<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">
    <p>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-plus-circle fa-lg"></i> Tambah Data <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" data-toggle="modal" data-target="#Tambah"><i class="fa fa-bank fa-lg"></i> Data Siswa</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#import"><i class="fa fa-upload fa-lg"></i> Import Kelas</a></li>
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
                            ?>
                        
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"><i class="fa fa-bank fa-fw fa-2x"></i> 
                Data Kelas
            </div>
            <?php
                $cek_angk = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_walikelas.nip
 from tbl_kelas,tbl_walikelas where tbl_kelas.id_kelas=tbl_walikelas.id_kelas and tbl_walikelas.nip='".$_SESSION['admin-wali']."' group by 
 tbl_walikelas.kelas");
                $a_angk = mysqli_fetch_assoc($cek_angk);
                    
                   $kelas=$a_angk['kelas']; 
               
                
             
                    ?>
                    <div class="panel-body">
        <table  class="table table-striped table-hover table-condensed" id="example1">
        <thead>
            <tr>
               <th width="3%">#</th>
                                            
                <th width="10%">NIS</th>
                <th width="25%">Nama Lengkap</th>
                <th width="30%">Alamat</th>                         <!-- <th >Wali Kelas</th> -->
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql_laporan = mysqli_query($link, "SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_siswa.alamat
                from tbl_kelas INNER JOIN tbl_siswa ON tbl_kelas.nis=tbl_siswa.nis and 
                tbl_kelas.kelas='$kelas' ");
            while ($data_kelas = mysqli_fetch_assoc($sql_laporan)) {
                ?>
                 <tr>
                                                <td><?php echo $no; ?></td>
                                               
                                                <td><?php echo $data_kelas['nis']; ?></td>
                                                <td><?php echo $data_kelas['nama_lengkap']; ?></td>
                                                <td><?php echo $data_kelas['alamat'];?></td>
                                                <td>
                                                     <a href="?admin=detail_siswa&nis=<?php echo $data_kelas['nis']; ?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Siswa <?php echo $data_kelas['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                   </a>

                                                   <a href="#" class="edit-record" data-id="<?php echo $data_kelas['id_kelas'];?>" title="" data-original-title="">
                                                    <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                                </a>
                                                <a href="#" data-href="index.php?admin=del_kelas&id_kelas=<?php echo $data_kelas['id_kelas']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <button type="button" class="btn btn-danger btn-flat btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

                                                </a>
                                                
                                            </td>
                                        </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    </div>
    


 
            </div>
        </div>
    </div>
</div>
</section>
</aside>

<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Tambah Data Kelas</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="?admin=add_kelas" >
                        <fieldset>
                            <div class="form-group">
                                 <label class="col-lg-3 control-label">ID Kelas</label>
                                 <div class="col-lg-8">
                                    <select name="id_kelas"  id="kode" class="form-control">
                                     <option value=""></option>
                                        <?php
                                        include "../../../config/config.php";
                                        $q = mysqli_query($link,"SELECT * from tbl_help group by id_kelas asc");
                                        while($r = mysqli_fetch_array($q)) {
                                            ?>

                                            <option value="<?php echo $r['id_kelas'] ?>">
                                                <?php echo $r['id_kelas'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                           <label class="col-lg-3 control-label"> Kd Kelas</label>
                                           <div class="col-lg-8">
                                               
                                              <select name="kd_kelas" id="SK" class="form-control" readonly>
                                                  
                                              </select>
                                              
                                          </div>
                                      </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kelas</label>
                            <div class="col-lg-8">
                                <input class="form-control" id="kelas" type="text" name="kelas" placeholders="Kelas" required />
                                
                            </div>
                        </div>

                        <div class="form-group">
                         <label class="col-lg-3 control-label">Nis Siswa</label>
                         <div class="col-lg-8">
                            <select name="nis" id="nis" multiple="multiple" style="width: 370px" class="form-control">
                                <?php
                                include "../../../config/config.php";
                                $q = mysqli_query($link,"SELECT nis, nama_lengkap from tbl_siswa");
                                while($r = mysqli_fetch_array($q)) {
                                    ?>
                                    <option value="<?php echo $r['nis'] ?>">
                                        <?php echo $r['nis']." ".$r['nama_lengkap'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
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
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Import Data Kelas</h4>
            </div>
            <div class="modal-body">
                <form role="form">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                   <p class="help-block">Import File Excel Format .xls (Excel 2003)</p>
                      <small><p color="Red">*Silahkan Download Format disini <b><strong><a href="../admin/file/download.php"><span class="fa fa-file-excel-o fa-2x fa-fw"></span>Download File »</a></strong></b></p></small>
                </div>
                
              </div>
              <!-- /.box-body -->

               <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="tambah"><i class="fa fa-cloud-upload fa-fw fa-lg"></i> Import Data</button>
                </div>
            </form>
            </div>
            </div>
            
            
            
        </div>
    </div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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

    <div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Ubah Data Kelas</h4>
                </div>
                <div class="modal-body">

                </div>
                
                
                
            </div>
        </div>
    </div>
 <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myEdit").modal('show');
                $.post('modules/kelas/hasil.php',
                    {kode:$(this).attr('data-id')},

                    function(html){
                        $(".modal-body").html(html);
                    }   
                    );
            });
        });
        
    </script>

<script src="http://127.0.0.1/e-raport/admin/js/select2.js" type="text/javascript"></script>
    <script src="http://127.0.0.1/e-raport/admin/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#nis").select2({
                placeholder: 'Pilih Siswa',
                allowClear: true
            });
        });
    </script>
<script>
    $("#kode").change(function(){
        
        var id_md = $("#kode").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/kelas/ambil-kelas.php",
            data: "md="+id_md,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#SK").html(msg);
                    
                    
                }
            }
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

