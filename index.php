<?php 
session_start();
include 'include_fns.php';
checkSessionUsernameNo();

//create short variable names
@$action = $_REQUEST['action'];
@$state = $_GET['state'];

//判断
if($action === "logout"){
	session_destroy();
	unset($action);
	$_SESSION = array();
	header("Location:login.php");
}
if($action == ""){
	do_html_index_header("首页|工业控制产品的备件销售管理系统");
}else{
	do_html_index_header($action."|工业控制产品的备件销售管理系统");
}
if($action == "发布合同"){
	insertTypeForm($state);
}

display_center_content($_SESSION['username'], $_SESSION['name'],$action,$_SESSION['position'],$state);
do_html_footer();
?>