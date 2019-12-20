<?php
$query_total = mysqli_query($link,"SELECT penilaian.nim,Sum(penilaian.nilai) as tot_nilai
						 FROM penilaian WHERE penilaian.nim ='" . $_SESSION['admin-mhs'] . "' 
						 AND penilaian.status='1' GROUP BY penilaian.nim");
$total_nilai = mysqli_fetch_array($query_total);
$jml_nilai_mhs = $total_nilai['tot_nilai'];
//$persen_nilai=($jml_nilai_mhs/100)*100;
?>
<div style="float:right; margin-top:-12px;">
    <table>
        <tr>
            <td><big style="font-weight: 700;font-family: Arial;font-size: large;">Jumlah Poin Anda Sekarang : </big></td>
        <td><h2>&nbsp;<?php if ($total_nilai['tot_nilai'] != 0) echo $jml_nilai_mhs; else echo '0'; ?> Poin</h2></td>
        <td valign="middle"><h3><i <?php if ($total_nilai['tot_nilai'] >= 50) echo "class='fa fa-smile-o fa-fw fa-2x' style='color:#5cb85c;'";
else if ($total_nilai['tot_nilai'] >= 40) echo "class='fa fa-meh-o fa-fw fa-2x' style='color:#f0ad4e;'";
else echo "class='fa fa-frown-o fa-fw fa-2x' style='color:#d9534f;'"; ?>></i></h3></td>
        </tr>
    </table>
</div>