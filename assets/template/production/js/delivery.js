
var status = 'T';
var record_debt = new Array();
$(document).ready(function () {
    $("#tabel_cari_aset").hide();
    $("#jenis").val('krat')
    $("#form-input-uang").hide();
    $("#form-input-krat").show();

    $("#jenis").change(function (e) { 
        if ($(this).val() == 'krat') {
            $("#form-input-krat").show();
            $("#form-input-uang").hide();
        } else {
            $("#form-input-krat").hide();
            $("#form-input-uang").show();
        }
    });
    
});

$("#button_aset").click(function(){
        var judul=$("#id_track_aset").val();
       console.log(judul);
        if(judul!=""){
            $("#result2").html(base_url+"assets/ajax-loader.gif");
              $.ajax({
                     type : "POST",
                  url  : (base_url+"delivery/track_aset"),
                  data:"judul="+judul,

                  success:function(data){
                    $("#result_aset").html(data);
                    $("#id_track_aset").val();
                  }
           });
           $('#tabel_cari_aset').show();
        }
});

$("#btn-bayar-aset").click(function () { 
    tgl_input = $("input[name=tgl_bayar]").val();
    tgl = format_tgl(tgl_input);
    record = record_debt;
    jenis = $("#jenis").val();
    id = $("#id").val();
    gudang = $("#gudang").val();
    //inputan
    str_bayar_uang = $("#bayar_uang").val();
    bayar_uang = str_bayar_uang.replace('.', '');
    bayar_krat = $("#bayar_krat").val();
    
    if (status == 'T') {
        alert('Data ini tidak memiliki piutang');
        return false;
    }
    if (id == '') {
        alert('Pilih ID Pelanggan');
        $("#id_track_aset").focus();
        return false;
    }
    if (jenis == 'uang') {
        if (bayar_uang == '0' || bayar_uang == '') {
            alert('Masukkan jumlah bayar');
            $("#bayar_uang").focus();
            return false;
        }
    } else {
        if (bayar_krat == '0' || bayar_krat == '') {
            alert('Masukkan jumlah krat');
            $("#bayar_krat").focus();
            return false;
        }
    }
    //konfirmasi
    var conf = confirm("Proses transaksi ?");
    if (conf == false) {
        return false;
    } else {
        $.ajax({
            type: "POST",
            url: base_url+"delivery/bayar_aset",
            data: {
                tgl : tgl, 
                jenis : jenis,
                bayar_uang : bayar_uang, 
                bayar_krat : bayar_krat, 
                id : id,
                gudang : gudang,
                record : record_debt,
            },
            dataType: "json",
            success: function (response) {
                if (response.status == true) {
                    alert('Data berhasil diproses');
                    status = 'T';
                    $('#form-tarik-aset')[0].reset();
                    $("#tabel_cari_aset").hide();
                    $("#id_track_aset").val('');
                    document.location = base_url+'delivery/penarikan';
                } else {
                    status = 'F';
                    alert('Data gagal diproses');
                }
            }
        });  
    }
    //end konfirmasi
    
});

function get_id_pelanggan(id) {
    $.ajax({
        url: base_url+"delivery/get_idpelanggan/"+id,
        dataType: "json",
        success: function (response) {
            $("#id").val(response);
        }
    });
}

function format_tgl(tgl) {
    month = tgl.substr(0,2);
    day = tgl.substr(3,2);
    year = tgl.substr(-4);
    date = year+'-'+month+'-'+day;
    return date;   
}

function pesan_sukses() {
    pesan = "<div class='alert alert-success'><strong>Sukses</strong> Data berhasil diproses</div>";
    return pesan;
}

function pesan_gagal() {
    pesan = "<div class='alert alert-danger'><strong>Gagal</strong> Data gagal diproses</div>";
    return pesan;
}

function get_total_harga(krat) {
    $.ajax({
        url: base_url+"delivery/get_harga_krat",
        dataType: "json",
        success: function (response) {
            
        }
    });
}