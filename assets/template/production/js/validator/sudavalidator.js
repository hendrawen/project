$(document).ready(function () {
    get_all_sumber();
    });

      function get_all_sumber() {
        $("#loading").show();
        $.ajax({
          url: base_url+'validator/sumberdata/load_all/',
          type: 'POST',
          dataType: 'html',
          success : function (data) {
            $("#loading").hide();
            $("#tbody-sumber-val").html(data);
          }
        })
      }

  //berdasarkan karyawan select
  $("#berdasarkan-sumber").change(function() {
    berdasarkan = $("#berdasarkan-sumber").val();
    $("#loading-combo").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
    url: base_url+'validator/sumberdata/isi_karyawan_validator/'+berdasarkan,
    type: 'POST',
    dataType: 'html',
    success : function (data) {
        $("#loading-combo").hide();
        $("#nama-sumber").html(data);
        $("#nama-sumber").focus();
    }
    });
  });

  $("#btn-filter-sumber").click(function() {
    bulan = $("#bulan-sumber").val();
    berdasarkan = $("#berdasarkan-sumber").val();
    nama = $("#nama-sumber").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'sudavalidator/sumberdata/load_filter/',
      type: 'POST',
      dataType: 'html',
      data: {bulan : bulan, nama : nama, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tbody-sumber-val").html(data);
      }
    });
  });

  $("#btn-reset-sumber").click(function() {
    get_all_sumber();
  });
