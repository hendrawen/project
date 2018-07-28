var table;
var btn_excel = $("#excel-tracking");
 
$(document).ready(function() {
    $('#filter-kota').select2();
    $('#filter-kecamatan').select2();
    $('#tahun-tracking').select2();
    $('#filter-marketing').select2();
    $('#filter-warna').select2();
    
    //datatables
    table = $('#table-tracking').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"tracking_aset/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.tahun = $('#tahun-tracking').val();
                data.kota = $('#filter-kota').val();
                data.kecamatan = $('#filter-kecamatan').val();
                data.id_karyawan = $('#filter-marketing').val();
                data.warna = $('#filter-warna').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56], //first column / numbering column
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
    warna = $('#filter-warna').val();
    marketing = $('#filter-marketing').val();
    if (tahun == '') {
        tahun = 'semua';
    }
    if (kota == '') {
        kota = 'semua';
    }
    if (kecamatan == '') {
        kecamatan = 'semua';
    }
    if (marketing == '') {
        marketing = 'semua';
    }
    
    window.location = base_url + 'tracking_aset/download_excel/'+tahun+'/'+kota+'/'+kecamatan+'/'+warna+'/'+marketing;
});