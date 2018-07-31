var table;
var btn_excel = $("#excel-tracking-pel");
 
$(document).ready(function() {
    $("#filter-tgl").datepicker({
        dateFormat : 'yy-mm-dd',
    });
    view('day');
    
    //datatables
    table = $('#table-penjualan2').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"laporan/penjualan2/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.tanggal = $('#filter-tgl').val();
                data.dari = $('#filter-bulan-dari').val();
                data.ke = $('#filter-bulan-ke').val();
                data.tahun = $('#filter-tahun').val();
                data.tahun2 = $('#filter-tahun2').val();
                data.status = $('#filter-status').val();
                data.status2 = $('#filter-status2').val();
                data.status3 = $('#filter-status3').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0 -1], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

});


function search() {
    reload_table();
}
function refresh() {
    $('#form-laporan')[0].reset();
    reload_table();
}

function reload_table()
{
    $('#table-penjualan2').DataTable().ajax.reload();//reload datatable ajax
}

function view(value) {
    if (value == 'day') {
        $("#view_day").show();
        $("#view_month").hide();
        $("#view_year").hide();
    } else if (value == 'month') {
        $("#view_day").hide();
        $("#view_month").show();
        $("#view_year").hide();
    } else if (value == 'year') {
        $("#view_day").hide();
        $("#view_month").hide();
        $("#view_year").show();
    }
    $('#form-laporan')[0].reset();
}

function excel_tanggal() {
    
    tgl = $("#filter-tgl").val();
    status = $("#filter-status").val();
    
    if (tgl == '') {
      tgl = 'semua';
    }
    if (status == '') {
      status = 'semua';
    }
    window.location = base_url + 'laporan/penjualan2/excel_tanggal/'+tgl+'/'+status;
}

function excel_bulan() {
    
    dari = $("#filter-bulan-dari").val();
    ke = $("#filter-bulan-ke").val();
    tahun = $("#filter-tahun").val();
    status = $("#filter-status2").val();

    if (dari == '') {
      dari = 'semua';
    }

    if (ke == '') {
      ke = 'semua';
    }

    if (tahun == '') {
      tahun = 'semua';
    }

    if (status == '') {
      status = 'semua';
    }

    window.location = base_url + 'laporan/penjualan2/excel_bulan/'+dari+'/'+ke+'/'+tahun+'/'+status;
}

function excel_tahun() {
    
    tahun = $("#filter-tahun2").val();
    status = $("#filter-status3").val();
    if (tahun == '') {
      tahun = 'semua';
    }
    if (status == '') {
      status = 'semua';
    }
    window.location = base_url + 'laporan/penjualan2/excel_tahun/'+tahun+'/'+status;
}