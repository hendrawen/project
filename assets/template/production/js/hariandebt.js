$(document).ready(function () {
    load_faktur();
    $("#printButton").click(function(){ 
    $("#printable").printArea(); 
    }); 

    $("#printBawah").click(function(){ 
        $("#printbawahtabel").printArea(); 
        }); 
  });

$('#autofakturdebt').autocomplete({
    source: (base_url+"harian/debt/get_autocomplete"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
    }
});

$('#autofakturdriver').autocomplete({
    source: (base_url+"harian/debt/get_autocomplete_driver"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
        document.getElementById('nama_driver').innerHTML = ui.item.label;
    }
});

$('#autogetdebt').autocomplete({
    source: (base_url+"harian/debt/get_autocomplete_debt"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
        document.getElementById('nama_debt_atas').innerHTML = ui.item.label;
        document.getElementById('nama_debt').innerHTML = ui.item.label;
    }
});

function track_faktur(){
    var judul=$("#autofakturdebt").val();
    console.log(judul);
     if(judul!=""){
         $("#result2").html(base_url+"assets/ajax-loader.gif");
           $.ajax({
               type : "POST",
               url  : (base_url+"harian/debt/track_faktur"),
               data:"judul="+judul,

               success:function(data){
                 load_faktur();
                 $("#result-faktur").html(data);
                 $("#result-faktur2").html(data);
                 $("#autofakturdebt").val();
               }
        });
     }
 }

 function load_faktur() {
    $('#result-faktur').load(base_url+"harian/debt/get_list");
    $('#result-faktur2').load(base_url+"harian/debt/get_list_belakang");
 }

 function delete_faktur(){
    $.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });
    $.ajax({
      url : (base_url+"harian/debt/hapus"),
      method : "POST",
      success :function(data){
          $("#result-faktur").html(data);
          $("#result-faktur2").html(data);
          alert('Data sudah di reset');
      }
    });
 }

 $("#button_track_faktur").click(function(){
    track_faktur();
 });

 $("#button_reset_faktur").click(function(){
    delete_faktur();
 });