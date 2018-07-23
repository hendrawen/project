var table;
var btn_excel = $("#excel-market");
 
$(document).ready(function() {
    $('#filter-bulan').select2();
    $('#filter-tahun').select2();
    // $('#table-kpi-debt').DataTable();
    get_now();
    
});

$('#btn-filter-kpi-debt').click(function () { 
    get();        
});

function get() {
    month = $("#filter-bulan").val();
    year = $("#filter-tahun").val();
    if (month == '' || year == '') {
        alert('Atur bulan dan tahun');
        $("#filter-bulan").focus();
        return false;
    }
    $("#loading").show();
    $.ajax({
        url: base_url+'debt/kpi/list',
        type: 'POST',
        dataType: 'html',
        data : {
            month : month, 
            year : year
        },
        success : function (data) {
            $("#loading").hide();
            $("#tbody-debt-kpi").html(data);
        }
    });
}

function get_now() {
    month = (new Date).getMonth() + 1;
    year = (new Date).getFullYear();

    $("#loading").show();
    $.ajax({
        url: base_url+'debt/kpi/list',
        type: 'POST',
        dataType: 'html',
        data : {
            month : month, 
            year : year
        },
        success : function (data) {
            $("#loading").hide();
            $("#tbody-debt-kpi").html(data);
        }
    });
}

$("#btn-reset-kpi-debt").click(function () { 
    month = (new Date).getMonth() + 1;
    year = (new Date).getFullYear();
    $("#filter-bulan").val(month).trigger('change');;
    $("#filter-tahun").val(year).trigger('change');;
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