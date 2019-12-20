<?php
if (!isset($_SESSION['admin-username']))
    header("location:../../login.php");
function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
     // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
    $BulanIndo = array("Januari", "Februari", "Maret",
     "April", "Mei", "Juni",
     "Juli", "Agustus", "September",
     "Oktober", "November", "Desember");
    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
    $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    return($result);
    
}
?>

<link rel="stylesheet" href="../css/datepicker/datepicker3.css">

<style>
    .datepicker{z-index:1151;}
</style>
<script>
    $(function(){
        $("#tanggal").datepicker({
            dateFormat : "dd/mm/yy",
            
            changeMonth : true,
            changeYear : true
        });
    });
    

</script>
<style>
  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
}
.example-modal .modal {
    background: transparent !important;
}
</style>

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <h3 class="page-header"><i class="fa fa-trophy fa-fw fa-2x"></i> Halaman Prestasi Siswa
            </h3>
            <div class="row-fluid placeholders">
                <div class="col-md-12 text-left">
                    <div class="col-md-12 text-left">
                        <p>
                            
                            <br/>
                        </p>
                        <?php
                        if (isset($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } unset($_SESSION['alert']);
                        ?>
                        <?php
        //                 $per_hal = 10;
        //                 $jumlah_record = mysqli_query ($link,"SELECT * FROM tbl_prestasi");
        // //$jum = mysql_result($jumlah_record,0);
        //                 $jmldata    = mysqli_num_rows($jumlah_record);
        //                 $halaman = ceil($jmldata/$per_hal);
        //                 $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        //                 $start = ($page - 1) * $per_hal;
                        $sql_prestasi = mysqli_query($link, "SELECT tbl_prestasi.nama_prestasi,tbl_prestasi.jenis,
                          tbl_prestasi.waktu,tbl_prestasi.lokasi,tbl_prestasi.tingkat,tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.kelas
                          from tbl_prestasi INNER JOIN tbl_siswa ON tbl_prestasi.nis=tbl_siswa.nis INNER JOIN
                          tbl_kelas ON tbl_prestasi.id_kelas=tbl_kelas.id_kelas order by tbl_prestasi.nis asc");
                        
                        $j = mysqli_num_rows($sql_prestasi);
                        if ($j > 0) {
                            ?>
                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading"><i class="fa  fa-trophy fa-fw fa-2x"></i> Data Prestasi</div>
                                <div class="panel-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5">#</th>
                                            <th width="35">Prestasi</th>
                                            <th width="10%">Jenis</th>
                                            <th width="20">Pelaksanaan</th>
                                            <th width="30">Lokasi</th>
                                            <th width="10%">Tingkat</th>
                                            <th width="20%">Siswa</th>
                                            <th width="5%">Kelas</th>
                                            

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($data_prestasi = mysqli_fetch_assoc($sql_prestasi)) {
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data_prestasi['nama_prestasi']; ?></a></td>
                                                <td><?php echo $data_prestasi['jenis']; ?></td>
                                                <td><?php echo (DateToIndo("$data_prestasi[waktu]")); ?></td>
                                                <td><?php echo $data_prestasi['lokasi']; ?></td>
                                                <td><?php echo $data_prestasi['tingkat']; ?></td>
                                                <td><?php echo $data_prestasi['nis']."  ".$data_prestasi['nama_lengkap']; ?></td>
                                                
                                                <td><?php echo $data_prestasi['kelas']; ?></td>
                                                
                                                
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-dismissable alert-info">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Belum Ada Data Prestasi Yang di Inputkan. . .
                                    </div>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>

<!-- Modal Tambah Alternatif-->
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trophy fa-fw fa-lg"></i> Tambah Data Prestasi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="?admin=add_prestasi" >
                    <fieldset>
                     <div class="form-group">
                        <label class="col-lg-3 control-label">Nama Prestasi</label>
                        <div class="col-lg-8">
                            <input class="form-control" id="nama_mhs" type="text" name="prestasi" placeholder="Prestasi" required/>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                     <label class="col-lg-3 control-label">Jenis Prestasi</label>
                     <div class="col-lg-8">
                        <select name ="jenis" id="jenjang" class="form-control">
                            <option>Pilih Prestasi</option>
                            <option value="Sains">Sains</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Olimpiade">Olimpiade</option>
                            <option value="Kesenian">Kesenian</option>
                            <option value="Lainnya">Lainnya</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                 <label class="col-lg-3 control-label">Tingkat</label>
                 <div class="col-lg-8">
                    <select name ="tingkat" id="jenjang" class="form-control">
                        <option>Pilih Tingkat</option>
                        <option value="Ragional">Ragional</option>
                        <option value="Daerah Kab/Kota">Daerah Kab/Kota</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                        
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Waktu Pelaksanaan</label>
                <div class="col-lg-8">
                    <input class="form-control"  id="tanggal" type="text" name="waktu" placeholder="Pelaksanaan" required/>
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Lokasi Pelaksanaan</label>
                <div class="col-lg-8">
                    <textarea name="lokasi" class="form-control" rows="3" placeholder="Lokasi"></textarea>
                </div>
            </div>
            <div class="form-group">
             <label class="col-lg-3 control-label">Siswa</label>
             <div class="col-lg-8">
                <select name="nis" id="nis" multiple="multiple" style="width: 370px" class="form-control">
                    <?php
                    include "../../../config/config.php";
                    $q = mysqli_query($link,"SELECT tbl_siswa.nis, tbl_siswa.nama_lengkap,tbl_kelas.nis 
                        from tbl_siswa INNER JOIN tbl_kelas ON tbl_siswa.nis=tbl_kelas.nis where tbl_siswa.nis");
                    while($r = mysqli_fetch_array($q)) {
                        ?>
                        <option value="<?php echo $r['nis'] ?>">
                            <?php echo $r['nis']." ".$r['nama_lengkap'] ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
         <label class="col-lg-3 control-label">Kelas</label>
         <div class="col-lg-8">
             
            <select name="kelas" id="SK" class="form-control">
                
            </select>
            
        </div>
    </div>

</fieldset>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Keluar</button>
    <button type="submit" class="btn btn-primary btn-flat" name="tambah"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trophy fa-fw fa-lg"></i> Ubah Data Prestasi</h4>
            </div>
            <div class="modal-body">
             
            </div>
            
            
            
        </div>
    </div>
</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    
    <div class="example-modal">
     <div class="modal modal-danger">
        <div class="modal-dialog">
           
            <div class="modal-content">
                
                <!-- <div class="modal-header">
                    
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-question-circle fa-fw fa-lg"></i>Konfirmasi Hapus</h4>
                </div> -->
                
                <div class="modal-body">
                    <h3 align="center"><i class="fa  fa-frown-o fa-fw fa-4x"></i></h3>
                    <h4 align="center"><strong><p>Data Ini Tidak dapat di Hapus...!!</p></strong></h4>
                    <!--  <p class="debug-url"></p> -->
                </div>
                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-refresh fa-fw fa-lg"></i>Kembali</button>
                    <!-- <a class="btn btn-info btn-ok" >Kembali <i class="fa fa-sign-out fa-fw fa-lg"></i></a> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>



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
<script src="../js/bootstrap-transition.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script>
  $(function(){
    $(document).on('click','.edit-record',function(e){
        e.preventDefault();
        $("#myEdit").modal('show');
        $.post('modules/prestasi/hasil.php',
            {nama_prestasi:$(this).attr('data-id')},

            function(html){
                $(".modal-body").html(html);
            }   
            );
    });
});
  
</script>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        
        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>


<script>
    $("#nis").change(function(){
        
        var id_md = $("#nis").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/prestasi/ambil-kelas.php",
            data: "md="+id_md,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#SK").html(msg);
                    
                    
                }
            }
        }); 
    });   
</script>
<script src="http://127.0.0.1/e-raport/admin/js/select2.js" type="text/javascript"></script>
<script src="http://127.0.0.1/e-raport/admin/js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#nis").select2({
            placeholder: 'Pilih Siswa',
            allowClear: true
        });
    });
</script>
<script src="../js/bootstrap-transition.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-question-circle fa-fw fa-lg"></i>Konfirmasi Hapus</h4>
                </div> -->
                
                <div class="modal-body">
                    <h3 align="center"><i class="fa  fa-times-circle-o fa-fw fa-4x"></i></h3>
                    <h4 align="center"><strong><p>Yakin Hapus Data ini.??</p></strong></h4>
                    <!--  <p class="debug-url"></p> -->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                    <a class="btn btn-danger btn-ok" >Ya, Hapus <i class="fa fa-sign-out fa-fw fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trophy fa-fw fa-lg"></i> Ubah Data Prestasi</h4>
                </div>
                <div class="modal-body">
                 
                </div>
                
                
                
            </div>
        </div>
    </div>
