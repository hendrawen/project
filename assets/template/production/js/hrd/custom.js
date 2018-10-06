$('#transaksilist').dataTable( {
  "rowsGroup": [0],
  "columnDefs": [
  {
      "targets": [ 0, 7 ], //first column / numbering column
      "orderable": false, //set not orderable
  },
  ],
} );

$(document).ready(function () {
  $(".text").hide();
  $("#2").click(function () {
      $(".text").show();
  });
  $("#1").click(function () {
      $(".text").hide();
  });
});

$(document).ready(function() {
  $('.js-example-basic-single').select2();
});


$('#title').autocomplete({
        source: (base_url+"hrd/pembayaran_barang/get_autocomplete"),
        select: function (event, ui) {
            $('[name="title"]').val(ui.item.label);
            $('[name="hutang"]').val(formatNumber(ui.item.utang));
            $('[name="id_transaksi"]').val(ui.item.transaksi);
            $('[name="id"]').val(ui.item.id);
            $('[name="sudah"]').val(ui.item.sudah);
            $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
        }
});

$('#id_track').autocomplete({
        source: (base_url+"dep/get_auto"),
        select: function (event, ui) {
            $('[name="title"]').val(ui.item.label);
            // $('[name="hutang"]').val(formatNumber(ui.item.utang));
            // $('[name="id_transaksi"]').val(ui.item.transaksi);
            // $('[name="id"]').val(ui.item.id);
            // $('[name="sudah"]').val(ui.item.sudah);
            // $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
        }
});

$('#id_track_aset').autocomplete({
    source: (base_url+"delivery/get_auto"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
        // $('[name="hutang"]').val(formatNumber(ui.item.utang));
        // $('[name="id_transaksi"]').val(ui.item.transaksi);
        // $('[name="id"]').val(ui.item.id);
        // $('[name="sudah"]').val(ui.item.sudah);
        // $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
    }
});


$('#id_track_admin').autocomplete({
    source: (base_url+"hrd/pembayaran_barang/get_auto"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
        // $('[name="hutang"]').val(formatNumber(ui.item.utang));
        // $('[name="id_transaksi"]').val(ui.item.transaksi);
        // $('[name="id"]').val(ui.item.id);
        // $('[name="sudah"]').val(ui.item.sudah);
        // $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
    }
});

$('#id_track_aset').autocomplete({
    source: (base_url+"delivery/get_auto"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
        // $('[name="hutang"]').val(formatNumber(ui.item.utang));
        // $('[name="id_transaksi"]').val(ui.item.transaksi);
        // $('[name="id"]').val(ui.item.id);
        // $('[name="sudah"]').val(ui.item.sudah);
        // $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
    }
});

$('#id_pembayaran_aset').autocomplete({
    source: (base_url+"hrd/pembayaran_aset/get_auto"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
    }
});

$('#title3').autocomplete({
        source: (base_url+"dep/get_auto_transaksi"),
        select: function (event, ui) {
            $('[name="title"]').val(ui.item.label);
            $('[name="hutang"]').val(formatNumber(ui.item.utang));
            $('[name="id_pelanggan2"]').val(ui.item.pelanggan);
            $('[name="id"]').val(ui.item.id);
            $('[name="sudah"]').val(ui.item.sudah);
            $('[name="jumlah"]').val(formatNumber(ui.item.jumlah));
        }
});

$('#autoidtransaksi').autocomplete({
        source: (base_url+"dep/get_autocomplete"),
        select: function (event, ui) {
            $('[name="id_pelanggan"]').val(ui.item.label);
            document.getElementById('nama_pelanggan').innerHTML = ui.item.nama_pelanggan;
            $('[name="id"]').val(ui.item.id);
            document.getElementById('alamat').innerHTML = ui.item.alamat;
            document.getElementById('nama_dagang').innerHTML = ui.item.nama_dagang;
            document.getElementById('no_telp').innerHTML = ui.item.no_telp;
        }
});

$('#autoidtransaksi2').autocomplete({
        source: (base_url+"admint/pesan/get_autocomplete"),
        select: function (event, ui) {
            $('[name="id_pelanggan"]').val(ui.item.label);
            document.getElementById('nama_pelanggan').innerHTML = ui.item.nama_pelanggan;
            $('[name="id"]').val(ui.item.id);
            document.getElementById('alamat').innerHTML = ui.item.alamat;
            document.getElementById('nama_dagang').innerHTML = ui.item.nama_dagang;
            document.getElementById('no_telp').innerHTML = ui.item.no_telp;
        }
});

$('#autoidjadwal').autocomplete({
        source: (base_url+"hrd/pembayaran_barang/get_autocomplete"),
        select: function (event, ui) {
            $('[name="id_pelanggan"]').val(ui.item.label);
        }
});

    function search(){
       var judul=$("#id_track").val();
       console.log(judul);
        if(judul!=""){
            $("#result").html(base_url+"assets/ajax-loader.gif");
              $.ajax({
                     type : "POST",
                  url  : (base_url+"dep/track_transaksi"),
                  data:"judul="+judul,

                  success:function(data){
                    $("#result").html(data);
                    $("#id_track").val();
                  }
           });
           $('#tabel_cari').show();
        }
    }

    $("#button").click(function(){
        search();
    });

    $('#id_track').keyup(function(e) {
        if(e.keyCode == 13) {
           search();
        }
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

function formatCurrency(num) {
   num = num.toString().replace(/\$|\./g,'');
   if(isNaN(num))
   num = "0";
   sign = (num == (num = Math.abs(num)));
   num = Math.floor(num*100+0.50000000001);
   cents = num0;
   num = Math.floor(num/100).toString();
   for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
   num = num.substring(0,num.length-(4*i+3))+'.'+
   num.substring(num.length-(4*i+3));
   return (((sign)?'':'-') + num);
    }


    function search_admin(){
       var judul=$("#id_track_admin").val();
       console.log(judul);
        if(judul!=""){
            $("#result2").html(base_url+"assets/ajax-loader.gif");
              $.ajax({
                     type : "POST",
                  url  : (base_url+"hrd/pembayaran_barang/track_transaksi"),
                  data:"judul="+judul,

                  success:function(data){
                    $("#result2").html(data);
                    $("#id_track_admin").val();
                  }
           });
           $('#tabel_cari').show();
        }
    }

    $("#button_admin").click(function(){
        search_admin();
    });

    $('#id_track_admin').keyup(function(e) {
        if(e.keyCode == 13) {
           search_admin();
        }
    });

    function search_aset(){
        var judul=$("#id_track_aset").val();
        console.log(judul);
         if(judul!=""){
             $("#result3").html(base_url+"assets/ajax-loader.gif");
               $.ajax({
                      type : "POST",
                   url  : (base_url+"delivery/track_aset"),
                   data:"judul="+judul,

                   success:function(data){
                     $("#result3").html(data);
                     $("#id_track_aset").val();
                   }
            });
            $('#tabel_cari_aset').show();
         }
     }

     $("#button_aset").click(function(){
        search_aset();
     });

     $('#id_track_aset').keyup(function(e) {
         if(e.keyCode == 13) {
            search_aset();
         }
     });
