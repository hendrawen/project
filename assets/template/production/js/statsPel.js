$(document).ready(function () {
    // get_all();
    get_all_tracking();
  });
  
    function get_all() {
      $("#loading").show();
      $.ajax({
        url: base_url+'statspel/laporan/get_all/',
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
        url: base_url+'statspel/laporan/load_pelanggan_all/',
        type: 'POST',
        dataType: 'html',
        success : function (data) {
          $("#loading").hide();
          $("#tbody-tracking").html(data);
        }
      });
    }

    $("#btn-lap-pel").click(function() {
    tahun = $("#tahun").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'statspel/laporan/load_pelanggan/',
      type: 'POST',
      dataType: 'html',
      data: {tahun : tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody-tracking").html(data);
      }
    });
  });

  $("#exc-pel").click(function() {
    t = $("#tahun").val();
    window.location = base_url + 'statspel/excel/tahunan/'+t;
  });