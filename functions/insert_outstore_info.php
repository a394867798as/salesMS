<?php
include '../include_fns.php';
 foreach ($_POST as $key => $value){
  $$key = $value;
   print_r($key);
   echo "<br/>";
 }
 $i = 0;
 $conn = db_connect();
 
$conn->autocommit(FALSE);//关闭系统自动提交事务
 foreach($pro_id as $value){
 	$pro_quantity = $quantity[$i];
 	$query = "insert into outstore
 			values('".$contract_id."','".$value."','".$pro_quantity."',
 					'".$company_name."'，'".$address."','".$tell."','".$name."',
 					'".$express_nam."','".$express_number."','".$store_nam."',now())";
 	$result = $conn->query($query) or die($conn->error);
 	if($result){
 		echo $value."出库信息更新成功。。。";
 	}else{
 		echo $value."出库信息更新失败。。。";
 	}
 	$query = "update contract_list set state = 3
 			  where contract_id = '".$contract_id."'
 			  and pro_id = '".$value."'";
 	$result = $conn->query($query) or die($conn->error);
 	if($result){
 		echo $value."产品列表状态已经更新。。。";
 		
 	}else{
 		echo $value."产品列表状态更新失败。。。";
 	}
 	$i++;
 }
 $conn->commit();
 $conn->autocommit(TRUE);//打开系统自动提交功能
 $conn->close();
 
 
?>