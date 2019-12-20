<?php
include "config/config.php";
$server = server();
if (isset($_POST['s_user']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = antiinjection($_POST['nis']);
    $nama_siswa = antiinjection($_POST['nama_siswa']);
    $emailsiswa = antiinjection($_POST['emailsiswa']);
    $gender = antiinjection($_POST['gender']);
    $pass1 = antiinjection($_POST['pass1']);
    $pass2 = antiinjection($_POST['pass2']);

    if ($pass1 !== $pass2) {
        ?>
        <script>
            alert('Maaf, Password Pertama dan Kedua Tidak Sama. Ulangi Kembali!');
            window.location = 'index.php';
        </script>
        <?php
    } 
        
        $passwd1 = $cipher->encrypt($pass1, $kunci);
        $passwd2 = $cipher->encrypt($pass2, $kunci);
        
        //enkripsi password (token)
        $token = md5($passwd1);
        $val_user = mysqli_query($link, "SELECT nis from akun where nis = '" . $nis . "'");
        $c_siswa = mysqli_num_rows($val_user);
        // if ($c_mhs == 0) {
        //     $t_mhs = mysqli_query($link, "insert into bantuan values('" . $nis . "','" . $nama_siswa . "','" . $gender . "')");

            if ($c_siswa==0) {
                // $oldmask = umask(0);
                // mkdir("file_upload/$nis", 0777);
                // umask($oldmask);
                $t_akun = mysqli_query($link, "insert into akun values('" . $nis . "','" . md5($passwd1) . "','" . $passwd2 . "','" . $emailsiswa . "','" . $nis . "',0)");
                //mengirim informasi pembuatan akun ke email mahasiswa
                $mail_from = mail_server();
                $subject = "Informasi Akun Raport Siswa";
                $pesan = "
                    <div style='margin: 20px 0; padding: 20px; border-left: 3px solid #eee;background-color: #f4f8fa; border-color: #bce8f1;'>
                    <h4>
                        <strong>Hi $nama_siswa</strong>, 
                            Akun Anda Berhasil Di buat untuk Login ke website eraport.smpn1mataram.sch.id.
                    </h4>
                    <p>Username dan Password Anda : </p>
                    <p>Username : $nis</p>
                    <p>Password : $pass2</p>
                    </div>
                    <br/>
                    Klik link <a href='$server/validasi.php?akun=$nis&token=$token'><i>Aktifkan Akun</i></a> untuk mengaktifkan Akun Anda.
                    ";
                $message = $pesan;
                $headers = "From: $mail_from\r\n";
                $headers .= "Reply-To: $mail_from\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                @mail($emailsiswa, $subject, $message, $headers);
                ?>
                <link href="assets/css/bootstrap.min.css" rel="stylesheet">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Daftar Akun</h4>
                        </div>
                        <div class="modal-body">
                            <p><strong>Selamat</strong></p>
                            <p>Silahkan Anda Login dengan Akun berikut. . .</p>
                            <p>Username : <b><strong><?php echo $nis; ?></strong></b></p>
                            <p>Password : <b><strong><?php echo $pass1; ?></strong></b></p>
                            <p>
                                Informasi Pembuatan akun Anda juga terkirim ke email Siswa Anda ( <?php echo $emailsiswa; ?> )
                            </p>
                            <p>Anda bisa merubah Password Anda setelah Login melalui menu Pengaturan. Terima Kasih.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="index.php#section2"><button type="button" class="btn btn-primary">Lanjutkan Untuk Login</button></a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                <?php
            } else {
                ?>
                <script>
                    alert('Maaf, User Gagal Di Buat. Terjadi Kesalahan. Hubungi Admin (Bag.Tata usaha)<?php echo mysqli_error($link); ?>');
                    window.location = 'index.php#section3';
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('Maaf, User Gagal Di Buat. NIS Sudah Terdaftar. Cek Email Siswa Anda untuk mengetahui Informasi Akun Anda atau Hubungi Bag.tata Usaha jika mengalami masalah .');
                window.location = 'index.php';
            </script>
            <?php
        }

