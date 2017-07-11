<?php
define("SECRET_KEY","gjiGU9dfh");
require_once "jwthelper.php";
/*
روش کار با توکن ساز 
require "jwthelper.php";
$i="حسن";
$mm=array(
'id'=>$i,
'name'=>'وحید'
);
$s=encode($mm);
var_dump($f=decode($s));
echo $f->id;
exit;*/
$dir=str_replace("index.php","",$_SERVER['PHP_SELF']);
define("Dir",dirname(__FILE__));
$request=str_replace($dir,"",$_SERVER['REQUEST_URI']);

$requet=trim("/",$request);
$parameters=explode("/",$request);
$parameters=array_slice($parameters,2);

if(isset($parameters[0]) && isset($parameters[1])){
			$dbh= new PDO("mysql:host=127.0.0.1:3306;dbname=social;charset=utf8","root","");
	require "./controllers/".basename($parameters[0]).".php";
	
	$class= new $parameters[0]();
	$method= $parameters [1];
	
	$id=$parameters [2];
	
	$class->$method ($id);
	}else{
	exit;
	}
?>