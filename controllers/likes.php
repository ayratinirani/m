<?php

class likes{
public function __construct(){

}


public function save_like(){

	global $dbh;


$userid=intval($_POST['user_id']);

$postid=intval($_POST['post_id']);
		$page=intval($_POST['page'])-1;
$offset=$page * 10;

$data=array();


$sql="SELECT  user_id FROM `likes` WHERE `user_id`=?   AND  `post_id`=?
ORDERY BY  `date_created`  DESC LIMIT ".$offset." , 10	) ";

$sth=$dbh->prepare($sql);
$sth->bindParam(1,$userid);
$sth->bindParam(2,$postid);
$sth->execute();
$result1=$sth->fetchAll(PDO::FETCH_ASSOC);
	
if($result1 !=null){
$data['result']="0";
}
else
	{
		$sql="INSERT INTO `likes` (`user_id` , `post_id` ) VALUES (:user,:post)";
$stmt=$dbh->prepare($sql);
$stmt->bindValue(':user',$userid);
$stmt->bindValue(':post',$postid);
// insert one row
// insert another row with different values
$result=$stmt->execute();
	
		$data['result']=$result;
		$data['id']=$dbh->LastInsertId();
$data['result']='1';}

header("Contet-type:application/json;charset:UTF-8");
	echo json_encode($data);}//end save like
	
}


}//end class



}