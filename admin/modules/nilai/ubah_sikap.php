<?php


if (isset($_POST['ubah'])) {
   
    $id_sikap = antiinjection($_POST['id_sikap']);
    $p_spritual = antiinjection($_POST['p_spritual']);
    $desk_spritual = antiinjection($_POST['desk_spritual']);
    $p_sosial = antiinjection($_POST['p_sosial']);
    $desk_sosial = antiinjection($_POST['desk_sosial']);
    
    //$ubahtgl = ubahformatTgl($waktu);
    
    $s = mysqli_query($link, "UPDATE tbl_sikap set p_spritual='" . $p_spritual . "', 
                                                           desk_spritual='".$desk_spritual."',
                                                           p_sosial='".$p_sosial."',
                                                           desk_sosial='".$desk_sosial."'
                                                           where id='".$id_sikap."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Nilai Sikap Berhasil Di Ubah.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Nilai Sikap Gagal Di Ubah.
                  </div>";
        $_SESSION['alert'] = $alert;
    }

    ?>
    <script type="text/javascript">document.location="index.php?admin=sikap";</script>
    <?php
}
