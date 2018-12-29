<?php
include "controller/islem-controller.php";
include "header.php";
?>

                  <div id="result"></div>
                <form id="islemForm" class="form-default">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">Email address</label>
                                <input name="cinsi" value="<?php echo $islemInfo["cinsi"] ?>" placeholder="cinsi" type="input" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">Miktar</label>
                                <input name="miktar" value="<?php echo $islemInfo["miktar"] ?>" placeholder="miktar" type="input" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>

                      <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">kur</label>
                                <input name="kur" value="<?php echo $islemInfo["kur"] ?>" placeholder="kur" type="input" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">sure</label>
                                <input name="sure" value="<?php echo $islemInfo["sure"] ?>" placeholder="sure" type="input" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">bolunebilir</label>
                                <input name="bolunebilir" value="<?php echo $islemInfo["bolunebilir"] ?>" placeholder="bolunebilir" type="input" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">aciklama</label>
                                <input name="aciklama" value="<?php echo $islemInfo["aciklama"] ?>" placeholder="aciklama" type="input" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>

            


                    <div class="row m-t-20">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary islemPost">Gönder</button>
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
          url: "controller/islem-controller.php?action=update&id=<?php echo $_GET['id']; ?>",
          data: form,
          dataType:"json",
          beforeSend: function() {},
          success: function(data) {
           
   
        
           
             
            socket.emit('islem_guncelle',data);
              
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

