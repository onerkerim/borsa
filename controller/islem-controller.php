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
include $dizin."model/islem-class.php";

$user 	= new user();
$islem 	= new islem();


if(!empty($_GET["islem_type"]))
{ 
	if($_GET["islem_type"]=="update")
	{	
		$islem_id=$_GET["id"];
		$islemInfo=$islem->islemInfo($islem_id);
		
	}
}

if(!empty($_GET["action"]))
{	
	if($_GET["action"]=="create")
	{
		$userInfo=$user->userCookieCheck();
		if($userInfo)
		{
			$user_id=$userInfo["user_id"];
			$cinsi=strip_tags($_POST["cinsi"]);
			$miktar=strip_tags($_POST["miktar"]);
			$kur=strip_tags($_POST["kur"]);
			$sure=strip_tags($_POST["sure"]);
			$bolunebilir=strip_tags($_POST["bolunebilir"]);
			$aciklama=strip_tags($_POST["aciklama"]);
			$islem_type=strip_tags($_GET["islem_type"]);

			if(!empty($user_id) and !empty($cinsi) and !empty($miktar) and !empty($kur) and !empty($sure))
			{

				
					
					$islemCreateResult=$islem->create($user_id,$cinsi,$miktar,$kur,$sure,$bolunebilir,$aciklama,$islem_type);


					if($islemCreateResult)
					{
		          
		          	$json = array(); 

		          	$json= array( 
		          	'islem_id'=> $islemCreateResult,
		            'cinsi'=> $cinsi, 
		              'miktar'=> $miktar, 
		            'kur'=> $kur,
		            'sure'=> $sure,
		            'bolunebilir'=> $bolunebilir,
		            'islem_type'=> $islem_type
		           
		            
		            );  
		            
		          	echo json_encode($json);  
		          	}

				
			}
			else
			{
				echo 2;
			}

		}
		else
		{
			// sisteme girilmemişse yada cookie silinmişse
			echo -1;
		}
	}
	else if($_GET["action"]=="islem-listele")
	{
		$userInfo=$user->userCookieCheck();
		if($userInfo)
		{
			$islemRow=$islem->islemListele($_GET["islem_type"]);
			$content="";
			foreach ($islemRow as $row) {

				  	$content=$content.'<tr onclick="islemDetay('.$row["islem_id"].')" id="islem-'.$row["islem_id"].'" class="gradeA odd" role="row">';
		            $content=$content.'   <td class="sorting_1" tabindex="0">'.$row["cinsi"].'</td>';
		            $content=$content.'   <td>' .$row["miktar"]. '</td>';
		            $content=$content.'   <td>'.$row["kur"].'</td>';
		            $content=$content.'   <td>'.$row["sure"].'</td>';
		            $content=$content.'   <td>'.$row["bolunebilir"].'</td>';
		            $content=$content.'   <td></td>';
		            '</tr>';
				// $content = '<li id="islem-'.$row["islem_id"].'"> <strong> Cinsi : '.$row["cinsi"].'</strong> Miktar : ' .$row["miktar"]. ' Kur : '.$row["kur"].'</li>';
				
			}
			echo $content;
		}
	}
	else if($_GET["action"]=="update")
	{
		$userInfo=$user->userCookieCheck();
		if($userInfo)
		{
			$user_id=$userInfo["user_id"];
			$cinsi=strip_tags($_POST["cinsi"]);
			$miktar=strip_tags($_POST["miktar"]);
			$kur=strip_tags($_POST["kur"]);
			$sure=strip_tags($_POST["sure"]);
			$bolunebilir=strip_tags($_POST["bolunebilir"]);
			$aciklama=strip_tags($_POST["aciklama"]);
			$islem_id=strip_tags($_GET["id"]);

			if(!empty($user_id) and !empty($cinsi) and !empty($miktar) and !empty($kur) and !empty($sure))
			{

					
					$islem_update_result=$islem->update($user_id,$cinsi,$miktar,$kur,$sure,$bolunebilir,$aciklama,$islem_id);


					if($islem_update_result)
					{
		          
		          	$json = array(); 

		          	$json= array( 
		          	'islem_id'=> $islem_update_result,
		            'cinsi'=> $cinsi, 
		              'miktar'=> $miktar, 
		            'kur'=> $kur,
		            'sure'=> $sure,
		            'bolunebilir'=> $bolunebilir
		     
		           
		            
		            );  
		            
		          	echo json_encode($json);  
		          	}

				
			}
			else
			{
				echo 2;
			}

		}
		else
		{
			// sisteme girilmemişse yada cookie silinmişse
			echo -1;
		}
	}

	
}





?>