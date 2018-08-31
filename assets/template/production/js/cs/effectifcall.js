var save_method; //for save method string
var table;
     $(document).ready(function () {
          table = $('#table_call').dataTable({
           "processing": true, //Feature control the processing indicator.
           "serverSide": true, //Feature control DataTables' server-side processing mode.
           "order": [], //Initial no order.

           // Load data for the table's content from an Ajax source
           "ajax": {
               "url": (base_url+"customerservice/ajax_list"),
               "type": "POST",
               "data": function ( data ) {
                 data.status = $('#status').val();
                 data.tanggal = $('#tanggal').val();
                 data.tahun = $('#tahun').val();
                 data.sumber_data = $('#sumber_data').val();
                 data.melalui = $('#melalui').val();
                 data.hari = $('#hari').val();
                }
           },

           //Set column definition initialisation properties.
           "columnDefs": [
           {
               "targets": [ 9 ], //first column / numbering column
               "orderable": false, //set not orderable
           },
           ],
         });

         $('#btn-filter2').click(function(){ //button filter event click
             reload_table();//reload datatable ajax   //just reload table
         });
         $('#btn-reset2').click(function(){ //button reset event click
             $('#form-filter2')[0].reset();
             reload_table();//reload datatable ajax
         });
     });


      function reload_table()
      {
           $('#table_call').DataTable().ajax.reload();//reload datatable ajax
      }


      function delete_call(id)
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
                  url : (base_url+"customerservice/ajax_delete/"+id),
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
