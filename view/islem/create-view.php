<?php include "header.php"; ?>     
    <div id="result"></div>
    <form id="islemForm" class="form-default">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="username">Cinsi</label>
                    <input name="cinsi" placeholder="cinsi" type="input" class="form-control" autocomplete="off">
                </div>
            </div>
             <div class="col-6">
                <div class="form-group">
                    <label for="username">Miktar</label>
                    <input name="miktar" placeholder="miktar" type="input" class="form-control" autocomplete="off">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="username">kur</label>
                    <input name="kur" placeholder="kur" type="input" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="username">sure</label>
                    <input name="sure" placeholder="sure" type="input" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="username">bolunebilir</label>
                    <input name="bolunebilir" placeholder="bolunebilir" type="input" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="username">aciklama</label>
                    <input name="aciklama" placeholder="aciklama" type="input" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary islemPost">Oluştur</button>
            </div>
        </div>
    </form>

<?php
/*
$resultParametre=array(
    array(
        "result"            =>  1,
        "message"           => "Giriş başarılı.",
        "messageStyle"      =>  "success",
        "script"            =>  "socket.emit('chat message', 'Giriş başarılı.');",
        "resultPrintTo"       =>  "#result",
        "resultPrintStyle"  => "default"
    ),
    array(
        "result"            =>  2,
        "message"           => "Gerekli alanları doldurun.",
        "messageStyle"      =>  "warning",
        "script"            =>  "",
        "resultPrintTo"       =>  "#result",
        "resultPrintStyle"  => "default"
    ),
    array(
        "result"            =>  3,
        "message"           => "Girmiş olduğunuz bilgileri kontrol edin.",
        "messageStyle"      =>  "warning",
        "script"            =>  "",
        "resultPrintTo"       =>  "#result",
        "resultPrintStyle"  => "default"
    ),
    array(
        "result"            =>  "-1",
        "message"           => "Sistemden çıkmış görünüyorsunuz tekrar giriş yapın.",
        "messageStyle"      =>  "warning",
        "script"            =>  "",
        "resultPrintTo"       =>  "#result",
        "resultPrintStyle"  => "default"
    )  

);
$data="#islemForm";
$ajaxContent=$ajax->add("click",".islemPost","post",$url="controller/islem-controller.php?action=create",$data,$resultParametre,1);
*/
include "footer.php";
?>


<script>
    var socket = io.connect( 'http://localhost:<?php echo $socketIoPort; ?>' ); 
</script>

<script type="text/javascript">
  $(".islemPost").click(function() {
      var form = $("#islemForm").serialize();
      $.ajax({
          type: "post",
          url: "controller/islem-controller.php?action=create&islem_type=<?php echo $_GET['islem_type']; ?>",
          data: form,
          dataType:"json",
          beforeSend: function() {},
          success: function(data) {
           
            /*
            var json_obj = $.parseJSON(data);//parse JSON

            var islem_id =json_obj[0].islem_id;
            var cinsi =json_obj[0].cinsi;
            var miktar =json_obj[0].miktar;
            var kur =json_obj[0].kur;
            var sure =json_obj[0].sure;
            var bolunebilir =json_obj[0].bolunebilir;
            var islem_type =json_obj[0].islem_type;
            */
             
            socket.emit('islem_eklendi', data);
              
          },
          complate: function() {},
          statusCode: {
              404: function() {
                  alert("sayfa bulunamadı");
              }
          }
      });
      return false;
  });</script>

