<?php
include '../include_fns.php';
@$state = $_POST['state'];
@$pro_id = $_POST['pro_id'];
@$contract_id = $_POST['contract_id'];
$date = array();
if($state != ""){
	$conn = db_connect();
	
	$query = "update contract_list set state = '".$state."'  
			  where pro_id = '".$pro_id."'
			  and contract_id = '".$contract_id."'";
	
	
	$result = $conn->query($query) or die($conn->error);
	
	if($result){
		$date['error'] = 1;
	}else{
		$date['error'] = 0;
	}
	
	$data = json_encode($date);
	
	echo  $data;
}else{
	header("Location:../");
}
?>