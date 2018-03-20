  $(document).ready(function(){
    $('.add_cart').click(function(){
      var id    = $(this).data("id");
      var nama_barang  = $(this).data("nama_barang");
      var harga_jual = $(this).data("harga_jual");
      var qty   	  = $('#' + id).val();
      $.ajax({
        url : (base_url+"pesan/add_to_cart"),
        method : "POST",
        data: $('#form_transaksi').serialize(),
        success: function(data){
          $('#form_transaksi')[0].reset();
          $('#detail_cart').html(data);
        }
      });
    });


  $('#detail_cart').load(base_url+"pesan/load_cart");

  $('#id_barang').on('input',function(){

             var id_barang=$(this).val();
             $.ajaxSetup({
                 data: {
                     csrf_test_name: $.cookie('csrf_cookie_name')
                 }
             });
             $.ajax({
                 type : "POST",
                 url  : (base_url+"pesan/get_barang"),
                 dataType : "JSON",
                 data : {id_barang: id_barang},
                 cache:false,
                 success: function(data){
                     $.each(data,function(id, nama_barang, harga_jual){
                         $('[name="id"]').val(data.id);
                         $('[name="nama_barang"]').val(data.nama_barang);
                         $('[name="harga_jual"]').val(data.harga_jual);

                     });

                 }
             });
             return false;
    });

    $('#id_pelanggan').on('input',function(){

               var id_pelanggan=$(this).val();
               $.ajaxSetup({
                   data: {
                       csrf_test_name: $.cookie('csrf_cookie_name')
                   }
               });
               $.ajax({
                   type : "POST",
                   url  : (base_url+"checkout/get_pelanggan"),
                   dataType : "JSON",
                   data : {id_pelanggan: id_pelanggan},
                   cache:false,
                   success: function(data){
                       $.each(data,function(id, nama_pelanggan, alamat, no_telp, nama_dagang, kota){
                           // $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                           // $('[name="alamat"]').innerText(data.alamat);
                           // $('[name="no_telp"]').val(data.no_telp);
                           // $('[name="nama_dagang"]').val(data.nama_dagang);
                           $('[name="id"]').val(data.id);
                           document.getElementById('id').innerHTML = data.id;
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
        url : (base_url+"pesan/delete_cart"),
        method : "POST",
        data : {row_id : row_id},
        success :function(data){
          $('#detail_cart').html(data);
        }
      });
    });
  });
