var table;
var btn_excel = $("#excel-tracking-pel");
 
$(document).ready(function() {
    // $("#filter-tgl").datepicker({
    //     dateFormat : 'yy-mm-dd',
    // });
    view('day');
    
    //datatables
    table.destroy();
    table = $('#table-penjualan-debt-admin2').DataTable({ 
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 16 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
             // Update footer
            $( api.column( 16 ).footer() ).html(
                $("#total").html('Total Penjualan : Rp. '+formatCurrency(total))
            );
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"laporan/penjualandebt/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.tanggal = $('#filter-tgl').val();
                data.dari = $('#filter-bulan-dari').val();
                data.ke = $('#filter-bulan-ke').val();
                data.tahun = $('#filter-tahun').val();
                data.tahun2 = $('#filter-tahun2').val();

                data.debt = $('#filter-debt').val();
                data.debt2 = $('#filter-debt2').val();
                data.debt3 = $('#filter-debt3').val();

                data.status = $('#filter-status').val();
                data.status2 = $('#filter-status2').val();
                data.status3 = $('#filter-status3').val();
            }
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0 -1], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });

});


function search() {
    reload_table();
}
function refresh() {
    $('#form-laporan')[0].reset();
    reload_table();
}

function reload_table()
{
    $('#table-penjualan-debt-admin2').DataTable().ajax.reload();//reload datatable ajax
}

function view(value) {
    if (value == 'day') {
        $("#view_day").show();
        $("#view_month").hide();
        $("#view_year").hide();
    } else if (value == 'month') {
        $("#view_day").hide();
        $("#view_month").show();
        $("#view_year").hide();
    } else if (value == 'year') {
        $("#view_day").hide();
        $("#view_month").hide();
        $("#view_year").show();
    }
    $('#form-laporan')[0].reset();
}

function excel_tanggal() {
    
    tgl = $("#filter-tgl").val();
    debt = $("#filter-debt").val();
    status = $("#filter-status").val();
    
    if (tgl == '') {
      tgl = 'semua';
    }
    if (debt == '') {
      debt = 'semua';
    }
    if (status == '') {
      status = 'semua';
    }

    window.location = base_url + 'laporan/penjualandebt/excel_tanggal/'+tgl+'/'+debt+'/'+status;
}

function excel_bulan() {
    
    dari = $("#filter-bulan-dari").val();
    ke = $("#filter-bulan-ke").val();
    tahun = $("#filter-tahun").val();
    debt = $("#filter-debt2").val();
    status = $("#filter-status2").val();

    if (dari == '') {
      dari = 'semua';
    }

    if (ke == '') {
      ke = 'semua';
    }

    if (tahun == '') {
      tahun = 'semua';
    }

    if (debt == '') {
      debt = 'semua';
    }

    if (status == '') {
      status = 'semua';
    }

    window.location = base_url + 'laporan/penjualandebt/excel_bulan/'+dari+'/'+ke+'/'+tahun+'/'+debt+'/'+status;
}

function excel_tahun() {
    
    tahun = $("#filter-tahun2").val();
    debt = $("#filter-debt3").val();
    status = $("#filter-status3").val();
    if (tahun == '') {
      tahun = 'semua';
    }
    if (status == '') {
      status = 'semua';
    }
    if (debt == '') {
        debt = 'semua';
      }
    window.location = base_url + 'laporan/penjualandebt/excel_tahun/'+tahun+'/'+debt+'/'+status;
}

function formatCurrency(num) {
    num = num.toString().replace(/\$|\./g,'');
    if(isNaN(num))
    num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    cents = num;
    num = Math.floor(num/100).toString();
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
    num = num.substring(0,num.length-(4*i+3))+'.'+
    num.substring(num.length-(4*i+3));
    return (((sign)?'':'-') + num);
     }