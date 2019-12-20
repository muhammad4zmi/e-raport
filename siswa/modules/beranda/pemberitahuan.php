<?php
$tandai = mysqli_query($link, "SELECT Count(penilaian.tandai) as tanda FROM penilaian
					WHERE penilaian.nim='" . $_SESSION['admin-mhs'] . "' and penilaian.tandai = '0'
					AND penilaian.status in ('1','2')");
$t0 = mysqli_fetch_array($tandai);
$notif = $t0['tanda'];
?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <b>Pemberitahuan</b> <?php echo ($t0['tanda'] != '0') ? "<span class=\"badge badge-important\"><b>" . $notif . "</b></span><b class=\"caret\"></b>" : ""; ?>
</a>
<?php
$tandai2 = mysqli_query($link, "SELECT penilaian.id_data,penilaian.nama_file,penilaian.nilai,penilaian.status,
						DATE(penilaian.waktu) as tanggl,
						TIME(penilaian.waktu)as v_j,
						TIMESTAMPDIFF(HOUR,penilaian.waktu,NOW()) as jam,
						TIMESTAMPDIFF(MINUTE,penilaian.waktu,NOW()) as min
						FROM penilaian WHERE penilaian.nim='" . $_SESSION['admin-mhs'] . "' and penilaian.tandai = '0' and
						penilaian.status in ('1','2')");
$r = mysqli_num_rows($tandai2);
if ($r > 0) {
    ?>
    <ul class="dropdown-menu">
        <?php
        while ($list0 = mysqli_fetch_array($tandai2)) {
            if ($list0['status'] == '1') {
                ?>
                <li>
                    <a href="index.php?mhs=laporan&id=<?php echo $cipher->encrypt($list0['id_data'],$kunci); ?>"><?php echo $list0['nama_file'] . " (Nilai " . $list0['nilai'] . ")<br>"; ?>
                        <small>
                            <i>
                                <?php
                                if ($list0['min'] < 1)
                                    echo "Baru Saja Divalidasi";
                                else if ($list0['min'] >= 1 and $list0['min'] < 60)
                                    echo "Di Validasi Pada " . $list0['min'] . " Menit yg lalu";
                                else if ($list0['jam'] > 0 and $list0['jam'] < 24)
                                    echo "Di Validasi Pada " . $list0['jam'] . " Jam yg lalu";
                                else if ($list0['jam'] >= 24 and $list0['jam'] < 48) //jika Jam lebih dari 24 jam
                                    echo "Kemarin, Pukul " . $list0['v_j'];
                                else if ($list0['jam'] >= 48) //jika Jam lebih dari 48 jam
                                    echo "Di Validasi Pada " . $list0['tanggl'] . ", Pukul " . $list0['v_j'];
                                ?>
                            </i>
                        </small>
                    </a>
                </li>
                <?php
            } else if ($list0['status'] == '2') {
               ?>
                <li>
                    <a href="index.php?mhs=laporan_ubah&data=<?php echo $cipher->encrypt($list0['id_data'],$kunci); ?>&stat=<?php echo $cipher->encrypt(antiinjection($list0['status']),$kunci); ?>"><?php echo $list0['nama_file'] . " (Nilai " . $list0['nilai'] . ")<br>"; ?>
                            <i>
                                <?php
                                if ($list0['min'] < 1)
                                    echo "<span class='label label-danger'>Periksa Kembali Data Upload Kegiatan Anda.</span> <br/><small>(Baru Saja)</small>";
                                else if ($list0['min'] >= 1 and $list0['min'] < 60)
                                    echo "<span class='label label-danger'>Periksa Kembali Data Upload Kegiatan Anda.</span> <br/><small>(Pemberitahuan Validasi : " . $list0['min'] . " Menit yg lalu)</small>";
                                else if ($list0['jam'] > 0 and $list0['jam'] < 24)
                                    echo "<span class='label label-danger'>Periksa Kembali Data Upload Kegiatan Anda.</span> <br/><small>(Pemberitahuan Validasi : " . $list0['jam'] . " Jam yg lalu)</small>";
                                else if ($list0['jam'] >= 24 and $list0['jam'] < 48) //jika Jam lebih dari 24 jam
                                    echo "<span class='label label-danger'>Periksa Kembali Data Upload Kegiatan Anda.</span> <br/><small>(Pemberitahuan Validasi : Kemarin, Pukul " . $list0['v_j'];
                                else if ($list0['jam'] >= 48) //jika Jam lebih dari 48 jam
                                    echo "<span class='label label-danger'>Periksa Kembali Data Upload Kegiatan Anda.</span> <br/><small>(Pemberitahuan Validasi : " . $list0['tanggl'] . ", Pukul " . $list0['v_j'];
                                ?>
                            </i>
                    </a>
                </li>
                <?php 
            }
        }
        ?>
    </ul>
    <?php
}
?>