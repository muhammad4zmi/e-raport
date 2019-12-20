<?php
include('../../../config/config.php');

$spritual = $_POST["spritual"];

$biaya = mysqli_query($link,"SELECT * FROM tbl_sikap WHERE p_spritual='$spritual'");
while($data=mysqli_fetch_array($biaya)){
	echo "$data[desk_spritual]";
}
?>