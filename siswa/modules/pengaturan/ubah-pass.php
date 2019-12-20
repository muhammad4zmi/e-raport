<?php

if (isset($_POST['ubah_p']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass_lama = antiinjection($_POST['pass_lama']);
    $pass_baru = antiinjection($_POST['pass_baru']);
    $ulangi_pass = antiinjection($_POST['ulangi_pass']);

    if ($pass_baru === $ulangi_pass) {
        $passwd1 = $cipher->encrypt($pass_lama, $kunci);
        $passwd2 = $cipher->encrypt($pass_baru, $kunci);

        $c_pass = mysqli_query($link, "SELECT password2 from akun where password2='" . $passwd1 . "' and nis='" . $_SESSION['admin-siswa'] . "'");
        $ada = mysqli_fetch_assoc($c_pass);
        if ($ada['password2'] === $passwd1) {
            $r_akun = mysqli_query($link, "update akun set password='" . md5($passwd2) . "', password2='" . $passwd2 . "' where nis='" . $_SESSION['admin-siswa'] . "'");
            $info = "<div class='alert alert-dismissable alert-success' id='pesan'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <h4>Berhasil!</h4>
            Password Anda Berhasil Di Ubah.
        </div>";
        $_SESSION['info-login'] = $info;
    } else {
        $info = "<div class='alert alert-dismissable alert-warning' id='pesan'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <h4>Warning!</h4>
        Password Lama Anda Salah. Ulangi Kembali.
    </div>";
    $_SESSION['info-login'] = $info;
}
} else {
    $info = "<div class='alert alert-dismissable alert-warning' id='pesan'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <h4>Warning!</h4>
    Password Tidak Sama. Ulangi Kembali.
</div>";
$_SESSION['info-login'] = $info;
}
?>
<script>window.location = 'index.php?siswa=pengaturan';</script>
<?php
}