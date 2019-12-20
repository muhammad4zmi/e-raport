<?php
if (!isset($_SESSION['admin-mhs'])and ! isset($_SESSION['login-mhs'])) {
    header("location:../");
}

$id = $cipher->decrypt(antiinjection($_GET['data']), $kunci);
$v = mysqli_query($link, "SELECT penilaian.id_data,date_format(penilaian.tgl,'%d %M %Y') as tgl,penilaian.nim,penilaian.nama_file,penilaian.nm_kegiatan,
                            unsur.kd_unsur,unsur.nama_unsur,sub_unsur.kd_sub_unsur,sub_unsur.nama_sub_unsur,
                            butir.kd_butir,butir.nama_butir,penilaian.nilai
			  FROM penilaian ,sub_unsur ,unsur ,butir
                          WHERE penilaian.kd_butir = butir.kd_butir
                          AND unsur.kd_unsur = sub_unsur.kd_unsur AND
                            sub_unsur.kd_sub_unsur = butir.kd_sub_unsur AND penilaian.id_data='" . $id . "' ORDER BY penilaian.id_data ASC");
$dt_v = mysqli_fetch_assoc($v);
?>
<script src="modules/laporan/JQueryDinamis.js"></script>
<h3 class="page-header"><i class="fa fa-cloud-upload fa-fw fa-2x"></i> Form Ubah Upload Kegiatan Mahasiswa</h3>
<?php
if (isset($_GET['stat'])) {
    $status = $cipher->decrypt(antiinjection($_GET['stat']), $kunci);
} else {
    $status = '0';
}
if ($status == '2') {
    ?>
    <blockquote class="pull-left">
        <div class="alert alert-dismissable alert-danger">
            <strong><i class="fa fa-warning fa-fw fa-lg"></i>Informasi !</strong><small>Maaf ! Cek Kembali Data Upload Kegiatan Anda. Ada kesalahan File atau Deskripsi Isian Kegiatan</small>
            <p>
                <small>Pastikan isian <b><u>Nama Kegiatan</u></b> di isi sesuai dengan nama jenis kegiatan yg terdapat di bukti hasil <i>Scan</i> Sertifikat Anda.</small>
            </p>
        </div>
        <small><cite title="Source Title"><span class="label label-danger">Bagian Kemahasiswaan</span></cite></small>
    </blockquote>
    <?php
} else {
    ?>
    <blockquote class="pull-left">
        <div class="alert alert-dismissable alert-success">
            <strong><i class="fa fa-check fa-fw fa-lg"></i>Informasi !</strong><small>Catatan ! Anda bisa Mengganti File Kegiatan Anda atau Hanya Mengganti Nama Kegiatan atau Unsur, Sub Unsur maupun Butir Kegiatan.</small>
            <p>
                <small>Pastikan isian <b><u>Nama Kegiatan</u></b> di isi sesuai dengan nama jenis kegiatan yg terdapat di bukti hasil <i>Scan</i> Sertifikat Anda.</small>
            </p>
        </div>
        <small><cite title="Source Title"><span class="label label-success">Bagian Kemahasiswaan</span></cite></small>
    </blockquote>
    <?php
}
?>
<div class="row-fluid placeholders">
    <div class="col-md-6 text-left">
        <form class="form-horizontal" action="modules/laporan/laporan_edit_proses.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group" id="oldfile">
                    <label for="inputFile" class="col-lg-3 control-label">File</label>
                    <div class="col-lg-7">
                        <input class="tultip form-control" id="inputFile" type="text" name="oldfile" value="<?php echo $dt_v['nama_file']; ?>" data-placement="top" title="" data-toggle="tooltip" data-original-title="Format Image File(.jpg) atau Compressed File(.rar/.zip)" readonly="" required/>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="tultip btn btn-success" id="btn_ubah" data-placement="top" title="" data-toggle="tooltip" data-original-title="Ubah File Kegiatan"><i class="fa fa-refresh fa-fw fa-lg"></i></button>
                    </div>
                </div>
                <div class="form-group" id="newfile">
                    <label for="inputFile" class="col-lg-3 control-label">File Kegiatan</label>
                    <div class="col-lg-7">
                        <input class="tultip form-control" id="inputNewFile" type="file" name="file" value="" data-placement="right" title="" data-toggle="tooltip" data-original-title="Format Image File(.jpg) atau Compressed File(.rar/.zip)"/>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="tultip btn btn-danger" id="btn_batal" data-placement="top" title="" data-toggle="tooltip" data-original-title="Batal Mengganti File Kegiatan"><i class="fa fa-ban fa-fw fa-lg"></i></button>
                    </div>
                </div>
                <input class="tultip form-control" value="<?php echo $dt_v['id_data']; ?>" type="hidden" name="data" readonly/>
                <input class="tultip form-control" value="<?php echo $dt_v['nim']; ?>" type="hidden" name="nim" readonly/>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Nama Kegiatan</label>
                    <div class="col-lg-9">
                        <input class="tultip form-control" id="inputNim" value="<?php echo $dt_v['nm_kegiatan']; ?>" type="text" name="nm_kegiatan" placeholder="Nama Kegiatan sesuai dengan Bukti Kegiatan" data-placement="right" title="" data-toggle="tooltip" data-original-title="Nama Kegiatan sesuai dengan Bukti Kegiatan"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUnsur" class="col-lg-3 control-label">Unsur</label>
                    <div class="col-lg-9">
                        <select id="unsur" class="tultip form-control" name="unsur" data-placement="right" title="" data-toggle="tooltip" data-original-title="Nama Unsur Kegiatan" required />
                        <option value="">-Pilih Unsur-</option>
                        <?php
                        $q_unsur = mysqli_query($link, "select * from unsur order by kd_unsur");
                        while ($u_dt = mysqli_fetch_array($q_unsur)) {
                            ?>
                            <option value="<?php echo $u_dt['kd_unsur']; ?>" <?php echo ($u_dt['kd_unsur'] == $dt_v['kd_unsur']) ? "selected" : ""; ?>><?php echo $u_dt['nama_unsur']; ?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSubUnsur" class="col-lg-3 control-label">Sub Unsur</label>
                    <div class="col-lg-9">
                        <select name="sub_unsur" id="sub_unsur" class="tultip form-control" data-placement="right" title="" data-toggle="tooltip" data-original-title="Nama Sub Unsur Kegiatan" required/>
                        <option value="<?php echo $dt_v['kd_butir']; ?>"><?php echo $dt_v['nama_sub_unsur']; ?></option>
                        </select>
                        <select name="sub_unsur2" id="sub_unsur2" class="form-control"/>
                        <option>--</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButir" class="col-lg-3 control-label">Butir</label>
                    <div class="col-lg-9">
                        <select name="butir" id="butir" class="tultip form-control" data-placement="right" title="" data-toggle="tooltip" data-original-title="Nama Butir Kegiatan" required/>
                        <option value="<?php echo $dt_v['kd_butir']; ?>"><?php echo $dt_v['nama_butir']; ?></option>
                        </select>
                        <select name="butir2" id="butir2" class="form-control" required/>
                        <option>--</option>
                        </select>
                        <input class="form-control" id="nilai" type="hidden" value="<?php echo $dt_v['nilai']; ?>" name="nilai" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="reset" class="btn btn-default"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                        <button type="submit" class="tultip btn btn-primary" name="ubah" id="upload" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Klik Jika Data Sudah Sesuai"><i class="fa fa-pencil-square-o fa-fw fa-lg"></i>Ubah Upload File Kegiatan</button>
                    </div>
                </div>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" style="width: 0%"></div>
                    <div class="percent">0%</div >
                </div>
                <div id="status"></div>
            </fieldset>	
        </form>
    </div>
    <div class="col-md-6">
        <?php
        $type = pathinfo("../file_upload/" . $dt_v['nim'] . "/" . $dt_v['nama_file'], PATHINFO_EXTENSION);
        if ($type == 'rar' || $type == 'zip') {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong><span class="fa fa-file-zip-o fa-lg"></span> Tipe File Anda : <?php echo $type; ?> !</strong><br> <?php echo $dt_v['nm_kegiatan']; ?>.
            </div>
            <?php
        } else {
            ?>
            <div class="thumbnail">
                <a data-toggle="modal" data-target="#file" href="#">
                    <img class="img-responsive" alt="300x200" src="../file_upload/<?php echo $dt_v['nim'] . "/" . $dt_v['nama_file']; ?>" style="width: 300px; height: 200px;">
                </a>
                <div class="caption">
                    <h3><?php echo $dt_v['nm_kegiatan']; ?></h3>
                    <p>Di Upload : <?php echo $dt_v['tgl']; ?></p>
                </div>
            </div>
            <div class="modal fade" id="file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-picture-o"></span> File Kegiatan</h4>
                        </div>
                        <div class="modal-body">
                            <img class="img-thumbnail" alt="300x200" src="../file_upload/<?php echo $dt_v['nim'] . "/" . $dt_v['nama_file']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar <span class="fa fa-sign-out"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    (function() {

        var bar = $('.progress-bar-success');
        var percent = $('.percent');
        var status = $('#status');
        $(".progress").hide();
        $('#upload').click(function() {
            $(".progress").fadeIn(10);
        });
        $('form').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
                //console.log(percentVal, position, total);
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
            }
        });

    })();
</script>