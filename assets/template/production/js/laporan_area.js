var table;
var btn_excel = $("#excel-tracking-pel");

$(document).ready(function () {
	view('day');

	//datatables
	table = $('#table-laporan-area2').DataTable({
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"order": [], //Initial no order.
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": base_url + "laporan/area/ajax_list",
			"type": "POST",
			"data": function (data) {
				data.tanggal = $('#filter-tgl').val();
				data.dari = $('#filter-bulan-dari').val();
				data.ke = $('#filter-bulan-ke').val();
				data.tahun = $('#filter-tahun').val();
				data.tahun2 = $('#filter-tahun2').val();

				data.berdasarkan = $('#berdasarkan-area1').val();
				data.berdasarkan2 = $('#berdasarkan-area2').val();
				data.berdasarkan3 = $('#berdasarkan-area3').val();

				data.area = $('#pilih-area1').val();
				data.area2 = $('#pilih-area2').val();
				data.area3 = $('#pilih-area3').val();

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
	$('#table-laporan-area2').DataTable().ajax.reload(); //reload datatable ajax
}

$("#berdasarkan-area2").change(function() {
	berdasarkan = $("#berdasarkan-area2").val();
	if (berdasarkan == '') {
		$('#pilih-area2').find('option').remove().end().append('<option value="">--Semua--</option>').val('');
		return false;
	}
	$("#loading-combo").show();

	$.ajaxSetup({
			data: {
					csrf_test_name: $.cookie('csrf_cookie_name')
			}
	});
	$.ajax({
		url: base_url+'laporan/area/isi_area/'+berdasarkan,
		type: 'POST',
		dataType: 'html',
		success : function (data) {
			$("#loading-combo").hide();
			$("#pilih-area2").html(data);
			$("#pilih-area2").focus();
		}
	});
});

$("#berdasarkan-area1").change(function() {
	berdasarkan = $("#berdasarkan-area1").val();
	if (berdasarkan == '') {
		$('#pilih-area1').find('option').remove().end().append('<option value="">--Semua--</option>').val('');
		return false;
	}
	$("#loading-combo").show();

	$.ajaxSetup({
			data: {
					csrf_test_name: $.cookie('csrf_cookie_name')
			}
	});
	$.ajax({
		url: base_url+'laporan/area/isi_area/'+berdasarkan,
		type: 'POST',
		dataType: 'html',
		success : function (data) {
			$("#loading-combo").hide();
			$("#pilih-area1").html(data);
			$("#pilih-area1").focus();
		}
	});
});

$("#berdasarkan-area3").change(function() {
	berdasarkan = $("#berdasarkan-area3").val();
	if (berdasarkan == '') {
		$('#pilih-area3').find('option').remove().end().append('<option value="">--Semua--</option>').val('');
		return false;
	}
	$("#loading-combo").show();

	$.ajaxSetup({
			data: {
					csrf_test_name: $.cookie('csrf_cookie_name')
			}
	});
	$.ajax({
		url: base_url+'laporan/area/isi_area/'+berdasarkan,
		type: 'POST',
		dataType: 'html',
		success : function (data) {
			$("#loading-combo").hide();
			$("#pilih-area3").html(data);
			$("#pilih-area3").focus();
		}
	});
});

  // area hari
  $("#excel_area_hari_admin").click(function() {
    t = $("#tgl").val();
    p = $("#pilih-area1").val();
    b = $("#berdasarkan-area1").val();
    if (p == '') {
      p = '-';
    }
    if (b == '') {
      b = '-';
    }
    if(!t){
      t = 'semua';
    }
    window.location = base_url + 'som/excel/area_harian/'+t+'/'+p+'/'+b;
  });


  // area bulan
  $("#excel_area_bulan_admin").click(function() {
    bd = $("#filter-bulan-dari").val();
    bk = $("#filter-bulan-ke").val();
    t = $("#filter-tahun").val();
    p = $("#pilih-area2").val();
    b = $("#berdasarkan-area2").val();
    if (p == '') {
      p = '-';
    }
    if (b == '') {
      b = '-';
    }

    window.location = base_url + 'som/excel/area_bulanan/'+bd+'/'+bk+'/'+t+'/'+p+'/'+b;
  });

// area tahun
$("#excel_area_tahun_admin").click(function() {
  t = $("#filter-tahun2").val();
  p = $("#pilih-area3").val();
  b = $("#berdasarkan-area3").val();
  if (p == '') {
    p = '-';
  }
  if (b == '') {
    b = '-';
  }

  window.location = base_url + 'som/excel/area/'+t+'/'+p+'/'+b;
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
