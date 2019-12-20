
<?php
error_reporting(E_ALL ^(E_NOTICE | E_WARNING));
if(isset($_POST['upload'])){
// menggunakan class phpExcelReader
include "excel_reader2.php";

// koneksi ke mysql
include "../../../config/config.php";
// $xkodemapel = "$_REQUEST[txt_mapel]";
// $xkodesoal = "$_REQUEST[txt_ujian]";
// $xkodekelas = "$_REQUEST[txt_level]";
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['filejadwal']['tmp_name']);

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
   //$id_jadwal = $data->val($i, 1);
  $nip = $data->val($i, 1);
  $id_kelas = $data->val($i, 2);
  $kd_mapel = $data->val($i, 3);
  
 
      // setelah data dibaca, sisipkan ke dalam tabel mhs
     $query = "INSERT INTO jadwal (id_jadwal,nip, id_kelas, kd_mapel) 
      VALUES ('', '$nip','$id_kelas','$kd_mapel')";
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
                    <strong>Gagal!</strong><br/> Data Mapel Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
 
  
  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah

}

// tampilan status sukses dan gagal
?>
    <script type="text/javascript">document.location="index.php?admin=jadwal";</script>
    <?php
}

?>