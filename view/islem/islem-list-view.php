

  

 

<?php
$ajaxContent=array();

$resultParametre="#resultAlis";
$ajaxContent[]=$ajax->add("load",".listele","post",$url="controller/islem-controller.php?action=islem-listele&islem_type=1",$data=0,$resultParametre,0);

$resultParametre="#resultSatis";
$ajaxContent[]=$ajax->add("load",".listele","post",$url="controller/islem-controller.php?action=islem-listele&islem_type=2",$data=0,$resultParametre,0);
include "footer.php";
?>





 <script>
    var socket = io.connect( 'http://localhost:<?php echo $socketIoPort; ?>' );
  $(function () {

    function callback(id) {
          setTimeout(function() {
            $(id).removeAttr( "style" ).hide().fadeIn();
          }, 1000 );
      };

  
    socket.on('islem_eklendi', function(data){
      //var content = '<strong> Cinsi : ' + data.cinsi + '</strong> Miktar : ' + data.miktar + ' Kur : '+data.kur;

       var content = '<td class="sorting_1" tabindex="0">' + data.cinsi + '</td><td>' + data.miktar + '</td><td>' + data.kur + '</td><td>' + data.sure + '</td><td>' + data.bolunebilir + '</td><td></td>';
        if(data.islem_type==1)
        {    
            $('#resultAlis').prepend($('<tr onclick="islemDetay('+data.islem_id+')" id="islem-'+ data.islem_id +'">').html(content));
        }
        else if(data.islem_type==2)
        {
            $('#resultSatis').prepend($('<tr onclick="islemDetay('+data.islem_id+')" id="islem-'+ data.islem_id +'">').html(content));
        }

       /*
         var options = {};
       $("#islem-516").effect( highlight, options, 500);
           function callback() {
          setTimeout(function() {
            $("#islem-516").removeAttr( "style" ).hide().fadeIn();
          }, 1000 );
        };
*/
        $("#islem-"+ data.islem_id ).closest('tr').css('background','#cdf0d9');
        $("#islem-"+ data.islem_id).fadeTo(100, 0.1,callback("#islem-"+ data.islem_id)).fadeTo(200, 1.0);

      //$("#islem-"+ data.islem_id).closest('tr').fadeIn(800);
     // $("#islem-"+ data.islem_id ).closest('tr').css('background','tomato');
     // $("#islem-"+ data.islem_id).closest('tr').fadeOut(800,function(){
     //   $(this).remove();
     // });
        
    });

    
    socket.on('islem_guncelle', function(data){
       var content = '<td class="sorting_1" tabindex="0">' + data.cinsi + '</td><td>' + data.miktar + '</td><td>' + data.kur + '</td><td>' + data.sure + '</td><td>' + data.bolunebilir + '</td><td></td>';
        $("#islem-"+ data.islem_id).html(content);
        
             
        $("#islem-"+ data.islem_id ).closest('tr').css('background','#f2f7e3');
        $("#islem-"+ data.islem_id).fadeTo(300, 0.1,callback("#islem-"+ data.islem_id)).fadeTo(200, 1.0);

      

        
    });


    
  });
</script>


