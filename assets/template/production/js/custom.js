$('#transaksilist').dataTable( {
  "rowsGroup": [1],
  "columnDefs": [
  {
      "targets": [ 0, 7 ], //first column / numbering column
      "orderable": false, //set not orderable
  },
  ],
} );

$(document).ready(function () {
  $(".text").hide();
  $("#2").click(function () {
      $(".text").show();
  });
  $("#1").click(function () {
      $(".text").hide();
  });
});

$(document).ready(function() {
  $('.js-example-basic-single').select2();
});


$('#title').autocomplete({
        source: (base_url+"pembayaran/get_autocomplete"),
        select: function (event, ui) {
            $('[name="title"]').val(ui.item.label);
            $('[name="hutang"]').val(formatNumber(ui.item.utang));
            $('[name="id_transaksi"]').val(ui.item.transaksi);
            $('[name="id"]').val(ui.item.id);
            $('[name="sudah"]').val(ui.item.sudah);
            $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
        }
});

$('#id_track').autocomplete({
        source: (base_url+"dep/get_auto"),
        select: function (event, ui) {
            $('[name="title"]').val(ui.item.label);
            // $('[name="hutang"]').val(formatNumber(ui.item.utang));
            // $('[name="id_transaksi"]').val(ui.item.transaksi);
            // $('[name="id"]').val(ui.item.id);
            // $('[name="sudah"]').val(ui.item.sudah);
            // $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
        }
});

$('#title3').autocomplete({
        source: (base_url+"dep/get_auto_transaksi"),
        select: function (event, ui) {
            $('[name="title"]').val(ui.item.label);
            $('[name="hutang"]').val(formatNumber(ui.item.utang));
            $('[name="id_pelanggan2"]').val(ui.item.pelanggan);
            $('[name="id"]').val(ui.item.id);
            $('[name="sudah"]').val(ui.item.sudah);
            $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
        }
});

$('#autoidtransaksi').autocomplete({
        source: (base_url+"dep/get_autocomplete"),
        select: function (event, ui) {
            $('[name="id_pelanggan"]').val(ui.item.label);
            document.getElementById('nama_pelanggan').innerHTML = ui.item.nama_pelanggan;
            $('[name="id"]').val(ui.item.id);
            document.getElementById('alamat').innerHTML = ui.item.alamat;
            document.getElementById('nama_dagang').innerHTML = ui.item.nama_dagang;
            document.getElementById('no_telp').innerHTML = ui.item.no_telp;
        }
});

$('#autoidjadwal').autocomplete({
        source: (base_url+"pembayaran/get_autocomplete"),
        select: function (event, ui) {
            $('[name="id_pelanggan"]').val(ui.item.label);
        }
});

$(document).ready(function(){
    function search(){
       var judul=$("#id_track").val();
       console.log(judul);
        if(judul!=""){
            $("#result").html(base_url+"assets/ajax-loader.gif");
              $.ajax({
                     type : "POST",
                  url  : (base_url+"dep/track_transaksi"),
                  data:"judul="+judul,

                  success:function(data){
                    $("#result").html(data);
                    $("#id_track").val();
                  }
           });
           $('#tabel_cari').show();
        }
    }

    $("#button").click(function(){
        search();
    });

    $('#id_track').keyup(function(e) {
        if(e.keyCode == 13) {
           search();
        }
    });
  });
