

<?php
// if (!isset($_SESSION['admin-username'])) {
//     header("location:../../login-form.php");
// }
//include "lap_kelas.php";
//include "../../config/config.php";
$kd_mapel=$_GET['kd_mapel'];
$kelas=$_GET['kelas'];
$semester=$_GET['semester'];

$sql_mapel = mysqli_query($link,"SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
            tbl_mapel.nama_mapel,tbl_guru.nip,
            tbl_guru.nama_guru,tbl_mapel.kkm,jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas
            from tbl_kelas,tbl_mapel,tbl_guru,jadwal where
            tbl_kelas.id_kelas=jadwal.id_kelas 
           and tbl_guru.nip=jadwal.nip and tbl_mapel.kd_mapel='$kd_mapel' and tbl_kelas.kelas='$kelas'
            group by tbl_mapel.kd_mapel");
$j = mysqli_fetch_array($sql_mapel);
$k = mysqli_fetch_assoc($sql_mapel);

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
            <li class="active">Isi Nilai</li>
        </ol>
    </section>
    <section class="content">
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Tambah Nilai Mapel<b><strong> 
 <?php echo $j['nama_mapel']; ?></strong></b>
           </h3>
<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">
        <div class="alert alert-warning">
        <h4>Perhatian!</h4>
        <p>
            1. Pastikan Semua Nilai Siswa telah terisi sebelum melakukan Simpan Nilai<br>
            2. Pilih Semester Berlangsung.
        </p>
    </div>
    
                        <?php
                        if (isset($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } unset($_SESSION['alert']);
                        ?>
                        <?php
                            ?>
                        
       <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Isi Nilai Berdasarkan Semester</div>
                    <div class="panel-body">
                    
                    <br/>
                    <small><p color="Red"><b><strong>*Pastikan Semua Nilai Sudah Terisi Lengkap Sebelum di Validasi ke Nilai Raport</strong></b></p></small>

                        <div class="tab-pane active" id="in" >
                            <div class="box-body table-responsive" id="data-mahasiswa">

                                <form action="?admin=add_nilai" method="POST" name='autoSumForm' id="isinilai" class="form-horizontal">  
                            
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_guru.nip,
                                tbl_guru.nama_guru,tbl_siswa.nis,tbl_siswa.nama_lengkap,
                                tbl_kelas.kd_kelas,tbl_mapel.kkm,jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas
                                from tbl_kelas,tbl_siswa,tbl_mapel,tbl_guru,jadwal where tbl_kelas.nis=tbl_siswa.nis
                                and jadwal.kd_mapel=tbl_mapel.kd_mapel
                                         and tbl_kelas.id_kelas=jadwal.id_kelas
                                and jadwal.nip=tbl_guru.nip and 
                                tbl_mapel.kd_mapel='$kd_mapel' and tbl_kelas.kelas='$kelas' group by tbl_siswa.nis
                                asc");
                                    
                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                //$t = mysqli_fetch_array($sql_laporan);
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);
                                 $sql_mapel = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_guru.nip,
                                tbl_guru.nama_guru,tbl_siswa.nis,tbl_siswa.nama_lengkap,
                                tbl_kelas.kd_kelas,tbl_kelas.kelas,tbl_mapel.kkm,jadwal.kd_mapel,jadwal.nip,jadwal.id_kelas
                                from tbl_kelas  inner JOIN tbl_siswa on tbl_kelas.nis=tbl_siswa.nis
                                inner join jadwal on tbl_kelas.id_kelas=jadwal.id_kelas
                                inner join tbl_guru on jadwal.nip=tbl_guru.nip
                                inner join tbl_mapel on jadwal.kd_mapel=tbl_mapel.kd_mapel
                                          where 
                                tbl_mapel.kd_mapel='$kd_mapel' and tbl_kelas.kelas='$kelas' group by tbl_siswa.nis");
                                $siswa = mysqli_fetch_array($sql_mapel);

                                if ($jml_lap > 0) {

                                    ?>
                                    <div class="row-fluid placeholders">
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
                                                <td><strong><b><?php echo $siswa['kelas'];?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Guru Mata Pelajaran</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo  $siswa['nip']. " " .$siswa['nama_guru'];?></b></strong></td>
                                            </tr>
                                            
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid placeholders">
                                <div class="col-12 text-left">
                                    <div class="panel panel-primary">
                                    <br/>

                                    <fieldset>

                                      <div class="form-group">
                                          <label for="inputPassword3" class="col-sm-2 control-label" required>Semester</label>

                                          <div class="col-sm-9">
                                            <input class="form-control" type="text"  id="kelas" value="<?php echo $semester?>" readonly>
                                          </div>
                                      </div>
                                       
                                      <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Nilai KKM</label>
                                               
                                           <div class="col-sm-9">
                                               
                                               <input class="form-control" type="text"  id="kelas" value="<?php echo $j['kkm']?>" readonly>
                                          </div>
                                      </div>
                                      <br>
                                  </fieldset>
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
                                               
                                               <th colspan="3" class="text-center">Nilai Pengetahuan</th>
                                               <th colspan="3" class="text-center">Nilai Keterampilan</th>
                                              
                                              
                                               
                                           </tr>
                                           <tr class="">
                                            <th width="5%" align="center">Harian</th>
                                            <th width="5%" align="center">Midle</th>
                                            <th width="5%" align="center">Semester</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                            <th width="5%" align="center">Harian</th>
                                            <th width="5%" align="center">Midle</th>
                                            <th width="5%" align="center">Semester</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                        while ($data_nilai = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                                <td>
                                                    <?php echo "<input class='form-control' type='text' id='nis' name='nis[]' value='".$data_nilai['nis']."' readonly> "?></td> 
                                                 <td><?php echo $data_nilai['nama_lengkap']; ?></td>
                                                
                                               <?php echo "<input class='form-control' type='hidden' id='kd_mapel' name='kd_mapel[]' value='".$data_nilai['kd_mapel']."' readonly> "?>
                                                <!-- <?php echo $data_nilai['nama_mapel']; ?> -->
                                                <?php echo "<input class='form-control' type='hidden' nip='nip' name='nip[]' value='".$data_nilai['nip']."' readonly> "?>

                                                   
                                                <td><input class="form-control" type="text" 
                                                    id="harian" name="harian[]" >
                                                </td> 
                                                <td><input class="form-control" type="text" id="mid" 
                                                     name="mid[]" >
                                                </td> 
                                                <td><input class="form-control" type="text" id="us" 
                                                    name="uas[]" >
                                                </td> 
                                               

                                                <input class="form-control" type="hidden" id="NA" value="0"  readonly name="NA[]"> 

                                                 <td><input class="form-control" type="text" 
                                                    id="hariank" name="hariank[]" >
                                                </td> 
                                                <td><input class="form-control" type="text" id="midk" 
                                                     name="midk[]" >
                                                </td> 
                                                <td><input class="form-control" type="text" id="usk" 
                                                    name="uask[]" >
                                                </td> 
                                               

                                                <input class="form-control" type="hidden" id="NAK" value="0"  readonly name="NAK[]">

                                                
                                               

                                                    
                                                
                                                    <input class="form-control" type="hidden"  name="kkm[]" id="kelas" value="<?php echo $j['kkm']?>" readonly>
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_nilai['id_kelas']?>">
                                                  <input class="form-control" type="hidden"  name="semester[]"  value="<?php echo $semester;?>">
                                                 
                                                
                                                
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
                            
                          
                            <button type="submit" class="btn btn-primary btn-flat" name="simpan"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
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

