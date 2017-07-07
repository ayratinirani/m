<?php

$dir=str_replace("index.php","",$_SERVER['PHP_SELF']);
$request=str_replace($dir,"",$_SERVER['REQUEST_URI']);

$requet=trim("/",$request);
$parameters=explode("/",$request);
$parameters=array_slice($parameters,2);

if(isset($parameters[0]) && isset($parameters[1])){
	
	require "./controllers/".basename($parameters[0]).".php";
	$class= new $parameters[0]();
	$method= $parameters [1];
	
	$id=$parameters [2];
	
	$class->$method ($id);
	}else{
	exit;
	}
?>