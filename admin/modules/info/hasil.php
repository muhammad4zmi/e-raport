<?php
include "../../../config/config.php";

$sql_info = mysqli_query($link,"SELECT * from tbl_info where id_info='".$_POST['id_info']."'");
$j = mysqli_fetch_array($sql_info);

?>
<!DOCTYPE html>
<html>
<head>
 <title></title>




 <link rel="stylesheet" href="http://localhost/e-raport/admin/css/datepicker/datepicker3.css">
 <link href="http://127.0.0.1/e-raport/admin/modules/mapel/select2.css" rel="stylesheet"  type="text/css"/>
 <link href="http://127.0.0.1/e-raport/admin/modules/mapel/select2.min.css" rel="stylesheet" type="text/css"/>
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
</head>
<body>
 <form role="form" method="POST" action="?admin=ubah_info">
              <div class="box-body">
                <div class="form-group">
                  <label>Judul Info</label>
                  <input type="text" class="form-control"  name="judul" value="<?php echo $j['judul'];?>">
                </div>
                <div class="form-group">
                  <label>Isi</label>
                  <textarea class="form-control" rows="3" name="editor1"><?php echo $j['isi']?></textarea>
                </div>
              
                     <div class="form-group">
                  <label>Tanggal Post</label>
                        <input class="form-control"  id="tanggal" type="text" name="tgl_post" value="<?php echo $j['tgl_post']?>" required/>

                    </div>
               
                <div class="form-group">
                   <label>Jenis Info</label>
                   
                    <select name ="jenis" id="jenjang" class="form-control">
                <option>Jenis Info</option>
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



<script src="http://localhost/e-raport/admin/js/bootstrap-datepicker.js"></script>
<script src="http://localhost/e-raport/admin/js/bootstrap-transition.js"></script>
<script src="http://localhost/e-raport/admin/js/jquery.js"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.js" type="text/javascript"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.min.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

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
<script type="text/javascript">
  $(document).ready(function() {
    $("#nip").select2({
      placeholder: 'Pilih Guru',
      allowClear: true
    });
  });
</script>
</body>
</html>