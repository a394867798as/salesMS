<?php
include '../include_fns.php';
//创建获取数据变量
@$conn = db_connect();
$pro_id =$_POST['pro_id'];
@$pro_name = $_POST['pro_name'];

//接收ajax传送数据并判断
$pro_id = $conn->real_escape_string(trim($pro_id));
@$pro_name = $conn->real_escape_string(trim($pro_name));
@$brand = $_POST['brand'];
@$unit = $_POST['unit'];
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
			echo '{"error":1}';
		}else{
			echo '{"error":2}';
		}
	}else{
		echo '{"error":3}';
	}
}
?>