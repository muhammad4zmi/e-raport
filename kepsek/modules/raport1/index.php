<?php
if (!isset($_SESSION['admin-kepsek'])){
    header("location:../user/index.php");
}

include "lap_kelas.php";

?>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Raport Siswa
            </h3>
<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">
    <p>
                            
                            <br/>
                        </p>
                        <?php
                        if (isset($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } unset($_SESSION['alert']);
                        ?>
                        <?php
                            ?>
                        
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"><i class="fa fa-book fa-fw fa-2x"></i> 
                Data Raport Siswa
            </div>
            <div class="panel-body">
            <ul id="myTab" class="nav nav-tabs">
                <?php
                $cek_angk = mysqli_query($link, "select kelas from tbl_kelas where nis group by kelas");
                while ($a_angk = mysqli_fetch_assoc($cek_angk)) {
                    ?>
                    <li class=""><a href="#<?php echo $a_angk['kelas']; ?>" data-toggle="tab"><?php echo $a_angk['kelas']; ?></a></li>
                    <?php
                }
                ?>
            </ul>
            <!--bagian isi-->
            <div id="myTabContent" class="tab-content">
                <?php
                $cek_angk2 = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_walikelas.id_wali,
tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru from tbl_kelas,tbl_walikelas,
tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas and tbl_walikelas.nip=tbl_guru.nip");
                while ($a_angk2 = mysqli_fetch_assoc($cek_angk2)) {
                    ?>
                    <div class="tab-pane fade" id="<?php echo $a_angk2['kelas']; ?>"><br/>
                    <table class="table table-condensed">
                <tr>
                    <td width="10%">Wali Kelas</td>
                    <td width="1%">:</td>
                    <td><span class="badge bg-green"><strong><?php echo $a_angk2['nama_guru']; ?></span></strong></td>
                </tr>
                </table>
                        <?php
                        view_angkatan($a_angk2['kelas'], $link);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

</section>
</aside>

