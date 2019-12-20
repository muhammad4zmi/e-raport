<?php
include('../../../config/config.php');

$sosial = $_POST["sosial"];

$biaya = mysqli_query($link,"SELECT * FROM tbl_sikap WHERE p_sosial='$sosial'");
while($data=mysqli_fetch_array($biaya)){
	echo "$data[desk_sosial]";
}
?>