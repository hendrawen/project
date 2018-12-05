var save_method; //for save method string
var table;

$(document).ready(function () {
    table = $('#table_produku').dataTable({
        "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": (base_url + "produku/ajax_list"),
            "type": "POST",
            "data": function (data) {}
        },

        //Set column definition initialisation properties.
        "rowsGroup": [0],
        "columnDefs": [
            {
                "targets": [
                    4, 5
                ], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ]
    });

});

function refresh_table() {
    $('#table_produku')
        .DataTable()
        .ajax
        .reload(); //reload datatable ajax
}
