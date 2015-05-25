<?php
include '../include_fns.php';
//创建获取数据变量
@$conn = db_connect();
$pro_id =$_POST['pro_id'];
@$pro_name = $_POST['pro_name'];

//接收ajax传送数据并判断
if($pro_id != "" and !isset($pro_name)){
	
	
	$query = "select * from product_info 
			where pro_id = '".$pro_id."'";
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
$pro_id = $conn->real_escape_string(trim($pro_id));
@$pro_name = $conn->real_escape_string(trim($pro_name));
@$brand = $_POST['brand'];
@$unit = $_POST['unit'];
//判断变量是否为空
if($pro_id != "" && $pro_name != "" && $brand != "" && $unit != ""){
	$conn = db_connect();

	$query = "select * from product_info
			where pro_id = '".$pro_id."'";
	$result = $conn->query($query);

	$row = $result->num_rows;
	if($row <= 0){
		$query = "insert into product_info(pro_id, unit, brand, name)
				 values('".$pro_id."', '".$unit."', '".$brand."', '".$pro_name."')";
		$result = $conn->query($query);

		if($result){
			header("Location:../?action=录入产品&&state=".$pro_id."<br /><br /> 录入产品成功");
		}else{
			header("Location:../?action=录入产品&&state=录入产品失败");
		}
	}else{
		header("Location:../?action=录入产品&&state=".$pro_id."<br /><br />产品已存在");
	}
}
?>