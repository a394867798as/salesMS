<?php
//修改产品信息的脚本
include '../include_fns.php';
$id = $_POST['id'];
$pro_id = $_POST['pro_id'];
$pro_name = $_POST['pro_name'];
$unit = $_POST['pro_unit'];
$conn = db_connect();

$query = "update product_info  set pro_id = '".$pro_id."', unit = '".$unit."', name='".$pro_name."'
		  where id =".$id;
if($result = $conn->query($query)){
	echo 1;
}else{
	echo 0;
}
?>