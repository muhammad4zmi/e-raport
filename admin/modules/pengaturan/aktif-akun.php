<?php

if (($_GET['admin']=='aktivasi') && isset($_GET['id_user'])) {
    $nis = antiinjection($_GET['id_user']);
    $q = mysqli_query($link, "SELECT username from akun where username='" . $nis . "'");
    $ada = mysqli_fetch_assoc($q);
    if ($ada['username'] === $nis) {
        $r_akun = mysqli_query($link, "update akun set status=1 where username='" . $nis . "'");
        $info = "<div class='alert alert-dismissable alert-success' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <big><strong>Berhasil!</strong></big> Akun Berhasil <strong>Diaktifkan</strong>.
             </div>";
        $_SESSION['alert'] = $info;
    } else {
        $info = "<div class='alert alert-dismissable alert-warning' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <big><strong>Gagal!</strong></big> Akun Gagal Diakifkan. Ulangi Kembali.
             </div>";
        $_SESSION['alert'] = $info;
    }
    ?>
    <script>window.location = 'index.php?admin=pengaturan';</script>
    <?php

}