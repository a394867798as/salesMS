<?php
function db_connect(){
	$result = new mysqli('localhost','root','123456','company');
	$result->query("set names utf8");
	if(!$result){
		throw  new  Exception('Could not connect to database server');
	}else{
		return $result;
	}
	
}
?>