$(document).ready(function () {
  get_all_eff();
  });

    function get_all_eff() {
      $("#loading").show();
      $.ajax({
        url: base_url+'customerservice/effectivecall/load_all/',
        type: 'POST',
        dataType: 'html',
        success : function (data) {
          $("#loading").hide();
          $("#tbody-kpi-eff").html(data);
        }
      })
    }

//berdasarkan karyawan select
$("#berdasarkan-eff").change(function() {
  berdasarkan = $("#berdasarkan-eff").val();
  $("#loading-combo").show();
  $.ajaxSetup({
      data: {
          csrf_test_name: $.cookie('csrf_cookie_name')
      }
  });
  $.ajax({
  url: base_url+'customerservice/effectivecall/isi_karyawan/'+berdasarkan,
  type: 'POST',
  dataType: 'html',
  success : function (data) {
      $("#loading-combo").hide();
  }
  });
});

$("#btn-filter-eff").click(function() {
  bulan = $("#bulan-eff").val();
  berdasarkan = $("#berdasarkan-eff").val();
  $("#loading").show();
  $.ajaxSetup({
      data: {
          csrf_test_name: $.cookie('csrf_cookie_name')
      }
  });
  $.ajax({
    url: base_url+'customerservice/effectivecall/load_filter/',
    type: 'POST',
    dataType: 'html',
    data: {bulan : bulan, berdasarkan : berdasarkan},
    success : function (data) {
      $("#loading").hide();
      $("#tbody-kpi-eff").html(data);
    }
  });
});

$("#btn-reset-eff").click(function() {
  get_all_eff();
});


