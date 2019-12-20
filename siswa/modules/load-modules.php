<?php
if (isset($_GET['siswa'])) {
    $psiswa=antiinjection($_GET['siswa']);
    $module = $psiswa;
} else {
    $module = "";
}

if ($module == "" or $module == "beranda") {
    include "beranda/index.php";
} else if ($module == "profil") {
    include "profil/index.php";
} else if ($module == "p_upload") {
    include "upload/upload.php";
} else if ($module == "laporan") {
    include "laporan/index.php";
} else if ($module == "laporan_del") {
    include "laporan/laporan_del.php";
} else if ($module == "laporan_ubah") {
    include "laporan/laporan_edit.php";
} else if ($module == "pengaturan") {
    include "pengaturan/index.php";
} else if ($module == "ubah_password") {
    include "pengaturan/ubah-pass.php";
}else if ($module == "ubah_profil"){
  include "profil/ubah_profil.php";
}

/* $mod_inc = "modules/" . $module . "/index.php";
  if( file_exists( $mod_inc ) ){
  include $mod_inc;
  } else {
  echo "Maaf Halaman Tidak Tersedia";
  } */
?>