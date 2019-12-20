<?php 
	
  mysql_connect('localhost','root','');
  mysql_select_db('db_raport');
	
	$baca=mysql_query("SELECT tbl_guru.nip,tbl_guru.nama_guru,tbl_mapel.kd_mapel,tbl_mapel.nip,tbl_mapel.nama_mapel 
    from tbl_guru INNER JOIN tbl_mapel ON tbl_guru.nip=tbl_mapel.nip where tbl_mapel.kd_mapel='".$_POST["md1"]."'") or die("gagal".mysql_error());
	
	while($r=mysql_fetch_array($baca)){
	
	?>
		<option name="guru" value="<?php echo $r["nip"] ?>"><?php echo $r["nama_guru"] ?></option>
		
	<?php
	}
	
	
	
	?>