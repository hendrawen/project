$(document).ready(function() {

  $("#tgl").change(function() {
    tgl = $("#tgl").val();
    $("#loading").show();
    $.ajax({
      url: base_url+'som/laporan/load_harian/',
      type: 'POST',
      dataType: 'html',
      data: {tgl: tgl},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  });

  $("#btn-search_bulan").click(function() {
    bulan_dari = $("#bulan_dari").val();
    bulan_ke = $("#bulan_ke").val();
    tahun = $("#tahun").val();
    $("#loading").show();
    $.ajax({
      url: base_url+'som/laporan/load_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from : bulan_dari, to : bulan_ke, tahun : tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    })
  });

  $("#tahunan").change(function() {
    tahun = $("#tahunan").val();
    $("#loading").show();
    $.ajax({
      url: base_url+'som/laporan/load_tahunan/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  $("#btn-produk").click(function() {
    tahun = $("#tahun").val();
    id_barang = $("#id_barang").val();
    $("#loading").show();
    $.ajax({
      url: base_url+'som/laporan/load_produk/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, id_barang : id_barang},
      success : function (data) {
        $("#loading").hide();
        $("#tabel").html(data);
      }
    });
  });

  $("#berdasarkan-area").change(function() {
    berdasarkan = $("#berdasarkan-area").val();
    $("#loading-combo").show();
    $.ajax({
      url: base_url+'som/laporan/isi_area/'+berdasarkan,
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading-combo").hide();
        $("#pilih-area").html(data);
        $("#pilih-area").focus();
      }
    });
  });

  $("#btn-area").click(function() {
    tahun = $("#tahun-area").val();
    area = $("#pilih-area").val();
    berdasarkan = $("#berdasarkan-area").val();
    console.log(tahun);
    console.log(area);
    console.log(berdasarkan);
    $("#loading").show();
    $.ajax({
      url: base_url+'som/laporan/load_area/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, area : area, berdasarkan : berdasarkan},
      success : function (data) {
        $("#loading").hide();
        $("#tabel").html(data);
      }
    });
  });
});
