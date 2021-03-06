var save_method; //for save method string
var table;
     $(document).ready(function () {
          table = $('#pembayaran').dataTable({
           "processing": true, //Feature control the processing indicator.
           "serverSide": true, //Feature control DataTables' server-side processing mode.
           "order": [], //Initial no order.

           // Load data for the table's content from an Ajax source
           "ajax": {
               "url": (base_url+"admint/pembayaran/ajax_list"),
               "type": "POST",
               "data": function ( data ) {
                }
           },

           //Set column definition initialisation properties.
           "columnDefs": [
           {
               "targets": [ 4, 5 ], //first column / numbering column
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
           $('#pembayaran').DataTable().ajax.reload();//reload datatable ajax
      }
