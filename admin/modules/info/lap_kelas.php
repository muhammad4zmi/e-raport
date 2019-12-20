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
    <table class="table table-striped table-hover table-condensed table-bordered">
        <thead>
            <tr>
               <th>#</th>
                                            
                                            <th>Kelas</th>
                                            <th>Siswa</th>
                                            <!-- <th >Wali Kelas</th> -->
                                            <th>Aksi</th>
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
                                                <td>

                                                   <a href="#" class="edit-record" data-id="<?php echo $data_kelas['id_kelas'];?>" title="" data-original-title="">
                                                    <button type="button" class="btn btn-info btn-flat btn-xs"><i class="glyphicon glyphicon-edit"></i></button>
                                                </a>
                                                <a href="#" data-href="index.php?admin=del_kelas&id_kelas=<?php echo $data_kelas['id_kelas']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <button type="button" class="btn btn-danger btn-flat btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

                                                </a>
                                                
                                            </td>
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

