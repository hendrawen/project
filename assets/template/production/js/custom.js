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

$('#title2').autocomplete({
        source: (base_url+"dep/get_auto"),
        select: function (event, ui) {
            $('[name="title"]').val(ui.item.label);
            $('[name="hutang"]').val(formatNumber(ui.item.utang));
            $('[name="id_transaksi"]').val(ui.item.transaksi);
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
        source: (base_url+"dep/get_autocomplete"),
        select: function (event, ui) {
            $('[name="id_pelanggan"]').val(ui.item.label);
        }
});
