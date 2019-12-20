<?php

if (isset($_POST['ubah'])) {
    include "../../../config/config.php";

    // mengatur time zone untuk WIB.
    date_default_timezone_set("Asia/Jakarta");
    $tgl = date("Ymd");
    $status = '0';
    $data = antiinjection($_POST['data']);
    $nim = antiinjection($_POST['nim']);
    $nm_kegiatan = antiinjection($_POST['nm_kegiatan']);
//  $unsur = antiinjection($_POST['unsur']);
//  $sub_unsur = antiinjection($_POST['sub_unsur']);
//  $sub_unsur2 = antiinjection($_POST['sub_unsur2']);
    $butir = antiinjection($_POST['butir']);
    $butir2 = antiinjection($_POST['butir2']);
    $nilai_cek = antiinjection($_POST['nilai']);
    if (!isset($nilai_cek)) {
        $nilai = 0;
    } else {
        $nilai = $nilai_cek;
    }
//  if ($_POST['sub_unsur2'] == '--')
//    $s_unsur = $sub_unsur;
//  else
//    $s_unsur = $sub_unsur2;
    if ($_POST['butir2'] == '--')
        $btr = $butir;
    else
        $btr = $butir2;
    //merubah nama file upload
    //proses Update File Kegiatan
    if (empty($_FILES) || $_FILES['file']['size'] == 0 || $_FILES['file']['error'] != 0) {
        //jika tidak ada perubahan file kegiatan
        $nama_file_lama = antiinjection($_POST['oldfile']);
        $sql = "UPDATE penilaian set nama_file='" . $nama_file_lama . "',nm_kegiatan = '" . $nm_kegiatan . "',
          kd_butir = '" . $btr . "', nilai = '" . $nilai . "', status = '" . $status . "' where id_data = '$data'";
        $cek = mysqli_query($link, $sql);
        if ($cek) {
            //$move = move_uploaded_file($_FILES['file']['tmp_name'], '../../../file_upload/' . $nim . "/" . $nama_file_baru);
            echo "<div class='alert alert-success' align='center'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Success!</h4>
                Kegiatan Berhasil Di Ubah. Silahkan Cek dengan Mengklik menu <a href='index.php?mhs=laporan'>Lihat file anda.</a>
             </div>";
        } else {
            echo "<div class='alert alert-warning' align='center'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Gagal!</h4>
                File Anda Gagal Terkirim. Silahkan Beritahukan Admin mengenai Pesan Error ini. <a href='index.php?mhs=laporan'>Lihat file anda.</a>
             </div>" . mysqli_error($link);
        }
    } else {
        $nama_file_lama = antiinjection($_POST['oldfile']);
        //membaca file upload
        $fileName = $_FILES['file']['name'];
        // membaca ukuran file yang diupload
        $fileSize = $_FILES['file']['size'];
        // membaca jenis file yang diupload
        $fileType = $_FILES['file']['type'];
        $info_file = pathinfo($fileName);
        $max_size = 1024000 * 5; //max file 5 mb
        $new_nama = $nim . "-" . $fileName;
        $nama_file = str_replace($fileName, $new_nama, $fileName);
        $nama_file_baru = $nama_file;
        if (($fileSize > $max_size)) {
            echo "<div class='alert alert-error' align='center'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <h4>Warning!</h4>
            Maaf, Proses Upload Gagal. Ukuran File Anda Tidak Boleh Lebih dari 5 MB !<br/><a href='index.php?mhs=upload'>Kembali.</a>
        </div>";
        } else if (!($info_file['extension'] == 'jpg' || $info_file['extension'] == 'JPG' || $info_file['extension'] == 'rar' || $info_file['extension'] == 'zip')) {
            echo "<div class='alert alert-warning' align='center'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <h4>Warning!</h4>
            Maaf, Proses Upload Gagal. File Yg di izinkan Hanya Document Image (.JPG), (.doc/.docx) atau Archive (.zip/.rar)!<br/><a href='index.php?mhs=upload'>Kembali.</a>
        </div>";
        } else {
            //menghapus file yg lama
            unlink("../../../file_upload/" . $nim . "/" . $nama_file_lama);
            $sql = "UPDATE penilaian set nama_file='" . $nama_file_baru . "',nm_kegiatan = '" . $nm_kegiatan . "',
          kd_butir = '" . $btr . "',nilai = '" . $nilai . "',status = '" . $status . "' where id_data = '$data'";
            //eksekusi query update kegiatan
            $cek = mysqli_query($link, $sql);
            if ($cek) {
                $move = move_uploaded_file($_FILES['file']['tmp_name'], '../../../file_upload/' . $nim . "/" . $nama_file_baru);
                echo "<div class='alert alert-success' align='center'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Success!</h4>
                Kegiatan Berhasil Di Ubah. Silahkan Cek dengan Mengklik menu <a href='index.php?mhs=laporan'>Lihat file anda.</a>
             </div>";
            } else {
                echo "<div class='alert alert-warning' align='center'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <h4>Gagal!</h4>
                File Anda Gagal Terkirim. Silahkan Beritahukan Admin mengenai Pesan Error ini. <a href='index.php?mhs=laporan'>Lihat file anda.</a>
             </div>" . mysqli_error($link);
            }
        }
    }

//    echo "<meta http-equiv='refresh' content='3; url=index.php?mhs=laporan'>";
}
?>