$(document).ready(function () {
    get_all_stok();
    });
  
      function get_all_stok() {
        $("#loading").show();
        $.ajax({
          url: base_url+'kepala_cabang/stok_opname/load_all/',
          type: 'POST',
          dataType: 'html',
          success : function (data) {
            $("#loading").hide();
            $("#tbody-stok").html(data);
          }
        })
      }
