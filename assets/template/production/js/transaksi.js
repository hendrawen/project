  $(document).ready(function(){
    $('.add_cart').click(function(){
      var id    = $(this).data("id");
      var nama_barang  = $(this).data("nama_barang");
      var harga_jual = $(this).data("harga_jual");
      var qty   	  = $('#' + id).val();
      $.ajax({
        url : (base_url+"dep/add_to_cart"),
        method : "POST",
        data: $('#form_transaksi').serialize(),
        success: function(data){
          $('#form_transaksi')[0].reset();
          $('#detail_cart').html(data);
        }
      });
    });

  $('#detail_cart').load(base_url+"dep/load_cart");

  $('#id_barang').on('input',function(){

             var id_barang=$(this).val();
             $.ajaxSetup({
                 data: {
                     csrf_test_name: $.cookie('csrf_cookie_name')
                 }
             });
             $.ajax({
                 type : "POST",
                 url  : (base_url+"dep/get_barang"),
                 dataType : "JSON",
                 data : {id_barang: id_barang},
                 cache:false,
                 success: function(data){
                     $.each(data,function(id, nama_barang, harga_jual){
                         $('[name="id"]').val(data.id);
                         $('[name="nama_barang"]').val(data.nama_barang);
                         $('[name="harga_jual"]').val(data.harga_jual);
                         $('[name="satuan"]').val(data.satuan);
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
                       $.each(data,function(id, id_pelanggan, nama_pelanggan, alamat, no_telp, nama_dagang, kota){
                           // $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                           // $('[name="alamat"]').innerText(data.alamat);
                           // $('[name="no_telp"]').val(data.no_telp);
                           // $('[name="nama_dagang"]').val(data.nama_dagang);
                           $('[name="id"]').val(data.id);
                           document.getElementById('id').innerHTML = data.id;
                           document.getElementById('idpelanggan').innerHTML = data.id_pelanggan;
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
        url : (base_url+"dep/delete_cart"),
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
        url : (base_url+"dep/hapus_cart"),
        method : "POST",
        success :function(data){
          $('#detail_cart').html(data);
        }
      });
    });


    //update data cart 
    $('#detail_cart3').load(base_url+"transaksi/load_cart3");

    $('.add_cart3').click(function(){
            var id    = $(this).data("id");
            var nama_barang  = $(this).data("nama_barang");
            var harga_jual = $(this).data("harga_jual");
            var qty   	  = $('#' + id).val();
            $.ajax({
            url : (base_url+"transaksi/add_to_cart"),
            method : "POST",
            data: $('#form_transaksi3').serialize(),
            success: function(data){
                $('#form_transaksi3')[0].reset();
                $('#detail_cart3').html(data);
            }
            });
        });

    $('#id_barang').on('input',function(){
        var id_barang=$(this).val();
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.ajax({
            type : "POST",
            url  : (base_url+"transaksi/get_barang"),
            dataType : "JSON",
            data : {id_barang: id_barang},
            cache:false,
            success: function(data){
                $.each(data,function(id, nama_barang, harga_jual){
                    $('[name="id"]').val(data.id);
                    $('[name="nama_barang"]').val(data.nama_barang);
                    $('[name="harga_jual"]').val(data.harga_jual);
                    $('[name="satuan"]').val(data.satuan);
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
                  $.each(data,function(id, id_pelanggan, nama_pelanggan, alamat, no_telp, nama_dagang, kota){
                      // $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                      // $('[name="alamat"]').innerText(data.alamat);
                      // $('[name="no_telp"]').val(data.no_telp);
                      // $('[name="nama_dagang"]').val(data.nama_dagang);
                      $('[name="id"]').val(data.id);
                      document.getElementById('id').innerHTML = data.id;
                      document.getElementById('idpelanggan').innerHTML = data.id_pelanggan;
                      document.getElementById('nama_pelanggan').innerHTML = data.nama_pelanggan;
                      document.getElementById('alamat').innerHTML = data.alamat;
                      document.getElementById('no_telp').innerHTML = data.no_telp;
                      document.getElementById('nama_dagang').innerHTML = data.nama_dagang;
                  });

              }
          });
          return false;
    });

    $(document).on('click','.romove_cart_admin',function(){
        var row_id=$(this).attr("id");
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.ajax({
          url : (base_url+"transaksi/delete_cart"),
          method : "POST",
          data : {row_id : row_id},
          success :function(data){
            $('#detail_cart3').html(data);
          }
        });
      });

      $(document).on('click','.hapus_cart3',function(){
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.ajax({
          url : (base_url+"transaksi/hapus_cart"),
          method : "POST",
          success :function(data){
            $('#detail_cart3').html(data);
          }
        });
      });

  });

  function hapus(faktur) {
    $("#pesan").html("");
    $("#password").val("");
    $.ajax({
        type: "post",
        url: base_url + "transaksi/get_faktur",
        data: {
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            if (response == false) {
                alert('No Faktur tidak diketahui');
            } else {
                $("#faktur").text(response.faktur);
                $("#nama_pelanggan").text(response.nama_pelanggan);
                $("#password").val("");

                $(".modal-title").text('Konfirmasi Hapus Data Transaksi');
                $("#label_keterangan").text('Masukkan password untuk konfirmasi hapus');
                $("#btn_hapus").text('Hapus');
                $("#modal_hapus").modal('show');
                save_method = 'hapus';
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function edit(faktur) {
    $("#pesan").html("");
    $("#password").val("");
    $.ajax({
        type: "post",
        url: base_url + "transaksi/get_faktur",
        data: {
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            if (response == false) {
                alert('No Faktur tidak diketahui');
            } else {
                $("#faktur").text(response.faktur);
                $("#nama_pelanggan").text(response.nama_pelanggan);
                //$("#id").val(response.id);
                $("#password").val("");
                save_method = 'ubah';

                $(".modal-title").text('Konfirmasi Ubah Data Transaksi');
                $("#label_keterangan").text('Masukkan password untuk konfirmasi ubah');
                $("#btn_hapus").text('Update');
                $("#modal_hapus").modal('show');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function check_password() {
    
    if (save_method == 'hapus') {
        hapus_action(); 
    } else if(save_method == 'ubah'){
        edit_action();
    }   
}

function edit_action() {
    password = $("#password").val();
    //id = $("#id").val();
    faktur = $("#faktur").text();
    $.ajax({
        type: "post",
        url: base_url + "transaksi/cek_password_edit",
        data: {
            password: password,
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            pesan_cek();
            if (response) {
                location.href = base_url+'transaksi/checkout/'+faktur;
            } else {
                pesan_gagal('Password salah');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function hapus_action() {
    password = $("#password").val();
    faktur = $("#faktur").text();
    $.ajax({
        type: "post",
        url: base_url + "transaksi/cek_password",
        data: {
            password: password,
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            pesan_cek();
            if (response) {
                pesan_sukses('Berhasil dihapus');
                setTimeout(() => {
                    location.reload();
                    $("#modal_hapus").modal('hide');
                    $("#pesan").html("");
                    $("#password").val("");
                }, 500);
            } else {
                pesan_gagal('Password salah');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function pesan_cek() {
    $("#btn_hapus").attr('disabled', 'disabled');
    $("#pesan").html(
        "<div class='alert alert-warning' role='alert'> Checking</div>"
    );
}

function pesan_gagal(pesan) {
    $("#pesan").html(
        "<div class='alert alert-danger' role='alert'> <strong>Error!</strong> " +
        pesan + " </div>"
    );
    $("#btn_hapus").removeAttr('disabled');
}

function pesan_sukses(pesan) {
    $("#pesan").html(
        "<div class='alert alert-success' role='alert'> <strong>Success!</strong> " +
        pesan + " </div>"
    );
    $("#btn_hapus").removeAttr('disabled');
}

$("#password").keypress(function (e) {
    if (e.which == 13) {
        check_password();
    }
});
