<?php
$result = query_chart_angkatan($link);
?>
<script type="text/javascript">
            $(function() {
                $('#per_angkatan').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',
                        spacingTop: 20
                    },
                    title: {
                        text: 'Statistik Data Upload Kegiatan Ekstrakulikuler'
                    },
                    subtitle: {
                        text: 'Sub : Per Tahun Angkatan Mahasiswa'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            showInLegend: true,
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name} :</td>' +
                                '<td style="padding:0"><b>&nbsp;{point.y:.0f} Kegiatan</b></td></tr>',
                        footerFormat: '</table>',
                        shared: false,
                        useHTML: true
                    },
                    series: [{
                            name: "Data",
                            colorByPoint: true,
                            data: [
                                <?php
                                while($dt = mysqli_fetch_assoc($result)){
                                ?>
                                {
                                    <?php
                                    echo "name: ",$dt['angkatan'],",";
                                    echo "y: $dt[jml]";
                                    ?>
                                },
                                <?php } ?>
                            ]
                        }]
                });
            });
        </script>