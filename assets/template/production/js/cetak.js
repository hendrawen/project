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

    $('#id_pelanggan').on('input',function(){

               var id_pelanggan=$(this).val();
               $.ajaxSetup({
                   data: {
                       csrf_test_name: $.cookie('csrf_cookie_name')
                   }
               });
               $.ajax({
                   type : "POST",
                   url  : (base_url+"cetak/get_pelanggan"),
                   dataType : "JSON",
                   data : {id_pelanggan: id_pelanggan},
                   cache:false,
                   success: function(data){
                       $.each(data,function(id, id_pelanggan, nama_pelanggan, alamat, no_telp, nama_dagang, kota){
                           // $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                           // $('[name="alamat"]').innerText(data.alamat);
                           // $('[name="no_telp"]').val(data.no_telp);
                           // $('[name="nama_dagang"]').val(data.nama_dagang);
                           $('[name="id"]').val(data.id);
                           document.getElementById('id').innerHTML = data.id;
                           document.getElementById('id_pelanggan').innerHTML = data.id_pelanggan;
                           document.getElementById('nama_pelanggan').innerHTML = data.nama_pelanggan;
                           document.getElementById('alamat').innerHTML = data.alamat;
                           document.getElementById('no_telp').innerHTML = data.no_telp;
                           document.getElementById('nama_dagang').innerHTML = data.nama_dagang;
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
