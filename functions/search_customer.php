<?php
include "../include_fns.php";
$customerName = $_GET['companyname'];

$conn = db_connect();
$data = array();

$query = "select * from customer_information
		  where company_name like '%".$customerName."%'";

$result = $conn->query($query);
if($result->num_rows > 0){
	$i = 0;
	while($search_array = $result->fetch_assoc()){
		$data[$i] = $search_array;
		$i++;
	}
	$data = json_encode($data);
	
	echo $data;
}else{
    $data["error"] = 0;
    $data = json_encode($data);
    
    echo $data;
}
?>