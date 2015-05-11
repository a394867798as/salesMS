<?php
include '../include_fns.php';
session_start();
print_r($_SESSION);
$contract_id = insert_contract($_POST);
?>