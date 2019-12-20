<?php
error_reporting(E_ALL ^(E_NOTICE | E_WARNING));

$sql_mapel = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
    and  rekap_nilai.id_kelas=tbl_kelas.id_kelas  group by tbl_siswa.nis");
$sql_mapel2 = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
    tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
    and  rekap_nilai.id_kelas=tbl_kelas.id_kelas  group by tbl_siswa.nis");
$j = mysqli_fetch_array($sql_mapel);
//$kelas=$j['kd_kelas'];
$dt_mhs = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,
         tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran 
         FROM tbl_siswa,tbl_kelas,rapot where tbl_siswa.nis=tbl_kelas.nis and 
         tbl_siswa.nis=rapot.nis and tbl_kelas.id_kelas=rapot.id_kelas
         group by tbl_kelas.id_kelas");
         $i_m = mysqli_fetch_array($dt_mhs);
         $kelas=$i_m['id_kelas'];
         $semester=$i_m['semester'];
         $thn_ajaran=$i_m['thn_ajaran'];
$dt_mhs1 = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,
            tbl_walikelas.id_kelas,tbl_walikelas.nip,
            tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran FROM tbl_siswa,
            tbl_kelas,rapot,tbl_walikelas
            where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=rapot.nis and tbl_kelas.id_kelas=
            rapot.id_kelas and tbl_kelas.id_kelas=tbl_walikelas.id_kelas 
            and tbl_walikelas.nip='".$_SESSION['admin-wali']."' group by tbl_kelas.id_kelas");
$ajaran = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,
         tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran 
         FROM tbl_siswa,tbl_kelas,rapot where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=
         rapot.nis  group by rapot.thn_ajaran");
                //$i_t = mysqli_fetch_array($ajaran);

                    
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
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Leger Siswa
           </h3>
