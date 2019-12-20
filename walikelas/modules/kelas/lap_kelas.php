<?php

function view_angkatan($kelas, $link) {
    ?>
  
    <div class="panel-body">
        <table  class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
               <th width="3%">#</th>
                                            
                <th width="10%">NIS</th>
                <th width="25%">Nama Lengkap</th>
                <th width="30%">Alamat</th>                         <!-- <th >Wali Kelas</th> -->
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql_laporan = mysqli_query($link, "SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_siswa.alamat
                from tbl_kelas INNER JOIN tbl_siswa ON tbl_kelas.nis=tbl_siswa.nis and 
                tbl_kelas.kelas='$kelas' ");
            while ($data_kelas = mysqli_fetch_assoc($sql_laporan)) {
                ?>
                 <tr>
                                                <td><?php echo $no; ?></td>
                                               
                                                <td><?php echo $data_kelas['nis']; ?></td>
                                                <td><?php echo $data_kelas['nama_lengkap']; ?></td>
                                                <td><?php echo $data_kelas['alamat'];?></td>
                                                <td>
                                                     <a href="?admin=detail_siswa&nis=<?php echo $data_kelas['nis']; ?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Siswa <?php echo $data_kelas['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                   </a>

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
    </div>
    


    <?php
}

