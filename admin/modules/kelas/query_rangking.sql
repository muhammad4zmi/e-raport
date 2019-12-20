SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,rapot.id_kelas,
Sum(rapot.nilai) as tot_nilai,rapot.semester
FROM rapot,tbl_siswa
WHERE tbl_siswa.nis=rapot.nis and rapot.id_kelas='7A' 
and rapot.semester='Genap'  GROUP BY tbl_siswa.nis order by tot_nilai desc 
SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,rapot.id_kelas,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
Sum(rapot.nilai) as tot_nilai,sum(rapot.nilai_k) as total, 
rapot.thn_ajaran,rapot.predikat,rapot.predikat_k,rapot.semester
FROM tbl_siswa,tbl_kelas,rapot
WHERE  tbl_siswa.nis=rapot.nis and tbl_kelas.id_kelas=rapot.id_kelas and tbl_kelas.kd_kelas='VII' 
and rapot.semester='Ganjil' and rapot.thn_ajaran='2019/2020' GROUP BY tbl_siswa.nis order by tot_nilai desc