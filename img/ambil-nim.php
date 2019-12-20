<?php

include "config/koneksi_kampus.php";
$nim_mhs = $_GET['inputNim'];
$sql_ceknim = mysqli_query($linkDBkampus, "select $dbkampus.mahasiswa.nim,$dbkampus.mahasiswa.nama_mahasiswa from $dbkampus.mahasiswa
                    where $dbkampus.mahasiswa.nim='" . $nim_mhs . "'");
$dt_nama = mysqli_fetch_assoc($sql_ceknim);
$ada_mhs = mysqli_num_rows($sql_ceknim);
echo $dt_nama['nama_mahasiswa'];
//echo $ada_mhs;

