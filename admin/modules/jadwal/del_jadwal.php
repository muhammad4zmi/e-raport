<?php

include "cek_login.php";
if (isset($_GET['id_jadwal'])) {
    $id_jadwal = antiinjection($_GET['id_jadwal']);
    $s = mysqli_query($link, "DELETE FROM jadwal where id_jadwal='" . $id_jadwal . "'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Jadwal Pelajaran Berhasil Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Jadwal Pelajaran Gagal Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
    ?>
    <script type="text/javascript">document.location = "index.php?admin=jadwal";</script>
    <?php

}