<?php
class ajax {
	private $dataValue="";
	// $type click,change
	// $url post get url address
	// $classOrId .clik class  #click id
	public function bootstrapAlert($message,$messageStyle)
	{
		$out='<div class="alert alert-'.$messageStyle.' alert-dismissible fade show m-b-24">'.$message.'</div>';
		return $out;
	}
  public function add($type,$classOrId,$postOrGet,$url,$data,$resultParametre,$debug) {
   	$out="";
  
  	$out=$out.'<script type="text/javascript">';
    if($type=="load")
    {
        //direk çalıştır click yada hover değil
        $out=$out.'$(document).ready(function() {';
    }
    else
    {
        $out=$out.'$("'.$classOrId.'").'.$type.'(function() {'; 
    }

     $out=$out." $('".$resultParametre."').html('yükleniyor...'); ";
  
  	// gelen data arraysa
  	if(is_array($data))
    {
	    foreach ($data as $key => $value) {
	    	$this->dataValue=$this->dataValue.'"'.$key.'":'.'"'.$value.'"'.',';
	    }
	    $this->dataValue="{".substr($this->dataValue, 0,-1)."}";
	}
	else
	{

		$out=$out.'var form=$("'.$data.'").serialize();';
	
	}
  	$out=$out.'$.ajax';
    $out=$out.'    ({ ';
    $out=$out.'    type  : "'.$postOrGet.'",';
    if(!empty($url))
    {
    $out=$out.'      url   : "'.$url.'",';
	}

	if(is_array($data))
    {
		$out=$out.' data:'.$this->dataValue.',';
	}
	else
	{
		$out=$out.' data:form,';
	}
    $out=$out.'        beforeSend :function()';
    $out=$out.'        {';
    $out=$out.'        },';
    $out=$out.'        success :function(data)';
    $out=$out.'        {';
    if($debug)
    {
    $out=$out.'         alert(data);';
    }       
    if(is_array($resultParametre))
    {
    	foreach ($resultParametre as $result) {
    		
    		
    		$out=$out." if(data==".$result["result"]."){";
    		$out=$out.$result["script"];
    		if(!empty($result["resultPrintTo"]))
    		{
    			$out=$out." $('".$result["resultPrintTo"]."').html('".$this->bootstrapAlert($result["message"],$result["messageStyle"])."'); ";
    		}
    		$out=$out."}";
    		
    	
	    }
    }
    else
    {

        $out=$out." $('".$resultParametre."').html(data); ";
    }
    
          
    $out=$out.'        },';
    $out=$out.'         complate:function()';
    $out=$out.'         {';                        
    $out=$out.'         }, ';
    $out=$out.'         statusCode: ';
    $out=$out.'         {';
    $out=$out.'            404: function() ';
    $out=$out.'            {';
    $out=$out.'              alert("sayfa bulunamadı");';
    $out=$out.'            }';
    $out=$out.'         }';
    $out=$out.'      });';
    $out=$out.'  return false; });</script>';

    return $out;
  }
    }


      



?>