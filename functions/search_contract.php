<?php
include '../include_fns.php';
@$search = $_GET['searchcontract'];
date_default_timezone_set('prc');
if($search == ""){
	header("Location:../");
}else{
	$conn = db_connect();
	$search = $conn->real_escape_string(trim($search));
	
	$query = "select * from contract
			  where contract_id like '".$search."%'";
	
	$result = $conn->query($query);
	
	if($result->num_rows >0){
		$contract_array_list = get_contract_query($query);
		display_contract_array($contract_array_list,$search);
	}else{
		$query = "select * from customer_information
				  where company_name like '%".$search."%'";
		
		$result = $conn->query($query);
		if($result->num_rows > 0){
			$check = 0;
			while($customer_array = $result -> fetch_assoc()){
				$query = "select * from contract
						  where customer_id = '".$customer_array['customer_id']."'";
				
				$contract_array_list = get_contract_query($query);
				if(!empty($contract_array_list)){
					$check++;
				}
				
				 display_contract_array($contract_array_list,$search);
				
				
			}
			if($check == 0){
				echo $search."-----没有搜索结果";
			}
		}else{
			echo $search."-----没有搜索结果";
		}
		
	}
}
?>