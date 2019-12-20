<?php

include "config/config.php";
$nis = $_GET['inputNis'];
$sql_cekmail = mysqli_query($link,"select nis,email from tbl_siswa where nis='".$nis."'");
$dt_nama = mysqli_fetch_assoc($sql_cekmail);
$ada_siswa = mysqli_num_rows($sql_cekmail);
echo $dt_nama['email'];

