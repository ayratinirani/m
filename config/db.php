<?php
class db{
private $host,$user,$pass,$dbname,$connection;

public function __construct($host,$username,$password,$dbname){

$this->connection=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;",$username,$password);
	
	return $connection;
}

}
?>