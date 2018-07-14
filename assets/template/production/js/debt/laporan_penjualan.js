$(document).ready(function() {
  
});

  $("#btn-dept").click(function() {
    tgl = $("#tgl").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'debt/history_trx/load_harian/',
      type: 'POST',
      dataType: 'html',
      data: {tgl: tgl},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  $("#btn-bulan").click(function() {
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
      url: base_url+'debt/history_trx/load_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from : bulan_dari, to : bulan_ke, tahun : tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  });

  $("#btn-tahunan").click(function() {
    tahun = $("#tahunan").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'debt/history_trx/load_tahunan/',
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
  $("#excelharian").click(function() {
    tgl = $("#tgl").val();
    if (tgl == '')  {
      tgl = 'semua';
    }
    nama = $("#nama-dept").val();
    window.location = base_url + 'som/exceldep/harian/'+tgl+'/'+nama;
  });
  // bulan
  $("#excelbulanan").click(function() {
    b1 = $("#bulan_dari").val();
    b2 = $("#bulan_ke").val();
    t = $("#tahun").val();
    nama = $("#nama-dept").val();
    window.location = base_url + 'som/exceldep/bulanan/'+b1+'/'+b2+'/'+t+'/'+nama;
  });
  // tahun
  $("#exceltahunan").click(function() {
    t = $("#tahunan").val();
    nama = $("#nama-dept").val();
    window.location = base_url + 'som/exceldep/tahunan/'+t+'/'+nama;
  });
  // produk