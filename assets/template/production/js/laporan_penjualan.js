$(document).ready(function () {
  get_all();
  get_all_tracking();
});

function get_all() {
  $("#loading").show();
  $.ajax({
    url: base_url+'laporan/penjualan/get_all/',
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
      url: base_url+'laporan/penjualan/load_pelanggan_all/',
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
      url: base_url+'laporan/penjualan/load_harian/',
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
      url: base_url+'laporan/penjualan/load_bulanan/',
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
      url: base_url+'laporan/penjualan/load_tahunan/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
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

  $("#btn-refresh").click(function () { 
    get_all();
  });

  $("#btn-refresh-tracking").click(function () { 
    get_all_tracking();
    
  });
