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
            $("#tbody-sumber-eff").html(data);
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
    url: base_url+'validator/effectivecall/isi_karyawan/'+berdasarkan,
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
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'validator/sumberdata/load_filter/',
      type: 'POST',
      dataType: 'html',
      data: {bulan : bulan, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tbody-sumber-eff").html(data);
      }
    });
  });
  
  $("#btn-reset-sumber").click(function() {
    get_all_sumber();
  });
  
  
  