$(document).ready(function () {
    get_all();
  });

  function get_all() {
    $("#loading").show();
    $.ajax({
      url: base_url+'produk/load_kota',
      type: 'POST',
      dataType: 'html',
      success : function (data) {
        $("#loading").hide();
        $("#tbody-produk").html(data);
      }
    })
  }
