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
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0, 7 ], //first column / numbering column
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

function tambah()
{
    remove_parent();
    isi_karyawan();
    isi_kantor();
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
    isi_karyawan();
    isi_kantor();
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
            $('[name="keterangan"]').val(data.keterangan);
            $('[name="pendapatan"]').val(data.pendapatan);
            $('[name="pengeluaran"]').val(data.pengeluaran);
            // $('[name="pendapatan"]').datepicker('update',data.pendapatan);
            // $('[name="pengeluaran"]').datepicker('update',data.pengeluaran);
            $('#modal-kas').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
 
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

function saldo() {
    $.ajax({
        url: base_url+"kas/get_saldo",
        dataType: "json",
        success: function (response) {
            $(".saldo").html(response);
        }
    });
}