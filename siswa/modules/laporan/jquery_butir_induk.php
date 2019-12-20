<?php

include "../../../config/config.php";
//connectToDB();

$kd_s_unsur = $_POST["sub_unsur"];
if ($_POST["sub_unsur"] == '')
    echo "&nbsp;";
else {
    $sql_butir = mysqli_query($link, "SELECT * FROM butir WHERE butir.kd_sub_unsur = '$kd_s_unsur' and butir.parent_butir=''");
    $bi = mysqli_num_rows($sql_butir);
    if ($bi > 0) {
        echo "<option value='--' selected disabled>--Pilih Butir--</option>";
        while ($but = mysqli_fetch_assoc($sql_butir)) {
            echo "<option value='" . $but['kd_butir'] . "'>" . $but['nama_butir'] . "</option>";
        }
    }
}
?>