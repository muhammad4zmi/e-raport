$(document).ready(function() {
    $("#cek_mapel").click(function() {
        // fungsi untuk mengecek total nilai mahasiswa
        $("#pesan").html("<img src='style/img/ajax-loader1.gif' />");
//        $("#pesan").hide();
        var mapel = $("#inputMapel").val();
        var nis = $("#nis").val();
        $.ajax({
            type: "GET",
            url: "modules/raport/ambil-kkm.php",
            data: "inputMapel=" + mapel,
           // data: "nis=" + nis,
            success: function(data) {
                if (data === '') {
                    $("#pesan").fadeIn(300);
                    $("#pesan").html("<div class='alert alert-dismissable alert-warning'><button type='button' class='close' data-dismiss='alert'>×</button><i class='fa fa-ban fa-fw'></i> Data Tidak ditemukan.</div>");
                    $("#pesan").fadeOut(5000);
                }
                else {
                    $("#pesan").fadeIn(300);
                    $("#pesan").html("<div class='alert alert-dismissable alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><big><strong><i class='fa fa-check-square-o fa-fw'></i>Info !</strong></big> Data Ditemukan.</div>");
                    $("#inputKKM").val(data);

                    $("#pesan").fadeOut(2500);
                }
            }
        });

        $.ajax({
            type: "GET",
            url: "modules/raport/ambil-kkm.php",
            data: "nis=" + nis,
            success: function(data) {
                if (data !== ''){
                    $("#inputKKM").val(data);
                }
            }
        });
        //fungsi untuk mengecek email mahasiswa
        $.ajax({
            type: "GET",
            url: "modules/raport/ambil-nilai.php",
            data: "inputMapel=" + mapel,
            success: function(data) {
                if (data !== ''){
                    $("#inputNilai").val(data);
                }
            }
        });

        $.ajax({
            type: "GET",
            url: "modules/raport/ambil-smt.php",
            data: "inputMapel=" + mapel,
            success: function(data) {
                if (data !== ''){
                    $("#inputSemester").val(data);
                }
            }
        });
        $.ajax({
            type: "GET",
            url: "modules/raport/ambil-ket.php",
            data: "inputMapel=" + mapel,
            success: function(data) {
                if (data !== ''){
                    $("#inputKet").val(data);
                }
            }
        });
        
        });
     
});


