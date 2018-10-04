$(document).ready(function () {
    get_all();
  });

  function get_all() {
    $("#loading").show();
    $.ajax({
      url: base_url+'kepala_cabang/produk_share/load_kota',
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading").hide();
        $("#tbody-produk").html(data);
      }
    })
  }

  //bulanan
  $("#btn-produk-share").click(function() {
    kota = $("#filter-kota").val();
    kecamatan = $("#filter-kecamatan").val();
    from = $("#bulan-share-from").val();
    to = $("#bulan-share-to").val();
    year = $("#tahun-share").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'kepala_cabang/produk_share/load_filter/',
      type: 'POST',
      dataType: 'html',
      data: {kota: kota, kecamatan: kecamatan, from: from, to : to, year : year},
      success : function (data) {
        $("#loading").hide();
        $("#tbody-produk").html(data);
      }
    });
  });

  $("#excel_share_produk").click(function() {
    ft = $("#filter-kota").val();
    if (ft == '') {
      ft = 'all';
    }
    fk = $("#filter-kecamatan").val();
    if (fk == '') {
      fk = 'all';
    }
    fs = $("#bulan-share-from").val();
    fto = $("#bulan-share-to").val();
    ys = $("#tahun-share").val();
    window.location = base_url + 'kepala_cabang/produk_share/excel_produk_share/'+ft+'/'+fk+'/'+fs+'/'+fto+'/'+ys;
  });

  $("#btn-refresh-produk").click(function () { 
    get_all();
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
