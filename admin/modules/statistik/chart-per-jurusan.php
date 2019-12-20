<?php
$qPieJurusan = query_chart_jurusan($link);
?>
<script type="text/javascript">
            $(function() {
                $('#per_jurusan').highcharts({
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
                        text: 'Sub : Per Program Studi / Jurusan'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
							showInLegend: true,
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.0f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                            name: "Data",
                            colorByPoint: true,
                            data: [
                                <?php
                                while($dtJur = mysqli_fetch_assoc($qPieJurusan)){
                                    $jur=jurusan($dtJur['jurusan']);
                                ?>
                                {
                                    <?php
                                    echo "name: '$dtJur[prodi]/$jur',";
                                    echo "y: $dtJur[jml]";
                                    ?>
                                },
                                <?php } ?>
                            ]
                        }]
                });
            });
        </script>