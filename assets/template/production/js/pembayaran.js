var save_method; //for save method string
var table;
$(document).ready(function () {
    table = $('#tbl_pembayaran').dataTable({
        "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": (base_url + "pembayaran/ajax_list"),
            "type": "POST",
            "data": function (data) {}
        },

        //Set column definition initialisation properties.
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
    $('#tbl_pembayaran')
        .DataTable()
        .ajax
        .reload(); //reload datatable ajax
}

function hapus(faktur) {
    $("#pesan").html("");
    $("#password").val("");
    $.ajax({
        type: "post",
        url: base_url + "pembayaran/get_faktur",
        data: {
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            if (response == false) {
                alert('No Faktur tidak diketahui');
            } else {
                $("#faktur").text(response.faktur);
                $("#nama_pelanggan").text(response.nama_pelanggan);
                //$("#id").val(response.id);
                $("#password").val("");

                $(".modal-title").text('Konfirmasi Hapus Data Pembayaran');
                $("#label_keterangan").text('Masukkan password untuk konfirmasi hapus');
                $("#btn_hapus").text('Hapus');
                $("#modal_hapus").modal('show');
                save_method = 'hapus';
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function edit(faktur) {
    $("#pesan").html("");
    $("#password").val("");
    $.ajax({
        type: "post",
        url: base_url + "pembayaran/get_faktur",
        data: {
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            if (response == false) {
                alert('No Faktur tidak diketahui');
            } else {
                $("#faktur").text(response.faktur);
                $("#nama_pelanggan").text(response.nama_pelanggan);
                //$("#id").val(response.id);
                $("#password").val("");
                save_method = 'ubah';

                $(".modal-title").text('Konfirmasi Ubah Data Pembayaran');
                $("#label_keterangan").text('Masukkan password untuk konfirmasi ubah');
                $("#btn_hapus").text('Update');
                $("#modal_hapus").modal('show');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function check_password() {
    
    if (save_method == 'hapus') {
        hapus_action(); 
    } else if(save_method == 'ubah'){
        edit_action();
    }   
}

function edit_action() {
    password = $("#password").val();
    //id = $("#id").val();
    faktur = $("#faktur").text();
    $.ajax({
        type: "post",
        url: base_url + "pembayaran/cek_password_edit",
        data: {
            password: password,
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            pesan_cek();
            if (response) {
                location.href = base_url+'pembayaran/update/'+faktur;
            } else {
                pesan_gagal('Password salah');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function hapus_action() {
    password = $("#password").val();
    faktur = $("#faktur").text();
    $.ajax({
        type: "post",
        url: base_url + "pembayaran/cek_password",
        data: {
            password: password,
            faktur: faktur
        },
        dataType: "json",
        success: function (response) {
            pesan_cek();
            if (response) {
                pesan_sukses('Berhasil dihapus');
                setTimeout(() => {
                    location.reload();
                    $("#modal_hapus").modal('hide');
                    $("#pesan").html("");
                    $("#password").val("");
                }, 500);
            } else {
                pesan_gagal('Password salah');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function pesan_cek() {
    $("#btn_hapus").attr('disabled', 'disabled');
    $("#pesan").html(
        "<div class='alert alert-warning' role='alert'> Checking</div>"
    );
}

function pesan_gagal(pesan) {
    $("#pesan").html(
        "<div class='alert alert-danger' role='alert'> <strong>Error!</strong> " +
        pesan + " </div>"
    );
    $("#btn_hapus").removeAttr('disabled');
}

function pesan_sukses(pesan) {
    $("#pesan").html(
        "<div class='alert alert-success' role='alert'> <strong>Success!</strong> " +
        pesan + " </div>"
    );
    $("#btn_hapus").removeAttr('disabled');
}

$("#password").keypress(function (e) {
    if (e.which == 13) {
        check_password();
    }
});