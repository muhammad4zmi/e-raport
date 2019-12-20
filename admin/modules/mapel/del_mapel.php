<?php

include "cek_login.php";
if (isset($_GET['kd_mapel'])) {
    $kd_mapel = antiinjection($_GET['kd_mapel']);
    $s = mysqli_query($link, "DELETE FROM tbl_mapel where kd_mapel='" . $kd_mapel . "'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Pelajaran Berhasil Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Pelajaran Gagal Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
    ?>
    <script type="text/javascript">document.location = "index.php?admin=dt_mapel";</script>
    <?php

}