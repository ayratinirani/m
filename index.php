<?php
//var_dump(file_get_contents("./classes/users.php"));
$dir=str_replace("index.php","",$_SERVER['PHP_SELF']);
$request=str_replace($dir,"",$_SERVER['REQUEST_URI']);

$requet=trim("/",$request);
$parameters=explode("/",$request);
$parameters=array_slice($parameters,2);
var_dump($parameters);

if(isset($parameters[0]) && isset($parameters[1])){
	require "./config/db.php";
	$database= new db("127.0.0.1","root","","social");
	require "./controllers/".$parameters[0].".php";
	$class= new $parameters[0]();
	$method= $parameters [1];
	$id=$parameters [2];
	
	$class->$method ();
	}else{
	exit;
	}
?>