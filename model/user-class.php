<?php
class user {
  private $db;
  private $general; 
  public function __construct() { 
        $this->db =  new db();
        $this->general =  new general();

  }

  public function userCookieCheck()
  {
      //kullanıcının cookiedeki bilgileriyle eşleşen user varmı kontrol eder
    if(isset($_COOKIE['login_user']))
    {
      $loginUserCookie=unserialize($_COOKIE['login_user']);
      if(!empty($loginUserCookie["user_token"]) and !empty($loginUserCookie["email"]))
      {
        $user_token=$loginUserCookie["user_token"];
        $sql   =  $this->db->prepare("SELECT * FROM user WHERE user_token = :user_token AND email= :email");
        $sql->bindParam(':user_token', $user_token);
        $sql->bindParam(':email', $loginUserCookie["email"]);
        $sql->execute();
        $user=$sql->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
          return $user;
        }
        else
        {
          return 0;
        }
      }
      else
      {
        return 0;
      }

    }
    else
    {
      return 0;
    }
    $this->db->dbClose();
  }

  public function login($email,$password)
  {
      $sql =  $this->db->prepare("SELECT * FROM user WHERE email = :email");
      $sql->bindParam(':email', $email);
      $sql->execute();
      $check=$sql->fetch(PDO::FETCH_ASSOC);
      if($check)
      {
        if(password_verify($password,$check["password"]))
        {
          //cookie
          $loginUserArray = array(
              'user_token' => $check["user_token"],
              'email'   => $check["email"]
          );
     

          setcookie("login_user", serialize($loginUserArray), time()+360000, "/");

          //giriş yapılmadan sepetete ğrğn varsa giriş yapıca bu user ata
         
          return 1;
        }
        else
        {
          return 3;
        }

      }
      else
      {
        return 2;
      }
  }

  public function register($email,$password,$user_name)
  {
      
   
        $search   =  $this->db->prepare("SELECT * FROM user WHERE (user_name = :user_name OR email = :email) AND (status=  :status)");
        $search->bindParam(':user_name', $shop_name);
        $search->bindParam(':email', $email);
        $search->bindValue(':status', 1);
        $search->execute();
        $search=$search->fetch(PDO::FETCH_ASSOC);


        if($search)
        {
          if($search["user_name"]==$shop_name)
          {
            return 2; // shop name kullanılıyor
          
          }
          else if($search["email"]==$email)
          {
            return 3; // email kullanılmakta
            
          }
      }
      else
      {
      

        $user_token     = $this->general->tokenGenerate();
        #şifre oluştururlurken ve login olurken harcanacak işlemci maliyeti
        $options = [
              'cost'        => 7
          ];
        $passwordHash        = password_hash($password, PASSWORD_DEFAULT,$options);
        $sql = $this->db->prepare('INSERT INTO user (user_name,email,password,status,user_token,created_at) VALUES (?,?,?,?,?,?)');
        $ekle = $sql->execute(array(
        $user_name,
        $email,
        $passwordHash,
        1,
        $user_token,
        date("Y-m-d H:i:s")
       

        ));
        $hata = $sql->errorInfo();
       
        if(empty($hata[2]))
        {
          echo 1;
          //return $this->login($email,$sifre);
        }
        else
        {
          return 0;
        }
      }
      
  }
}
?>