<?php
if (!isset($_SESSION['admin-wali'])){
    header("location:../user/index.php");
}
//include "lap_kelas.php";
?>
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
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Raport Siswa
            </h3>
<div class="row-fluid placeholders">
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
                            ?>
                        
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"><i class="fa fa-book fa-fw fa-2x"></i> 
                Data Raport Siswa
            </div>
            <div class="panel-body">
            <ul id="myTab" class="nav nav-tabs">
                <?php
                 $cek_angk = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_walikelas.nip
                     from tbl_kelas,tbl_walikelas where tbl_kelas.id_kelas=tbl_walikelas.id_kelas and tbl_walikelas.nip='".$_SESSION['admin-wali']."' group by 
                     tbl_walikelas.kelas");
                $a_angk=mysqli_fetch_array($cek_angk);
                 $kelas=$a_angk['kelas']; 
                ?>
                <table class="table table-striped table-hover table-condensed table-bordered" id="example1">
        <thead>
            <tr>
               <th>#</th>
                                            <th>Nama Siswa</th>
                                            <!-- <th>Kelas</th> -->
                                            
                                            <th >Semester</th>
                                            
                                            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $test = mysqli_query($link,"select * from rapot");
            //             while( $ret = mysqli_fetch_array($test) ){
            //             $nis1=$ret['nis']; 
                    
            $no = 1;
            $sql_laporan = mysqli_query($link, "SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_siswa.nis,
 tbl_siswa.nama_lengkap,rekap_nilai.semester from rekap_nilai INNER JOIN 
tbl_kelas ON rekap_nilai.id_kelas=tbl_kelas.id_kelas 
INNER JOIN tbl_siswa ON tbl_kelas.nis=tbl_siswa.nis and 
tbl_kelas.kelas='$kelas' group by tbl_siswa.nis");
        //}
            while ($data_r = mysqli_fetch_assoc($sql_laporan)) {
                    $nis=$data_r['nis'];
                    $id_kelas=$data_r['id_kelas'];
                    $kelas=$data_r['kelas'];
                    $semester=$data_r['semester'];
                    $query_total = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                                Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                                FROM rapot
                                                WHERE rapot.id_kelas and rapot.id_kelas='$id_kelas' and rapot.nis ='$nis' 
                                                and rapot.semester='Ganjil'  GROUP BY rapot.nis");
                         $total_nilai = mysqli_fetch_array($query_total);
                         $jml_nilai_ganjil = $total_nilai['tot_nilai'];


                         //genap
                         $query_total2 = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                                Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                                FROM rapot
                                                WHERE rapot.id_kelas and rapot.id_kelas='$id_kelas' and rapot.nis ='$nis' 
                                                and rapot.semester='Genap'  GROUP BY rapot.nis");
                         $total_nilai1 = mysqli_fetch_array($query_total2);
                         $jml_nilai_genap = $total_nilai1['tot_nilai'];

                ?>
                 <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><?php echo $data_r['nis']."  ".$data_r['nama_lengkap']; ?></td>
                                                <!-- <td><?php echo $data_r['kelas']; ?></td> -->
<!--                                                 <td><?php echo $data_r['thn_ajaran']; ?></td> -->
                                                <td>
                                                <?php
                                                    if($jml_nilai_ganjil==0){
                                                      echo "Nilai Ganjil <span class='badge bg-red'><strong>0</strong></span>";  
                                                    }elseif($jml_nilai_ganjil > 0){
                                                        echo "Nilai Ganjil <span class='badge bg-yellow'><strong> $jml_nilai_ganjil </strong></span>";
                                                    }
                                                
                                                    ?>
                                                    <?php
                                                    if($jml_nilai_genap==0){
                                                      echo "Nilai Genap <span class='badge bg-red'><strong>0</strong></span>";  
                                                    }elseif($jml_nilai_genap > 0){
                                                        echo "Nilai Genap <span class='badge bg-green'><strong> $jml_nilai_genap </strong></span>";
                                                    }
                                                
                                                    ?>
                                                    </td>
                                                
                                                <td>
                                                 <a href="?admin=detail_raport&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Raport Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                   </a>
                                                   <a href="?admin=add_raport&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Isi Raport Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-plus-circle"></i></button>
                                                   </a>

                                                   
                                                <a href="#" data-href="index.php?admin=del-raport&nis=<?php echo $data_r['nis']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <button type="button" class="btn btn-danger btn-flat btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

                                                </a>
                                                <a href="?admin=chart-siswa&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Grafik Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-bar-chart"></i>  Lihat Grafik </button>
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
        </div>
    </div>
</div>

</section>
</aside>

<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Input Raport Siswa</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="?admin=add_kelas" >
                        <fieldset>
                        
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-lg-12" id="pesan">        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <label class="col-lg-3 control-label">Siswa</label>
                                         <div class="col-lg-8">
                                            <select name="nis" id="nis" multiple="multiple" style="width: 270px" class="form-control">
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
                                         
                                        <select name="kelas" id="SK" class="form-control" readonly required>
                                            
                                        </select>
                                        
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                     <label class="col-lg-3 control-label">Mata Pelajaran</label>
                                     <div class="col-lg-8">
                                     <div class="input-group">
                                         
                                        <select name="mapel" id="inputMapel" multiple="multiple" style="width: 230px" class="form-control" >
                                        
                                            
                                        </select>

                                        <span class="input-group-btn">
                                                    <button class="btn btn-success" id="cek_mapel" type="button"><i class="fa fa-arrow-circle-o-right fa-fw fa-lg"></i></button>
                                        </span>
                                        </div>
                                        
                                    </div>
                                    </div>
                                        
                                    <div class="form-group">
                                     <label class="col-lg-3 control-label">KKM</label>
                                     <div class="col-lg-8">
                                         
                                         <input class="form-control" id="inputKKM" placeholder="KKM" name="kkm" type="text"  required>
                                        
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-3 control-label">Nilai</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="inputNilai" placeholder="Nilai" name="nilai" type="text" required readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-3 control-label">Semester</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="inputSemester" placeholder="semester" name="semester" type="text" required readonly="">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-3 control-label">Keterangan Nilai</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="inputKet" placeholder="Keterangan Nilai" name="ket" type="text" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-3 control-label">Deskripsi</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="inputPassword2" placeholder="Deskripsi Nilai" name="desk" type="text" required>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                       
                                    asas
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <div class="panel panel-primary">
            <!-- Default panel contents -->
                                    <div class="panel-heading"><i class="fa fa-book"></i> 
                                        Data Kehadiran Siswa
                                    </div>
                                    <div class="panel-body">
                                    <div class="row">
                                    <div class="col-xs-4">
                                     <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-2 control-label">Alfa</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" placeholder="Alfa" name="alfa" type="number" required>
                                        </div>
                                    </div>
                                    </div>
                                        <div class="col-xs-4">
                                        <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-2 control-label">Izin</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" placeholder="Izin" name="izin" type="number" required>
                                        </div>
                                    </div>
                                        </div>
                                        <div class="col-xs-4">
                                        <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-2 control-label">Sakit</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" placeholder="Izin" name="sakit" type="number" required>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                     <div class="col-sm-6">
                                    <div class="panel panel-primary">
            <!-- Default panel contents -->
                                    <div class="panel-heading"><i class="fa fa-book"></i> 
                                        Akhlak dan Kepribadian Siswa
                                    </div>
                                    <div class="panel-body">
                                    <div class="row">

                                    <div class="col-xs-5">
                                     <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-2 control-label">Akhlak</label>
                                        <div class="col-lg-12">
                                            <input class="form-control" placeholder="Akhlak" name="akhlak" type="text" required>
                                        </div>
                                    </div>
                                    </div>
                                        <div class="col-xs-5">
                                        <div class="form-group">
                                        <label for="inputPassword2" class="col-lg-2 control-label">Kepribadian</label>
                                        <div class="col-lg-12">
                                            <input class="form-control" placeholder="Kepribadian" name="pribadi" type="text" required>
                                        </div>
                                    </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                    </div>
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
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Ubah Data Kelas</h4>
                </div>
                <div class="modal-body">

                </div>
                
                
                
            </div>
        </div>
    </div>
 <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myEdit").modal('show');
                $.post('modules/kelas/hasil.php',
                    {kode:$(this).attr('data-id')},

                    function(html){
                        $(".modal-body").html(html);
                    }   
                    );
            });
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

<script>
    $("#Mapel").change(function(){
        
        var id_md = $("#Mapel").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/raport/ambil-kkm.php",
            data: "md="+id_md,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#SK3").html(msg);
                    
                    
                }
            }
        }); 
    });  
    </script 

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
<script type="text/javascript" src="modules/raport/raport.js"></script>
<script type="text/javascript" src="modules/raport/costum_nilai.js"></script>
<script src="http://127.0.0.1/e-raport/admin/js/select2.js" type="text/javascript"></script>
    <script src="http://127.0.0.1/e-raport/admin/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#inputMapel").select2({
                placeholder: 'Pilih Pelajaran',
                allowClear: true
            });
        });
    </script>
<script>
    $("#nis").change(function(){
        
        var id_md = $("#nis").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/raport/ambil-mapel.php",
            data: "md="+id_md,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#inputMapel").html(msg);
                    
                    
                }
            }
        }); 
    });  
    </script>
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

