$(document).ready(function() {

  $("#tgl").change(function() {
    tgl = $("#tgl").val();
    $.ajax({
      url: base_url+'som/laporan/load_harian/'+tgl,
      type: 'POST',
      dataType: 'html',
      data: {tgl: tgl},
      beforeSend : function() {
        $("loading").css('display', 'show');
      },
      complete : function() {
        $("loading").css('display', 'none');
      },
      success : function (data) {
        $("#tbody").html(data);
      }
    })

  });
});
