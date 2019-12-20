<?php


if (isset($_POST['tambah'])) {
    $id = antiinjection($_POST['id_kelas']);
    $kode = antiinjection($_POST['nip']);
    //$kelas = antiinjection($_POST['kelas']);
    //$nis = antiinjection($_POST['nis']);
    $cekdata =mysqli_query($link, "select nip from tbl_walikelas where nip='$kode' ");
    //$ada = mysqli_query($link, $cekdata)or die(mysqli_error());
    if(mysqli_num_rows($cekdata)>0){
        $alert = "<div class='alert alert-dismissable alert-warning'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Upps..!!</strong>
        Maaf, Guru dengan NIP ".$kode." Sudah ada  Menjadi Wali Kelas!!

    </div>";
    $_SESSION['alert'] = $alert;


            //header("location:index.php?modul=datastaf");

}else{
    $s = mysqli_query($link, "INSERT Into tbl_walikelas set id_kelas ='".$id."', nip='".$kode."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
        <strong>Berhasil!</strong> Data Wali Kelas Berhasil Di Simpan.
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
<script type="text/javascript">document.location="index.php?admin=dt_wali";</script>

<?php
}
