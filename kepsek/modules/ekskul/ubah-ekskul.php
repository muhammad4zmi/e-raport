<?php


if (isset($_POST['ubah'])) {
   
    $id_ekskul = antiinjection($_POST['id_ekskul']);
    $ekskul = antiinjection($_POST['ekskul']);
   
    
    //$ubahtgl = ubahformatTgl($waktu);
    
    $s = mysqli_query($link, "UPDATE tbl_ekskul set 
                              nama_ekskul='" . $ekskul ."' where id_ekskul='".$id_ekskul."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Ekstrakurikuler Berhasil Di Ubah.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Ekstrakurikuler Gagal Di Ubah.
                  </div>";
        $_SESSION['alert'] = $alert;
    }

    ?>
    <script type="text/javascript">document.location="index.php?admin=ekskul";</script>
    <?php
}
