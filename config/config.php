<?php

// These four parameters must be changed dependent on your MySQL settings
$hostdb = 'localhost'; // MySQl host
$userdb = 'root';  // MySQL username
$passdb = '';  // MySQL password
$namedb = 'db_raport'; // MySQL database name
// Please uncomment the appropriate statement
$link = mysqli_connect($hostdb, $userdb, $passdb, $namedb);

if (!$link) {
	die('Could not connect: ' . mysqli_error());
}

function antiinjection($data) {
    $filter_sql = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
    return $filter_sql;
}

function mail_server() {
    return "info@eraport.portofolioku.web.id";
}

function webmail() {
    return "https://portofolioku.web.id:2096/cpsess1894456145/webmail/paper_lantern/index.html?login=1&post_login=34180205769282";
    
}

function server() {
    return "http://eraport.portofolioku.web.id";
}


include "cipher.php"; // panggil file nya
$cipher = new Cipher(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
$kunci = "bismillaah"; // kunci
?>