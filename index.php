<?php
$dir=str_replace("index.php","",$_SERVER['PHP_SELF']);

$request=str_replace($dir,"",$_SERVER['REQUEST_URI']);
$requet=trim("/",$request);
$params=explode(" ",$request);

if(isset($parameters[0]) && isset($parameters[1])){
	require "./classes".$parameters[0].".php";
	$class= new $parameter[0]();
	$class->$parameters[1]();
	}else{
	exit;
	}
?>