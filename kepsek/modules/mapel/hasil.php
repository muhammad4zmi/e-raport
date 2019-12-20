<?php
include "../../../config/config.php";

$sql_mapel = mysqli_query($link,"SELECT * from tbl_mapel where kd_mapel='".$_POST['kd_mapel']."'");
$j = mysqli_fetch_array($sql_mapel);

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
   <form class="form-horizontal" method="POST" action="?admin=ubah_mapel" >
       <fieldset>
           <div class="form-group">
            <label class="col-lg-3 control-label">Kode Pelajaran</label>
            <div class="col-lg-8">
                <input class="form-control" id="nama_mhs" type="text" name="kd_mapel" value="<?php echo $j['kd_mapel'];?>" readonly/>

            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Nama Pelajaran</label>
            <div class="col-lg-8">
                <input class="form-control" id="nama_mhs" type="text" name="mapel" value="<?php echo $j['nama_mapel'];?>" required/>

            </div>
        </div>
        <div class="form-group">
           <label class="col-lg-3 control-label">Nip Guru</label>
           <div class="col-lg-8">
               <select name ="nip" class="form-control">
                <?php
                //include "../../../config/config.php";
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
    </div>



</fieldset>
<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Keluar</button>
<button type="submit" class="btn btn-primary btn-flat" name="ubah_mapel"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
</form>



<script src="http://localhost/e-raport/admin/js/bootstrap-datepicker.js"></script>
<script src="http://localhost/e-raport/admin/js/bootstrap-transition.js"></script>
<script src="http://localhost/e-raport/admin/js/jquery.js"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.js" type="text/javascript"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.min.js" type="text/javascript"></script>
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