$(document).ready(function () {
    get_all_penarikan_debt();
  });

    function get_all_penarikan_debt() {
      $("#loading").show();
      $.ajax({
        url: base_url+'lap_dep/penarikan/load_penarikan_all/',
        type: 'POST',
        dataType: 'html',
        success : function (data) {
          $("#loading").hide();
          $("#tbody-penarikan-debt").html(data);
        }
      })
    }

    
    $("#btn-penarikan-tahunan").click(function() {
      tahun = $("#tahunan").val();
      debt = $("#debt").val();
      console.log(tahun);
      console.log(debt);
      
      
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'lap_dep/penarikan/load_penarikan_tahunan/',
        type: 'POST',
        dataType: 'html',
        data: {tahun: tahun, debt:debt},
        success : function (data) {
          $("#loading").hide();
          $("#tbody-penarikan-debt").html(data);
        }
      });
    });
  
    /* -------------
    ----- penarikan aset ---
    --------------*/
    // harian
    $("#btn-laporan-penarikan-harian").click(function() {
      tgl = $("#tgl").val();
      debt = $("#debt").val();
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'lap_dep/penarikan/load_penarikan_harian/',
        type: 'POST',
        dataType: 'html',
        data: {tgl: tgl, debt:debt},
        success : function (data) {
          $("#loading").hide();
          $("#tbody-penarikan-debt").html(data);
        }
      });
    });
  
//laporan penarikan aset
$("#btn-search_bulan_aset").click(function() {
    bulan_dari = $("#bulan_dari").val();
    bulan_ke = $("#bulan_ke").val();
    tahun = $("#tahun").val();
    debt = $("#debt").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'lap_dep/penarikan/load_penarikan_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from : bulan_dari, to : bulan_ke, tahun : tahun, debt:debt},
      success : function (data) {
        $("#loading").hide();
        $("#tbody-penarikan-debt").html(data);
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
    get_all_penarikan_debt();
  });

