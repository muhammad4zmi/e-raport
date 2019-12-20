<?php 
	
  mysql_connect('localhost','root','');
  mysql_select_db('db_raport');
	
	$baca=mysql_query("select * from tbl_kelas where nis='".$_POST["md"]."'") or die("gagal".mysql_error());
	
	while($r=mysql_fetch_array($baca)){
	
	?>
		<option name="kelas" value="<?php echo $r["id_kelas"] ?>"><?php echo $r["kelas"] ?></option>
		
	<?php
	}
	
	
	
	?>