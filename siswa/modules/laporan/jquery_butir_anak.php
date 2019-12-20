<?php

include "../../../config/config.php";
//connectToDB();

$kd_s_unsur2 = $_POST["sub_unsur2"];
if ($_POST["sub_unsur2"] == '')
    echo "&nbsp;";
else {
    $sql_butir2 = mysqli_query($link, "SELECT * FROM butir WHERE butir.kd_sub_unsur = '$kd_s_unsur2'");
    $ba = mysqli_num_rows($sql_butir2);
    if ($ba > 0) {
            echo "<option value='--' selected disabled>--Pilih Butir Kegiatan--</option>";
        while ($but2 = mysqli_fetch_assoc($sql_butir2)) {
            echo "<option value='" . $but2['kd_butir'] . "'>" . $but2['nama_butir'] . "</option>";
        }
    }
}
?>