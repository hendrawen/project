$(document).ready(function () {
    get_all_penarikan();
  });

    function get_all_penarikan() {
      $("#loading").show();
      $.ajax({
        url: base_url+'laporan/penarikan/load_penarikan_all/',
        type: 'POST',
        dataType: 'html',
        success : function (data) {
          $("#loading").hide();
          $("#tbody-penarikan").html(data);
        }
      })
    }

//laporan penarikan aset
$("#btn-search_bulan_aset").click(function() {
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
      url: base_url+'laporan/penarikan/load_penarikan_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from : bulan_dari, to : bulan_ke, tahun : tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  });

  // bulan
  $("#penarikan_excel_bulanan").click(function() {
    b1 = $("#bulan_dari").val();
    b2 = $("#bulan_ke").val();
    t = $("#tahun").val();
    window.location = base_url + 'laporan/excel/Penarikan_bulanan/'+b1+'/'+b2+'/'+t;
  });
  
  $("#btn-refresh-penarikan").click(function() {
    get_all_penarikan();
  });
