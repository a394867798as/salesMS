<?php
session_start();
include '../include_fns.php';
checkSessionUsername();
if(checkPost($_POST)){
	$conn = db_connect();
	$username = $conn->real_escape_string(trim($_POST['username']));
	$password = $conn->real_escape_string(trim($_POST['password']));
	if(checkUsername($username)){
		$query = "select * from accountlogin
				where username = '".$username."'
				and password = '".md5($password)."'";
		$result = $conn->query($query);
		if($array = $result->fetch_assoc()){
			$_SESSION['username'] = $array['username'];
			$query = "select * from account
					where accountId = ".$array['accountId'];
			$result = $conn->query($query);
			$array = $result->fetch_assoc();
			$_SESSION['name'] = $array['name'];
			$_SESSION['accountId'] = $array['accountId'];
			$_SESSION['position'] = $array['position'];
			$conn->close();
			printf("sucessfull.");
			header( "refresh:5;url=../index.php" ); 
	  		printf('You\'ll be redirected in about 5 secs. If not, click <a href="../login.php">here</a>.');
		}else{
			$conn->close();
			header("Location:../login.php?login=2");
		}
	}else{
		$conn->close();
		header("Location:../login.php?login=1");
	}
}else{
	header("Location:../login.php?login=0");
}
?>