var table;
var btn_excel = $("#excel-tracking");
 
$(document).ready(function() {
    $('#filter-kota').select2();
    $('#filter-kecamatan').select2();
    $('#tahun-tracking').select2();
    
    //datatables
    table = $('#table-tracking').DataTable({ 

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
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
             // Update footer
            $( api.column( 11 ).footer() ).html(
                formatCurrency(total)
            );
        },

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"status_pelanggan/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.tahun = $('#tahun-tracking').val();
                data.kota = $('#filter-kota').val();
                data.kecamatan = $('#filter-kecamatan').val();
                data.warna = $('#filter-warna').val();
                data.piutang = $('#filter-utang').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
    $('#btn-filter-tracking').click(function(){
        reload_table_tracking();
        
    });

    $('#btn-reset-tracking').click(function(){ 
        $('#form-tracking')[0].reset();
        $('#tahun-tracking').val("").trigger('change');
        $('#filter-kota').val("").trigger('change');
        $('#filter-kecamatan').val("").trigger('change');
        reload_table_tracking();
    });
});

function reload_table_tracking()
{
    $('#table-tracking').DataTable().ajax.reload();//reload datatable ajax
}

$(btn_excel).click(function (e) {
    tahun = $('#tahun-tracking').val();
    kota = $('#filter-kota').val();
    kecamatan = $('#filter-kecamatan').val();
    warna = $('#filter-warna').val();
    if (tahun == '') {
        tahun = 'semua';
    }
    if (kota == '') {
        kota = 'semua';
    }
    if (kecamatan == '') {
        kecamatan = 'semua';
    }
    
    window.location = base_url + 'status_pelanggan/download_excel/'+tahun+'/'+kota+'/'+kecamatan+'/'+warna;
<<<<<<< HEAD
});


function FormatCurrency(objNum)
  {
   var num = objNum.value
   var ent, dec;
   if (num != '' && num != objNum.oldvalue)
   {
     num = HapusTitik(num);
     if (isNaN(num))
     {
       objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
     } else {
       var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
       if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
       {
         alert(num.split('.')[1]);
         objNum.value = TambahTitik(num.split('.')[0])+'.'+num.split('.')[1];
       }
       else
       {
         objNum.value = TambahTitik(num.split('.')[0]);
       }
       objNum.oldvalue = objNum.value;
     }
   }
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

function HapusTitik(num)
{
    if (num == '' || num == '0') {
        return '0';
    } else {
        return (num.replace(/\./g, ''));
    }
}

function TambahTitik(num)
{
   numArr=new String(num).split('').reverse();
   for (i=3;i<numArr.length;i+=3)
   {
     numArr[i]+='.';
   }
   return numArr.reverse().join('');
}
=======
});
>>>>>>> fdc9eb20e0a312146ae7ff12ec69dd517f035146
