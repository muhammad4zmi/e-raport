<?php
//session_start();
// mengecek ada tidaknya session untuk username
if (!isset($_SESSION['admin-kepsek']))
{
    header("location:/e-raport/kepsek");
exit;
}
?>