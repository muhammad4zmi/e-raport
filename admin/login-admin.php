<?php

ob_start();
session_start();
include "../config/config.php";
//connectToDB(); //fungsi koneksi ke database
$user = antiinjection($_POST['user-admin']);
$pass = antiinjection($_POST['pass-admin']);
//$newpass = $cipher->encrypt($pass, $kunci);; // enkripsi password
$query = mysqli_query($link, "select * from admin where `username`='$user' and `pass1`='$pass'");
$ada_tidak = mysqli_num_rows($query);
if ($ada_tidak > 0) {
    $_SESSION['admin-username'] = $user;
 header("location:index.php?admin=beranda");
    

} else {
    $alert = "<div class=\"alert alert-danger\">
                     <strong>Login Gagal!</strong><br/> Username atau Password Anda Salah. Coba Lagi.
                  </div>";
    $_SESSION['alert'] = $alert;
    ?>
    <script>
        window.location = "login.php";
    </script>
    <?php

}