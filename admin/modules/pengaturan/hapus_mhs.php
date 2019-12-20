<?php

if (isset($_GET['id_user'])) {

    //Delete folder function
    function deleteDirectory($dir) {
        if (!file_exists($dir))
            return true;
        if (!is_dir($dir) || is_link($dir))
            return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..')
                continue;
            if (!deleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!deleteDirectory($dir . "/" . $item))
                    return false;
            };
        }
        return rmdir($dir);
    }

    $id = antiinjection($_GET['id_user']);
    $sql = "select nis,nama_lengkap from tbl_siswa where tbl_siswa.nis='$id'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $del = mysqli_query($link, "delete from tbl_siswa where nis='$id'");
        if ($del) {
            //delete file
            deleteDirectory("../file_upload/" . $data['nim']);
            $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Akun Siswa Berhasil Di Hapus.
                  </div>";
            $_SESSION['alert'] = $alert;
        } else {
            $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Akun Siswa Gagal Di Hapus.
                  </div>";
            $_SESSION['alert'] = $alert;
        }
    } else {
        ?>
        <script>alert("Warning! Proses Hapus Data Siswa Gagal. Cek Query.");
            window.location = "index.php?admin=pengaturan";
        </script>
        <?php

    }
    ?>
    <script type="text/javascript">document.location = "index.php?admin=pengaturan";</script>
    <?php

}