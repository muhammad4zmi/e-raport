<?php
include("../style/chart/FusionCharts.php");
include("../style/chart/FC_Colors.php");
?>
<SCRIPT LANGUAGE="Javascript" SRC="../style/chart/FusionCharts.js"></SCRIPT>
<CENTER>
    <?php
    $strXML = "<graph caption='Statistik Upload Kegiatan Per Bulan' xAxisName='Bulan' yAxisName='Jumlah Kegiatan' decimalPrecision='0' formatNumberScale='2'>";
    // Fetch all factory records
    $strQuery = "SELECT count(MONTHNAME(DATE(penilaian.tgl)))as jml,MONTHNAME(DATE(penilaian.tgl)) as month,YEAR(DATE(penilaian.tgl)) as thn,penilaian.nim
					FROM penilaian WHERE nim='" . $_SESSION['admin-mhs'] . "' GROUP BY MONTHNAME(DATE(penilaian.tgl))
					order by DATE(penilaian.tgl) asc";
    $result = mysqli_query($link, $strQuery) or die(mysqli_error($link));

    //Iterate through each factory
    if ($result) {
        while ($ors = mysqli_fetch_array($result)) {
            //Generate <set name='..' value='..' />        
            $strXML .= "<set name='" . $ors['month'] . ", " . $ors['thn'] . "' value='" . $ors['jml'] . "' color='" . getFCColor() . "'/>";
        }
    }
    //mysql_close($link);
    //Finally, close <graph> element
    $strXML .= "</graph>";
    //Create the chart - Column 3D Chart with data contained in strXML
    echo renderChart("../style/chart/FCF_Column3D.swf", "", $strXML, "", 590, 300);
    ?>
</CENTER>