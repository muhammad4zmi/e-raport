<?php

if (isset($_POST['ubah_p']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass_lama = antiinjection($_POST['pass_lama']);
    $pass_baru = antiinjection($_POST['pass_baru']);
    $ulangi_pass = antiinjection($_POST['ulangi_pass']);

    if ($pass_baru === $ulangi_pass) {
        //$passwd1 = $cipher->encrypt($pass_lama, $kunci);
        //$passwd2 = $cipher->encrypt($pass_baru, $kunci);

        $c_pass = mysqli_query($link, "SELECT pass2 from admin where pass2='" . $pass_lama . "' and username='" . $_SESSION['admin-username'] . "'");
        $ada = mysqli_fetch_assoc($c_pass);
        if ($ada['pass2'] === $pass_lama) {
            $r_akun = mysqli_query($link, "update admin set pass1='" . $pass_baru . "', pass2='" . $ulangi_pass . "' where username='" . $_SESSION['admin-username'] . "'");
            $info = "<div class='alert alert-dismissable alert-success' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <big><strong>Berhasil!</strong></big> Password Anda Berhasil Di Ubah.
             </div>";
            $_SESSION['alert'] = $info;
        } else {
            $info = "<div class='alert alert-dismissable alert-warning' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <big><strong>Gagal!</strong></big> Password Lama Anda Salah. Ulangi Kembali.
             </div>";
            $_SESSION['alert'] = $info;
        }
    } else {
        $info = "<div class='alert alert-dismissable alert-warning' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <big><strong>Gagal!</strong></big> Password Tidak Sama. Ulangi Kembali.
             </div>";
        $_SESSION['alert'] = $info;
    }
    ?>
    <script>window.location = 'index.php?admin=pengaturan';</script>
    <?php

}