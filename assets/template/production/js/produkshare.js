$(document).ready(function () {
    get_all();
  });

  function get_all() {
    $("#loading").show();
    $.ajax({
      url: base_url+'produk/load_kota',
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
      url: base_url+'produk/load_filter/',
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
    window.location = base_url + 'produk/excel_produk_share/'+ft+'/'+fk+'/'+fs+'/'+fto+'/'+ys;
  });

  $("#btn-refresh-produk").click(function () { 
    get_all();
  });
