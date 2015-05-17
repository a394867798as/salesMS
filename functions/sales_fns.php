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
		}
	}
	
	//实例化变量
	$contract_count = round($contract_count,2);
	$accountId = $_SESSION['accountId'];
	
	if(empty($contract_id)){
		
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
	$conn->close();
	
	return $contract_id;
}
//获取数据库中contract的数据
function get_contract_list($contract_id="", $state="", $time=6){
	//设置时区
	date_default_timezone_set('PRC');
	$nowtime = time();
	
	
	if($time == 6 && $contract_id == "" && $state == ""){
		$time = 648000 * 24;
		$selecttime = $nowtime - $time;
		$selecttime = date("Y-m-d",$selecttime);
		$query = "select * from contract
				 where date > '".$selecttime."'
				 order by date desc";
	}
	if($time == 6 && $contract_id != "" ){
		$time = 648000 * 24;
		$selecttime = $nowtime - $time;
		$selecttime = date("Y-m-d",$selecttime);
		$query = "select * from contract
				 where date > '".$selecttime."'
				 and contract_id = '".$contract_id."'";
	}
	return get_contract_query($query,$state);
	
	
}
function get_contract_query($var,$state = ""){
	$contract_array_list = array();
	//连接数据库
	$conn = db_connect();
	
	$result = $conn->query($var);
	
	while($contract_array = $result->fetch_assoc()){
		$contract_id = $contract_array['contract_id'];
		//获取单个合同的客户信息，并存入$contract_array
		$query = "select * from customer_information
				  where customer_id = '".$contract_array['customer_id']."'";
		$customer_result = $conn->query($query);
		foreach ($customer_result->fetch_assoc() as $key=>$value){
			$contract_array[$key] = $value;
		}
		//获取单个合同的产品信息,并存入$contract_array
		if($state == ""){
			$query = "select * from contract_list
				  where contract_id = '".$contract_id."'";
		}else{
			$query = "select * from contract_list
				  where contract_id = '".$contract_id."'
				  and state =".$state;
		}
		$pro_result = $conn->query($query);
		$pro_number = 0;
		while($pro_array = $pro_result->fetch_assoc()){
			//获取产品信息
			$query = "select * from product_info
					  where pro_id = '".$pro_array['pro_id']."'";
			$proinfo_result = $conn->query($query);
			foreach ($proinfo_result->fetch_assoc() as $pro_key => $pro_value){
				$pro_array[$pro_key] = $pro_value;
			}
			$contract_array['pro_list'][$pro_number] = $pro_array;
			$pro_number ++;
		}
		$contract_array_list[$contract_id] = $contract_array;
	}
	$conn->close();
	return $contract_array_list;
}
function display_contract_state($state){
	switch ($state){
		case 0:
			return "已签订合同,等待付款";
			break;
		case 1:
			return "货款已经到账";
			break;
		case 2:
			return "已经订货";
			break;
		case 3:
			return "产品已经出库";
			break;
		case 4;
			return "发票已开具";
			break;
		case 5;
		 	return "<span style='color:#ccc;'>此项已经取消</span>";
		 	break;
	}
}
function get_search_value($value, $search = ""){
	if($search == ""){
		return $value;
	}else{
		$value = str_ireplace($search, "<span style='color:red;'>".ucwords($search)."</span>", $value);
		return $value;
	}
}
function display_outdata_state($pro_value,$contract_array){
	
	$state = $pro_value['state'];
	$maxdelivery = $pro_value['maxdelivery'];
	$contractid = $pro_value['contract_id'];
	switch ($state){
		case 0:
			$value = "已付款 ?";
			display_button($value, $state,$maxdelivery);
			break;
		case 1:
			if($maxdelivery == 0){
				$value = "已发货 ？";
			}else{
				$value = "已定货 ?";
			}
			display_button($value, $state,$maxdelivery,$contractid);
			break;
		case 2:
			return "已经订货";
			break;
		case 3:
			return "产品已经出库";
			break;
		case 4;
		return "发票已开具";
		break;
		case 5;
		return "<span style='color:#ccc;'>此项已经取消</span>";
		break;
	}
}
//获取所有客户信息 
function get_customer_array($customerid = ""){
	$conn = db_connect();
	if($customerid == ""){
		$query = "select * from customer_information";
	}else{
		$customerid = $conn->real_escape_string(trim($customerid));
		
		$query = "select * from customer_information
				  where customer_id = '".$customerid."'";
	}
	
	$customer_array = array();
	
	$result = $conn->query($query);
	if($result->num_rows > 0){
		while($customer_array_list = $result->fetch_assoc()){
			$customerid = $customer_array_list['customer_id'];
			$customer_array[$customerid] = $customer_array_list;
		}
	}else{
		$customer_array['error'] = 0; 
	}
	$conn->close();
	return $customer_array;
}
//根据查询条件获取客户数组
function get_customer_show_array($query){
	$conn = db_connect();
	$customer_array = array();
	
	$result = $conn->query($query);
	if($result->num_rows > 0){
		while($customer_array_list = $result->fetch_assoc()){
			$customerid = $customer_array_list['customer_id'];
			$customer_array[$customerid] = $customer_array_list;
		}
	}else{
		$customer_array['error'] = 0;
	}
	$conn->close();
	return $customer_array;
}
//限制显示文字字数
function select_char_length($value,$number){

	$count = mb_strlen($value);
	if($count<$number){
		return $value;
	}else{
		$value = mb_substr($value,0,$number)."...";
		return $value;
	}

}
?>