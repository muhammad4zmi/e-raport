<?php

include "config/config.php";
$nis = $_GET['inputNis'];
$sql_ceknis = mysqli_query($link,"select nis, nama_lengkap from tbl_siswa
                    where nis='" . $nis . "'");
$dt_nama = mysqli_fetch_assoc($sql_ceknis);
$ada_siswa = mysqli_num_rows($sql_ceknis);
echo $dt_nama['nama_lengkap'];

