$(document).ready(function(){
  $('.add_cart').click(function(){
    var id    = $(this).data("id");
    var nama_barang  = $(this).data("nama_barang");
    var wp_suplier_id = $(this).data("wp_suplier_id");
    var harga = $(this).data("harga");
    var satuan = $(this).data("satuan2");
    var subtotal = $(this).data("subtotal");
    var qty   	  = $('#' + id).val();
    //console.log(idpesan);
    $.ajax({
      url : (base_url+"admin_gudang/pembelian/add_to_cart"),
      method : "POST",
      data: $('#form_barang').serialize(),
      success: function(data){
        $('#form_barang')[0].reset();
        $('#detail_cart').html(data);
      }
    });
  });

$('#detail_cart').load(base_url+"admin_gudang/pembelian/load_cart");

$('#id_barang').on('input',function(){

           var id_barang=$(this).val();
           $.ajaxSetup({
               data: {
                   csrf_test_name: $.cookie('csrf_cookie_name')
               }
           });
           $.ajax({
               type : "POST",
               url  : (base_url+"admin_gudang/pembelian/get_barang"),
               dataType : "JSON",
               data : {id_barang: id_barang},
               cache:false,
               success: function(data){
                   $.each(data,function(id, nama_barang, harga_jual){
                       $('[name="id"]').val(data.id);
                       $('[name="nama_barang"]').val(data.nama_barang);
                       //$('[name="harga_jual"]').val(data.harga_jual);
                       //$('[name="satuan"]').val(data.satuan);
                       cek = data.nama_barang.search('Setengah');
                       if (cek > 0) {
                         $('[name="qty"]').val(0.5);
                         $('[name="qty"]').attr('readonly',true);

                       } else {
                         $('[name="qty"]').val(1);
                         $('[name="qty"]').attr('readonly',false);
                         $('[name="qty"]').focus();
                       }

                   });

               }
           });
           return false;
  });

  $('#wp_suplier_id').autocomplete({
          source: (base_url+"admin_gudang/pembelian/get_autocomplete"),
          select: function (event, ui) {
              $('[name="id_suplier"]').val(ui.item.label);
              document.getElementById('nama_suplier').innerHTML = ui.item.nama_suplier;
              document.getElementById('id_suplier').innerHTML = ui.item.id_suplier;
              $('[name="id"]').val(ui.item.id);
              document.getElementById('alamat').innerHTML = ui.item.alamat;
          }
  });

  $('#id_suplier').on('input',function(){

             var id_pelanggan=$(this).val();
             $.ajaxSetup({
                 data: {
                     csrf_test_name: $.cookie('csrf_cookie_name')
                 }
             });
             $.ajax({
                 type : "POST",
                 url  : (base_url+"admin_gudang/pembelian/get_suplier"),
                 dataType : "JSON",
                 data : {id_suplier: id_suplier},
                 cache:false,
                 success: function(data){
                     $.each(data,function(id, id_suplier, nama_suplier, alamat){
                         // $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                         // $('[name="alamat"]').innerText(data.alamat);
                         // $('[name="no_telp"]').val(data.no_telp);
                         // $('[name="nama_dagang"]').val(data.nama_dagang);
                         $('[name="id"]').val(data.id);
                         document.getElementById('id').innerHTML = data.id;
                         document.getElementById('id_suplier').innerHTML = data.id_suplier;
                         document.getElementById('nama_suplier').innerHTML = data.nama_suplier;
                         document.getElementById('alamat').innerHTML = data.alamat;
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
      url : (base_url+"admin_gudang/pembelian/delete_cart"),
      method : "POST",
      data : {row_id : row_id},
      success :function(data){
        $('#detail_cart').html(data);
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
      url : (base_url+"admin_gudang/pembelian/hapus_cart"),
      method : "POST",
      success :function(data){
        $('#detail_cart').html(data);
      }
    });
  });

  $('#id_track_suplier').autocomplete({
      source: (base_url+"admin_gudang/pembayaran_barang/get_auto"),
      select: function (event, ui) {
          $('[name="title"]').val(ui.item.label);
          // $('[name="hutang"]').val(formatNumber(ui.item.utang));
          // $('[name="id_transaksi"]').val(ui.item.transaksi);
          // $('[name="id"]').val(ui.item.id);
          // $('[name="sudah"]').val(ui.item.sudah);
          // $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
      }
  });

  $("#button_suplier").click(function(){
      search_suplier();
  });

  function search_suplier(){
     var judul=$("#id_track_suplier").val();
     console.log(judul);
      if(judul!=""){
          $("#result2").html(base_url+"assets/ajax-loader.gif");
            $.ajax({
                   type : "POST",
                url  : (base_url+"admin_gudang/pembayaran_barang/track_pembayaran"),
                data:"judul="+judul,

                success:function(data){
                  $("#result2").html(data);
                  $("#id_track_suplier").val();
                }
         });
         $('#tabel_search').show();
      }
  }

});
