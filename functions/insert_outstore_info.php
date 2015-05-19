<?php
include '../include_fns.php';
display_html_top("出库中。。。。");

 foreach ($_POST as $key => $value){
  $$key = $value;
 
 }

 $time = date("Y-m-d",time());
 $i = 0;
 $conn = db_connect();
 
$conn->autocommit(FALSE);//关闭系统自动提交事务
 foreach($pro_id as $value){
 	$pro_quantity = $quantity[$i];
	$query = "select * from contract_list 
			  where contract_id = '".$contract_id."'
			  and pro_id like '%".$value."%'";
	$result = $conn->query($query);
	$contract_list = $result->fetch_assoc();
	$pro_id = $contract_list['pro_id'];
	
 	$query = "INSERT INTO `company`.`outstore` 
 			(`contract_id`, `pro_id`, `quantity`, `company_name`,
 			 `address`, `tell`, `name`, `express_nam`, `express_number`, `store_nam`, `time`)
 			 VALUES ('".$contract_id."', '".$pro_id."', '".$quantity[$i]."', '".$company_name."', '".$address."',
 			 		 '".$tell."', '".$name."', '".$express_nam."', '".$express_number."', '".$store_nam."', '".$time."');";
 	
 	$result = $conn->query($query) or die($conn->error);
 	if($result){
 		echo "<div class='outstore_state' >".$value."出库信息更新成功。。。</div>";
 	}else{
 		echo $value."出库信息更新失败。。。";
 	}
 	$query = "update contract_list set state = 3
 			  where contract_id = '".$contract_id."'
 			  and pro_id like '".$value."%'";
 	
 	$result = $conn->query($query) or die($conn->error);
 	if($result){
 		echo "<div class='outstore_state' style='margin-bottom:10px;'>".$value."产品列表状态已经更新。。。</div>";
 		
 	}else{
 		echo $value."产品列表状态更新失败。。。";
 	}
 	$i++;
 }
 $conn->commit();
 $conn->autocommit(TRUE);//打开系统自动提交功能
 $conn->close();
 echo "<div class='outstore_state'>5秒后自动跳转<a href='../?action=查看合同&contractid=".$contract_id."'>点击查看出库信息</a></div>";
 header("refresh:5;url=../?action=chakanhetong&contractid=".$contract_id);
 do_html_footer();
?>