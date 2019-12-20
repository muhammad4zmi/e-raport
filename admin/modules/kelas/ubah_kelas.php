<?php

if (isset($_POST['ubah_kelas'])&& $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = antiinjection($_POST['id_kelas']);
    //$kode = antiinjection($_POST['kode']);
    $kelas = antiinjection($_POST['kelas']);
    $nis = antiinjection($_POST['nis']);

    $sql_ubah=mysqli_query($link,"update tbl_kelas set id_kelas='".$id."',kelas='".$kelas."', nis='".$nis."'
        where id_kelas='".$id."'");
    
    if($sql_ubah){
       $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
       <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
       
       <strong>Info!</strong> Data Berhasil Di Ubah.
   </div>";
   $_SESSION['alert'] = $alert;
} else {
    $alert = "<div class='alert alert-dismissable alert-warning'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    
    <h4>Warning..!!</h4>
    Maaf, Data Tidak bisa di Ubah..!!
    
</div>";
$_SESSION['alert'] = $alert;
}

?>
<script type="text/javascript">document.location = "index.php?admin=dt_kelas";</script>
<?php
}