<?php 
	
 include "../../../config/config.php";
	
	$baca=mysqli_query($link,"select * from tbl_help where id_kelas='".$_POST["md"]."'") or die("gagal".mysqli_error());
	
	while($r=mysqli_fetch_array($baca)){
	
	?>
		<option name="kd_kelas" value="<?php echo $r["kd_kelas"] ?>"><?php echo $r["kd_kelas"] ?></option>
		
	<?php
	}
	
	
	
	?>