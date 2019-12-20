<?php
$qBarUnsur = query_chart_unsur($link);
$qPieUnsur = query_chart_unsur($link);
?>
<script type="text/javascript">
            $(function() {
                $('#per_unsur').highcharts({
                    chart: {
                        spacingTop: 20
                    },
                    title: {
                        text: 'Statistik Data Upload Kegiatan Ekstrakulikuler'
                    },
                    subtitle: {
                        text: 'Sub : Per Unsur Kegiatan'
                    },
                    xAxis: {
                        categories: ['Nama Unsur Kegiatan']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Kegiatan Ekstrakurikuler'
                        }
                    },
                    labels: {
                        items: [{
                                html: 'Persentase Unsur Kegiatan',
                                style: {
                                    left: '50px',
                                    top: '18px',
                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                }
                            }]
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name} :</td>' +
                                '<td style="padding:0"><b>&nbsp;{point.y:.0f} Kegiatan</b></td></tr>',
                        footerFormat: '</table>',
                        shared: false,
                        useHTML: true
                    },
                    series: [
                        <?php
                        while($dtBarUnsur = mysqli_fetch_array($qBarUnsur)){
                        ?>
                        {
                            <?php
                            echo "type: 'column',";
                            echo "name: '$dtBarUnsur[nama_unsur]',";
                            echo "data: [$dtBarUnsur[jml]]";
                            ?>
                        },
                        <?php } ?>
                        {
                            type: 'pie',
                            name: '<br>Data&nbsp;',
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            colorByPoint: true,
                            data: [
                                <?php
                            $no=0;
                                while($dtPieUnsur = mysqli_fetch_array($qPieUnsur)){
                                ?>
                                {
                                    <?php
                                    echo "name: '$dtPieUnsur[nama_unsur]',";
                                    echo "y: $dtPieUnsur[jml],";
                                    echo "color: Highcharts.getOptions().colors[$no]"; // color
                                    ?>
                                },
                                <?php $no++; } ?>
                                    ],
                            allowPointSelect: true,
                            cursor: 'pointer',
                            center: [100, 80],
                            size: 100,
                            showInLegend: false,
                            dataLabels: {
                                enabled: false
                            }
                        }]
                });
            });
        </script>