<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">
    
                        <?php
                        if (isset($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } unset($_SESSION['alert']);
                        ?>
                        <?php
                            ?>
                            <div class="col-md-12 text-left">
    <div class="alert alert-info">
        <h4>Info!</h4>
        <p>
            1. Silahkan Lakukan Filter data berdasarkan Parameter Kelas, Semester dan Tahun Ajaran Untuk melihat Nilai Nilai Raport<br>
            2. Klik Tombol Cetak Leger Untuk Mencetak Dokumen.
        </p>
    </div>
                        
       <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Filter Leger Siswa</div>
                    <div class="panel-body">
                    <form method="post" class="form-horizontal">
                       <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                    
                    <select  class="form-control" name="kelas" id="semester" required="">
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        // $tr=mysql_fetch_assoc($sql_mapel2);
                                        // $kelas=$tr['kd_kelas'];
                                        while($thk = mysqli_fetch_array($dt_mhs1)) {
                                            //$kelas=$r1['kd_kelas'];
                                            ?>

                                            <option value="<?php echo $thk['id_kelas'] ?>">
                                                <?php echo $thk['kelas'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>    
                                       
                                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label" required>Semester</label>

                  <div class="col-sm-10">
                    <select  class="form-control" name="semester" id="semester" required="">
                                        <option value="">Pilih Semester</option>
                                        <option value="Ganjil">Ganjil</option> 
                                        <option value="Genap">Genap</option>    
                                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tahun Pelajaran</label>

                  <div class="col-sm-10">
                    <?php

                    ?>
                    <select  class="form-control" name="thn_ajaran" id="semester" required="">
                                        <option value="">Pilih Tahun Pelajaran</option>
                                        <?php
                                        // $tr=mysql_fetch_assoc($sql_mapel2);
                                        // $kelas=$tr['kd_kelas'];
                                        while($th = mysqli_fetch_array($ajaran)) {
                                            //$kelas=$r1['kd_kelas'];
                                            ?>

                                            <option value="<?php echo $th['thn_ajaran'] ?>">
                                                <?php echo $th['thn_ajaran'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>    
                                    </select>
                  </div>
                </div>
                        
                        <button type="submit" class="btn btn-primary btn-flat pull-right" name="proses" id="tombol_show"><i class="fa fa-file-text fa-fw fa-lg"></i> Lihat Leger</button><br/>
                  </form>
                  <script type="text/javascript">
                    $(document).ready(function () {
                    $("#cetak").hide();
                   });
                    </script>

            </div>
        </div>
        <?php
                      if (isset($_POST['proses'])) {
                    ?>
                     <script type="text/javascript">
                    $(document).ready(function () {
                        $("#cetak").show();
                       });

                    </script>
                        

                          
                            
                                <?php
                                
                                //$kelas=$_POST['kelas'];
                                $semester=$_POST['semester'];
                                $kelas=$_POST['kelas'];
                                $thn_ajaran=$_POST['thn_ajaran'];
                              //  $nis=$_POST['nis'];
                                $rapot=mysqli_query($link,"SET @ranking=0; ");
                                $sql_laporan = mysqli_query($link, "SELECT @ranking:=@ranking+1 AS ranking, tbl_siswa.nis,tbl_siswa.nama_lengkap,rapot.id_kelas,
                                    Sum(rapot.nilai)+sum(rapot.nilai_k) as 
                                    total, count(rapot.kd_mapel) as rerata,
                                    rapot.thn_ajaran,rapot.predikat,
                                    rapot.predikat_k,rapot.semester
                                    FROM tbl_siswa,rapot
                                    WHERE  tbl_siswa.nis=rapot.nis and rapot.id_kelas='$kelas' 
                                    and rapot.semester='$semester' and 
                                    rapot.thn_ajaran='$thn_ajaran' GROUP BY tbl_siswa.nis 
                                    order by total desc"); 
                                $sql_laporan1 = mysqli_query($link, "SELECT @ranking:=@ranking+1 AS ranking, tbl_siswa.nis,tbl_siswa.nama_lengkap,rapot.id_kelas,
                                    Sum(rapot.nilai)+sum(rapot.nilai_k) as 
                                    total, count(rapot.kd_mapel) as rerata,
                                    rapot.thn_ajaran,rapot.predikat,
                                    rapot.predikat_k,rapot.semester
                                    FROM tbl_siswa,rapot
                                    WHERE  tbl_siswa.nis=rapot.nis and rapot.id_kelas='$kelas' 
                                    and rapot.semester='$semester' and 
                                    rapot.thn_ajaran='$thn_ajaran' GROUP BY tbl_siswa.nis 
                                    order by total desc"); 
                                
                                }

                                $identitas = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai,rapot.predikat,rapot.deskripsi,rapot.semester,rapot.thn_ajaran,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                    rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                     and rapot.semester='$semester' and 
                                    tbl_kelas.kd_kelas='$kelas' 
                                    group by tbl_mapel.kd_mapel");
                                $siswa = mysqli_fetch_array($identitas);
                                
                                
                                    ?>


<div class="panel panel-primary" id="cetak" >
                    <!-- Default panel contents -->
                    <div class="panel-heading">Detail Nilai Leger</div>
                    <div class="panel-body">

                            <form action=""  id="MyForm">
                                
                                   
                                <?php
                              
                                            
                                    ?>
                                     <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="" align="center">
                                                <th rowspan="2" width="5%">#</th>
                                               <th rowspan="2" width="10%">Nis</th>
                                               <th rowspan="2" width="30%">Nama Lengkap</th>
                                              
                                               <th colspan="2" width="10%" class="text-center">Nilai Sikap</th>
                                               <th rowspan="2"  width="10%" class="text-center">Total nilai<br/><span><font style="font-size: 10px" color="red">(Pengetahuan + Keterampilan)</font></span></th>
                                               
                                           </tr>
                                            <tr class="">
                                            <th width="5%" align="center">Spritual</th>
                                            <th width="5%" align="center">Sosial</th>
                                            
                                        </tr> 
                                              
                                              
                                               
                                           
                                           

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                $no = 1;
                               
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                
                                if ($jml_lap > 0) {

                                    
                                        while ($data_nilai = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                                <td>
                                                    <?php echo $data_nilai['nis'];?></td> 
                                                 <td><?php echo $data_nilai['nama_lengkap']; ?></td>
                                                 
                                                
                                                <td class="text-center"><?php echo $data_nilai['predikat']; ?>
                                                </td> 
                                                 <td class="text-center"><?php echo $data_nilai['predikat_k']; ?>
                                                </td> 
                                                <td class="text-center"><?php echo $data_nilai['total']; ?>
                                                </td> 
                                                
                                               

                                                
       
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester ini belum dimasukkan.</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                          
                             <a  class="btn btn-primary btn-sm pull-right" href="modules/raport/cetak_leger.php?id_kelas=<?php echo $kelas ?>&semester=<?php echo $semester; ?>&thn_ajaran=<?php echo $thn_ajaran;?>" target="_blank"><i class="fa fa-print fa-lg fa-fw"></i> Cetak Leger</a></button>
                            </form>
                        </div>
                        </div>




                        

            </div>
        </div>
    </div>

</div>
</section>
</aside>


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
<script>
    $("#kode").change(function(){
        
        var id_md = $("#kode").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/kelas/ambil-kelas.php",
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
    </script 

