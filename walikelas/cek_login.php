<?php
//session_start();
// mengecek ada tidaknya session untuk username
if (!isset($_SESSION['admin-wali']))
{
    header("location:/e-raport/walikelas");
exit;
}
?>