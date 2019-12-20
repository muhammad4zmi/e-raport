<?php

include "cek_login.php";
if (isset($_GET['kd_mapel']) and isset($_GET['id_kelas'])) {
    
    $kd_mapel =  antiinjection($_GET['kd_mapel']);
   // $nis = antiinjection($_GET['nis']);
    $id_kelas = antiinjection($_GET['id_kelas']);
    //$semester = antiinjection($_GET['semester']);
    $s = mysqli_query($link, "DELETE FROM rekap_nilai where  kd_mapel='".$kd_mapel."' and id_kelas='".$id_kelas."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Guru Berhasil Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Guru Gagal Di Hapus.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
    ?>
    <script type="text/javascript">document.location = "index.php?admin=nilai";</script>
    <?php

}