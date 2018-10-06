var save_method; //for save method string
var table;
     $(document).ready(function () {
          table = $('#table_muat').dataTable({
           "processing": true, //Feature control the processing indicator.
           "serverSide": true, //Feature control DataTables' server-side processing mode.
           "order": [], //Initial no order.

           // Load data for the table's content from an Ajax source
           "ajax": {
            "url": (base_url+"hrd/muat/ajax_list/"),
            "type": "POST"
            },

           //Set column definition initialisation properties.
           "columnDefs": [
           {
               "targets": [  4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ], //first column / numbering column
               "orderable": false, //set not orderable
           },
           ],
         });

     });


      function reload_table()
      {
           $('#table_muat').DataTable().ajax.reload();//reload datatable ajax
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
                  url : (base_url+"hrd/muat/delete/"+id),
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
