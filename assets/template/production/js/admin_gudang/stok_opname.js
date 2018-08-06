$(document).ready(function () {
    get_all_stok();
    });
  
      function get_all_stok() {
        $("#loading").show();
        $.ajax({
          url: base_url+'admin_gudang/stok_opname/load_all/',
          type: 'POST',
          dataType: 'html',
          success : function (data) {
            $("#loading").hide();
            $("#tbody-stok").html(data);
          }
        })
      }