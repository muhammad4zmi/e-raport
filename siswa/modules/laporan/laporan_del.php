<?php

if (isset($_GET['data'])) {
    $id = $cipher->decrypt(antiinjection($_GET['data']),$kunci);
    $sql = "select id_data,nim,nama_file from penilaian where penilaian.id_data='$id'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
        $del = mysqli_query($link, "delete from penilaian where penilaian.id_data='$id'");
        if ($del) {
            //delete file
            unlink("../file_upload/" . $data['nim']."/" . $data['nama_file']);
            ?>
             <!-- Modal -->
            <div class="modal fade" id="ModalRes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Informasi</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success fade in">
                                <h4>Sukses!</h4>
                                <p>Berhasil! Data Kegiatan Anda Berhasil Dihapus</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script type="text/javascript">
                $('#ModalRes').modal('show');
            </script>
            <script>alert("Berhasil! Data Kegiatan Anda Berhasil Dihapus.");
                window.location = "index.php?mhs=laporan";</script>
            <?php

        } else {
            ?>
            <script>alert("Gagal! Data Kegiatan Tidak berhasil dihapus. Coba Ulangi atau Cek Kembali Daftar Kegiatan Anda.");
                window.location = "index.php?mhs=laporan";</script>
            <?php
        }
    } else {
        ?>
        <script>alert("Oops! Proses Hapus Data Kegiatan Gagal. Cek Kembali Daftar Kegiatan Anda.");
            window.location = "index.php?mhs=laporan";</script>
        <?php

    }
}
?>