<?php

if (isset($_GET['admin'])) {
    $page = antiinjection($_GET['admin']);
    $module = $page;
} else {
    $module = "";
}
switch ($module) {
    //------------Route Untuk Halaman Beranda------------//
    case 'beranda': case '':
    require("modules/beranda/index.php");
    break;

    //------------Route Untuk Halaman Data Guru------------//
    case 'dt_guru' :
    require("modules/guru/index.php");
    break;
    case 'add_guru' :
    require("modules/guru/add_guru.php");
    break;
    case 'ubah_guru' :
    require("modules/guru/ubah_guru.php");
    break;
    case 'del_guru' :
    require("modules/guru/del_guru.php");
    break;
    case 'cari_guru' :
    require("modules/guru/find_guru.php");
    break;
    //------------Route Untuk Halaman Data Mapel------------//
    case 'dt_mapel' :
    require("modules/mapel/index.php");
    break;
    case 'add_mapel' :
    require("modules/mapel/add_pelajaran.php");
    break;
    case 'cari_mapel' :
    require("modules/mapel/find-mapel.php");
    break;
    case 'del_mapel' :
    require("modules/mapel/del_mapel.php");
    break;
    case 'ubah_mapel' :
    require("modules/mapel/ubah_mapel.php");
    break;
    //-----------Route Untuk Halaman Kelas-------------//
    case 'dt_kelas' :
    require("modules/kelas/index.php");
    break;
    case 'add_kelas' :
    require("modules/kelas/add_kelas.php");
    break;
    case 'cari_kelas' :
    require("modules/kelas/find_kelas.php");
    break;
    case 'del_kelas' :
    require("modules/kelas/del_kelas.php");
    break;
    case 'ubah_kelas' :
    require("modules/kelas/ubah_kelas.php");
    break;

    //------------Route Untuk Halaman Wali Kelas------------//
    case 'dt_wali' :
    require("modules/wali kelas/index.php");
    break;
    case 'ubah_wali' :
    require("modules/wali kelas/ubah_wali.php");
    break;
    case 'add_wali' :
    require("modules/wali kelas/add_wali.php");
    break;
    

    //------------Route Untuk Halaman SIswa-----------//
    case 'dt_siswa' :
    require("modules/siswa/index.php");
    break;
    case 'form_siswa' :
    require("modules/siswa/form_siswa.php");
    break;
    case 'add_siswa' :
    require("modules/siswa/add_siswa.php");
    break;
    case 'del_siswa' :
    require("modules/siswa/del_siswa.php");
    break;
    case 'form_ubah' :
    require("modules/siswa/ubah_siswa.php");
    break;
    case 'ubah_siswa' :
    require("modules/siswa/ubah.php");
    break;
    case 'detail_siswa' :
    require("modules/kelas/detail.php");
    break;
    case 'cari_siswa' :
    require("modules/kelas/find-siswa.php");
    break;
    case 'siswa' :
    require("modules/siswa/data.php");
    break;

    case 'add_ekskul' :
    require("modules/ekskul/add_ekskul.php");
    break;
    case 'ubah_ekskul':
    require("modules/ekskul/ubah-ekskul.php");
    break;
    case 'del_ekskul' :
    require("modules/ekskul/del-ekskul.php");
    break;

    //------------Route Untuk Halaman Statistik------------//
    case 'statistik' :
    require("modules/statistik/index.php");
    break;
    case 'sikap' :
    require("modules/nilai/sikap.php");
    break;
    case 'view_nilai' :
    require("modules/nilai/nilai_mapel.php");
    break;
    case 'ubah_sikap' :
    require("modules/nilai/ubah_sikap.php");
    break;
    case 'add_sikap' :
    require("modules/nilai/add_sikap.php");
    break;
    case 'del_sikap' :
    require("modules/nilai/del_sikap.php");
    break;
    case 'nilai' :
    require("modules/nilai/index.php");
    break;
    case 'isi_nilai' :
    require("modules/nilai/isi_nilai.php");
    break;
    case 'add_nilai' :
    require("modules/nilai/add_nilai.php");
    break;
    case 'edit_nilai' :
    require("modules/nilai/edit_nilai.php");
    break;
    case 'ubah_nilai' :
    require("modules/nilai/ubah_nilai.php");
    break;
    case 'ekskul' :
    require("modules/ekskul/index.php");
    break;

    //------------Route Untuk Halaman Prestasi------------//
    case 'prestasi' :
    require("modules/prestasi/index.php");
    break;
    case 'add_prestasi' :
    require("modules/prestasi/add_prestasi.php");
    break;
    case 'cari_prestasi' :
    require("modules/prestasi/find-prestasi.php");
    break;
    case 'ubah_prestasi' :
    require("modules/prestasi/ubah_prestasi.php");
    break;
    case 'raport' :
    require("modules/raport/index.php");
    break;
    case 'detail_raport' :
    require("modules/raport/detail_nilai.php");
    break;
    case 'add_raport' :
    require("modules/raport/add_rapot.php");
    break;
    case 'add_viiigenap' :
    require("modules/raport/add_viiigenap.php");
    break;
    case 'leger' :
    require("modules/raport/leger.php");
    break;
    case 'data_user' :
    require("modules/data_user/index.php");
    break;
    case 'add-user' :
    require("modules/data_user/add-user.php");
    break;
    case 'del-user' :
    require("modules/data_user/del-user.php");
    break;
    case 'import_nilai' :
    require("modules/upload/proses_nilai.php");
    break;
//info
 case 'info' :
    require("modules/info/index.php");
    break;
    case 'add_info' :
    require("modules/info/add_info.php");
    break;
    case 'del_info' :
    require("modules/info/del_info.php");
    break;
     case 'ubah_info' :
    require("modules/info/ubah_info.php");
    break;
    case 'tulis_info':
    require("modules/info/tulis-berita.php");
    break;
    case 'ubah_berita' :
    require("modules/info/edit-berita.php");
    break;
    //-------Upload-------------//
    case 'upload_guru' :
    require("modules/upload/proses_guru.php");
    break;
    //------------Route Untuk Halaman Pengaturan------------//
    case 'chart-rerata' :
    require("modules/statistik/grafik.php");
    break;
    case 'chart-siswa' :
    require("modules/statistik/chart-siswa.php");
    break;
    case 'del-raport' :
    require("modules/raport/del-raport.php");
    break;
    case 'pengaturan' :
    require("modules/pengaturan/index.php");
    break;
    case 'reset_akun' :
    require("modules/pengaturan/reset_pass.php");
    break;
    case 'aktivasi' :
    require("modules/pengaturan/aktif-akun.php");
    break;
    case 'hapus_akun' :
    require("modules/pengaturan/hapus_mhs.php");
    break;
    case 'proses_akun' :
    require("modules/pengaturan/p_reset.php");
    break;
    case 'ubah_pass' :
    require("modules/pengaturan/ubah_admin.php");
    break;
    case 'ubah_admin_email' :
    require("modules/pengaturan/ubah_email.php");
    break;
    case 'edit-captcha' :
    require("modules/pengaturan/edit-captcha.php");
    break;
    default :
    require("404.php");
    break;
}
?>