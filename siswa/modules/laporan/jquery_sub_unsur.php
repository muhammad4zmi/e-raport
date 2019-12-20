<?php

include "../../../config/config.php";
//connectToDB();

$kd_unsur = $_POST["unsur"];
//$kd_s_u = $_POST["kd_s_u"];
$sql_sub = mysqli_query($link, "select * from sub_unsur where sub_unsur.kd_unsur='$kd_unsur' and parent_sub=''");
if (!$sql_sub) {
    echo "<option>Gagal Ambil Data Unsur" . mysqli_error($link) . "</option>";
} else {
    echo "<option>--Pilih Sub Unsur--</option>";
    while ($s = mysqli_fetch_assoc($sql_sub)) {
        echo "<option value='" . $s['kd_sub_unsur'] . "'>" . $s['nama_sub_unsur'] . "</option>";
    }
}
?>