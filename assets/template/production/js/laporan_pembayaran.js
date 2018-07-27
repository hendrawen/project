$(document).ready(function() {
  load_Pembayaran();
});

    $("#berdasarkan").change(function() {
      berdasarkan = $("#berdasarkan").val();
      $("#loading-combo").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'laporan/pembayaran/isi_dept/'+berdasarkan,
        type: 'POST',
        dataType: 'html',
        success : function (data) {
          $("#loading-combo").hide();
          $("#nama").html(data);
          $("#nama").focus();
        }
      });
    });
    
    $("#debtharian").click(function() {
      tgl = $("#tgl").val();
      berdasarkan = $("#berdasarkan").val();
      nama = $("#nama").val();
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'laporan/pembayaran/load_debt_harian/',
        type: 'POST',
        dataType: 'html',
        data: {tgl: tgl, nama : nama, berdasarkan : berdasarkan},
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);
        }
      });
    });

    $("#btn-debtbulan").click(function() {
      from = $("#bulan_dari").val();
      to = $("#bulan_ke").val();
      tahun = $("#tahun").val();
      berdasarkan = $("#berdasarkan-dept").val();
      nama = $("#nama").val();
      console.log(nama);
      
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'laporan/pembayaran/load_debt_bulanan/',
        type: 'POST',
        dataType: 'html',
        data: {from : from, to : to, tahun : tahun, nama : nama, berdasarkan : berdasarkan},
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);
        }
      })
    });

    $("#btn-debttahunan").click(function() {
      tahun = $("#tahunan").val();
      berdasarkan = $("#berdasarkan-dept").val();
      nama = $("#nama").val();
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'laporan/pembayaran/load_debt_tahunan/',
        type: 'POST',
        dataType: 'html',
        data: {tahun: tahun, nama : nama, berdasarkan : berdasarkan},
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);
        }
      });
    });

    $("#btn-tahunan").click(function() {
      tahun = $("#tahunan").val();
      berdasarkan = $("#berdasarkan-dept").val();
      nama = $("#nama-dept").val();
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'som/lap_dep/load_tahunan/',
        type: 'POST',
        dataType: 'html',
        data: {tahun: tahun, nama : nama, berdasarkan : berdasarkan},
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);
        }
      });
    });
    


    $("#btn-laporan-pembayaran-harian").click(function() {
      tgl = $("#tgl").val();
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'laporan/pembayaran/load_pembayaran_harian/',
        type: 'POST',
        dataType: 'html',
        data: {tgl: tgl},
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);

        }
      })
    });

    $("#excel_pembayaran_harian").click(function() {
      tgl = $("#tgl").val();
      window.location = base_url + 'laporan/excel/pembayaran_harian/'+tgl;
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
        url: base_url+'laporan/pembayaran/load_pembayaran_bulanan/',
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
      window.location = base_url + 'laporan/excel/pembayaran_bulanan/'+b1+'/'+b2+'/'+t;
    });

    $("#btn-search_tahun").click(function() {
      tahun = $("#tahunan").val();
      $("#loading").show();
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
        url: base_url+'laporan/pembayaran/load_pembayaran_tahunan/',
        type: 'POST',
        dataType: 'html',
        data: {tahun : tahun},
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);
        }
      })
    });
  
    // tahunan
    $("#pembayaran_excel_tahunan").click(function() {
      t = $("#tahunan").val();
      window.location = base_url + 'laporan/excel/pembayaran_tahunan/'+t;
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
    
  
  function load_Pembayaran() {
    $("#loading").show();
    $.ajax({
      url: base_url+'laporan/pembayaran/load_pembayaran_all/',
      dataType: 'html',
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);

      }
    })
}

  $("#btn-refresh-pembayaran").click(function() {
    load_Pembayaran();
  });

