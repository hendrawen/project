$(document).ready(function() {
     
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
        url: base_url+'laporan/load_pembayaran_bulanan/',
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
    $("#pembayaran_excel_bulanan").click(function() {
      b1 = $("#bulan_dari").val();
      b2 = $("#bulan_ke").val();
      t = $("#tahun").val();
      window.location = base_url + 'laporan/excel/bulanan/'+b1+'/'+b2+'/'+t;
    });

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
        url: base_url+'laporan/load_penarikan_bulanan/',
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
    
  });
  