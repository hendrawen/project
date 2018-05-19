var save_method; //for save method string
var table;
     $(document).ready(function () {
          table = $('#table').dataTable({
           "processing": true, //Feature control the processing indicator.
           "serverSide": true, //Feature control DataTables' server-side processing mode.
           "order": [], //Initial no order.

           // Load data for the table's content from an Ajax source
           "ajax": {
               "url": (base_url+"pelanggan/ajax_list"),
               "type": "POST",
               "data": function ( data ) {
                    data.kota = $('#filter-kota').val();
                    data.kecamatan = $('#filter-kecamatan').val();
                    data.kelurahan = $('#filter-kelurahan').val();
                    data.status = $('#status').val();
                    data.nama = $('#nama').val();
                    data.created_at = $('#created_at').val();
                    data.tahun = $('#tahun').val();
                }
           },

           //Set column definition initialisation properties.
           "columnDefs": [
           {
               "targets": [ 13 ], //first column / numbering column
               "orderable": false, //set not orderable
           },
           ],
         });

         $('#btn-filter').click(function(){ //button filter event click
             reload_table();//reload datatable ajax   //just reload table
         });
         $('#btn-reset').click(function(){ //button reset event click
             $('#form-filter')[0].reset();
             reload_table();//reload datatable ajax
         });
     });


      function reload_table()
      {
           $('#table').DataTable().ajax.reload();//reload datatable ajax
      }


      function delete_pelanggan(id)
      {
          if(confirm('Are you sure delete this data?'))
          {
              // ajax delete data to database
              $.ajaxSetup({
                  data: {
                      csrf_test_name: $.cookie('csrf_cookie_name')
                  }
              });
              $.ajax({
                  url : (base_url+"pelanggan/ajax_delete/"+id),
                  type: "POST",
                  dataType: "JSON",
                  success: function(data)
                  {
                      //if success reload ajax table
                      $('#modal_form').modal('hide');
                      reload_table();
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error deleting data');
                  }
              });

          }
      }

      $("#kota").change(function(event) {
        var element = $("option:selected", this);
        var id_kota = element.attr("id_kota");
        $("#loader-kecamatan").show();
        $.ajax({
          url: base_url+'pelanggan/get_kecamatan/'+id_kota,
          dataType: 'html',
          success : function (data) {
            $("#loader-kecamatan").hide();
            $("#kecamatan").html(data);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error getting record');
          }
        })
      });

      $("#kecamatan").change(function(event) {
        var element = $("option:selected", this);
        $("#loader-kelurahan").show();
        var id_kecamatan = element.attr("id_kecamatan");
        $.ajax({
          url: base_url+'pelanggan/get_kelurahan/'+id_kecamatan,
          dataType: 'html',
          success : function (data) {
            $("#loader-kelurahan").hide();
            $("#kelurahan").html(data);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error getting record');
          }
        })
      });

      $("#filter-kota").change(function(event) {
        var element = $("option:selected", this);
        var id_kota = element.attr("id_kota");
        $.ajax({
          url: base_url+'pelanggan/get_kecamatan/'+id_kota,
          dataType: 'html',
          success : function (data) {
            $("#filter-kecamatan").html(data);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error getting record');
          }
        })
      });

      $("#filter-kecamatan").change(function(event) {
        var element = $("option:selected", this);
        var id_kecamatan = element.attr("id_kecamatan");
        $.ajax({
          url: base_url+'pelanggan/get_kelurahan/'+id_kecamatan,
          dataType: 'html',
          success : function (data) {
            $("#filter-kelurahan").html(data);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error getting record');
          }
        })
      });
