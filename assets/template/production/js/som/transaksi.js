var table;
     $(document).ready(function () {
          table = $('#table_transaksi').dataTable({
           "processing": true, //Feature control the processing indicator.
           "serverSide": true, //Feature control DataTables' server-side processing mode.
           "order": [], //Initial no order.

           // Load data for the table's content from an Ajax source
           "ajax": {
               "url": (base_url+"som/transaksi/ajax_list"),
               "type": "POST",
               "data": function ( data ) {
                 data.dari = $('#dari').val();
                 data.ke = $('#ke').val();
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

         $('#btn-filter-transaksi').click(function(){ //button filter event click
             reload_table();//reload datatable ajax   //just reload table
         });
         $('#btn-reset-transaksi').click(function(){ //button reset event click
             $('#form-filter-transaksi')[0].reset();
             reload_table();//reload datatable ajax
         });

     });


      function reload_table()
      {
           $('#table_transaksi').DataTable().ajax.reload();//reload datatable ajax
      }

      $(excel_transaksi).click(function (e) {
        dari = $('#dari').val();
        ke = $('#ke').val();
        console.log(dari);
        console.log(ke);
        
        
        window.location = base_url + 'som/transaksi/excel/'+dari+'/'+ke;
        
    });