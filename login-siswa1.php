<?php

if (isset($_POST['login-siswa']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
//ob_start();
    session_start();
    include "config/config.php";
    $webmail = webmail();
    $user = antiinjection($_POST['user-siswa']);
    $pass = antiinjection($_POST['pass-siswa']);
    $cek_akun = mysqli_query($link, "select akun.* from akun
	  where akun.`username`='$user'");
    $a_akun = mysqli_fetch_assoc($cek_akun);
	$mail_siswa = $a_akun['email'];
    if ($a_akun['status'] == 0) {
        $info = "<div class='alert alert-dismissable alert-danger text-center'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Oops!</h4>
                Maaf, Akun Anda belum di aktivasi. Gunakan
                $mail_siswa untuk verifikasi akun di alamat <a href='$webmail' target='_blank'>gmail.co.id</a> 
             </div>";
        $_SESSION['info-login'] = $info;
         header("location:index.php#section2");
    } else if ($a_akun['status'] == 1) {
        $passlog = $cipher->encrypt($pass, $kunci); //enkripsi password dengan cipher
        $sql = "select akun.*,tbl_siswa.nama_lengkap,tbl_siswa.jk from akun,tbl_siswa
	  where akun.nis=tbl_siswa.nis and akun.`username`='$user' and akun.`password`=md5('$passlog') and status=1";
        $query = mysqli_query($link, $sql);
        $data = mysqli_fetch_array($query);
        $ada_tidak = mysqli_num_rows($query);
        if ($ada_tidak > 0) {
            $_SESSION['admin-siswa'] = $user;
            $_SESSION['nama_siswa'] = $data['nama_lengkap'];
            $_SESSION['jk'] = $data['jk'];
            $_SESSION['login-siswa'] = session_id();
            header("location:siswa/");
        } else {
            $info = "<div class='alert alert-dismissable alert-warning' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Warning!</h4>
                Mohon Maaf, Username atau Password Anda Salah.
             </div>";
            $_SESSION['info-login'] = $info;
             header("location:index.php#section2");
        }
    }
}