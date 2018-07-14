var table;
var btn_excel = $("#excel-tracking");
 
$(document).ready(function() {
    $('#filter-kota').select2();
    $('#filter-kecamatan').select2();
    $('#tahun-tracking').select2();
    
    //datatables
    table = $('#table-tracking').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"som/status_pelanggan/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.tahun = $('#tahun-tracking').val();
                data.kota = $('#filter-kota').val();
                data.kecamatan = $('#filter-kecamatan').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
    $('#btn-filter-tracking').click(function(){
        reload_table_tracking();
        
    });

    $('#btn-reset-tracking').click(function(){ 
        $('#form-tracking')[0].reset();
        $('#tahun-tracking').val("").trigger('change');
        $('#filter-kota').val("").trigger('change');
        $('#filter-kecamatan').val("").trigger('change');
        reload_table_tracking();
    });
});

function reload_table_tracking()
{
    $('#table-tracking').DataTable().ajax.reload();//reload datatable ajax
}

$(btn_excel).click(function (e) {
    tahun = $('#tahun-tracking').val();
    kota = $('#filter-kota').val();
    kecamatan = $('#filter-kecamatan').val();
    if (tahun == '') {
        tahun = 'semua';
    }
    if (kota == '') {
        kota = 'semua';
    }
    if (kecamatan == '') {
        kecamatan = 'semua';
    }
    
    window.location = base_url + 'status_pelanggan/download_excel/'+tahun+'/'+kota+'/'+kecamatan;
});