<script src="modules/raport/highcharts.js" type="text/javascript"></script>
<script src="modules/raport/jquery.min.js" type="text/javascript"></script>
<script src="modules/raport/exporting.js"></script>

 <?php
include '../../../config/config.php';
//$link1 = mysqli_connect("localhost", "root", "", "db_raport");
 $id_kelas=$_GET['id_kelas'];
 $semester=$_GET['semester'];

$thn_ajaran=$_GET['thn_ajaran'];


    
     $sql_rerata=mysqli_query($link,"select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_mapel.id_kelas,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,rapot.kd_mapel,rapot.id_kelas,
                                sum(rapot.nilai)/count(tbl_siswa.nis) as rerata,
                                rapot.semester,rapot.thn_ajaran
                                from tbl_mapel,tbl_kelas,tbl_siswa,rapot
                                where tbl_mapel.kd_mapel=rapot.kd_mapel and 
                                tbl_kelas.id_kelas=tbl_mapel.id_kelas and 
                                tbl_kelas.kd_kelas='$kd_kelas' and 
                                rapot.semester='$semester' and rapot.thn_ajaran='$thn_ajaran' 
                                group by tbl_mapel.kd_mapel");
    while( $data = mysqli_fetch_array( $sql_rerata ) ){
        $jumlah = $data['rerata'];
        $kls = $data['kd_kelas'];
        $mapel=$data['kd_mapel'];
      }
        ?>
               



    
<script type="text/javascript">
var chart1; // globally available
    $(document).ready(function() {
      chart1 = new Highcharts.Chart({
       chart: {
        renderTo: 'view',
},
        title: {
            text: 'Data Nilai Pelajaran Siswa',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
              categories: [<?php while($r=mysqli_fetch_array($q)){ echo "'Kelas :".$data["kd_kelas"]." <br/>Mapel :".$r["nama_mapel"]." <br/>Semester: ".$r["semester"]."',";}?>]
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
            data: [<?php while($t=mysqli_fetch_array($sql_rerata)){ echo $t["rerata"].",";}?>]
        }]
    });
});
</script>

<!-- <div id="view" style="min-width: 310px; height: 400px; margin: 0 auto"></div> -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
<h3 class="page-header"><i class="fa fa-bar-chart-o fa-fw fa-2x"></i>Grafik Belajar Siswa </h3>

<div class="row">
    <div class="col-md-5 text-right">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Statistik Hasil Belajar Siswa Per Semester <i class="fa fa-bar-chart-o fa-fw fa-2x"></i></div>
           <div class="panel-body">
           <hr>
            <div id='container'></div>
            <hr>
            </div>
        </div>
    </div>

    <div class="col-md-7 text-right">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
             <div class="panel-heading">Statistik Hasil Belajar Siswa Per Pelajaran <i class="fa fa-bar-chart-o fa-fw fa-2x"></i></div>
            <div class="panel-body">
            <hr>
                <!-- Post Content -->
                <div id="view"></div>

                <hr>
                </div>
        </div>
    </div>
</div>
</section>
</aside>
