  <style type="text/css">
.indexberita {
  width:73%;
    text-align: center;
        max-width: 100%;
        padding: 2px 23px 29px 19px;
        margin: 0 auto 20px;
        background-color: transparent;
        -webkit-box-shadow: 0 2px 2px rgba(0,0,0,.07);
           -moz-box-shadow: 0 2px 2px rgba(0,0,0,.07);
       
        }
.isiberita {
  padding-left:10px;
  margin-left:10px;
  text-decoration:none;
  color:#434242;
}

.isiberita:hover {
  text-decoration:underline;
  color:#000000;
}

</style>
<?php
include "../../../config/config.php";
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

$sql_info = mysqli_query($link,"SELECT * from tbl_info where id_info='".$_POST['id_info']."'");
$j = mysqli_fetch_array($sql_info);

?>
<!DOCTYPE html>
<html>
<head>
   <title></title>
</head>
<body>
   
<div class="paragraphs">  
   <div class="row">  
    <div class="span8 well">  
     
     <div class="content-heading"><h3 align="center"><b><?=$j['judul'];?></b></h3></div>  
     <b><span align="center">Diposkan pada <?=DateToIndo($j['tgl_post']);?></span></b>  
     <p style="text-align:justify;"><?=$j['isi'];?></p>  
     <div style="clear:both;"></div><br>
     <p>Ttd<br><br><br>
     Admin</p>  
    </div>  
   </div>  
  </div>
</body>
</html>