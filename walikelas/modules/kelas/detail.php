            <?php
// include "../../../config/config.php";
$nis=$_GET['nis'];

$sql_detail = mysqli_query($link,"SELECT * from tbl_siswa where nis='$nis'");
$j = mysqli_fetch_array($sql_detail);
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


?><br/><br/>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Hasil Belajar SIswa
        </section>
        <section class="content-header" align="center" style="background:#EDEDED"><h1>
            Detail Identitas Siswa <b><?php echo $j['nama_lengkap']?></b>
            <small></small>
        </h1></section>
        <section class="content-header">
            

                        </section>

                                             <!-- Main content -->
                        <section class="content">

                                                <!-- Small boxes (Stat box) -->
                          <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading"><i class="fa fa-users fa-fw fa-2x"></i> Detail Identitas Siswa</div>
                                <div class="panel-body">

                                <div class="box-body table-responsive" id="data-mahasiswa">
                                  <div class="col-md-12">
                                      <table class="table"> 
                                      <strong><p color="Red">I. IDENTITAS SISWA</p></strong> 
                                          <tr>
                                              <td width="20%">NIS</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['nis'];?> </big></strong></td>
                                              
                                            </tr>
                                            <tr>
                                              <td width="20%">NISN</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['nisn'];?> </big></strong></td>
                                              
                                            </tr>
                                            <tr>
                                              <td width="20%">Nama Lengkap</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['nama_lengkap'];?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Jenis Kelamin</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['jk'];?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Tempat Lahir</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['tempat_lahir'];?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Tanggal Lahir</td>
                                              <td width="1%">:</td>
                                              
                                              <td><strong><big><?php echo (DateToIndo("$j[tgl_lahir]"));?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Agama</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['agama'];?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Alamat</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['alamat'];?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Telepon</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['telpon'];?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Email</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['email'];?></big></strong></td>
                                            </tr>


                                            <tr>

                                              <td width="20%"><strong>II. DATA ORAMNG TUA</strong></td>
                                              
                                            </tr>
                                            <tr>
                                              <td width="20%">Nama Ayah</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['nama_ayah']; ?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Tahun Lahir</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['thn_lahir']; ?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Pekerjaan Ayah</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['pekerjaan_ayah']; ?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Pendidikan Ayah</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['pendidikan_ayah']; ?></big></strong></td>
                                            </tr>

                                            <tr>
                                              <td width="20%">Nama Ibu</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['nama_ibu']; ?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Tahun Lahir</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['thnlahir']; ?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Pekerjaan Ibu</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['pekerjaan_ibu']; ?></big></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="20%">Pendidikan Ibu</td>
                                              <td width="1%">:</td>
                                              <td><strong><big><?php echo $j['pendidikan_ibu']; ?></big></strong></td>
                                            </tr>


                                      </table>
                                  </div>
                                      </div>
                                      </div>
                                      </section>

                                        </div>

                                    </div><!-- /.box-body -->
                                    <!-- Main row -->


                                </section><!-- /.Left col -->


                            </section><!-- /.content -->
                        </aside><!-- /.right-side -->
