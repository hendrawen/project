var table;
var btn_excel = $("#excel-tracking-pel");

$(document).ready(function () {
	// $("#filter-tgl").datepicker({
	//     dateFormat : 'yy-mm-dd',
	// });
	view('day');

	//datatables
	table = $('#table-laporan-produk').DataTable({
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"order": [], //Initial no order.
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": base_url + "kepala_cabang/produk/ajax_list",
			"type": "POST",
			"data": function (data) {
				data.tanggal = $('#filter-tgl').val();
				data.dari = $('#filter-bulan-dari').val();
				data.ke = $('#filter-bulan-ke').val();
				data.tahun = $('#filter-tahun').val();
				data.tahun2 = $('#filter-tahun2').val();

				data.barang1 = $('#id_barang_hari').val();
				data.barang2 = $('#id_barang_bulan').val();
				data.barang3 = $('#id_barang_tahun').val();

			}
		},
		//Set column definition initialisation properties.
		"columnDefs": [{
			"targets": [0 - 1], //first column / numbering column
			"orderable": false, //set not orderable
		}, ],
	});

});


function search() {
	reload_table();
}

function refresh() {
	$('#form-laporan')[0].reset();
	reload_table();
}

function reload_table() {
	$('#table-laporan-produk').DataTable().ajax.reload(); //reload datatable ajax
}




  /*
  --- produk ---
  */
 $("#excel_produk_tahunan").click(function() {
    t = $("#filter-tahun2").val();
    i = $("#id_barang_tahun").val();
    window.location = base_url + 'som/excel/produk/'+t+'/'+i;
  });

  $("#produk_excel_bulanan").click(function() {
    f = $("#filter-bulan-dari").val();
    t = $("#filter-bulan-ke").val();
    y = $("#filter-tahun").val();
    i = $("#id_barang_bulan").val();
    window.location = base_url + 'som/excel/produk_bulanan/'+f+'/'+t+'/'+y+'/'+i;
  });

  $("#excel_produk_harian").click(function() {
    t = $("#filter-tgl").val();
    i = $("#id_barang_hari").val();
    window.location = base_url + 'som/excel/produk_harian/'+t+'/'+i;
  });

  /*
  --- end produk ---
  */

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
