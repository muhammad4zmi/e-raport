<?php


if (isset($_POST['tambah'])) {
    
    
    
    
   
   
    $kd_mapel = antiinjection($_POST['kd_mapel']);
     $nip = antiinjection($_POST['nip']);
    $id_kelas= antiinjection($_POST['id_kelas']);
    
    
   
    $s = mysqli_query($link, "INSERT INTO `db_raport`.`jadwal` (`kd_mapel`, `nip`, `id_kelas`) VALUES ('$kd_mapel', '$nip', '$id_kelas')");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Jadwal Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Jadwal Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }

    ?>
    <script type="text/javascript">document.location="index.php?admin=jadwal";</script>
    <?php
    }

