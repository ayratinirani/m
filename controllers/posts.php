<?php
class posts{
	global $dbh;
	public function new_post(){
	$text=htmlentities($_POST['text'],ENT_QUOTES,"UTF-8");
	$userId=intval($_POST['user_id']);
	
	$file=$_FILES['media'];
	
	
		
	
	}
	
	
	

public function load_latest_posts(){

	global $dbh;

	
	$id=htmlentities($_POST['id'],ENT_QUOTES,"UTF-8");
		$page=intval($_POST['page'])-1;
$offset=$page * 10;
	//for future
	//$token=htmlentities($_POST['token'],ENT_QUOTES,"UTF-8");

	 $data=array();
	//$tokenobj=token_decode($token);
	//$id=$token->id;
	
	$user_id=$id;
	
	$sql="SELECT  receiver_id FROM `following` WHERE `requester_id`=?  ";
$sth=$dbh->prepare($sql);
$sth->bindParam(1,$id);
$sth->execute();
$result1=$sth->fetchAll(PDO::FETCH_ASSOC);
	
if($result !=null){
	
		$sql="SELECT  * FROM `posts` WHERE `user_id` IN (".implode(",", $result1['receiver_id']).") ORDERY BY  `date_created`  DESC LIMIT ".$offset." , 10	) ";
$sth=$dbh->prepare($sql);
$sth->bindParam(1,$id);
$sth->execute();
$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	$data['result']=$result;
	
	}else{
		$data['result']=$result;
	}

header("Contet-type:application/json;charset:UTF-8");
	echo json_encode($data);

}//end load_latest_posts

	
	
}
?>