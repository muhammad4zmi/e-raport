<?php
$DB_host = "localhost";
$DB_user = "portofolioku_root1";
$DB_pass = "+*,10HKZmYoD";
$DB_name = "portofolioku_wilayah";

try
{
	$db = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $message)
{
	echo $message->getMessage();
}
?>