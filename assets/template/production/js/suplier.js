$(document).ready(function(){
  $('.add_faktur').click(function(){
    var id    = $(this).data("id");
    var nama_barang  = $(this).data("nama_barang");
    var harga = $(this).data("harga");
    var qty   = $(this).data("qty");
    var satuan = $(this).data("satuan");
    var bayar = $(this).data("bayar");
    var utang = $(this).data("utang");
    $.ajax({
      url : (base_url+"faktur/add_to_cart"),
      method : "POST",
      data: $('#form_faktur').serialize(),
      success: function(data){
        $('#form_faktur')[0].reset();
        $('#detail_faktur').html(data);
      }
    });
  });

$('#detail_faktur').load(base_url+"faktur/load_cart");

  $(document).on('click','.romove_cart',function(){
    var row_id=$(this).attr("id");
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url : (base_url+"faktur/delete_cart"),
      method : "POST",
      data : {row_id : row_id},
      success :function(data){
        //location.reload();
        $('#detail_faktur').html(data);
      }
    });
  });
  $(document).on('click','.hapus_cart',function(){
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url : (base_url+"faktur/hapus_cart"),
      method : "POST",
      success :function(data){
        $('#detail_faktur').html(data);
      }
    });
  });

  $("#printButton").click(function(){
      var mode = 'iframe'; //popup
      var close = mode == "popup";
      var options = { mode : mode, popClose : close};
      $("div.x_content").printArea( options );
  });

  $('.save_faktur').click(function(){
    $.ajax({
      url : (base_url+"faktur/simpan_faktur"),
      method : "POST",
      data: $('#form_simpan').serialize(),
      success: function(data){
        $('#form_simpan')[0].reset();
        $('#detail_faktur').html(data);
      }
    });
  });

  $('#id_transaksi').autocomplete({
          source: (base_url+"faktur2/get_autocomplete"),
          select: function (event, ui) {
              $('[name="id_transaksi"]').val(ui.item.label);
              document.getElementById('id_pelanggan').innerHTML = ui.item.id_pelanggan;
              document.getElementById('nama_pelanggan').innerHTML = ui.item.nama_pelanggan;
              //$('[name="id"]').val(ui.item.id);
              document.getElementById('alamat').innerHTML = ui.item.alamat;
              document.getElementById('nama_dagang').innerHTML = ui.item.nama_dagang;
              document.getElementById('no_telp').innerHTML = ui.item.no_telp;
              document.getElementById('tgl_transaksi').innerHTML = ui.item.tgl_transaksi;
              document.getElementById('jatuh_tempo').innerHTML = ui.item.jatuh_tempo;
              document.getElementById('nama').innerHTML = ui.item.nama;
              document.getElementById('lat').innerHTML = ui.item.lat;
              document.getElementById('long').innerHTML = ui.item.long;
              document.getElementById('kecamatan').innerHTML = ui.item.kecamatan;
              document.getElementById('kelurahan').innerHTML = ui.item.kelurahan;
          }
  });

});
