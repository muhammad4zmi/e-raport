<?php

include "../../../config/config.php";
//connectToDB();

$butir = $_POST["butir"];
if ($_POST["butir"] == '')
    echo "&nbsp;";
else {
    $q_butir = mysqli_query($link, "SELECT * FROM butir WHERE butir.parent_butir = '$butir'");
    $bs = mysqli_num_rows($q_butir);
    if ($bs > 0) {
        echo "<option value='--' selected disabled>--Pilih Lagi Sub Unsur--</option>";
        while ($q_b = mysqli_fetch_assoc($q_butir)) {
            echo "<option value='" . $q_b['kd_butir'] . "'>" . $q_b['nama_butir'] . "</option>";
        }
    }
}
?>