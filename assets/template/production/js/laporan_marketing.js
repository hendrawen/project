$(document).ready(function() {
    load_marketing();
  });
        
        $("#btn-laporan-marketing-harian").click(function() {
          tgl = $("#tgl").val();
          berdasarkan = $("#berdasarkan-marketing").val();
          nama = $("#nama-marketing").val();
          $("#loading").show();
          $.ajaxSetup({
              data: {
                  csrf_test_name: $.cookie('csrf_cookie_name')
              }
          });
          $.ajax({
            url: base_url+'laporan/marketing/load_harian_marketing/',
            type: 'POST',
            dataType: 'html',
            data: {tgl: tgl, nama : nama, berdasarkan : berdasarkan},
            success : function (data) {
              $("#loading").hide();
              $("#tbody").html(data);

            }
          })
        });


        $("#excel_marketing_harian").click(function() {
          tgl = $("#tgl").val();
          n = $("#nama-marketing").val();
          window.location = base_url + 'laporan/excel/marketing_harian/'+tgl+'/'+n;
        });

        //berdasarkan marketing
        $("#berdasarkan-marketing").change(function() {
            berdasarkan = $("#berdasarkan-marketing").val();
            $("#loading-combo").show();
            $.ajaxSetup({
                data: {
                    csrf_test_name: $.cookie('csrf_cookie_name')
                }
            });
            $.ajax({
            url: base_url+'laporan/marketing/isi_marketing/'+berdasarkan,
            type: 'POST',
            dataType: 'html',
            success : function (data) {
                $("#loading-combo").hide();
                $("#nama-marketing").html(data);
                $("#nama-marketing").focus();
            }
            });
        });

      //tahunan marketing
      $("#btn-marketing-tahunan").click(function() {
        tahun = $("#tahun-marketing").val();
        berdasarkan = $("#berdasarkan-marketing").val();
        nama = $("#nama-marketing").val();
        $("#loading").show();
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.ajax({
          url: base_url+'laporan/marketing/load_tahunan_marketing/',
          type: 'POST',
          dataType: 'html',
          data: {tahun: tahun, nama : nama, berdasarkan : berdasarkan},
          success : function (data) {
            $("#loading").hide();
            $("#tbody").html(data);
          }
        });
      });

      //bulanan marketing
      $("#btn-marketing-bulanan").click(function() {
        bulan_dari = $("#bulan_dari").val();
        bulan_ke = $("#bulan_ke").val();
        tahun = $("#tahun-marketing").val();
        berdasarkan = $("#berdasarkan-marketing").val();
        nama = $("#nama-marketing").val();
        $("#loading").show();
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.ajax({
          url: base_url+'laporan/marketing/load_bulanan_marketing/',
          type: 'POST',
          dataType: 'html',
          data: {from : bulan_dari, to : bulan_ke, tahun: tahun, nama : nama, berdasarkan : berdasarkan},
          success : function (data) {
            $("#loading").hide();
            $("#tbody").html(data);
          }
        });
      });

      $("#marketing_excel_bulanan").click(function() {
        b1 = $("#bulan_dari").val();
        b2 = $("#bulan_ke").val();
        t = $("#tahun").val();
        n = $("#nama-marketing").val();
        window.location = base_url + 'laporan/excel/marketing_bulanan/'+b1+'/'+b2+'/'+t+'/'+n;
      });
  
      $("#excel_marketing_tahunan").click(function() {
        t = $("#tahun-marketing").val();
        n = $("#nama-marketing").val();
        window.location = base_url + 'laporan/excel/marketing_tahunan/'+t+'/'+n;
      });
      
    
    function load_marketing() {
      $("#loading").show();
      $.ajax({
        url: base_url+'laporan/marketing/load_marketing_all/',
        dataType: 'html',
        success : function (data) {
          $("#loading").hide();
          $("#tbody").html(data);
  
        }
      })
  }
  
    $("#btn-refresh-marketing").click(function() {
      load_marketing();
    });
  
  