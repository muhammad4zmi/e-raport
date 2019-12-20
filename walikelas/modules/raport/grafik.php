<script src="modules/raport/highcharts.js" type="text/javascript"></script>
<script src="modules/raport/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
            $(function() {
                 chart1 = new Highcharts.Chart({
                       chart: {
                        renderTo: 'container',
                        type: 'column'
                    },
                    title: {
                        text: 'Statistik Nilai Rata-Rata Siswa'
                    },
                    subtitle: {
                        text: 'Sub : Per Semester'
                    },
                    xAxis: {
                        categories: ['Nilai Rata-Rata']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Nilai Rata-Rata'
                        }
                    },
                   
                    
                    series: [
                        <?php
                        $nis=$_GET['nis'];

                        $sql   =mysqli_query($link,"SELECT rapot.nis,rapot.semester,
                                tbl_kelas.id_kelas,
                                tbl_kelas.kelas,Sum(rapot.nilai)/count(rapot.kd_mapel) as mapel
                                FROM rapot,tbl_kelas
                                WHERE tbl_kelas.id_kelas=rapot.id_kelas and rapot.nis ='$nis' 
                                and rapot.semester='Ganjil' ");
                        while($dtBarUnsur = mysqli_fetch_array($sql)){
                            ?>
                        {
                            <?php
                            echo "type: 'column',";
                            echo "name: 'Kelas :$dtBarUnsur[kelas],Semester :$dtBarUnsur[semester]',";
                            echo "data: [$dtBarUnsur[mapel]]";
                            ?>
                        },
                        <?php } ?>
                        <?php
                        $sql1   =mysqli_query($link,"SELECT rapot.nis,rapot.semester,
                                tbl_kelas.id_kelas,
                                tbl_kelas.kelas,Sum(rapot.nilai)/count(rapot.kd_mapel) as mapel
                                FROM rapot,tbl_kelas
                                WHERE tbl_kelas.id_kelas=rapot.id_kelas and rapot.nis ='$nis' 
                                and rapot.semester='Genap'");
                        while($dtBarUnsur1 = mysqli_fetch_array($sql1)){
                        ?>
                        {
                            <?php
                            echo "type: 'column',";
                            echo "name: 'Kelas :$dtBarUnsur1[kelas],Semester :$dtBarUnsur1[semester]',";
                            echo "data: [$dtBarUnsur1[mapel]]";
                            ?>
                        },
                        <?php } ?>
                        ]
                });
            });
        </script>

<br/><br/>

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
    <div class="col-md-12 text-right">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Statistik Nilai Rata-Rata Siswa Per Semester <i class="fa fa-bar-chart-o fa-fw fa-2x"></i></div>
           <div class="panel-body">
           <hr>
            <div id='container'></div>
            <hr>
            </div>
        </div>
    </div>

   
</div>
</section>
</aside>
