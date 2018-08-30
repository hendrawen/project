var save_method; //for save method string
var table;
$(document).ready(function () {
    table = $('#tbl_pembayaran').dataTable({
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
                $("#password").val("");
                $("#modal_hapus").modal('show');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function check_password() {
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
                    refresh_table();
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