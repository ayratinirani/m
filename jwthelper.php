<?php
function token_encode($token){
	require_once "DJWT.php";
return JWT::encode($token, SECRET_KEY);

}
function token_decode($json){
	require_once "DJWT.php";
$token = JWT::decode($json, SECRET_KEY); 
return $token;
}





?>