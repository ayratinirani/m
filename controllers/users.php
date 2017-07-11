<?php

class users{
public function __construct(){

}
public function login($id){
global $dbh;
$data=array();
	$dbh->exec("set names utf8");
	//$dbh=$da->getDb();
$user=htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");
$pass= htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");
$sql="SELECT  id , full_name FROM `users` WHERE `user_name`=? AND `password`=? ";
$sth=$dbh->prepare($sql);
$sth->bindParam(1,$user);
$sth->bindParam(2,$pass);
$sth->execute();
$result=$sth->fetch(PDO::FETCH_ASSOC);

	if($result ==false){
	$data['result']="0";
	}else{
			$data['token']=token_encode($result['id']);
			
			$data['result']=$result;
	}
	header("Contet-type:application/json;charset:UTF-8");
		

	echo json_encode($data);
	
}//end login

public function register(){
global $dbh;
$user=htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");

$email=htmlentities($_POST['email'],ENT_QUOTES,"UTF-8");

$pass=htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");

$fullname=htmlentities($_POST['fullname'],ENT_QUOTES,"UTF-8");

$data=array();
//	$data['email']=$email;
	//$data['user']=$user;

	//check user unique
	$sql="SELECT id FROM `users` WHERE `email`=? ";
$sth=$dbh->prepare($sql);
$sth->bindParam(1,$email);
$sth->execute();
$result1=$sth->fetch(PDO::FETCH_ASSOC);

	if(!($result1 ==false)){
	$data['result']="email_error";
	}else{
	
	$sql="SELECT id FROM `users` WHERE `user_name`=? ";
$sth=$dbh->prepare($sql);
$sth->bindParam(1,$user);
$sth->execute();
$result2=$sth->fetch(PDO::FETCH_ASSOC);

	if(!($result2 ==false)){
	$data['result']="user error";
	}else{
	$sql="INSERT INTO `users` (`user_name` , `full_name` , `email` , `password`) VALUES (:user,:name,:email,:pass)";
$stmt=$dbh->prepare($sql);
$stmt->bindValue(':user',$user);
$stmt->bindValue(':name',$fullname);
$stmt->bindValue(':email',$email);
$stmt->bindValue(':pass',$pass);

// insert one row
// insert another row with different values
$result=$stmt->execute();
	
		$data['result']=$result;
		$data['id']=$dbh->LastInsertId();
		$data['token']=token_encode($result);
	
	
	}
	
	}
	//$dbh=$da->getDb();
		
		header("Contet-type:application/json;charset:UTF-8");
	echo json_encode($data);
	
}

public function forget(){

	global $dbh;


$email=htmlentities($_POST['email'],ENT_QUOTES,"UTF-8");


$data=array();
//	$data['email']=$email;
	//$data['user']=$user;

	//check user unique
	$sql="SELECT * FROM `users` WHERE `email`=? ";
$sth=$dbh->prepare($sql);
$sth->bindParam(1,$email);
$sth->execute();
$result1=$sth->fetch(PDO::FETCH_ASSOC);

	if($result1 ==false){
	$data['result']="email_error";}
	else{
		require_once Dir."/swift/lib/swift_required.php";
		
		$body="<p>username=".$result1['user_name']."<br /> pass=".$result1['password']."</p>";
	//	echo $body;
	//	exit;
		$transport=Swift_SmtpTransport::newInstance(
		'smtp.google.com',587)->setUsername('mohammad.ounegh@gmail.com')->setPassword('mtso5223435');
		
		
		$transport=Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
		
		$transport=Swift_MailTransport::newInstance();
		$mailer=Swift_Mailer::newInstance($transport);
		
		$message=Swift_Message::newInstance("یاد آوری رمز عبور ")
		->setFrom(array(
		'mohammad@ounegh.ir'=>'مدیر شبکه گپلشیک'
		))
		->setTo(array($email))
		->setBody($body);
		if (!$mailer->send($message, $failures)) { 
			$data['result']="0";
			 }else{
					$data['result']="ok";
			}
	}
header("Contet-type:application/json;charset:UTF-8");
	echo json_encode($data);
}




public function search(){
global $dbh;
$searchtext=htmlentities($_POST['search_text'],ENT_QUOTES,"UTF-8");
$page=intval($_POST['page'])-1;
$offset=$page * 10;

$sql="SELECT  `id`,`full_name` FROM `lusers` WHERE `user_name` like %?%   OR  `full_name`  like %?%
ORDERY BY  `date_created`  DESC LIMIT ".$offset." , 10	) ";

$sth=$dbh->prepare($sql);
$sth->bindParam(1,$searchtext);
$sth->bindParam(2,$searchtext);
$sth->execute();
$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	
if($result !=null){
$data['result']=$result;
}else{
$data ['result']="0";
}

header("Contet-type:application/json;charset:UTF-8");
	echo json_encode($data);
}

}//end claas



?>