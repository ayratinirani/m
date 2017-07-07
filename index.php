<?php
//echo "hi";
echo $_SERVER['REQUEST_URI']."<br>";
$dir=str_replace("index.php","",$_SERVER['PHP_SELF']);
$request=str_replace($dir,"",$_SERVER['REQUEST_URI']);
//$qqq=strpos($request,'?');
//echo $qqq;
//$requset=substr($request,$qqq+1);
//echo "<br>".$request;
$requet=trim("/",$request);
//echo $request;

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
	echo "<br>$id";
	$class->$method ("mohammad");
	}else{
	exit;
	}
?>