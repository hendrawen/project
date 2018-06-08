$(document).ready(function () {
    get_all_growth();
  });

  function get_all_growth() {
    $("#loading").show();
    $.ajax({
      url: base_url+'gtransaksi/get_all/',
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading").hide();
        $("#tbody-gtransaksi").html(data);
      }
    })
  }

  $("#btn-growth_transaksi").click(function() {
    tahun = $("#tahun").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'gtransaksi/load_growth_transaksi/',
      type: 'POST',
      dataType: 'html',
      data: {tahun : tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody-gtransaksi").html(data);
      }
    })
  });

  $("#btn-refresh-gtransaksi").click(function() {
    get_all_growth();
  });

  $("#excel_gtransaksi_harian").click(function() {
    t = $("#tahun").val();
    window.location = base_url + 'gtransaksi/excelg/'+t;
  });

