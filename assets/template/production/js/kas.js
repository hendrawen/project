var table;
var save_method;
$(document).ready(function() {
    //datatables
    table = $('#table-kas').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url + "kas/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.hari = $('#filter-hari').val();
                data.bulan1 = $('#filter-bulan1').val();
                data.bulan2 = $('#filter-bulan2').val();
                data.tahun = $('#filter-tahun').val();
                data.kantor = $('#filter-kantor').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ 0, -1 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });

   
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

    //set input/textarea/select event when change value, remove class error and remove text help block
    remove_parent();
    saldo();
    isi_karyawan();
    isi_kantor();
    isi_kategori();

});

function reload() {
    $('#table-kas').DataTable().ajax.reload();//reload datatable ajax
    isi_karyawan();
    isi_kantor();
    isi_kategori();
}

$('#btn-reload').click(function(){ //button reset event click
    $('#form-filter')[0].reset();
    reload_table();//reload datatable ajax
});


function remove_parent() {
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
}

$('#btn-search').click(function(){ //button filter event click
    reload_table();//reload datatable ajax   //just reload table
});

function tambah()
{
    remove_parent();
    // isi_karyawan();
    // isi_kantor();
    // isi_kategori();
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('[name="pendapatan"]').val('0');
    $('[name="pengeluaran"]').val('0');
    $("#modal-kas").modal("show"); // show bootstrap modal
    $('.modal-title').text('Tambah Pendapatan dan Pengeluaran'); // Set Title to Bootstrap modal title
}

function ubah(id)
{
    remove_parent();
    // isi_karyawan();
    // isi_kantor();
    // isi_kategori();
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : base_url+"kas/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_kas"]').val(data.id_kas);
            $('[name="tanggal"]').val(data.tanggal);
            $('[name="id_kantor"]').val(data.id_kantor);
            $('[name="id_karyawan"]').val(data.id_karyawan);
            $('[name="id_kategori"]').val(data.id_kategori);
            $('[name="pendapatan"]').val(data.pendapatan);
            $('[name="pengeluaran"]').val(data.pengeluaran);
            // $('[name="pendapatan"]').datepicker('update',data.pendapatan);
            // $('[name="pengeluaran"]').datepicker('update',data.pengeluaran);
            $('#modal-kas').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pendapatan dan Pengeluaran'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
    saldo();
}

function simpan()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    HapusTitik
    var url;

    if(save_method == 'add') {
        url = base_url+"kas/ajax_add";
    } else {
        url = base_url+"kas/ajax_update";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal-kas').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Simpan'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Simpan'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function hapus(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : base_url+"kas/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal-kas').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function isi_karyawan() {
    $('#id_karyawan')
        .empty()
        .append('<option selected="selected" value="">-- Select One --</option>');
    $.ajax({
        url: base_url+"kas/get_karyawan",
        dataType: "json",
        success: function (response) {
            $.each(response, function(key, value) {
                $('#id_karyawan')
                    .append($("<option></option>")
                    .attr("value",value.id_karyawan)
                    .text(value.nama));
           });
        }
    });
}

function isi_kantor() {
    $('#id_kantor')
        .empty()
        .append('<option selected="selected" value="">-- Select One --</option>');
    $.ajax({
        url: base_url+"kas/get_kantor",
        dataType: "json",
        success: function (response) {
            $.each(response, function(key, value) {
                $('#id_kantor')
                    .append($("<option></option>")
                    .attr("value",value.id)
                    .text(value.nama_gudang));
           });
        }
    });
}

function isi_kategori() {
    $('#id_kategori')
        .empty()
        .append('<option selected="selected" value="">-- Select One --</option>');
    $.ajax({
        url: base_url+"kas/get_kategori",
        dataType: "json",
        success: function (response) {
            $.each(response, function(key, value) {
                $('#id_kategori')
                    .append($("<option></option>")
                    .attr("value",value.id_kategori)
                    .text(value.nama_kategori));
           });
        }
    });
}

function saldo() {
    $.ajax({
        url: base_url+"kas/get_saldo",
        dataType: "json",
        success: function (response) {
            $(".saldo").html(response);
        }
    });
}


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
function HapusTitik(num)
{
   return (num.replace(/\./g, ''));
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

$("#btn-kas-harian").click(function() {
    day = $("#kas-hari").val();
    kantor = $("#kantor").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'kas/load_kas_harian/',
      type: 'POST',
      dataType: 'html',
      data: {day: day, kantor : kantor},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  $("#btn-kas-bulanan").click(function() {
    from = $("#kas-from").val();
    to = $("#kas-to").val();
    year = $("#kas-year").val();
    kantor = $("#kantor").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'kas/load_kas_bulanan/',
      type: 'POST',
      dataType: 'html',
      data: {from: from, to : to, year : year, kantor : kantor},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });

  $("#btn-kas-tahunan").click(function() {
    tahun = $("#tahun").val();
    kantor = $("#kantor").val();
    $("#loading").show();
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url: base_url+'kas/load_kas_tahunan/',
      type: 'POST',
      dataType: 'html',
      data: {tahun: tahun, kantor : kantor},
      success : function (data) {
        $("#loading").hide();
        $("#tbody").html(data);
      }
    });
  });
