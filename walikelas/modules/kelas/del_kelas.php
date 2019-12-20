<?php

include "cek_login.php";
if (isset($_GET['id_kelas'])) {
    $id_kelas = (int) antiinjection($_GET['id_kelas']);
    $s = mysqli_query($link, "DELETE FROM tbl_kelas where id_kelas='" . $id_kelas . "'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Kelas Berhasil Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Kelas Gagal Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
    ?>
    <script type="text/javascript">document.location = "index.php?admin=dt_kelas";</script>
    <?php

}