<?php
class users{
public function __construct(){

}
public function login($id){
	$data=array();
	$dbh= new PDO("mysql:host=127.0.0.1:3306;dbname=social;charset=utf8","root","");
	$dbh->exec("set names utf8");
	//$dbh=$da->getDb();
$user=htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");
$pass= htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");
$sql="SELECT * FROM `users` WHERE `user_name`=? AND `password`=? ";
$sth=$dbh->prepare($sql);
$sth->bindParam(1,$user);
$sth->bindParam(2,$pass);
$sth->execute();
$result=$sth->fetch(PDO::FETCH_ASSOC);

	if($result =="false"){
	$result="0";
	}
	header("Contet-type:text/json;charset:UTF-8");
		$data['result']=$result;
	echo json_encode($data);
	
}//end login

public function register(){

$user=htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");

$email=htmlentities($_POST['email'],ENT_QUOTES,"UTF-8");

$pass=htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");

$fullname=htmlentities($_POST['fullname'],ENT_QUOTES,"UTF-8");

$data=array();
//	$data['email']=$email;
	$data['user']=$user;
	
		
	$dbh= new PDO("mysql:host=127.0.0.1:3306;dbname=social;charset=utf8","root","");
	//$dbh=$da->getDb();
	$sql="INSERT INTO `users` (`user_name` , `full_name` , `email` , `password`) VALUES (:user,:name,:email,:pass)";
$stmt=$dbh->prepare($sql);
$stmt->bindValue(':user',$user);
$stmt->bindValue(':name',$fullname);
$stmt->bindValue(':email',$email);
$stmt->bindValue(':pass',$pass);

// insert one row
// insert another row with different values
$result=$stmt->execute();
	header("Contet-type:text/json;charset:UTF-8");
		$data['result']=$result;
	echo json_encode($data);
	
}


}//end claas



?>