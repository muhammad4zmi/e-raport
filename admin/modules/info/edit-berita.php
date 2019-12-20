<?php

$id_info=$_GET['id_info'];
$sql_info = mysqli_query($link,"SELECT * from tbl_info where id_info='$id_info'");
$j = mysqli_fetch_array($sql_info);

?>
<!DOCTYPE html>
<html>
<head>
 <title></title>




 <link rel="stylesheet" href="../css/datepicker/datepicker3.css">
 <style>
  .datepicker{z-index:1151;}
</style>
<script>
  $(function(){
    $("#tgl").datepicker({
      dateFormat : "dd/mm/yy",

      changeMonth : true,
      changeYear : true
    });
  });


</script>

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">

        <h3 class="page-header"><i class="fa fa-home fa-fw"></i>Selamat Datang Admin</h3>
        <div class="row placeholders">
            <div class="col-md-12 " align="left">
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="fa  fa-hand-o-right fa-fw fa-2x"></i> Tulis Informasi</div>
                    <div class="panel-body">
                     <form role="form" method="POST" action="?admin=ubah_info">
              <div class="box-body">
                <div class="form-group">
                  <label>Judul Info</label>
                  <input type="hidden" class="form-control"  name="id_info" value="<?php echo $j['id_info'];?>">
                  <input type="text" class="form-control"  name="judul" value="<?php echo $j['judul'];?>">
                </div>
                <div class="form-group">
                  <label>Isi Informasi</label>
                  <textarea id="editor1" name="editor1" rows="10" cols="80">
                   <?php echo $j['isi']?>
                    </textarea>
                                           
                </div>
              
                     <div class="form-group">
                  <label>Tanggal Post</label>
                         <input class="form-control" type="date" name="tgl_post" value="<?php echo $j['tgl_post']?>" required/>

                    </div>
               
                <div class="form-group">
                   <label>Jenis Info</label>
                   
                    <select name ="jenis" id="jenjang" class="form-control">
                        <option>Pilih Jenis</option>
                        <option value="Pengumuman" <?php echo ($j['tipe'] == "Pengumuman") ? 'selected' : ''; ?>>Pengumuman</option>
                <option value="Sambutan" <?php echo ($j['tipe'] == "Sambutan") ? 'selected' : ''; ?>>Sambutan</option>
                        

                    </select>
                
            </div>
                
              </div>
              <!-- /.box-body -->

              
                

       
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Keluar</button>
        <button type="submit" class="btn btn-primary btn-flat" name="ubah_info"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
    </div>
</form>
                   
               </div>  
               
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
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
<script src="modules/info/ckeditor/ckeditor.js"></script>
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


