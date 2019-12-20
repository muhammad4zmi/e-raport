<?php


if (isset($_POST['tambah'])) {
    $id = antiinjection($_POST['id_kelas']);
    $kode = antiinjection($_POST['kd_kelas']);
    $kelas = antiinjection($_POST['kelas']);
    $nis = antiinjection($_POST['nis']);
    $cekdata =mysqli_query($link, "select id_kelas,nis from tbl_kelas where id_kelas='$id' and nis ='$nis'");
    //$ada = mysqli_query($link, $cekdata)or die(mysqli_error());
    if(mysqli_num_rows($cekdata)>0){
        $alert = "<div class='alert alert-dismissable alert-warning'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Upps..!!</strong>
        Maaf, Data Siswa dengan NIS ".$nis." Sudah ada di Kelas ".$kelas.".!!

    </div>";
    $_SESSION['alert'] = $alert;


            //header("location:index.php?modul=datastaf");

}else{
    
    
    $s = mysqli_query($link, "INSERT Into tbl_kelas set id_kelas ='".$id."', kd_kelas='".$kode."',kelas='".$kelas."', nis='".$nis."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
        <strong>Berhasil!</strong> Data Kelas Berhasil Di Simpan.
    </div>";
    $_SESSION['alert'] = $alert;
} else {
    $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
    <strong>Gagal!</strong><br/> Data Kelas Gagal Di Simpan.
</div>";
$_SESSION['alert'] = $alert;
}
}
?>
<script type="text/javascript">document.location="index.php?admin=dt_kelas";</script>
<?php
}
