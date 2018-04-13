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

$('#id_transaksi').on('input',function(){

           var id_transaksi=$(this).val();
           $.ajaxSetup({
               data: {
                   csrf_test_name: $.cookie('csrf_cookie_name')
               }
           });
           $.ajax({
               type : "POST",
               url  : (base_url+"faktur/get_detail_transaksi"),
               dataType : "JSON",
               data : {id_transaksi: id_transaksi},
               cache:false,
               success: function(data){
                   $.each(data,function(id, nama_barang, harga, utang, bayar, satuan, tgl_transaksi, nama_pelanggan, nama_dagang, no_telp, alamat, id_pelanggan, kelurahan, kecamatan, lat, long, jatuh_tempo){
                       $('[name="id"]').val(data.id);
                       $('[name="nama_barang"]').val(data.nama_barang);
                       $('[name="harga"]').val(data.harga);
                       $('[name="utang"]').val(data.utang);
                       $('[name="bayar"]').val(data.bayar);
                       $('[name="qty"]').val(data.qty);
                       $('[name="satuan"]').val(data.satuan);
                       //$('[name="lat"]').val(data.lat);
                       //$('[name="lang"]').val(data.lang);
                       document.getElementById('lat').innerHTML = data.lat;
                       document.getElementById('long').innerHTML = data.long;
                       document.getElementById('nama_pelanggan').innerHTML = data.nama_pelanggan;
                       document.getElementById('alamat').innerHTML = data.alamat;
                       document.getElementById('no_telp').innerHTML = data.no_telp;
                       document.getElementById('nama_dagang').innerHTML = data.nama_dagang;
                       document.getElementById('kelurahan').innerHTML = data.kelurahan;
                       document.getElementById('kecamatan').innerHTML = data.kecamatan;
                       document.getElementById('id_pelanggan').innerHTML = data.id_pelanggan;
                       document.getElementById('tgl_transaksi').innerHTML = data.tgl_transaksi;
                       document.getElementById('jatuh_tempo').innerHTML = data.jatuh_tempo;
                   });

               }
           });
           return false;
  });

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

});
