
$('#autofakturdebt').autocomplete({
    source: (base_url+"harian/debt/get_autocomplete"),
    select: function (event, ui) {
        $('[name="title"]').val(ui.item.label);
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
                 $("#result-faktur").html(data);
                 $("#autofakturdebt").val();
               }
        });
        $('#table_faktur').show();
     }
 }
 $("#button_track_faktur").click(function(){
    track_faktur();
 });