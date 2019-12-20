<?php

function view_angkatan($kelas, $link) {
    ?>
 
     <table class="table table-striped table-hover table-condensed table-bordered" >
        <thead>
            <tr>
               <th>#</th>
                                            <th>Mata Pelajaran</th>
                                            <!-- <th>Kelas</th> -->
                                            
                                            <th >Nama Guru</th>
                                            
                                            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $test = mysqli_query($link,"select * from rapot");
            //             while( $ret = mysqli_fetch_array($test) ){
            //             $nis1=$ret['nis']; 
                    
            $no = 1;
            $sql_laporan = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_guru.nip,
jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas,
            tbl_guru.nama_guru from tbl_kelas,tbl_mapel,tbl_guru,jadwal where
            tbl_kelas.id_kelas=jadwal.id_kelas and jadwal.nip=tbl_guru.nip and
        jadwal.kd_mapel=tbl_mapel.kd_mapel and tbl_kelas.kelas='$kelas'  group by tbl_mapel.kd_mapel");
        //}
            while ($data_r = mysqli_fetch_assoc($sql_laporan)) {
                   // $nis=$data_r['nis'];
                    $kelas=$data_r['kelas'];
                    //$semester=$data_r['semester'];
                  
                ?>
                 <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><?php echo $data_r['kd_mapel']."  ".$data_r['nama_mapel']; ?></td>
                                                <!-- <td><?php echo $data_r['kelas']; ?></td> -->
<!--                                                 <td><?php echo $data_r['thn_ajaran']; ?></td> -->
                                                <td><?php echo $data_r['nip']." ".$data_r['nama_guru']; ?></td>
                                                
                                                <td>
                                                 <a href="?admin=view_nilai&kd_mapel=<?php echo $data_r['kd_mapel']; ?>&kelas=<?php echo $kelas;?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Nilai Siswa <?php echo $data_r['nama_mapel']?>">
                                                       <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-download"></i> Lihat Nilai</button>
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

