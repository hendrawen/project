$(document).ready(function () {
    get_all();
    get_all_tracking();
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
  
    function get_all_tracking() {
      $("#loading").show();
      $.ajax({
        url: base_url+'laporan/produk/load_pelanggan_all/',
        type: 'POST',
        dataType: 'html',
        success : function (data) {
          $("#loading").hide();
          $("#tbody-tracking").html(data);
        }
      });
    }

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
      url: base_url+'laporan/area/isi_area/'+berdasarkan,
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
      url: base_url+'laporan/area/load_area/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, area : area, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
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

  $("#btn-refresh").click(function () { 
    get_all();
  });

  $("#btn-refresh-tracking").click(function () { 
    get_all_tracking();
    
  });
