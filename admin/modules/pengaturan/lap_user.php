<?php

function view_angkatan($angkatan, $link)  {

    ?>
    <table class='table table-striped'>
        <thead>
        <td><big><b><i class='icon-file icon-white'></i> #</b></big></td>
    <td><big><b><i class='icon-user icon-white'></i>Username</b></big></td>
    <td><big><b><i class='icon-barcode icon-white'></i>Email</b></big></td>
    <td><big><b><i class='icon-barcode icon-white'></i>NIS Siswa</b></big></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </thead>
    <?php
    $query = "select akun.username,akun.email,akun.password,tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_siswa.nisn,tbl_siswa.alamat,
                    tbl_kelas.kelas,akun.status FROM akun,tbl_kelas,tbl_siswa
                    where tbl_siswa.nis=akun.nis and tbl_kelas.kelas='$a_angk2'  
                    group by tbl_siswa.nis";
    $hasil = mysqli_query($link, $query);
    $num = mysqli_num_rows($hasil);
    $id = 1;
    while ($data = mysqli_fetch_array($hasil)) {
        ?>
        <tr <?php echo ($data['status'] != 1) ? "class='danger'" : "class='success'"; ?>>
            <td><?php echo $id; ?></td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><a class="btn <?php echo ($data['status'] != 1) ? "btn-danger":"btn-success";?> btn-xs" data-toggle="modal" data-target="#<?php echo $data['nim']; ?>"><?php echo $data['nim']; ?></a></td>
        <div class="modal fade" id="<?php echo $data['nis']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">Identitas Siswa <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                            <div class="panel-body">
                                Nama : <?php echo $data['nama_lengkap']; ?><br/>
                                Kelas : <?php echo $data['kelas'] ;?><br/>
                                Alamat : <?php echo $data['alamat']; ?>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <td>
            <a href="?admin=hapus_akun&id_user=<?php echo $data['nis']; ?>" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Hapus :  <?php echo $data['nama_lengkap']; ?>" onclick="return confirm('Anda yakin menghapus Akun dengan Nama <?php echo $data['nama_lengkap']; ?> ?');">
                <i class='fa fa-trash-o fa-lg'></i>
            </a>
        </td>
        <td>
            <a href="?admin=reset_akun&id_user=<?php echo $data['username']; ?>" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Reset Password" onclick="return confirm('Anda yakin ingin reset password Akun dengan Nama <?php echo $data['nama_mhs']; ?> ?');">
                <i class='fa fa-refresh fa-lg'></i>
            </a>
        </td>
        <?php if ($data['status'] != 1) { ?>
            <td>
                <a href="?admin=aktivasi&id_user=<?php echo $data['username']; ?>" class="tultip" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Aktifkan Akun" onclick="return confirm('Anda yakin ingin mengaktifkan Akun dengan Nama <?php echo $data['nama_mhs']; ?> ?');">
                    <i class='fa fa-unlock-alt fa-lg'></i>
                </a>
            </td>    
            <?php
        }
        $id++;
    }
    ?>
    </tr>
    </table>
    <?php
}
