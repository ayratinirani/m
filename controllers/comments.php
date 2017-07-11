<?php

class comments {
	public function load_comment() {
		$data=array();
		global $dbh;
		$postid=htmlentities($_POST['post_id'],ENT_QUOTES,"UTF-8");
		$page=intval($_POST['page'])-1;
		$offset=$page * 10;
		$sql="SELECT * FROM `comments` WHERE `post_id`=? ORDERY BY `date_created` DESC LIMIT ".$offset." , 10";
		$sth=$dbh->prepare($sql);
		$sth->bindParam(1,$postid);
		$sth->execute();
		$result=$sth->fetchAll(PDO::FETCH_ASSOC);
		if($result !=null) {
			$data ['result']=$result;
		}else {
			$data ['result']='0';
		}

		header("Contet-type:application/json;charset:UTF-8");
		echo json_encode($data);
	}
//end load

public function save_comment() {
	global $dbh;
	$userid=intval($_POST['user_id']);
	$postid=intval($_POST['post_id']);
	$text=htmlentities($_POST['text'],ENT_QUOTES,"UTF-8");
	$data=array();
	$sql="INSERT INTO `comments` (`user_id` , `post_id`,`text` ) VALUES (:user,:post,:text)";
	$stmt=$dbh->prepare($sql);
	$stmt->bindValue(':user',$userid);
	$stmt->bindValue(':post',$postid);
	$stmt->bindValue(':text',$text);
	// insert one row
	// insert another row with different values
	$result=$stmt->execute();
	$data['result']=$result;
	$data['id']=$dbh->LastInsertId();
	$data['result']='1';
	header("Contet-type:application/json;charset:UTF-8");
	echo json_encode($data);
}
//end save comment

}
//end class
?>