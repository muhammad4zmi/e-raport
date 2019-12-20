<?php
$sql = mysqli_query($link, "SELECT sub_unsur.nama_sub_unsur FROM
                            penilaian,butir,sub_unsur WHERE penilaian.kd_butir = butir.kd_butir 
                            AND butir.kd_sub_unsur = sub_unsur.kd_sub_unsur 
                            AND penilaian.nim='" . $_SESSION['admin-mhs'] . "' AND sub_unsur.nama_sub_unsur LIKE '%Mengikuti Kegiatan Orientasi Mahasiswa Baru%';");
$hasil = mysqli_fetch_array($sql);
$cek = mysqli_num_rows($sql);
if ($cek) {
    ?>
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <big><strong><i class="fa fa-check-square-o fa-fw fa-2x"></i>Info !</strong></big> Anda Sudah mengupload data Kegiatan <i><strong><?php echo $hasil['nama_sub_unsur']; ?></strong></i> yang merupakan Salah satu syarat wajib mengikuti Yudisium.
    </div>
<?php } else {
    ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <big><strong><i class="fa fa-warning fa-fw fa-2x"></i>Info !</strong></big> Anda belum mengupload data Kegiatan <i><strong>Mengikuti Kegiatan Orientasi Mahasiswa Baru</strong></i> yang merupakan Salah satu syarat wajib mengikuti Yudisium.
    </div>
<?php } ?>