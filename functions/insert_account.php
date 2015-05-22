<?php
include '../include_fns.php';
//创建获取数据变量
@$conn = db_connect();
$cell_phone=$_POST['cell_phone'];
@$starff_name = $_POST['starff_name'];

//接收ajax传送数据并判断
if($cell_phone != "" and !isset($starff_name)){
	
	
	$query = "select * from account 
			where accountId = '".$cell_phone."'";
	$result = $conn->query($query);
	
	$row = $result->num_rows;
	$conn->close();
	if($row>0){
		echo 0;
	}else{
		echo 1;
	}
	exit();
}
$cell_phone = $conn->real_escape_string(trim($cell_phone));
@$starff_name = $conn->real_escape_string(trim($starff_name));
@$postion = $_POST['postion'];

if($cell_phone != "" && $starff_name != "" && $postion != "" ){
	$conn = db_connect();

	$query = "select * from account
			where accountId = '".$cell_phone."'";
	$result = $conn->query($query);

	$row = $result->num_rows;
	if($row <= 0){
		$query = "insert into account
				 values('".$cell_phone."', '".$starff_name."', '".$postion."')";
		$result = $conn->query($query);

		if($result){
			echo "员工 ".$starff_name." 添加成功";
		}else{
			echo "员工 ".$starff_name." 添加失败";
		} 
	}else{
		echo "手机号 ".$cell_phone." 已经存在";
	}
}
?>