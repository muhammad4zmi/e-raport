<script src="modules/beranda/highcharts.js" type="text/javascript"></script>
<script src="modules/beranda/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var chart1; // globally available
    $(document).ready(function() {
      chart1 = new Highcharts.Chart({
       chart: {
        renderTo: 'container',
        type: 'column'
    },
    title: {
        text: 'Grafik Presentasi Hasil Belajar Siswa '
    },
    xAxis: {
        categories: ['Kelas : ']
    },
    yAxis: {
        title: {
         text: 'Presentasi Nilai'
     }
 },
 series:
 [
 <?php
$link1 = mysqli_connect("localhost", "root", "", "db_raport");
 $sql   = "SELECT tbl_nilai.nis,tbl_nilai.semester,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_siswa.nis,tbl_siswa.nama_lengkap
 FROM tbl_nilai,tbl_kelas,tbl_siswa where tbl_nilai.id_kelas=tbl_kelas.id_kelas and tbl_nilai.nis=tbl_siswa.nis and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "' ";
 $query = mysqli_query($link1,$sql )  or die(mysqli_error());
 while( $ret = mysqli_fetch_array( $query ) ){
    $merek=$ret['semester'];
    $nis=$ret['nama_lengkap'];
    $kelas=$ret['kelas'];
    $sql_jumlah   = "SELECT tbl_nilai.total_nilai as jml,tbl_nilai.semester as
    smt,tbl_nilai.nis as nis, tbl_nilai.id_kelas as kls,tbl_kelas.id_kelas,tbl_kelas.kelas FROM tbl_nilai,tbl_kelas WHERE
    tbl_nilai.id_kelas=tbl_kelas.id_kelas and tbl_kelas.kelas='$kelas' and semester='$merek'";
    $query_jumlah = mysqli_query($link1,$sql_jumlah ) or die(mysqli_error());
    while( $data = mysqli_fetch_array( $query_jumlah ) ){
        $jumlah = $data['jml'];
        $kls = $data['kls'];
    }
    ?>
    {
      name: '<?php echo $kelas."<br/> Semester : ".$merek; ?><br/> Total Nilai',
      data: [<?php echo $jumlah; ?>]
  },
                  // {
                  //   name: '<?php echo $merek; ?>',
                  //   data: [<?php echo $kls; ?>]
                  // },

                  <?php } ?>
                  ]
              });
});
</script>

<?php 
  //Include Koneksi
  // mysql_connect("localhost","root","");
  //   mysql_select_db("db_raport");
    
  //Membuat Query
  
    
     $k=mysqli_query($link1,"select nilai_akhir as jml,semester,kd_mapel,id_kelas from rekap_nilai where nis='" . $_SESSION['admin-siswa'] . "' order by id_kelas");        
  $q=mysqli_query($link1,"SELECT rekap_nilai.nis,rekap_nilai.semester,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
        tbl_mapel.nama_mapel  FROM rekap_nilai,tbl_kelas,tbl_mapel 
        where rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.kd_mapel=tbl_mapel.kd_mapel and rekap_nilai.nis='" . $_SESSION['admin-siswa'] . "'");
               

?>

<!-- File yang diperlukan dalam membuat chart -->
<!-- <script src="modules/beranda/jquery.min.js"></script>
<script src="modules/beranda/highcharts.js"></script -->
<script src="modules/beranda/exporting.js"></script>
    
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
              categories: [<?php while($r=mysqli_fetch_array($q)){ echo "'Kelas :".$r["kelas"]." <br/>Mapel :".$r["nama_mapel"]." <br/>Semester: ".$r["semester"]."',";}?>]
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
            data: [<?php while($t=mysqli_fetch_array($k)){ echo $t["jml"].",";}?>]
        }]
    });
});
</script>

<!-- <div id="view" style="min-width: 310px; height: 400px; margin: 0 auto"></div> -->

<h3 class="page-header"><i class="fa fa-home fa-fw fa-2x"></i>Beranda </h3>

<div class="row">
    <div class="col-md-5 text-right">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Statistik Hasil Belajar Siswa Per Semester <i class="fa fa-bar-chart-o fa-fw fa-2x"></i></div>
           <hr>
            <div id='container'></div>
            <hr>
        </div>
    </div>

    <div class="col-md-7 text-right">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
             <div class="panel-heading">Statistik Hasil Belajar Siswa Per Pelajaran <i class="fa fa-bar-chart-o fa-fw fa-2x"></i></div>
            <hr>
                <!-- Post Content -->
                <div id="view"></div>

                <hr>
        </div>
    </div>
</div>
