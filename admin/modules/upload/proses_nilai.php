
<?php
error_reporting(E_ALL ^(E_NOTICE | E_WARNING));
if(isset($_POST['upload'])){
// menggunakan class phpExcelReader
include "excel_reader3.php";

// koneksi ke mysql
include "../../../config/config.php";
// $xkodemapel = "$_REQUEST[txt_mapel]";
// $xkodesoal = "$_REQUEST[txt_ujian]";
// $xkodekelas = "$_REQUEST[txt_level]";
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['filenilai']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
  // membaca data soalid (kolom ke-1 FIELD)
  $fieldz = $data->val($i, 1);
  // membaca data pertanyaan (kolom ke-2 R)
   $nis = $data->val($i, 1);
  $kd_mapel = $data->val($i, 2);
  $nip = $data->val($i, 3);
  $id_kelas = $data->val($i,4);
  $kkm = $data->val($i, 5);
  $semester =$data->val($i,6);
  
  $nilai_harian = $data->val($i, 7);
  $nilai_mid = $data->val($i, 8);
  $nilai_uas = $data->val($i, 9);
  $nilai_akhir = $data->val($i, 10);
  $nilai_hk = $data->val($i, 11);
  $nilai_midk = $data->val($i, 12);
  $nilai_usk = $data->val($i, 13);
  $NAK = $data->val($i, 14);
 

      // setelah data dibaca, sisipkan ke dalam tabel mhs
     $query = "INSERT INTO rekap_nilai (nis,kd_mapel,nip,id_kelas,kkm,semester,nilai_harian,nilai_mid,nilai_uas,nilai_akhir,nilai_hk,nilai_midk,nilai_usk,NAK) 
      VALUES ('$nis', '$kd_mapel', '$nip','$id_kelas','$kkm','$semester','$nilai_harian','$nilai_mid','$nilai_uas','$nilai_akhir','$nilai_hk','$nilai_midk','$nilai_usk','$NAK')";
      $hasil = mysqli_query($link,$query);
       if ($hasil) $sukses++;
      else $gagal++;
       if ($query) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Proses Import Selesai!.<br/>
                    <p>Jumlah Data Berhasil di Import ".$sukses."</p>
                    <p>Jumlah Data Gagal di Import ".$gagal."</p>
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Siswa Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
 
  }
  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah


// tampilan status sukses dan gagal
?>
    <script type="text/javascript">document.location="index.php?admin=nilai";</script>
    <?php
    
}
?>