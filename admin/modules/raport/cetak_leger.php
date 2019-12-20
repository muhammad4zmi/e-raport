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
//$kd_mapel=$_GET['kd_mapel'];
$semester=$_GET['semester'];
$id_kelas=$_GET['id_kelas'];
$thn_ajaran=$_GET['thn_ajaran'];


$sql_mapel = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
    and  rekap_nilai.id_kelas=tbl_kelas.id_kelas  group by tbl_siswa.nis");
$sql_mapel2 = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
    tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
    and  rekap_nilai.id_kelas=tbl_kelas.id_kelas  group by tbl_siswa.nis");
$j = mysqli_fetch_array($sql_mapel);
//$kelas=$j['kd_kelas'];

        // $thn_ajaran=$i_m['thn_ajaran'];
 $dt_mhs1 = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,
         tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran 
         FROM tbl_siswa,tbl_kelas,rapot where tbl_siswa.nis=tbl_kelas.nis and 
         tbl_siswa.nis=rapot.nis and tbl_kelas.id_kelas=rapot.id_kelas and tbl_kelas.id_kelas='$id_kelas'
         group by tbl_kelas.id_kelas");
$siswa=mysqli_fetch_array($dt_mhs1);
$ajaran = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,
         tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran 
         FROM tbl_siswa,tbl_kelas,rapot where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=
         rapot.nis  group by rapot.thn_ajaran");
$cek_angk2 = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,tbl_walikelas.id_wali,
                tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru,tbl_kelas.nis from tbl_kelas,tbl_walikelas,
                tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas 
                and tbl_walikelas.nip=tbl_guru.nip  and tbl_kelas.id_kelas='$id_kelas'");
                $a_angk2 = mysqli_fetch_array($cek_angk2);
                    $walikelas=$a_angk2['nama_guru'];
                    $nip=$a_angk2['nip'];
                   
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
            font-size: 11px;
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
                                
                                // $rapot=mysqli_query($link,"SET @ranking=0; ");
                                $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,rapot.id_kelas,
                                    Sum(rapot.nilai)+sum(rapot.nilai_k) as 
                                    total, count(rapot.kd_mapel) as rerata,
                                    rapot.thn_ajaran,rapot.predikat,
                                    rapot.predikat_k,rapot.semester
                                    FROM tbl_siswa,rapot
                                    WHERE  tbl_siswa.nis=rapot.nis and rapot.id_kelas='$id_kelas' 
                                    and rapot.semester='$semester' and 
                                    rapot.thn_ajaran='$thn_ajaran' GROUP BY tbl_siswa.nis 
                                    order by total desc");
                          
                             ?>
            </div>
        </div>
         <p style="font-size: 15px; font-weight: bolder; text-align: center">DAFTAR NILAI LEGER<br/>Kelas <?php echo $siswa['kelas']. " Semester ".$semester;?><br/>Tahun Ajaran <?php echo$thn_ajaran;?></p>
                       
                                   
                           
                                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">
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
                                                <td class="tl">
                                                    <?php echo $data_nilai['nis'];?></td> 
                                                 <td class="tl"><?php echo $data_nilai['nama_lengkap']; ?></td>
                                                 
                                                
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
                  
                  <td align="center">Mengetahui,<br/>Wali Kelas</td>
                 
                
                </tr>
              
             
                <tr>
                 
                
                  <td align="center"><br/><br/><br/><b>(<?php echo $walikelas;?>)</b><br/>NIP <?php echo $nip;?></td>

                  
                  
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

