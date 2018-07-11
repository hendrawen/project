$(document).ready(function() {

  $("#berdasarkan-dept").change(function() {
    berdasarkan = $("#berdasarkan-dept").val();
    $("#loading-combo").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/lap_dep/isi_dept/'+berdasarkan,
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading-combo").hide();
        $("#nama-dept").html(data);
        $("#nama-dept").focus();
      }
    });
  });

  $("#btn-dept").click(function() {
    tgl = $("#tgl").val();
    berdasarkan = $("#berdasarkan-dept").val();
    nama = $("#nama-dept").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/lap_dep/load_harian/',
      type: 'POST',
      dataType: 'html',
      data: {tgl: tgl, nama : nama, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  $("#btn-bulan").click(function() {
    bulan_dari = $("#bulan_dari").val();
    bulan_ke = $("#bulan_ke").val();
    tahun = $("#tahun").val();
    berdasarkan = $("#berdasarkan-dept").val();
    nama = $("#nama-dept").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/lap_dep/load_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from : bulan_dari, to : bulan_ke, tahun : tahun, nama : nama, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  });

  $("#btn-tahunan").click(function() {
    tahun = $("#tahunan").val();
    berdasarkan = $("#berdasarkan-dept").val();
    nama = $("#nama-dept").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'som/lap_dep/load_tahunan/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, nama : nama, berdasarkan : berdasarkan},
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
        $("#tbody").html(data);
      }
    });
  });

  $("#berdasarkan-area").change(function() {
    berdasarkan = $("#berdasarkan-area").val();
    if (berdasarkan == '') {
      $('#pilih-area').find('option').remove().end().append('<option value="">--Semua--</option>').val('');
      return false;
    }
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

  // download excel
  $("#excelharian").click(function() {
    tgl = $("#tgl").val();
    if (tgl == '')  {
      tgl = 'semua';
    }
    nama = $("#nama-dept").val();
    window.location = base_url + 'som/exceldep/harian/'+tgl+'/'+nama;
  });
  // bulan
  $("#excelbulanan").click(function() {
    b1 = $("#bulan_dari").val();
    b2 = $("#bulan_ke").val();
    t = $("#tahun").val();
    nama = $("#nama-dept").val();
    window.location = base_url + 'som/exceldep/bulanan/'+b1+'/'+b2+'/'+t+'/'+nama;
  });
  // tahun
  $("#exceltahunan").click(function() {
    t = $("#tahunan").val();
    nama = $("#nama-dept").val();
    window.location = base_url + 'som/exceldep/tahunan/'+t+'/'+nama;
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
    if (p == '') {
      p = '-';
    }
    if (b == '') {
      b = '-';
    }

    window.location = base_url + 'som/excel/area/'+t+'/'+p+'/'+b;
  });
  // marketing
  $("#excel_marketing").click(function() {
    t = $("#tahun-marketing").val();
    n = $("#nama-marketing").val();
    window.location = base_url + 'som/excel/marketing/'+t+'/'+n;
  });
  //Pelanggan
  $("#excel_pelanggan").click(function() {
    b1 = $("#bulan-pelanggan-from").val();
    b2 = $("#bulan-pelanggan-to").val();
    t  = $("#tahun-pelanggan").val();
    window.location = base_url + 'som/excel/pelanggan/'+b1+'/'+b2+'/'+t;
  });

});
