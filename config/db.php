<?php
class db{
private $con;
public function __construct($host,$username,$password,$dbname){

$this->con=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;",$username,$password);
	
}
public function getDb(){
	return $this->con;
}

}
?>