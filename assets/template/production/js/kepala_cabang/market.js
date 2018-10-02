var table;
var btn_excel = $("#excel-market");
 
$(document).ready(function() {
    $('#filter-kota').select2();
    $('#filter-kecamatan').select2();
    $('#tahun-market').select2();
    //datatables
    table = $('#table-market').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"kepala_cabang/market/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.tahun = $('#tahun-market').val();
                data.kota = $('#filter-kota').val();
                data.kecamatan = $('#filter-kecamatan').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
    $('#btn-filter-market').click(function(){
        reload_table_market();
        
    });

    $('#btn-reset-market').click(function(){ 
        $('#form-market')[0].reset();
        reload_table_market();
    });
});

function reload_table_market()
{
    $('#table-market').DataTable().ajax.reload();//reload datatable ajax
}

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
    
    window.location = base_url + 'kepala_cabang/market/download_excel/'+tahun+'/'+kota+'/'+kecamatan;
});


$("#filter-kota").change(function(event) {
	var element = $("option:selected", this);
	var id_kota = element.attr("id_kota");
	$("#loader-kecamatan").show();
	$.ajax({
	  url: base_url+'kepala_cabang/get_wilayah/get_kecamatan/'+id_kota,
	  dataType: 'html',
	  success : function (data) {
		$("#loader-kecamatan").hide();
		$("#filter-kecamatan").html(data);
	  },
	  error: function (jqXHR, textStatus, errorThrown)
	  {
		  alert('Error getting record');
	  }
	})
  });
