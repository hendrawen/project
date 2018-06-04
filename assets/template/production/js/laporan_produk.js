$(document).ready(function () {
    get_all();
  });

  function get_all() {
    $("#loading").show();
    $.ajax({
      url: base_url+'laporan/produk/get_all/',
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  }

/* -------------
  ----- Produk ---
  --------------*/
  // harian
  $("#btn-produk-harian").click(function() {
    day = $("#produk-hari").val();
    id_barang = $("#id_barang").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'laporan/produk/load_produk_harian/',
      type: 'POST',
      dataType: 'html',
      data: {day: day, id_barang : id_barang},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  //bulanan
  $("#btn-produk-bulanan").click(function() {
    from = $("#produk-from").val();
    to = $("#produk-to").val();
    year = $("#produk-year").val();
    id_barang = $("#id_barang").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'laporan/produk/load_produk_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from: from, to : to, year : year, id_barang : id_barang},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  // tahunan
  $("#btn-produk-tahun").click(function() {
    tahun = $("#tahun").val();
    id_barang = $("#id_barang").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'laporan/produk/load_produk_tahun/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, id_barang : id_barang},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  /* -------------
  -- end Produk --
  --------------*/

  /*
  --- produk ---
  */
 $("#excel_produk").click(function() {
    t = $("#tahun").val();
    i = $("#id_barang").val();
    window.location = base_url + 'som/excel/produk/'+t+'/'+i;
  });

  $("#excel_produk_bulanan").click(function() {
    f = $("#produk-from").val();
    t = $("#produk-to").val();
    y = $("#produk-year").val();
    i = $("#id_barang").val();
    window.location = base_url + 'som/excel/produk_bulanan/'+f+'/'+t+'/'+y+'/'+i;
  });
  
  $("#excel_produk_harian").click(function() {
    t = $("#produk-hari").val();
    i = $("#id_barang").val();
    window.location = base_url + 'som/excel/produk_harian/'+t+'/'+i;
  });

  /*
  --- end produk ---
  */

 $("#btn-refresh").click(function () { 
    get_all();
  });
