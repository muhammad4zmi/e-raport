$(document).ready(function() {
    $("#newfile").hide();
    $("#btn_ubah").click(function(){
        $("#oldfile").fadeOut(100);
        $("#newfile").fadeIn(700);
    });
    $("#btn_batal").click(function(){
        $("#newfile").fadeOut(100);
        $("#oldfile").fadeIn(700);
    });
        
    $("#unsur").change(function() {
        var unsur = $("#unsur").val();
        $.ajax({
            type: "POST",
            url: "modules/laporan/jquery_sub_unsur.php",
            data: "unsur=" + unsur,
            success: function(data) {
                $("#sub_unsur").html(data);
            }
        });
    });

    var sub2unsur = $("#sub_unsur2");
    sub2unsur.hide();
    /*aksi untuk combobox sub unsur*/
    $("#sub_unsur").change(function() {
        var sub_unsur = $("#sub_unsur").val();
        $.ajax({
            type: "POST",
            url: "modules/laporan/jquery_sub_unsur2.php",
            data: "sub_unsur=" + sub_unsur,
            success: function(data) {
                if (data == 0) {
                    /*aksi untuk combobox butir untuk sub unsur tunggal*/
                    sub2unsur.fadeOut(300);
                    $.ajax({
                        type: "POST",
                        url: "modules/laporan/jquery_butir_induk.php",
                        data: "sub_unsur=" + sub_unsur,
                        success: function(data) {
                            $("#butir").html(data).fadeIn(700);
                        }
                    });
                } else {
                    /*aksi untuk combobox sub_butir2*/
                    sub2unsur.html(data).fadeIn(700);
                    $("#sub_unsur2").select(function() {
                        var sub_unsur2 = $("#sub_unsur2").val();
                        $.ajax({
                            type: "POST",
                            url: "modules/laporan/jquery_butir_anak.php",
                            data: "sub_unsur2=" + sub_unsur2,
                            success: function(data) {
                                $("#butir").html(data).fadeIn(700);
                            }
                        });
                    });
                    $("#sub_unsur2").change(function() {
                        var sub_unsur2 = $("#sub_unsur2").val();
                        $.ajax({
                            type: "POST",
                            url: "modules/laporan/jquery_butir_anak.php",
                            data: "sub_unsur2=" + sub_unsur2,
                            success: function(data) {
                                $("#butir").html(data).fadeIn(700);
                            }
                        });
                    });
                    $("#sub_unsur2").select();
                }
            }
        });
    });
    $("#butir2").hide();
    $("#butir").change(function() {
        var butir = $("#butir").val();
        $.ajax({
            type: "POST",
            url: "modules/laporan/jquery_pil_butir_induk.php",
            data: "butir=" + butir,
            success: function(data) {
                if (data == 0) {
                    /*aksi untuk combobox butir untuk sub unsur tunggal*/
                    $("#butir2").fadeOut(300);
                    $.ajax({
                        type: "POST",
                        url: "modules/laporan/jquery_butir_nilai.php",
                        data: "butir=" + butir,
                        success: function(data) {
                            $("#nilai").val(data);
                        }
                    });
                } else {
                    $("#butir2").html(data).fadeIn(700);
                    $("#butir2").select(function() {
                        var butir2 = $("#butir2").val();
                        $.ajax({
                            type: "POST",
                            url: "modules/laporan/jquery_butir_nilai2.php",
                            data: "butir2=" + butir2,
                            success: function(data) {
                                $("#nilai").val(data);
                            }
                        });
                    });
                    $("#butir2").change(function() {
                        var butir2 = $("#butir2").val();
                        $.ajax({
                            type: "POST",
                            url: "modules/laporan/jquery_butir_nilai2.php",
                            data: "butir2=" + butir2,
                            success: function(data) {
                                $("#nilai").val(data);
                            }
                        });
                    });
                    $("#butir2").select();
                }
            }
        });
    });
});