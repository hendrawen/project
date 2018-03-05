
    $(document).ready(function(){
        tampil_data_suplier();   //pemanggilan fungsi tampil barang.

        $('#mydata').dataTable();

        //fungsi tampil barang
        function tampil_data_suplier(){
            $.ajax({
                type  : 'ajax',
                url   : 'suplier/data_suplier',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    var no = 1;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+no+++'</td>'+
                                '<td>'+data[i].id_suplier+'</td>'+
                                '<td>'+data[i].nama_suplier+'</td>'+
                                '<td>'+data[i].alamat+'</td>'+
                                '<td style="text-align:center;">'+
                                  '<a href="javascript:;" class="btn btn-default btn-sm item_view" data="'+data[i].id+'"><i class="glyphicon glyphicon-search"></i></a>'+' '+
                                  '<a href="javascript:;" class="btn btn-default btn-sm item_edit" data="'+data[i].id+'"><i class="glyphicon glyphicon-pencil"></i></a>'+' '+
                                  '<a href="javascript:;" class="btn btn-default btn-sm item_hapus" data="'+data[i].id+'"><i class="glyphicon glyphicon-trash"></i></a>'+
                                '</td>'+
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }

        //Simpan Data Suplier
        $('#btn_simpan').on('click',function(){
            //var id_suplier=$('#id_suplier').val();
            var nama_suplier=$('#nama_suplier2').val();
            var alamat=$('#alamat2').val();
            $.ajax({
                type : "POST",
                url  : "suplier/simpan",
                dataType : "JSON",
                data : {nama_suplier: nama_suplier, alamat: alamat, csrf_test_name: $.cookie('csrf_cookie_name')},
                success: function(data){
                    location.reload(true);
                    //$('[name="id_suplier"]').val("");
                    $('[name="nama_suplier"]').val("");
                    $('[name="alamat"]').val("");
                    $('#ModalaAdd').modal('hide');
                    tampil_data_suplier();
                }
            });
            return false;
        });

        //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "suplier/get_suplier",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id_suplier, nama_suplier, alamat){
                        $('#ModalaEdit').modal('show');
                        $('[name="id"]').val(data.id);
                        $('[name="id_suplier"]').val(data.id_suplier);
                        $('[name="nama_suplier"]').val(data.nama_suplier);
                        $('[name="alamat"]').val(data.alamat);
                    });
                }
            });
            return false;
        });

        //Update Suplier
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
            //var id_suplier=$('#id_suplier2').val();
            var nama_suplier=$('#nama_suplier2').val();
            var alamat=$('#alamat2').val();
            $.ajax({
                type : "POST",
                url  : "suplier/update_suplier",
                dataType : "JSON",
                data : {id:id, nama_suplier:nama_suplier, alamat:alamat, csrf_test_name:$.cookie('csrf_cookie_name')},
                success: function(data){
                    location.reload(true);
                    $('[name="id"]').val("");
                    //$('[name="id_suplier"]').val("");
                    $('[name="nama_suplier"]').val("");
                    $('[name="alamat"]').val("");
                    $('#ModalaEdit').modal('hide');
                    tampil_data_suplier();
                }
            });
            return false;
        });

        //GET HAPUS
            $('#show_data').on('click','.item_hapus',function(){
                var id=$(this).attr('data');
                $('#ModalHapus').modal('show');
                $('[name="id"]').val(id);
            });

        //Hapus Barang
            $('#btn_hapus').on('click',function(){
                var id=$('#id2').val();
                $.ajax({
                type : "POST",
                url  : "suplier/hapus",
                dataType : "JSON",
                        data : {id: id, csrf_test_name: $.cookie('csrf_cookie_name')},
                        success: function(data){
                                location.reload(true);
                                $('#ModalHapus').modal('hide');
                                tampil_data_suplier();
                        }
                    });
                    return false;
                });

    });
