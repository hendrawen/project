var table;
var btn_excel = $("#excel-tracking-pel");

$(document).ready(function () {
	// $("#filter-tgl").datepicker({
	//     dateFormat : 'yy-mm-dd',
	// });
	view('day');

	//datatables
	table = $('#table-laporan-penarikan').DataTable({
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"order": [], //Initial no order.
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": base_url + "kepala_cabang/penarikan/ajax_list",
			"type": "POST",
			"data": function (data) {
				data.tanggal = $('#filter-tgl').val();
				data.dari = $('#filter-bulan-dari').val();
				data.ke = $('#filter-bulan-ke').val();
				data.tahun = $('#filter-tahun').val();
				data.tahun2 = $('#filter-tahun2').val();

				data.debt = $('#filter-debt').val();
				data.debt2 = $('#filter-debt2').val();
				data.debt3 = $('#filter-debt3').val();

				data.status = $('#filter-status').val();
				data.status2 = $('#filter-status2').val();
				data.status3 = $('#filter-status3').val();
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
	// $('#form-laporan')[0].reset();
	reload_table();
}

function reload_table() {
	$('#table-laporan-penarikan').DataTable().ajax.reload(); //reload datatable ajax
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
	// $('#form-laporan')[0].reset();
}

// bulan
$("#penarikan_excel_bulanan2").click(function () {
	dari = $("#filter-bulan-dari").val();
	ke = $("#filter-bulan-ke").val();
	tahun = $("#filter-tahun").val();

	window.location = base_url + 'kepala_cabang/excel/penarikan_bulanan/'+dari+'/' + ke + '/' + tahun;
});

$("#excel_penarikan_harian").click(function () {
	day = $("#filter-tgl").val();
	window.location = base_url + 'kepala_cabang/excel/penarikan_harian/' + day;
});

$("#excel_penarikan_tahunan").click(function () {
	tahun = $("#filter-tahun2").val();
	window.location = base_url + 'kepala_cabang/excel/penarikan_tahunan/' + tahun;
});
