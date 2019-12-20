<?php 
	
  mysql_connect('localhost','root','');
  mysql_select_db('db_raport');
	
	$baca=mysql_query("select * from tbl_help where id_kelas='".$_POST["md"]."'") or die("gagal".mysql_error());
	
	while($r=mysql_fetch_array($baca)){
	
	?>
		<option name="kd_kelas" value="<?php echo $r["kd_kelas"] ?>"><?php echo $r["kd_kelas"] ?></option>
		
	<?php
	}
	
	
	
	?>