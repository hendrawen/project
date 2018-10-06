$('#autopelanggan').autocomplete({
    source: (base_url+"kepala_cabang/faktur2/get_autocomplete"),
    select: function (event, ui) {
        $('[name="id_pelanggan"]').val(ui.item.label);
        //document.getElementById('id_transaksi').innerHTML = ui.item.id_transaksi;
        document.getElementById('id_pelanggan').innerHTML = ui.item.id_pelanggan;
        document.getElementById('nama_pelanggan').innerHTML = ui.item.nama_pelanggan;
        document.getElementById('alamat').innerHTML = ui.item.alamat;
        document.getElementById('nama_dagang').innerHTML = ui.item.nama_dagang;
        document.getElementById('no_telp').innerHTML = ui.item.no_telp;
        //document.getElementById('tgl_transaksi').innerHTML = ui.item.tgl_transaksi;
        document.getElementById('jatuh_tempo').innerHTML = ui.item.jatuh_tempo;
        document.getElementById('nama').innerHTML = ui.item.nama;
        document.getElementById('lat').innerHTML = ui.item.lat;
        document.getElementById('long').innerHTML = ui.item.long;
        document.getElementById('kecamatan').innerHTML = ui.item.kecamatan;
        document.getElementById('kelurahan').innerHTML = ui.item.kelurahan;
    }
});

$("#button_pelanggan").click(function(){
    search_pelanggan();
});


function search_pelanggan(){
	var judul=$("#autopelanggan").val();
	console.log(judul);
	 if(judul!=""){
		 $("#result2").html(base_url+"assets/ajax-loader.gif");
		   $.ajax({
				  type : "POST",
			   url  : (base_url+"kepala_cabang/faktur2/track_pelanggan"),
			   data:"judul="+judul,

			   success:function(data){
				 $("#result").html(data);
				 $("#autopelanggan").val();
			   }
		});
		$('#tabel_pelanggan').show();
	 }
}
