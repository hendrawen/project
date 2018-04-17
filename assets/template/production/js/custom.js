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
        }
});
