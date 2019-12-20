<?php

if (isset($_POST['ubah-captcha']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $idkey = antiinjection($_POST['idkey']);
    $sitekey = antiinjection($_POST['sitekey']);
    $secretkey = antiinjection($_POST['secretkey']);

   
        $r_akun = mysqli_query($link, "update recaptcha set id='".$idkey."',sitekey='".$sitekey."',secretkey='".$secretkey."' where id='".$idkey."'");
        if($r_akun){
        $info = "<div class='alert alert-dismissable alert-success' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <big><strong>Berhasil!</strong></big> reCaptcha Anda Berhasil Di Ubah.
             </div>";
        $_SESSION['alert'] = $info;
    } else {
        $info = "<div class='alert alert-dismissable alert-warning' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <big><strong>Gagal!</strong></big> reCaptcha Gagal Di ubah. Ulangi Kembali.
             </div>";
        $_SESSION['alert'] = $info;
    }
    ?>
    <script>window.location = 'index.php?admin=pengaturan';</script>
    <?php
}