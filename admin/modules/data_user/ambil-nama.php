<?php 
	
  include "../../../config/config.php";
	
	$baca=mysqli_query($link,"select * from tbl_guru where nip='".$_POST["md"]."'") or die("gagal".mysqli_error());
	
	while($r=mysqli_fetch_array($baca)){
	
	?>
		<option name="nama" value="<?php echo $r["nama_guru"] ?>"><?php echo $r["nama_guru"] ?></option>
		
	<?php
	}
	
	
	
	?>