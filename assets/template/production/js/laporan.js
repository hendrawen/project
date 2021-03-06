$(document).ready(function () {
  get_all();
  get_all_tracking();
});

function get_all() {
    $("#loading").show();
    $.ajax({
      url: base_url+'som/laporan/get_all/',
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  }

  function get_all_tracking() {
    $("#loading").show();
    $.ajax({
      url: base_url+'som/laporan/load_pelanggan_all/',
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading").hide();
        $("#tbody-tracking").html(data);
      }
    });
  }

  $("#btn-laporan-harian").click(function() {
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

  $("#btn-laporan-tahunan").click(function() {
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
      url: base_url+'som/laporan/load_produk_harian/',
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
      url: base_url+'som/laporan/load_produk_bulanan/',
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
      url: base_url+'som/laporan/load_produk_tahun/',
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
        $("#tbody").html(data);
      }
    });
  });


    $("#btn-area-bulan").click(function() {
      bulan_dari = $("#bulan_dari").val();
      bulan_ke = $("#bulan_ke").val();
      tahun = $("#tahun").val();
      area = $("#pilih-area").val();
      berdasarkan = $("#berdasarkan-area").val();
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'som/laporan/load_area_bulan/',
        type: 'POST',
        dataType: 'html',
        data: {from : bulan_dari, to : bulan_ke, tahun : tahun, area : area, berdasarkan : berdasarkan},
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);
        }
      });
    });


      $("#btn-area-hari").click(function() {
        tgl = $("#tgl").val();
        berdasarkan = $("#berdasarkan-area").val();
        area = $("#pilih-area").val();
        $("#loading").show();
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.ajax({
          url: base_url+'som/laporan/load_area_harian/',
          type: 'POST',
          dataType: 'html',
          data: {tgl: tgl, area : area, berdasarkan : berdasarkan},
          success : function (data) {
            $("#loading").hide();
            $("#tbody").html(data);
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
        $("#tbody").html(data);
      }
    });
  });

  $("#btn-lap-pelanggan").click(function() {
    from = $("#bulan-pelanggan-from").val();
    to = $("#bulan-pelanggan-to").val();
    tahun = $("#tahun-pelanggan").val();
    $("#loading").show();
    $.ajaxSetup({
      data : {
        csrf_test_name: $.cookie('csrf_cookie_name')
      }
    });
    $.ajax({
      url: base_url+'laporan/load_pelanggan/',
      type: 'POST',
      dataType: 'html',
      data: {from: from, to : to, tahun : tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody-tracking").html(data);
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

  $("#btn-refresh").click(function () {
    get_all();
  });

  $("#btn-refresh-tracking").click(function () {
    get_all_tracking();

  });
