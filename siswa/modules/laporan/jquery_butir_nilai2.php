<?php

include "../../../config/config.php";
//connectToDB();

$butir2 = $_POST["butir2"];
if ($_POST["butir2"] == '')
    echo "&nbsp;";
else {
    $q_nil = mysqli_query($link, "SELECT * FROM butir WHERE butir.kd_butir = '$butir2'");
    $n = mysqli_num_rows($q_nil);
    if ($n > 0) {
        while ($nilai = mysqli_fetch_assoc($q_nil)) {
            echo $nilai['nilai'];
        }
    } else {
        echo "0";
    }
}
?>