<?php 
	
  include "../../../config/config.php";
	echo '<option value="">Pilih Mata Pelajaran</option>';
	$baca=mysqli_query($link,"select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,rekap_nilai.kd_mapel,
rekap_nilai.nis,rekap_nilai.semester
from tbl_mapel,rekap_nilai
where tbl_mapel.kd_mapel=rekap_nilai.kd_mapel and rekap_nilai.nis='".$_POST["md"]."'") or die("gagal".mysql_error());
	
	while($r=mysqli_fetch_array($baca)){

	
	?>

		<option name="kelas" value="<?php echo $r["kd_mapel"] ?>"><?php echo $r["nama_mapel"]." ".$r['semester'] ?></option>
		
	<?php
	}
	
	
	
	?>