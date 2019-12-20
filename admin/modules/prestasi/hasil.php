<?php
include "../../../config/config.php";

$sql_prestasi = mysqli_query($link,"SELECT * from tbl_prestasi where nama_prestasi='".$_POST['nama_prestasi']."'");
$j = mysqli_fetch_array($sql_prestasi);

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
   <form class="form-horizontal" method="POST" action="?admin=ubah_prestasi" >
       <fieldset>
           <div class="form-group">
            <label class="col-lg-3 control-label">Nama Prestasi</label>
            <div class="col-lg-8">
                <input class="form-control" id="nama_mhs" type="hidden" name="id_prestasi" value="<?php echo $j['id_prestasi'] ?>" required/>
                 <input class="form-control"  type="text" name="prestasi" value="<?php echo $j['nama_prestasi'] ?>" required/>
                

            </div>
        </div>
        <div class="form-group">
           <label class="col-lg-3 control-label">Jenis Prestasi</label>
           <div class="col-lg-8">
            <select name ="jenis" id="jenjang" class="form-control">
                <option>Pilih Prestasi</option>
                <option value="Sains" <?php echo ($j['jenis'] == "Sains") ? 'selected' : ''; ?>>Sains</option>
                <option value="Olahraga" <?php echo ($j['jenis'] == "Olahraga") ? 'selected' : ''; ?>>Olahraga</option>
                <option value="Olimpiade" <?php echo ($j['jenis'] == "Olimpiade") ? 'selected' : ''; ?>>Olimpiade</option>
                <option value="Kesenian" <?php echo ($j['jenis'] == "Kesenian") ? 'selected' : ''; ?>>Kesenian</option>
                <option value="Lainnya" <?php echo ($j['jenis'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya</option>

            </select>
        </div>
    </div>

    <div class="form-group">
       <label class="col-lg-3 control-label">Tingkat Prestasi</label>
       <div class="col-lg-8">
        <select name ="tingkat" id="jenjang" class="form-control">
            <option>Pilih Jenis</option>
            <option value="Ragional" <?php echo ($j['tingkat'] == "Ragional") ? 'selected' : ''; ?>>Ragional</option>
            <option value="Daerah Kab/Kota" <?php echo ($j['jk'] == "Daerah Kab/Kota") ? 'selected' : ''; ?>>Daerah Kab/Kota</option>
            <option value="Provinsi" <?php echo ($j['tingkat'] == "Provinsi") ? 'selected' : ''; ?>>Provinsi</option>
            <option value="Nasional" <?php echo ($j['tingkat'] == "Nasional") ? 'selected' : ''; ?>>Nasional</option>
            <option value="Internasional" <?php echo ($j['tingkat'] == "Internasional") ? 'selected' : ''; ?>>Internasional</option>

        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">Waktu Pelaksanaan</label>
    <div class="col-lg-8">
        <input class="form-control"  id="tgl" type="date" name="waktu" value="<?php echo $j['waktu']?>" required/>

    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">Lokasi Pelaksanaan</label>
    <div class="col-lg-8">
        <textarea name="lokasi" class="form-control" rows="3" placeholder="Lokasi"><?php echo $j['lokasi']?></textarea>
    </div>
</div>
<div class="form-group">
   <label class="col-lg-3 control-label">Siswa</label>
   <div class="col-lg-8">
    <select name ="nis" id="nis" class="form-control">
        <?php
        //include "../../../config/config.php";
        $q = mysqli_query($link,"SELECT tbl_siswa.nis, tbl_siswa.nama_lengkap,tbl_kelas.nis 
            from tbl_siswa INNER JOIN tbl_kelas ON tbl_siswa.nis=tbl_kelas.nis where tbl_siswa.nis");
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
<div class="form-group">
   <label class="col-lg-3 control-label">Kelas</label>
   <div class="col-lg-8">

    <select name="kelas" id="SK" class="form-control">

        <?php
        mysql_connect('localhost', 'root', '');
        mysql_select_db("db_raport");
        $q = mysql_query("SELECT * FROM tbl_kelas where nis");
        while($r = mysql_fetch_array($q)) {
            ?>
            <option value="<?php echo $r['id_kelas'] ?>">
                <?php echo $r['kelas'] ?>
            </option>
            <?php
        }
        ?>

    </select>

</div>
</div>

</fieldset>
<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Keluar</button>
<button type="submit" class="btn btn-primary btn-flat" name="ubah"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
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

<script>
    $("#nis").change(function(){

        var id_md = $("#nis").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/prestasi/ambil-kelas.php",
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
</body>
</html>