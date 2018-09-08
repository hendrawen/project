var table;
var btn_excel = $("#excel-tracking-pel");

$(document).ready(function () {
	// $("#filter-tgl").datepicker({
	//     dateFormat : 'yy-mm-dd',
	// });
	view('day');

	//datatables
	table = $('#table-laporan-marketing-admin').DataTable({
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"order": [], //Initial no order.
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": base_url + "laporan/marketing/ajax_list",
			"type": "POST",
			"data": function (data) {
				data.tanggal = $('#filter-tgl').val();
				data.dari = $('#filter-bulan-dari').val();
				data.ke = $('#filter-bulan-ke').val();
				data.tahun = $('#filter-tahun').val();
				data.tahun2 = $('#filter-tahun2').val();

				data.berdasarkan = $('#berdasarkan-marketing1').val();
				data.berdasarkan2 = $('#berdasarkan-marketing2').val();
        data.berdasarkan3 = $('#berdasarkan-marketing3').val();
        
        data.marketing = $('#nama-marketing1').val();
				data.marketing2 = $('#nama-marketing2').val();
				data.marketing3 = $('#nama-marketing3').val();

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
	$('#table-laporan-marketing-admin').DataTable().ajax.reload(); //reload datatable ajax
}

$("#excel_marketing_harian").click(function () {
	tgl = $("#filter-tgl").val();
	n = $("#nama-marketing1").val();
	window.location = base_url + 'laporan/excel/marketing_harian/' + tgl + '/' + n;
});

//berdasarkan marketing harian
$("#berdasarkan-marketing1").change(function () {
	berdasarkan = $("#berdasarkan-marketing1").val();
	$("#loading-combo").show();
	$.ajaxSetup({
		data: {
			csrf_test_name: $.cookie('csrf_cookie_name')
		}
	});
	$.ajax({
		url: base_url + 'laporan/marketing/isi_marketing/' + berdasarkan,
		type: 'POST',
		dataType: 'html',
		success: function (data) {
			$("#loading-combo").hide();
			$("#nama-marketing1").html(data);
			$("#nama-marketing1").focus();
		}
	});
});

//berdasarkan marketing bulanan
$("#berdasarkan-marketing2").change(function () {
	berdasarkan = $("#berdasarkan-marketing2").val();
	$("#loading-combo").show();
	$.ajaxSetup({
		data: {
			csrf_test_name: $.cookie('csrf_cookie_name')
		}
	});
	$.ajax({
		url: base_url + 'laporan/marketing/isi_marketing/' + berdasarkan,
		type: 'POST',
		dataType: 'html',
		success: function (data) {
			$("#loading-combo").hide();
			$("#nama-marketing2").html(data);
			$("#nama-marketing2").focus();
		}
	});
});

//berdasarkan marketing tahunan
$("#berdasarkan-marketing3").change(function () {
	berdasarkan = $("#berdasarkan-marketing3").val();
	$("#loading-combo").show();
	$.ajaxSetup({
		data: {
			csrf_test_name: $.cookie('csrf_cookie_name')
		}
	});
	$.ajax({
		url: base_url + 'laporan/marketing/isi_marketing/' + berdasarkan,
		type: 'POST',
		dataType: 'html',
		success: function (data) {
			$("#loading-combo").hide();
			$("#nama-marketing3").html(data);
			$("#nama-marketing3").focus();
		}
	});
});


$("#marketing_excel_bulanan_admin").click(function () {
	b1 = $("#filter-bulan-dari").val();
	b2 = $("#filter-bulan-ke").val();
	t = $("#filter-tahun").val();
	n = $("#nama-marketing2").val();
	window.location = base_url + 'laporan/excel/marketing_bulanan/' + b1 + '/' + b2 + '/' + t + '/' + n;
});

$("#excel_marketing_tahunan").click(function () {
	t = $("#filter-tahun2").val();
	n = $("#nama-marketing3").val();
	window.location = base_url + 'laporan/excel/marketing_tahunan/' + t + '/' + n;
});


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
