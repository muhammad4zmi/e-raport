<?php
include '../../../config/config.php';
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
$kd_mapel=$_GET['kd_mapel'];
$semester=$_GET['semester'];
$kelas=$_GET['kelas'];


$sql_mapel = mysqli_query($link,"SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
            tbl_mapel.nama_mapel,tbl_guru.nip,
            tbl_guru.nama_guru,tbl_mapel.kkm,jadwal.nip,jadwal.kd_mapel,jadwal.id_kelas
            from tbl_kelas INNER JOIN jadwal ON
            tbl_kelas.id_kelas=jadwal.id_kelas 
            INNER JOIN tbl_guru ON jadwal.nip=tbl_guru.nip
                inner join tbl_mapel on tbl_mapel.kd_mapel=jadwal.kd_mapel where tbl_mapel.kd_mapel='$kd_mapel' 
            group by tbl_mapel.kd_mapel");

$siswa = mysqli_fetch_array($sql_mapel);
$k = mysqli_fetch_assoc($sql_mapel);
// $mapel1=$k['kd_mapel'];
// $kelas1=$k['kelas'];
// $semester1=$k['semester'];

$sql_mapel2 = mysqli_query($link,"SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_mapel.kd_mapel,
            tbl_mapel.nama_mapel,tbl_guru.nip,
            tbl_guru.nama_guru,tbl_mapel.kkm,jadwal.nip,jadwal.kd_mapel,jadwal.id_kelas
            from tbl_kelas INNER JOIN jadwal ON
            tbl_kelas.id_kelas=jadwal.id_kelas 
            INNER JOIN tbl_guru ON jadwal.nip=tbl_guru.nip
                inner join tbl_mapel on tbl_mapel.kd_mapel=jadwal.kd_mapel where tbl_mapel.kd_mapel='$kd_mapel' 
            group by tbl_mapel.kd_mapel");

//$kelas=$k['id_kelas'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0055)http://krs.amikom.ac.id/index.php/cetak/khs/1/2016/2017 -->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Daftar Nilai </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Sebuah situs Aplikasi untuk melihat hasil belajar peserta didik di SMPN 1 Mataram." />
        <meta name="keywords" content="e-raport SMPN 1 Mataram" />
        <meta name="author" content="anonymous" />
        <!--style bootstrap-->
      <link rel="shortcut icon" href="../../style/ico/tutwuri.png">
        <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }
        
        .krs_box {
            border: 1px solid #000;
        }
        
        .krs_box * {
            text-align: center;
            padding: 0 1px;
        }
        
        .krs_box td,
        .krs_box th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        
        .krs_box th {
            font-size: 12px;
        }
        
        .tl {
            text-align: left;
            padding-left: 10px
        }
        
        .tc {
            text-align: center;
        }
        
        .tr {
            text-align: right;
        }
        
        .tj {
            text-align: justify;
        }
        
        .fb {
            font-weight: bold;
        }
        
        .line {
            border-bottom: 1px dashed #000;
            clear: both;
        }

    </style>
    </head>
    <body cz-shortcut-listen="true">
    <div style="margin:0 auto;width:800px;">
        <br><br>
        <table align="center" width="800" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td><img src="../../img/tutwuri.png" width="70"></td>
                    <td width="800" style="font-weight:bold;text-align:center;">
                        <!--<div style="font-size:11px;">SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER</div>-->
                        <div style="font-size:16px;font-family:Times New Roman,Times,serif">DINAS PENDIDIKAN DAN KEBUDAYAAN KOTA MATARAM</div>
                        <div style="font-size:16px;">SMPN 1 MATARAM</div>
                        <p>
                        <div>Jl. Pejanggik No.3, Kota Mataram- Nusa Tenggara Barat
                            <br>Telp. (0274)884201 - 206, Faks : (0274)884208</div></p>
                    </td>
                    
                </tr>
            </tbody>
        </table>
        <hr>
        
                                <?php
                                
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
                          
                             ?>
            </div>
        </div>
         <p style="font-size: 15px; font-weight: bolder; text-align: center">DAFTAR NILAI SEMESTER</p>
                        <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
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
                                   
                           
                                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">
                                    <thead>
                                    
                                        
                                        <tr>
                                                <th rowspan="2" width="5%">#</th>
                                               <th rowspan="2" width="10%">Nis</th>
                                               <th rowspan="2" width="30%">Nama Lengkap</th>
                                               <!-- <th rowspan="2" width="10%">Kode Mapel</th> -->
                                               <!-- <th rowspan="2" width="25%">Mata Pelajaran</th> -->
                                               
                                               <th colspan="4" class="text-center">Nilai Pengetahuan</th>
                                               <th colspan="4" class="text-center">Nilai Keterampilan</th>
                                              
                                              
                                               
                                           </tr>
                                          <tr>
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
                                                <td class="tl">
                                                    <?php echo $data_nilai['nis'];?></td> 
                                                 <td class="tl"><?php echo $data_nilai['nama_lengkap']; ?></td>
                                                 
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
                            
                          <table align="center" >
              
              
                <tr>
                  
                  <td class="text-right">Mataram, <?php echo(DateToIndo(date('Y m d')));?></td>
                  
                </tr>
              
  </table><br/>
  <table align="center" >
             
              <!-- <tr>
         
                    <td width="33%">Mataram, <?php echo(DateToIndo(date('Y m d')));?></td>
                 </tr> -->
                <tr>
                  
                  <td align="center">Mengetahui,<br/>Guru Bidang Studi</td>
                 
                
                </tr>
              
             
                <tr>
                 
                
                  <td align="center"><br/><br/><br/><b>(<?php echo $siswa['nama_guru'];?>)</b><br/>NIP <?php echo $siswa['nip'];?></td>

                  
                  
                </tr>
                
                
                
              
            </table>
                        </div>
                        </div>



 <div style="text-align:center;" class="tc">[<a href="javascript:void()" onclick="print()">CETAK</a>]</div>
                        

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

