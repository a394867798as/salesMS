<?php
include '../include_fns.php';
foreach ($_POST as $key => $value){
	$$key = $value;
}
$conn = db_connect();
if($customer_id != ""){
	$query = "select * from billing_information where customer_id = '".$customer_id."'";
	$result = $conn->query($query);
	if($result->num_rows >0){
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
		$query = "insert into billing_information 
				  values('".$customer_id."','".$bill_name."','".$bill_address."','".$bill_bankNumber."','".$bill_tell."',
				  		'".$bill_bankName."','".$bill_itin."')";
		$result = $conn->query($query);
		if($result){
			echo $waring = $bill_name."<br />的开票信息插入成功";
		}else{
			echo $waring = $bill_name."<br />的开票信息插入失败";
		}
	}
}

?>