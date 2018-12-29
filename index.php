
<?php

    include "setting.php";
    //include "language.php";
    include "class/ajax-class.php";
    $ajax   = new ajax();

 
    $server_name=explode('.', $_SERVER["SERVER_NAME"]);
	$shopName=$server_name[0];

	$url=$_SERVER['REQUEST_URI'];
	$url_parse=explode('/', $url);

	if(!empty($_GET["url1"]))
	{
		if($_GET["url1"]=="register")
		{
			include "view/signup-view.php";
		}
		else if($_GET["url1"]=="login")
		{
			include "view/login-view.php";
		}
		else if($_GET["url1"]=="islem-create")
		{
			include "view/islem/create-view.php";
		}
		else if($_GET["url1"]=="islem-update")
		{
			include "view/islem/update-view.php";
		}
		else if($_GET["url1"]=="islem-list")
		{
			include "view/islem/islem-list-view.php";
		}
	}
	else
	{
		//include "controller/user-controller.php";
		//var_dump($user->userCookieCheck());
		include "view/dashboard-view.php";
	}
    //include "router.php";
?>