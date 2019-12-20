<?php

if (isset($_POST['ubah_info'])&& $_SERVER['REQUEST_METHOD'] === 'POST') {
  // function ubahformatTgl($tanggal) {
  //       $pisah = explode('/',$tanggal);
  //       $urutan = array($pisah[0],$pisah[2],$pisah[1]);
  //       $satukan = implode('-',$urutan);
  //       return $satukan;
  //   }
    $id_info = antiinjection($_POST['id_info']);
    $judul = antiinjection($_POST['judul']);
    $editor1 = antiinjection($_POST['editor1']);
    $tgl_post = antiinjection($_POST['tgl_post']);
    //$tgl_post = antiinjection($_POST['tgl_post']);
    $jenis = antiinjection($_POST['jenis']);
   

    $sql_ubah=mysqli_query($link,"update tbl_info set judul='".$judul."',isi='".$editor1."', tgl_post='".$tgl_post."',tipe ='".$jenis."'
        where id_info='".$id_info."'");
    
    if($sql_ubah){
       $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
       <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
       
       <strong>Info!</strong> Data Berhasil Di Ubah.
   </div>";
   $_SESSION['alert'] = $alert;
} else {
    $alert = "<div class='alert alert-dismissable alert-warning'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    
    <h4>Warning..!!</h4>
    Maaf, Data Tidak bisa di Ubah..!!
    
</div>";
$_SESSION['alert'] = $alert;
}

?>
<script type="text/javascript">document.location = "index.php?admin=info";</script>
<?php
}