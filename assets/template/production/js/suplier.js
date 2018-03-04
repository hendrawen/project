
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

        //GET HAPUS
            $('#show_data').on('click','.item_hapus',function(){
                var id=$(this).attr('data');
                $('#ModalHapus').modal('show');
                $('[name="kode"]').val(id);
            });

        //Hapus Barang
            $('#btn_hapus').on('click',function(){
                var kode=$('#textkode').val();
                $.ajax({
                type : "POST",
                url  : "suplier/hapus",
                dataType : "JSON",
                        data : {kode: kode},
                        success: function(data){
                                $('#ModalHapus').modal('hide');
                                tampil_data_suplier();
                        }
                    });
                    return false;
                });

    });
