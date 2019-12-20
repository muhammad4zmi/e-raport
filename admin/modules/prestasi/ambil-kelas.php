<?php 
	
  include "../../../config/config.php";
	
	$baca=mysqli_query($link,"select * from tbl_kelas where nis='".$_POST["md"]."'") or die("gagal".mysqli_error());
	
	while($r=mysqli_fetch_array($baca)){
	
	?>
		<option name="kelas" value="<?php echo $r["id_kelas"] ?>"><?php echo $r["kelas"] ?></option>
		
	<?php
	}
	
	
	
	?>