<?php

include "config/config.php";
$nis = $_GET['inputNis'];
$sql_cekjk = mysqli_query($link,"select nis,jk from tbl_siswa where nis='".$nis."'");
$dt_nama = mysqli_fetch_assoc($sql_cekjk);
$ada_siswa = mysqli_num_rows($sql_cekjk);
echo $dt_nama['jk'];

