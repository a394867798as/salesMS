<?php
include '../include_fns.php';
session_start();

display_html_top();


display_loading();

$contract_id = insert_contract($_POST);

if($contract_id !=""){
	header("refresh:3;url=../?action=chakanhetong&state=all&contractid=".$contract_id);
}
do_html_footer();
?>