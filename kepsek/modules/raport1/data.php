<?php
include 'konek.php';

error_reporting(0);
$page = $_GET['page'];

if ($page == 'cari-nis')
{
	$id = $_POST['id'];
	$kota = $db->query("select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,rekap_nilai.kd_mapel,
rekap_nilai.nis,rekap_nilai.semester
from tbl_mapel,rekap_nilai
where tbl_mapel.kd_mapel=rekap_nilai.kd_mapel and rekap_nilai.nis = '$id'");
	echo'<option value="0">Pilih Kabupaten/Kota</option>';
	while ($rowkota = $kota->fetch(PDO::FETCH_ASSOC)) {
	    
	    echo'<option value="'.$rowkota['id_mapel'].'">'.$rowkota['nama_mapel'].'</option>';
	}
}