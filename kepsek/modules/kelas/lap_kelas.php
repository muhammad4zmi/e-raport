<?php

function view_angkatan($kelas, $link) {
    ?>
    <?php
                        $per_hal = 10;
                        $jumlah_record = mysqli_query ($link,"SELECT * FROM tbl_kelas");
        //$jum = mysql_result($jumlah_record,0);
                        $jmldata    = mysqli_num_rows($jumlah_record);
                        $halaman = ceil($jmldata/$per_hal);
                        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                        $start = ($page - 1) * $per_hal;
                        ?>
     <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
               <th width="5%">#</th>
                                            
                                            <th width="10%">Kelas</th>
                                            <th width="20%">Siswa</th>
                                            <!-- <th >Wali Kelas</th> -->
                                            
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql_laporan = mysqli_query($link, "SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_siswa.nis,tbl_siswa.nama_lengkap
from tbl_kelas INNER JOIN tbl_siswa ON tbl_kelas.nis=tbl_siswa.nis and tbl_kelas.kelas='$kelas' ");
            while ($data_kelas = mysqli_fetch_assoc($sql_laporan)) {
                ?>
                 <tr>
                                                <td><?php echo $no; ?></td>
                                               
                                                <td><?php echo $data_kelas['kelas']; ?></td>
                                                <td><?php echo $data_kelas['nis']."  ".$data_kelas['nama_lengkap']; ?></td>
                                                <!-- <td><?php echo $data_kelas['nip']."  ".$data_kelas['nama_guru'];?></td> -->
                                                
                                        </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <nav align="center">
                            <ul class="pagination">

                                <li class="disabled"><a href="?admin=dt_kelas&page=<?php echo $page -1 ?>" aria-label="Previous"> <span aria-hidden="true">Sebelumnya</span></a></li>
                            </ul>
                            <?php 
                            for($x=1;$x<=$halaman;$x++)
                            {
                                ?>
                                <ul class="pagination">
                                    <li class="active"><a href="?admin=dt_kelas&page=<?php echo $x ?>"><?php echo $x ?><span class="sr-only">(current)</span></a></li>
                                </ul>
                                <?php
                            }
                            ?>
                            <ul class="pagination">
                                <li><a href="?admin=dt_kelas&page=<?php echo $page +1 ?>" aria-label="Next"> <span aria-hidden="true">Selanjutnya</span></a></li>
                            </ul>
                        </nav>
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

