<?php

include "../../../config/config.php";
//connectToDB();

$kd_s_unsur = $_POST["sub_unsur"];
if ($_POST["sub_unsur"] == '')
    echo "&nbsp;";
else {
    $sql_sub2 = mysqli_query($link, "SELECT sub_unsur.kd_unsur, sub_unsur.kd_sub_unsur, sub_unsur.nama_sub_unsur,sub_unsur.parent_sub
						FROM sub_unsur WHERE sub_unsur.parent_sub = '$kd_s_unsur'");
    $s = mysqli_num_rows($sql_sub2);
    if ($s > 0) {
            echo "<option value='--' selected disabled>--Pilih Butir Sub Unsur--</option>";
        while ($s2 = mysqli_fetch_assoc($sql_sub2)) {
            echo "<option value='" . $s2['kd_sub_unsur'] . "'>" . $s2['nama_sub_unsur'] . "</option>";
        }
    }
}
?>