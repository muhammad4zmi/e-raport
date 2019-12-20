<?php


if (isset($_POST['tambah'])) {
    
   $ekskul = antiinjection($_POST['ekskul']);

    
    $s = mysqli_query($link, "INSERT Into tbl_ekskul values('','$ekskul')");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Ekstrakurikuler Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Ekstrakurikuler Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }

    ?>
    <script type="text/javascript">document.location="index.php?admin=ekskul";</script>
    <?php
}
