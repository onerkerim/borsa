<?php
if(!empty($_GET["action"]))
{
	// ajax isteği ise
	$dizin="../";
}
else
{
	$dizin="";
}

include $dizin."db/db-class.php";
include $dizin."class/general-class.php";
include $dizin."model/user-class.php";

$user = new user();

if(!empty($_GET["action"]))
{
	$email=strip_tags($_POST["email"]);
	$password=strip_tags($_POST["password"]);
	if($_GET["action"]=="login")
	{

	  

	if(!empty($email) and !empty($password))
	 	{
	      echo $user->login($email,$password);
	          
	  }
	}

	else if($_GET["action"]=="register")
	{

		$user_name=strip_tags($_POST["user_name"]);

		if(!empty($email) and !empty($password) and !empty($user_name))
		{
			echo $user->register($email,$password,$user_name);
		}
		
	  	
	}
}





?>