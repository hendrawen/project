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
