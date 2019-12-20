<?php
include "../../../config/config.php";

$sql_mapel = mysqli_query($link,"SELECT * from jadwal where id_jadwal='".$_POST['id_jadwal']."'");
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
   <form class="form-horizontal" method="POST" action="?admin=ubah_jadwal" >
       <fieldset>
           <div class="form-group">
            <label class="col-lg-3 control-label">Kode Pelajaran</label>
            <div class="col-lg-8">
                 <input class="form-control" id="nama_mhs" type="hidden" name="id_jadwal" value="<?php echo $j['id_jadwal'];?>">
                <select name ="kd_mapel" id="kd_mapel" class="form-control">
                <?php
                //include "../../../config/config.php";
               $sql_jadwal=mysqli_query($link,"SELECT jadwal.id_jadwal, tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,jadwal.nip,tbl_guru.nama_guru,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kkm
from tbl_guru,tbl_kelas,jadwal,tbl_mapel where tbl_mapel.kd_mapel=jadwal.kd_mapel and tbl_guru.nip=jadwal.nip 
and tbl_kelas.id_kelas=jadwal.id_kelas group by jadwal.id_jadwal ORDER BY tbl_kelas.id_kelas asc");
                while($r1 = mysqli_fetch_array($sql_jadwal)) {
                    ?>
                    <option value="<?php echo $r1['kd_mapel'] ?>">
                        <?php echo $r1['kd_mapel']." ".$r1['nama_mapel'] ?>
                    </option>
                    <?php
                }
                ?>
            </select>

            </div>
        </div>
        
        <div class="form-group">
           <label class="col-lg-3 control-label">Nip Guru</label>
           <div class="col-lg-8">
               <select name ="nip" class="form-control">
                <?php
                //include "../../../config/config.php";
                $q = mysqli_query($link,"SELECT nip, nama_guru from tbl_guru group by nip");
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
     <div class="form-group">
                             <label class="col-lg-3 control-label">Kelas</label>
                             <div class="col-lg-8">
                                <select name="kelas" id="kelas"  class="form-control">
                                    <?php
                                    // include "../../../config/config.php";
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
                        </div>
                        



</fieldset>
<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Keluar</button>
<button type="submit" class="btn btn-primary btn-flat" name="ubah_jadwal"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
</form>



<script src="http://localhost/e-raport/admin/js/bootstrap-datepicker.js"></script>
<script src="http://localhost/e-raport/admin/js/bootstrap-transition.js"></script>
<script src="http://localhost/e-raport/admin/js/jquery.js"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.js" type="text/javascript"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#kd_mapel").select2({
            placeholder: 'Pilih Guru',
            allowClear: true
        });
    });
</script>
</body>
</html>