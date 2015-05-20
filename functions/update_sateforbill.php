<?php
include '../include_fns.php';
$contract_id = $_GET['contractid'];
echo $contract_id;
if($contract_id != ""){
	$nowDate = date("Y-m-d",time());
	$conn = db_connect();
	
	$conn->autocommit(FALSE);//关闭自动提交事务
	$query = "update contract_list set state = 4
			  where contract_id = '".$contract_id."'";
	echo $query;
	$result = $conn->query($query) or die($conn->error);
	if($result){
		echo 1;
	}else{
		echo "<script>alert('数据更新失败，请联系管理员');window.location = '../?action=开具发票'</script>";
	}
	
	$query = "update contract set billoutDate = '".$nowDate."'
			  where contract_id = '".$contract_id."'";
	$result = $conn->query($query) or die($conn->error);
	if($result){
		echo 2;
	}else{
		echo "<script>alert('数据更新失败，请联系管理员');window.location = '../?action=开具发票'</script>";
	}
	
	$conn->commit();//提交事务
	$conn->autocommit(TRUE);
	
	header("Location:/salesMS/?action=查看合同&&contractid=".$contract_id);
}
?>