<?php

include "../../../config/config.php";
//connectToDB();

$butir = $_POST["butir"];
if ($_POST["butir"] == '')
    echo "&nbsp;";
else {
    $q_nil = mysqli_query($link, "SELECT * FROM butir WHERE butir.kd_butir = '$butir'");
    $n = mysqli_num_rows($q_nil);
    if ($n > 0) {
        while ($nilai = mysqli_fetch_array($q_nil)) {
            echo $nilai['nilai'];
        }
    } else {
        echo "0";
    }
}
?>