<?php 
	//Include Koneksi
	mysql_connect("localhost","root","");
    mysql_select_db("db_raport");
    
	//Membuat Query
	
    
     $k=mysql_query("select nilai_akhir as jml,semester,kd_mapel,id_kelas from rekap_nilai where nis='133' order by id_kelas");        
	$q=mysql_query("SELECT rekap_nilai.nis,rekap_nilai.semester,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
        tbl_mapel.nama_mapel  FROM rekap_nilai,tbl_kelas,tbl_mapel 
        where rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.kd_mapel=tbl_mapel.kd_mapel and rekap_nilai.nis='133'");
               

?>

<!-- File yang diperlukan dalam membuat chart -->
<script src="modules/beranda/jquery.min.js"></script>
<script src="modules/beranda/highcharts.js"></script>
<script src="modules/beranda/exporting.js"></script>
    
<script type="text/javascript">
$(function () {
    $('#view').highcharts({
        title: {
            text: 'Data Nilai Pelajaran Siswa',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
              categories: [<?php while($r=mysql_fetch_array($q)){ echo "'Kelas :".$r["kelas"]." <br/>Mapel :".$r["nama_mapel"]." <br/>Semester: ".$r["semester"]."',";}?>]
        },
        yAxis: {
            title: {
                text: 'Nilai Pelajaran'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Nilai Mapel',
            data: [<?php while($t=mysql_fetch_array($k)){ echo $t["jml"].",";}?>]
        }]
    });
});
</script>

<div id="view" style="min-width: 310px; height: 400px; margin: 0 auto"></div>