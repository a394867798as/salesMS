<?php
//检测post变量是否为空
function checkPost($post){
	foreach ($post as $key=>$value){
		if(!isset($key) || $value === ""){
			return false;
		}
	}
	return true;
}
//检测用户名是否存在
function checkUsername($username){
	$conn = db_connect();
	$query = "select * from accountlogin
			where username = '".$username."'";
	$result = $conn->query($query);
	if($result->num_rows>0){
		return true;
	}else{
		return false;
		$conn->close();
	}
}
//检测是否登陆
function checkSessionUsername(){
	if(isset($_SESSION['username']) and $_SESSION['username'] !==""){
		header("Location:/salesMS");
	}
}
function checkSessionUsernameNo(){
	if(!isset($_SESSION['username'])){
		header("Location:/salesMS/login.php");
	}
}
//检测员工职位
function get_position($positionId){
	switch ($positionId){
		case 0: return "经理";break;
		case 1: return "销售";break;
		case 2: return "财务";break;
	}
}
//获取合同不同状态的数量
function get_contract_state($name,$position){
	//连接数据库
	$conn = db_connect();
	$array_contract = array();
	//选择输出
	for($i = 0; $i<=4; $i++){
		if($position == 0 || $position == 3){
			$query = "select distinct contract_id from contract_list 
					where state=".$i;
		}else{
			$query = "select distinct contract_id from contract_list
					where state=".$i." 
					and contract_id in(select contract_id from contract where accountId =
							(select accountid from account where name = '".$name."'))";
		}
		$result = $conn->query($query) or die($conn->error);
		if($result){
			$array_contract[$i] = $result->num_rows;
		}else{
			$array_contract[$i] = "NULL";
		}
		
	}
	$conn->close();
	
	return $array_contract;
}
//公司信息
function siswell_ifomation($select){
	switch($select){
		case 'tell':
			return "010-64732035 84717232";
			break;
		case "fax":
			return "010-84713182";
			break;
		case 'address':
			return "北京市朝阳区启阳路4号中轻大厦B座2单元602室";
			break;
		case "name":
			return "西思维尔科技（北京）有限公司";
			break;
		default:
			return NULL;
	}
}
function insert_contract($post){
	$conn = db_connect();
	
	//获取post变量
	foreach ($post as $key => $value){
		if($key != "" && $value != ""){
			$$key = $conn->real_escape_string(trim($value));
			echo $key."</br>";
		}
	}
	
	//实例化变量
	$contract_count = round($contract_count,2);
	$accountId = $_SESSION['accountId'];
	
	if($contract_id === "" || !isset($contract_id)){
		
		header("refresh:5;url=../?action=fabuhetong");
	}
	$conn->autocommit(FALSE);//关闭系统自动提交事务
	
	//检测客户是否存在，如果不存在，将客户信息存入数据库，如果存在获取客户ID号
	$query = "select * from customer_information
		 where company_name like '".$buy_company."'";
	
	$result = $conn->query($query);
	
	if(empty($result->num_rows) ){
	
		if(!isset($buy_billing)){
			$query = "insert into customer_information(company_name, name, tell, fax,address)
			 values('".$buy_company."', '".$buy_name."', '".$buy_tell."', '".$buy_fax."', '".$buy_address."')";
	
		}else{
			$query = "insert into customer_information(company_name, name, tell, fax, address, billing_address )
			 values('".$buy_company."', '".$buy_name."', '".$buy_tell."', '".$buy_fax."', '".$buy_address."', '".$buy_billing."')";
		}
		$result = $conn->query($query) or die($conn->error);
	
		if(!$result ){
			return false;
		}
	
	}
	if(isset($buy_billing) && !empty($result->num_rows) ){
	
		$customer_array = $result->fetch_assoc();
		if($customer_array['billing_address'] === ""){
			$customer_id = $customer_array['customer_id'];
			$query = "update customer_information
				  set billing_address = '".$buy_lilling."'
				  where customer_id = '".$customer_id."'";
			$result = $conn->query($query);
			if(!$result){
				return false;
			}
		}
	}
	
	$query = "select * from customer_information
		 where company_name = '".$buy_company."'";
	
	$result = $conn->query($query) or die($conn->error);
	$customer_array = $result->fetch_assoc() or die($conn->error);
	
	$customer_id = $customer_array['customer_id'];
	//检测合同号
	$query = "select contract_id from contract
		  where contract_id = '".$contract_id."'
		  and customer_id = '".$customer_id."'";
	$result = $conn -> query($query) or die($conn->error);
	if($result->num_rows > 0){
		$state = json_encode($post);
		header("Location:../?action=发布合同&&state=".$state);
	}
	//插入合同信息
	$query = "insert into contract
		  values('".$contract_id."', '".$customer_id."', '".$contract_count."', '".$accountId."','".$contract_date."', NULL)";
	
	$result = $conn->query($query) or die($conn->error);
	if(!$result){
		return false;
	}
	
	
	$query = "select contract_id from contract
		  where contract_id = '".$contract_id."'
		  and customer_id = '".$customer_id."'";
	$result = $conn -> query($query) or die($conn->error);
	
	if(empty($result->num_rows)){
		return false;
	}else{
	
		$contract_object = $result->fetch_object();
		$contract_id = $contract_object->contract_id;
	}
	//插入合同产品列表
	for($i=0; $i<$pro_count; $i++){
		if(isset(${"type_".$i})){
			$type = ${"type_".$i};
			$unit = ${"unit_".$i};
			$lead = ${"lead_".$i};
			$qty = ${"qty_".$i};
			$Uprice = ${"Uprice_".$i};
			$query="insert into contract_list
				value('".$contract_id."', '".$type."', ".$Uprice.", ".$qty.",NULL,".$lead.", 0)";
			$result = $conn->query($query) or die($conn->error);
	
			if(!$result){
				return false;
			}
		}
	}
	//end transaction
	$conn->commit();
	$conn->autocommit(TRUE);
	
	return $contract_id;
}
?>