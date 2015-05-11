<?php
session_start();
include '../include_fns.php';


if(checkPost($_POST)){
	//创建短变量
	$conn = db_connect();
	$phone = $conn->real_escape_string(trim($_POST['phoneNumber']));//mysqli_real_escape_string对接受字符串进行转义
	$name = $conn->real_escape_string(trim($_POST['name']));
	$username = $conn->real_escape_string(trim($_POST['username']));
	$password = $conn->real_escape_string(trim($_POST['password']));
	//连接数据库
	//判断员工信息是否正确
	$query = "select * from account 
			where accountId = ".$phone."
			and name = '".$name."'";
	$result = $conn->query($query);
	
	if($result->num_rows === 1){
		//判断员工是否已经注册
		$query = "select * from accountlogin
				where accountId = ".$phone."
				or username = '".$username."'";
		$result = $conn->query($query);
		if($result->num_rows === 0){
			//将员工注册信息插入数据库
			$query = "insert into accountlogin(accountId,username,password)
					values(".$phone.",'".$username."','".md5($password)."')";
			$result = $conn->query($query);
			if($result){
				echo "sucessfull.";
				header( "refresh:5;url=../login.php" ); 
  				echo 'You\'ll be redirected in about 5 secs. If not, click <a href="../login.php">here</a>.';
			}else{
				header("Location:../register.php?regeister=3");
			}
		}else{
			header("Location:../register.php?regeister=2");
		}
	}else{
		header("Location:../register.php?regeister=1");
	}
}else{
	header("Location:../register.php?regeister=0");
}

$conn->close();

?>