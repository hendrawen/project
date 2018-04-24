$(document).ready(function() {

  $("#tgl").change(function() {
    tgl = $("#tgl").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/load_harian/',
      type: 'POST',
      dataType: 'html',
      data: {tgl: tgl},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  });

  $("#btn-search_bulan").click(function() {
    bulan_dari = $("#bulan_dari").val();
    bulan_ke = $("#bulan_ke").val();
    tahun = $("#tahun").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/load_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from : bulan_dari, to : bulan_ke, tahun : tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  });

  $("#tahunan").change(function() {
    tahun = $("#tahunan").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/load_tahunan/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  $("#btn-produk").click(function() {
    tahun = $("#tahun").val();
    id_barang = $("#id_barang").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/load_produk/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, id_barang : id_barang},
      success : function (data) {
        $("#loading").hide();
        $("#tabel").html(data);
      }
    });
  });

  $("#berdasarkan-area").change(function() {
    berdasarkan = $("#berdasarkan-area").val();
    $("#loading-combo").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/isi_area/'+berdasarkan,
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading-combo").hide();
        $("#pilih-area").html(data);
        $("#pilih-area").focus();
      }
    });
  });

  $("#btn-area").click(function() {
    tahun = $("#tahun-area").val();
    area = $("#pilih-area").val();
    berdasarkan = $("#berdasarkan-area").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/load_area/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, area : area, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tabel").html(data);
      }
    });
  });
  //berdasarkan marketing
  $("#berdasarkan-marketing").change(function() {
    berdasarkan = $("#berdasarkan-marketing").val();
    $("#loading-combo").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/isi_marketing/'+berdasarkan,
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading-combo").hide();
        $("#nama-marketing").html(data);
        $("#nama-marketing").focus();
      }
    });
  });

  $("#btn-marketing").click(function() {
    tahun = $("#tahun-marketing").val();
    berdasarkan = $("#berdasarkan-marketing").val();
    nama = $("#nama-marketing").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/laporan/load_marketing/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, nama : nama, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tabel").html(data);
      }
    });
  });

  // download excel
  $("#excel_harian").click(function() {
    tgl = $("#tgl").val();
    window.location = base_url + 'som/excel/harian/'+tgl;
  });
  // bulan
  $("#excel_bulanan").click(function() {
    b1 = $("#bulan_dari").val();
    b2 = $("#bulan_ke").val();
    t = $("#tahun").val();
    window.location = base_url + 'som/excel/bulanan/'+b1+'/'+b2+'/'+t;
  });
  // tahun
  $("#excel_tahunan").click(function() {
    t = $("#tahunan").val();
    window.location = base_url + 'som/excel/tahunan/'+t;
  });
  // produk
  $("#excel_produk").click(function() {
    t = $("#tahun").val();
    i = $("#id_barang").val();
    window.location = base_url + 'som/excel/produk/'+t+'/'+i;
  });
  // area
  $("#excel_area").click(function() {
    t = $("#tahun-area").val();
    p = $("#pilih-area").val();
    b = $("#berdasarkan-area").val();
    window.location = base_url + 'som/excel/area/'+t+'/'+p+'/'+b;
  });
  // marketing
  $("#excel_marketing").click(function() {
    t = $("#tahun-marketing").val();
    n = $("#nama-marketing").val();
    window.location = base_url + 'som/excel/marketing/'+t+'/'+n;
  });
});
