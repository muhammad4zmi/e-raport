<?php

if (isset($_POST['login-siswa']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
//ob_start();
    session_start();
    include "config/config.php";
    // $sql_recaptcha = mysqli_query($link,"SELECT * from recaptcha where id");
    // $j = mysqli_fetch_array($sql_recaptcha);
    $webmail = webmail();
    $user = antiinjection($_POST['user-siswa']);
    $pass = antiinjection($_POST['pass-siswa']);
    //$captcha        = $_POST['g-recaptcha-response'];
    //di bawah ini silahkan masukkan pada gambar di atas pada kotak hijau
    // $secretKey      = $j['secretkey'];
    // $ip             = $_SERVER['REMOTE_ADDR'];
    // $response       = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    // $responseKeys   = json_decode($response,true);
    //     if(intval($responseKeys["success"]) !== 1) {
    //     //pesan jika reCAPTCHA tidak di centang
    //     $info = "<div class='alert alert-dismissable alert-danger' id='pesan'>
    //             <button type='button' class='close' data-dismiss='alert'>x</button>
    //             <h4>Informasi!</h4>
    //             Mohon Maaf, Sepertinya anda bukan manusia!.
    //          </div>";
    //         $_SESSION['info-login'] = $info;
    //         header("location:index.php#section2");
    //     }else{
    $cek_akun = mysqli_query($link, "select akun.* from akun
	  where akun.`username`='$user'");
    $a_akun = mysqli_fetch_assoc($cek_akun);
    $tidak = mysqli_num_rows($cek_akun);
	$mail_siswa = $a_akun['email'];
    if($tidak == 0){
        $info = "<div class='alert alert-dismissable alert-danger text-center' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Informasi!</h4>
                Maaf, Nis Anda belum terdaftar di Database. Silahkan Buat Akun menggunakan Nim Anda</div>";
        $_SESSION['info-login'] = $info;
        header("location:index.php#section2");
    }
    else if ($a_akun['status'] == 0) {
        $info = "<div class='alert alert-dismissable alert-danger text-center' id='pesan'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Informasi!</h4>
                Maaf, Akun Anda belum di aktivasi. Gunakan
                $mail_siswa untuk verifikasi akun di alamat <a href='$webmail' target='_blank'>admin@e-raport.com</a> 
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
                <h4>Informasi!</h4>
                Mohon Maaf, Username atau Password Anda Salah.
             </div>";
            $_SESSION['info-login'] = $info;
            header("location:index.php#section2");
        }
    }
}
