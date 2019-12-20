<?php
include "../../../config/config.php";

$sql_guru = mysqli_query($link,"SELECT * from tbl_guru where nip='".$_POST['nip']."'");
$j = mysqli_fetch_array($sql_guru);

?>
<!DOCTYPE html>
<html>
<head>
   <title></title>
   
   
   
   
   <link rel="stylesheet" href="http://localhost/e-raport/admin/css/datepicker/datepicker3.css">
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
   <form class="form-horizontal" method="POST" action="?admin=ubah_guru" >
       <fieldset>
           <div class="form-group">
            <label class="col-lg-3 control-label">NIP</label>
            <div class="col-lg-8">
                <input class="form-control" id="nama_mhs" type="text" name="nip" value="<?php echo $j['nip'];?>" readonly/>
                
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Nama Guru</label>
            <div class="col-lg-8">
                <input class="form-control" id="nama_mhs" type="text" name="nama_guru" value="<?php echo $j['nama_guru'];?>" required/>
                
            </div>
        </div>
        <div class="form-group">
           <label class="col-lg-3 control-label">Jenis Kelamin</label>
           <div class="col-lg-8">
            <select name ="jk" id="jenjang" class="form-control">
                <option>Pilih Kelamin</option>
                <option value="Laki-Laki" <?php echo ($j['jk'] == "Laki-Laki") ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="Prempuan" <?php echo ($j['jk'] == "Prempuan") ? 'selected' : ''; ?>>Prempuan</option>
                
                
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Tanggal Lahir</label>
        <div class="col-lg-8">
            <input class="form-control"  id="tgl" type="text" name="lahir" value="<?php echo $j['tgl_lahir'];?>" />
            
        </div>
    </div>
    <div class="form-group">
       <label class="col-lg-3 control-label">Agama</label>
       <div class="col-lg-8">
        <select name ="agama" id="jenjang" class="form-control">
            <option>Pilih Agama</option>
            <option value="Islam" <?php echo ($j['agama'] == "Islam") ? 'selected' : ''; ?>>Islam</option>
            <option value="Kristen" <?php echo ($j['agama'] == "Kristen") ? 'selected' : ''; ?>>Kristen</option>
            <option value="Hindu" <?php echo ($j['agama'] == "Hindu") ? 'selected' : ''; ?>>Hindu</option>
            <option value="Buddha" <?php echo ($j['agama'] == "Buddha") ? 'selected' : ''; ?>>Buddha</option>
            
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">Alamat</label>
    <div class="col-lg-8">
        <textarea name="alamat" class="form-control" rows="3" ><?php echo $j['alamat'];?></textarea>
    </div>
</div>

</fieldset>
<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Keluar</button>
<button type="submit" class="btn btn-primary btn-flat" name="ubah_guru"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
</form>



<script src="http://localhost/e-raport/admin/js/bootstrap-datepicker.js"></script>
<script src="http://localhost/e-raport/admin/js/bootstrap-transition.js"></script>
<script src="http://localhost/e-raport/admin/js/jquery.js"></script>


</body>
</html>