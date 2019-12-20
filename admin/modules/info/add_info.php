<?php


if (isset($_POST['tambah_info'])) {
    function ubahformatTgl($tanggal) {
        $pisah = explode('/',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$urutan);
        return $satukan;
    }
    
    $judul = antiinjection($_POST['judul']);
    $editor1 = antiinjection($_POST['editor1']);
    $tgl_post = antiinjection($_POST['tgl_post']);
    $jenis = antiinjection($_POST['jenis']);
    $ubahtgl = ubahformatTgl($tgl_post);
    $cekdata =mysqli_query($link, "select id_info from tbl_info where judul='$judul'");
    //$ada = mysqli_query($link, $cekdata)or die(mysqli_error());
    if(mysqli_num_rows($cekdata)>0){
        $alert = "<div class='alert alert-dismissable alert-warning'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Upps..!!</strong>
        Maaf, Informasi dengan ID ".$judul." Sudah ada..!!

    </div>";
    $_SESSION['alert'] = $alert;
           
                
            //header("location:index.php?modul=datastaf");
 
}else{
    $s = mysqli_query($link, "INSERT Into tbl_info set judul='" . $judul . "', isi='".$editor1."',
                        tgl_post='".$ubahtgl."',tipe='".$jenis."'");
   if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
        <strong>Berhasil!</strong> Informasi Berhasil Di Simpan.
    </div>";
    $_SESSION['alert'] = $alert;
} else {
    $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
    <strong>Gagal!</strong><br/> Informasi Gagal Di Simpan.
</div>";
$_SESSION['alert'] = $alert;
}
}
?>
<script type="text/javascript">document.location="index.php?admin=info";</script>
<?php
}
