var table;
var btn_excel = $("#excel-market");
 
$(document).ready(function() {
    $('#filter-bulan').select2();
    $('#filter-tahun').select2();
    $('#filter-karyawan').select2();
    // $('#table-kpi-marketing').DataTable();
    get_now();
    
});

$('#btn-filter-kpi-marketing').click(function () { 
    get();        
});

function get() {
    month = $("#filter-bulan").val();
    year = $("#filter-tahun").val();
    id_karyawan = $('#filter-karyawan').val();
    if (id_karyawan == '') {
        id_karyawan = 'semua';
    }

    if (month == '' || year == '') {
        alert('Atur bulan dan tahun');
        $("#filter-bulan").focus();
        return false;
    }
    $("#loading").show();
    $.ajax({
        url: base_url+'kpi/marketing/list',
        type: 'POST',
        dataType: 'html',
        data : {
            month : month, 
            year : year, 
            id_karyawan : id_karyawan
        },
        success : function (data) {
            $("#loading").hide();
            $("#tbody-kpi-marketing").html(data);
        }
    });
}

function get_now() {
    month = (new Date).getMonth() + 1;
    year = (new Date).getFullYear();
    id_karyawan = 'semua';

    $("#loading").show();
    $.ajax({
        url: base_url+'kpi/marketing/list',
        type: 'POST',
        dataType: 'html',
        data : {
            month : month, 
            year : year, 
            id_karyawan : id_karyawan
        },
        success : function (data) {
            $("#loading").hide();
            $("#tbody-kpi-marketing").html(data);
        }
    });
}

$("#btn-reset-kpi-marketing").click(function () { 
    month = (new Date).getMonth() + 1;
    year = (new Date).getFullYear();
    $("#filter-bulan").val(month).trigger('change');;
    $("#filter-tahun").val(year).trigger('change');;
    $('#filter-karyawan').val('').trigger('change');;
    get_now();
});

$(btn_excel).click(function (e) {
    tahun = $('#tahun-market').val();
    kota = $('#filter-kota').val();
    kecamatan = $('#filter-kecamatan').val();
    if (tahun == '') {
        tahun = 'all';
    }
    if (kota == '') {
        kota = 'all';
    }
    if (kecamatan == '') {
        kecamatan = 'all';
    }
    
    window.location = base_url + 'market/download_excel/'+tahun+'/'+kota+'/'+kecamatan;
});