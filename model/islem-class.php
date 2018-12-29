<?php
class islem {
  private $db;
  private $general; 
  public function __construct() { 
        $this->db =  new db();
        $this->general =  new general();

  }



  public function create($user_id,$cinsi,$miktar,$kur,$sure,$bolunebilir,$aciklama,$islem_type)
  {
      
        $sql = $this->db->prepare('INSERT INTO islem (user_id,cinsi,miktar,kur,sure,bolunebilir,aciklama,created_at,islem_type) VALUES (?,?,?,?,?,?,?,?,?)');
        $ekle = $sql->execute(array(
        $user_id,$cinsi,$miktar,$kur,$sure,$bolunebilir,$aciklama,date("Y-m-d H:i:s"),$islem_type
        ));
        $hata = $sql->errorInfo();
       
        if(empty($hata[2]))
        {
         

          return $this->db->lastInsertId();




          //return $this->login($email,$sifre);
        }
        else
        {
          return 0;
        }
      
      
  }

  public function update($user_id,$cinsi,$miktar,$kur,$sure,$bolunebilir,$aciklama,$islem_id)
  {

       


         $guncelle = $this->db->prepare("UPDATE islem SET 
          cinsi=?,
          miktar=?,
          kur=?,
          sure=?,
          bolunebilir=?,
          aciklama=?,
          updated_at=? WHERE islem_id = ? AND user_id = ?");
            $guncelle->execute(array(
             $cinsi,
             $miktar,
             $kur,
             $sure,
             $bolunebilir,
             $aciklama,
             date("Y-m-d H:i:s"),
             $islem_id,
             $user_id

            ));

            $hata = $guncelle->errorInfo();
       
        if(empty($hata[2]))
        {
         

          return $islem_id;




          //return $this->login($email,$sifre);
        }
        else
        {
          return 0;
        }
      
      
  }

  public function islemListele($islem_type)
  {
      $sql =  $this->db->prepare("SELECT * FROM islem WHERE islem_type  =   :islem_type ORDER BY islem_id DESC");
      $sql->bindParam(':islem_type', $islem_type,PDO::PARAM_INT);
      $sql->execute();
      $check=$sql->fetchAll(PDO::FETCH_ASSOC);
      return  $check;
  }


  public function islemInfo($islem_id)
  {
      $sql =  $this->db->prepare("SELECT * FROM islem WHERE islem_id  =   :islem_id");
      $sql->bindParam(':islem_id', $islem_id,PDO::PARAM_INT);
      $sql->execute();
      $check=$sql->fetch(PDO::FETCH_ASSOC);
      return  $check;
  }
}
?>