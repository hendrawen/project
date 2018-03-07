var save_method; //for save method string
var table;
     $(document).ready(function () {
          table = $('#table').dataTable({
           "processing": true, //Feature control the processing indicator.
           "serverSide": true, //Feature control DataTables' server-side processing mode.
           "order": [], //Initial no order.

           // Load data for the table's content from an Ajax source
           "ajax": {
               "url": "pelanggan/ajax_list",
               "type": "POST",
               "data": function ( data ) {
                    data.kota = $('#kota').val();
                    data.status = $('#status').val();
                    data.kelurahan = $('#kelurahan').val();
                    data.kecamatan = $('#kecamatan').val();
                    data.nama = $('#nama').val();
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
                  url : "pelanggan/ajax_delete/"+id,
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
