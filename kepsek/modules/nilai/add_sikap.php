<?php


if (isset($_POST['tambah'])) {
    
   $p_spritual = antiinjection($_POST['p_spritual']);
    $desk_spritual = antiinjection($_POST['desk_spritual']);
    $p_sosial = antiinjection($_POST['p_sosial']);
    $desk_sosial = antiinjection($_POST['desk_sosial']);
    
    $s = mysqli_query($link, "INSERT Into tbl_sikap values('','$p_spritual','$desk_spritual','$p_sosial','$desk_sosial')");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Sikap Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Sikap Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }

    ?>
    <script type="text/javascript">document.location="index.php?admin=sikap";</script>
    <?php
}
