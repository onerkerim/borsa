<?php
class general {

  public function get_random_string($length=9,$characters = "ABCDEFGHIJKLMNOPRQSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_") {

      $return="";
       $num_characters = strlen($characters) - 1;
       while (strlen($return) < $length) {
        $return.= $characters[mt_rand(0, $num_characters)];
       }
       return $return;
      }

  public function tokenGenerate()
  {
    return base64_encode(openssl_random_pseudo_bytes(32));
  }    
}
?>