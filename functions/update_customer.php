<?php
//修改用户信息的脚本
include '../include_fns.php';
foreach ($_POST as $key=>$value){
	$$key = $value;
}
$conn = db_connect();
$query = "update customer_information
		 set company_name = '".$company_name."',
		 address = '".$address."', tell = '".$tell."',
		 fax = '".$fax."', name = '".$name."', billing_address = '".$billing_address."'
		 where customer_id = '".$customer_id."'";

$result = $conn->query($query) or die($conn->error);
if($result){
	$json_array = array("error"=>1);
	$json_array['customer_id'] = $customer_id;
}else{
	$json_array = array("error"=>0);
}
$json = json_encode($json_array);
echo $json;
?>