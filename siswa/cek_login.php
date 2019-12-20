<?php
//session_start();
// mengecek ada tidaknya session untuk username
if (!isset($_SESSION['login-siswa']))
{
    ?>
    <script>
        alert('Oopz, Maaf... Anda Harus Melakukan Proses Login');
		window.location='../'; //keluar ke halaman utama aplikasi
    </script>
    <?php
exit;
}
?>