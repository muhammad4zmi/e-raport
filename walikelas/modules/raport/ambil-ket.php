<?php

  include "../../../config/config.php";
$mapel = $_GET['inputMapel'];
//$nis = $_GET['nis'];
$sql_ceknis = mysqli_query($link,"select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,rekap_nilai.kd_mapel,
rekap_nilai.nis,rekap_nilai.semester,rekap_nilai.keterangan
from tbl_mapel,rekap_nilai
where tbl_mapel.kd_mapel=rekap_nilai.kd_mapel and rekap_nilai.nis='133' 
and rekap_nilai.kd_mapel='".$mapel."' group by rekap_nilai.semester");
$dt_nama = mysqli_fetch_assoc($sql_ceknis);
$ada_siswa = mysqli_num_rows($sql_ceknis);

echo $dt_nama['keterangan'];