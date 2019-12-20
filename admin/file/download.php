<?php

header("Content-Disposition: attachment; filename=\"NILAI EXTRA KUR.STMIKBG_AKHIR.docx"); // gunakan backslash untuk mengijinkan file dengan spasi
$file_size = filesize("NILAI EXTRA KUR.STMIKBG_AKHIR.docx");
header("Content-Description: File Transfer");
header("Content-Type: application/force-download"); // some browsers need this
header("Content-length: " . $file_size);
$type = filetype("NILAI EXTRA KUR.STMIKBG_AKHIR.docx");
header("Content-type: application/" . $type);
header("Expires: 0");
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Pragma: no-cache");
$fp = fopen("NILAI EXTRA KUR.STMIKBG_AKHIR.docx", 'r');
$content = fread($fp, $file_size);
fclose($fp);
echo $content;
