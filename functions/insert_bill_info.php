<?php
/****
 * 将客户开票资料插入到开票信息数据库中
 */
include '../include_fns.php';
foreach ($_POST as $key => $value){
	$$key = $value;
}
$conn = db_connect();
if($customer_id != ""){
	//检测开票资料中是否存在该用户的开票信息
	$query = "select * from billing_information where customer_id = '".$customer_id."'";
	$result = $conn->query($query);
	if($result->num_rows >0){
		//如果存在，更新开票信息
		$query = "update billing_information set 
				 name = '".$bill_name."', address = '".$bill_address."', bankName = '".$bill_bankName."',
				 bankNumber = '".$bill_bankNumber."', tell = '".$bill_tell."', ITIN = '".$bill_itin."' 
				 where customer_id = '".$customer_id."'";
		$result = $conn->query( $query);
		if($result){
			echo $waring = $bill_name."<br />的开票信息更新成功";
		}else{
			echo  $waring = $bill_name."<br />的开票信息更新失败";
		}
	}else{
		//如果不存在，则添加该用户的开票信息
		$query = "insert into billing_information 
				  values('".$customer_id."','".$bill_name."','".$bill_address."','".$bill_bankNumber."','".$bill_tell."',
				  		'".$bill_bankName."','".$bill_itin."')";
		$result = $conn->query($query);
		//给出提示信息
		if($result){
			echo $waring = $bill_name."<br />的开票信息插入成功";
		}else{
			echo $waring = $bill_name."<br />的开票信息插入失败";
		}
	}
}

?>