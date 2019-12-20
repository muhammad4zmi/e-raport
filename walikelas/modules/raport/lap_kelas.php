<?php

function view_angkatan($kelas, $link) {
    ?>
    <?php
                        $per_hal = 10;
                        $jumlah_record = mysqli_query ($link,"SELECT * FROM rapot");
                        
        //$jum = mysql_result($jumlah_record,0);
                        $jmldata    = mysqli_num_rows($jumlah_record);
                        $halaman = ceil($jmldata/$per_hal);
                        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                        $start = ($page - 1) * $per_hal;

                        
                       // print_r($m);
                        ?>
    <table class="table table-striped table-hover table-condensed table-bordered" id="example1">
        <thead>
            <tr>
               <th>#</th>
                                            <th>Nama Siswa</th>
                                            <!-- <th>Kelas</th> -->
                                            
                                            <th >Semester</th>
                                            
                                            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $test = mysqli_query($link,"select * from rapot");
            //             while( $ret = mysqli_fetch_array($test) ){
            //             $nis1=$ret['nis']; 
                    
            $no = 1;
            $sql_laporan = mysqli_query($link, "SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_siswa.nis,
 tbl_siswa.nama_lengkap,rekap_nilai.semester from rekap_nilai INNER JOIN 
tbl_kelas ON rekap_nilai.id_kelas=tbl_kelas.id_kelas 
INNER JOIN tbl_siswa ON tbl_kelas.nis=tbl_siswa.nis and 
tbl_kelas.kelas='$kelas' group by tbl_siswa.nis");
        //}
            while ($data_r = mysqli_fetch_assoc($sql_laporan)) {
                    $nis=$data_r['nis'];
                    $id_kelas=$data_r['id_kelas'];
                    $kelas=$data_r['kelas'];
                    $semester=$data_r['semester'];
                    $query_total = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                                Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                                FROM rapot
                                                WHERE rapot.id_kelas and rapot.id_kelas='$id_kelas' and rapot.nis ='$nis' 
                                                and rapot.semester='Ganjil'  GROUP BY rapot.nis");
                         $total_nilai = mysqli_fetch_array($query_total);
                         $jml_nilai_ganjil = $total_nilai['tot_nilai'];


                         //genap
                         $query_total2 = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                                Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                                FROM rapot
                                                WHERE rapot.id_kelas and rapot.id_kelas='$id_kelas' and rapot.nis ='$nis' 
                                                and rapot.semester='Genap'  GROUP BY rapot.nis");
                         $total_nilai1 = mysqli_fetch_array($query_total2);
                         $jml_nilai_genap = $total_nilai1['tot_nilai'];

                ?>
                 <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><?php echo $data_r['nis']."  ".$data_r['nama_lengkap']; ?></td>
                                                <!-- <td><?php echo $data_r['kelas']; ?></td> -->
<!--                                                 <td><?php echo $data_r['thn_ajaran']; ?></td> -->
                                                <td>
                                                <?php
                                                    if($jml_nilai_ganjil==0){
                                                      echo "Nilai Ganjil <span class='badge bg-red'><strong>0</strong></span>";  
                                                    }elseif($jml_nilai_ganjil > 0){
                                                        echo "Nilai Ganjil <span class='badge bg-yellow'><strong> $jml_nilai_ganjil </strong></span>";
                                                    }
                                                
                                                    ?>
                                                    <?php
                                                    if($jml_nilai_genap==0){
                                                      echo "Nilai Genap <span class='badge bg-red'><strong>0</strong></span>";  
                                                    }elseif($jml_nilai_genap > 0){
                                                        echo "Nilai Genap <span class='badge bg-green'><strong> $jml_nilai_genap </strong></span>";
                                                    }
                                                
                                                    ?>
                                                    </td>
                                                
                                                <td>
                                                 <a href="?admin=detail_raport&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Raport Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                   </a>
                                                   <a href="?admin=add_raport&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Isi Raport Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-plus-circle"></i></button>
                                                   </a>

                                                   
                                                <a href="#" data-href="index.php?admin=del-raport&nis=<?php echo $data_r['nis']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <button type="button" class="btn btn-danger btn-flat btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

                                                </a>
                                                <a href="?admin=chart-siswa&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Grafik Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-bar-chart"></i>  Lihat Grafik </button>
                                                   </a> 
                                                
                                            </td>
                                        </tr>
                <?php
                $no++;
            }
        
            ?>
        </tbody>
    </table>
    <!-- <nav align="center">
                            <ul class="pagination">

                                <li class="disabled"><a href="?admin=raport&page=<?php echo $page -1 ?>" aria-label="Previous"> <span aria-hidden="true">Sebelumnya</span></a></li>
                            </ul>
                            <?php 
                            for($x=1;$x<=$halaman;$x++)
                            {
                                ?>
                                <ul class="pagination">
                                    <li class="active"><a href="?admin=raport&page=<?php echo $x ?>"><?php echo $x ?><span class="sr-only">(current)</span></a></li>
                                </ul>
                                <?php
                            }
                            ?>
                            <ul class="pagination">
                                <li><a href="?admin=raport&page=<?php echo $page +1 ?>" aria-label="Next"> <span aria-hidden="true">Selanjutnya</span></a></li>
                            </ul>
                        </nav> -->
    <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
                    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
                    <!-- AdminLTE App -->
                    <script src="js/AdminLTE/app.js" type="text/javascript"></script>
                    <!-- AdminLTE for demo purposes -->

                    <!-- page script -->
                   <script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>


    <?php
}

