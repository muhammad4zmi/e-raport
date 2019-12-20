<?php
error_reporting(E_ALL ^(E_NOTICE | E_WARNING));
$kd_mapel=$_GET['kd_mapel'];
$kelas=$_GET['kelas'];

$sql_mapel = mysqli_query($link,"SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
            tbl_mapel.nama_mapel,tbl_guru.nip,
            tbl_guru.nama_guru,tbl_mapel.kkm,jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas
            from tbl_kelas,tbl_mapel,tbl_guru,jadwal where
            tbl_kelas.id_kelas=jadwal.id_kelas 
           and tbl_guru.nip=jadwal.nip and tbl_mapel.kd_mapel=jadwal.kd_mapel and tbl_mapel.kd_mapel='$kd_mapel' and tbl_kelas.kelas='$kelas'
            group by tbl_mapel.kd_mapel");

$siswa = mysqli_fetch_array($sql_mapel);
$k = mysqli_fetch_assoc($sql_mapel);
$mapel=$k['kd_mapel'];
$kelas1=$k['kelas'];
$semester=$k['semester'];

$sql_mapel2 = mysqli_query($link,"SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
            tbl_mapel.nama_mapel,tbl_guru.nip,
            tbl_guru.nama_guru,tbl_mapel.kkm,jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas
            from tbl_kelas,tbl_mapel,tbl_guru,jadwal where
            tbl_kelas.id_kelas=jadwal.id_kelas 
           and tbl_guru.nip=jadwal.nip and tbl_mapel.kd_mapel=jadwal.kd_mapel and tbl_mapel.kd_mapel='$kd_mapel' and tbl_kelas.kelas='$kelas'
            group by tbl_mapel.kd_mapel");

//$kelas=$k['id_kelas'];
?>
<script type="text/javascript">
function addText() {
  var x = document.getElementById("cmb");
  var y = document.getElementById("txt");
  getCmb = x.value;
  y.value = getCmb;
}

</script>
<br/><br/>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Detail Nilai</li>
        </ol>
    </section>
    <section class="content">
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Detail Nilai Mapel<b><strong> 
 <?php echo $siswa['nama_mapel']; ?></strong></b>
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
                         <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Filter Detail Nilai Siswa</div>
                    <div class="panel-body">
                    <form method="post" class="form-horizontal">
                     <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                    <input type="hidden" name="kd_mapel" value="<?php echo $kd_mapel;?>">
                    <select  class="form-control" name="kelas" id="semester" required="">
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        // $tr=mysql_fetch_assoc($sql_mapel2);
                                        // $kelas=$tr['kd_kelas'];
                                        while($r1 = mysqli_fetch_array($sql_mapel2)) {
                                            //$kelas=$r1['kd_kelas'];
                                            ?>

                                            <option value="<?php echo $r1['kelas'] ?>">
                                                <?php echo $r1['kelas'] ?>
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
              
                        
                        <button type="submit" class="btn btn-primary btn-flat pull-right" name="proses" id="tombol_show"><i class="fa fa-file-text fa-fw fa-lg"></i> Detail Nilai</button><br/>
                  </form>
                  <script type="text/javascript">
                    $(document).ready(function () {
                    $("#cetak").hide();
                   });
                    </script>

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
                                $kd_mapel=$_POST['kd_mapel'];
                                $sql_detail=mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
                                    tbl_mapel.nama_mapel,tbl_guru.nip,
                                    tbl_guru.nama_guru,tbl_mapel.kkm,
                                    jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas,
                                    rekap_nilai.nilai_harian,rekap_nilai.nilai_mid,
                                    rekap_nilai.nilai_uas,rekap_nilai.nilai_akhir,
                                    rekap_nilai.nilai_hk,rekap_nilai.nilai_midk,
                                    rekap_nilai.nilai_usk,rekap_nilai.NAK,rekap_nilai.semester
                                    from 
                                    tbl_kelas,tbl_siswa,tbl_mapel,tbl_guru,rekap_nilai,jadwal
                                    where tbl_siswa.nis=rekap_nilai.nis and tbl_kelas.id_kelas=
                                    rekap_nilai.id_kelas and tbl_guru.nip=rekap_nilai.nip and jadwal.kd_mapel=rekap_nilai.kd_mapel
                                    and tbl_kelas.kelas='$kelas' and rekap_nilai.kd_mapel='$kd_mapel' 
                                    and rekap_nilai.semester='$semester' group by tbl_siswa.nis");
                                 $sql_detail1=mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
                                    tbl_mapel.nama_mapel,tbl_guru.nip,
                                    tbl_guru.nama_guru,tbl_mapel.kkm,
                                    jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas,
                                    rekap_nilai.nilai_harian,rekap_nilai.nilai_mid,
                                    rekap_nilai.nilai_uas,rekap_nilai.nilai_akhir,
                                    rekap_nilai.nilai_hk,rekap_nilai.nilai_midk,
                                    rekap_nilai.nilai_usk,rekap_nilai.NAK,rekap_nilai.semester
                                    from 
                                    tbl_kelas,tbl_siswa,tbl_mapel,tbl_guru,rekap_nilai,jadwal
                                    where tbl_siswa.nis=rekap_nilai.nis and tbl_kelas.id_kelas=
                                    rekap_nilai.id_kelas and tbl_guru.nip=rekap_nilai.nip and jadwal.kd_mapel=rekap_nilai.kd_mapel
                                    and tbl_kelas.kelas='$kelas' and rekap_nilai.kd_mapel='$kd_mapel' 
                                    and rekap_nilai.semester='$semester' group by tbl_siswa.nis");
                            }else{
                                $sql_detail=mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_mapel.nip,tbl_guru.nip,
                                    tbl_guru.nama_guru,tbl_mapel.kkm,tbl_mapel.id_kelas,
                                    rekap_nilai.nilai_harian,rekap_nilai.nilai_mid,
                                    rekap_nilai.nilai_uas,rekap_nilai.nilai_akhir,
                                    rekap_nilai.nilai_hk,rekap_nilai.nilai_midk,
                                    rekap_nilai.nilai_usk,rekap_nilai.NAK,rekap_nilai.semester
                                    from tbl_kelas,tbl_siswa,tbl_mapel,tbl_guru,rekap_nilai
                                    where tbl_siswa.nis=rekap_nilai.nis and tbl_kelas.id_kelas=
                                    rekap_nilai.id_kelas and tbl_guru.nip=rekap_nilai.nip 
                                    and tbl_kelas.kelas='VIIA' and rekap_nilai.kd_mapel='MP005' 
                                    and rekap_nilai.semester='Ganjil' group by tbl_siswa.nis");
                               
                            }
                            $siswa1=mysqli_fetch_array($sql_detail1);
                            //$semester1=$siswa1['semester'];
                             ?>
            </div>
        </div>
       <div class="panel panel-primary" id="cetak">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Lihat Nilai Berdasarkan Semester</div>
                    <div class="panel-body">
                    
                    <br/>
                     
                        <div class="tab-pane active" id="in" >
                            <div class="box-body table-responsive" id="data-mahasiswa">

                                  
                            
                                
                                  
                                <div class="col-12 text-left">
                                    <div class="panel panel-primary">
                                <table class="table" style="font-size: smaller">
                                            <tr>
                                                <td width="20%">Kode Mapel</td>
                                                <td width="1%">:</td>
                                                <td><strong><b><?php echo $siswa['kd_mapel']; ?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Mata Pelajaran</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo $siswa['nama_mapel']; ?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Kelas/Semester</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo $siswa['kelas']. " ".$semester;?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Guru Mata Pelajaran</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo  $siswa['nip']. " " .$siswa['nama_guru'];?></b></strong></td>
                                            </tr>
                                             <tr>
                                                <td>KKM</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo  $siswa['kkm'];?></b></strong></td>
                                            </tr>
                                            
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                           
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="" align="center">
                                                <th rowspan="2" width="5%">#</th>
                                               <th rowspan="2" width="10%">Nis</th>
                                               <th rowspan="2" width="30%">Nama Lengkap</th>
                                               <!-- <th rowspan="2" width="10%">Kode Mapel</th> -->
                                               <!-- <th rowspan="2" width="25%">Mata Pelajaran</th> -->
                                               
                                               <th colspan="4" class="text-center">Nilai Pengetahuan</th>
                                               <th colspan="4" class="text-center">Nilai Keterampilan</th>
                                              
                                              
                                               
                                           </tr>
                                           <tr class="">
                                            <th width="5%" align="center">Harian</th>
                                            <th width="5%" align="center">Midle</th>
                                            <th width="5%" align="center">Semester</th>
                                            <th width="5%" align="center">NA</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                            <th width="5%" align="center">Harian</th>
                                            <th width="5%" align="center">Midle</th>
                                            <th width="5%" align="center">Semester</th>
                                           <th width="5%" align="center">NA</th>
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                $no = 1;
                               
                                $jml_lap = mysqli_num_rows($sql_detail);
                                
                                if ($jml_lap > 0) {

                                    
                                        while ($data_nilai = mysqli_fetch_array($sql_detail)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                                <td>
                                                    <?php echo $data_nilai['nis'];?></td> 
                                                 <td><?php echo $data_nilai['nama_lengkap']; ?></td>
                                                 
                                                <td><?php echo $data_nilai['nilai_harian']; ?>
                                                </td> 
                                                <td><?php echo $data_nilai['nilai_mid']; ?>
                                                </td> 
                                                <td><?php echo $data_nilai['nilai_uas']; ?>
                                                </td> 
                                               <td><?php echo $data_nilai['nilai_akhir']; ?></td>

                                              

                                                 <td><?php echo $data_nilai['nilai_hk']; ?>
                                                </td> 
                                                <td><?php echo $data_nilai['nilai_midk']; ?>
                                                </td> 
                                                <td><?php echo $data_nilai['nilai_usk']; ?>
                                                </td> 
                                               

                                                <td><?php echo $data_nilai['NAK']; ?></td>
       
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
                            
                          
                              <a  class="btn btn-primary btn-sm pull-right" href="modules/nilai/cetak_nilai.php?kd_mapel=<?php echo $kd_mapel ?>&semester=<?php echo $siswa1['semester']; ?>&kelas=<?php echo $siswa1['kelas'];?>" target="_blank"><i class="fa fa-print fa-lg fa-fw"></i> Cetak Nilai</a></button>
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

