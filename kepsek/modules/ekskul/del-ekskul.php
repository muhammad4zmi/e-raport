<?php

include "cek_login.php";
if (isset($_GET['id_ekskul'])) {
    $id_ekskul = (int) antiinjection($_GET['id_ekskul']);
    $s = mysqli_query($link, "DELETE FROM tbl_ekskul where id_ekskul='" . $id_ekskul . "'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Ekstrakurikuler Berhasil Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Ekstrakurikuler Gagal Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
    ?>
    <script type="text/javascript">document.location = "index.php?admin=ekskul";</script>
    <?php

}