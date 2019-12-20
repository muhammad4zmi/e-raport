<?php
session_start();
 if(isset($_POST['login'])){
include("../config/config.php");

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($link,"SELECT * FROM tbl_user WHERE nip='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if($data['jabatan']==1){

        // buat session login dan username
        $_SESSION['admin-kepsek'] = $username;
        $_SESSION['jabatan'] = "Kepala Sekolah";
        $_SESSION['nama']=$row['nama_lengkap'];
        // alihkan ke halaman dashboard admin
        header("location:http://localhost/eraport/kepsek/");

    // cek jika user login sebagai pegawai
    }else if($data['jabatan']=="2"){
        // buat session login dan username
        $_SESSION['admin-wali'] = $username;
        $_SESSION['jabatan'] = "Wali Kelas";
        $_SESSION['nama']=$row['nama_lengkap'];
        // alihkan ke halaman dashboard pegawai
        header("location:http://localhost/eraport/walikelas/");

    // cek jika user login sebagai pengurus
    

    }else{

        // alihkan ke halaman login kembali
        header("location:index.php");
    }   
}
}


                
                ?>