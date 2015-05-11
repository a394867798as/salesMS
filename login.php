<?php 
session_start();
  include 'include_fns.php';
  checkSessionUsername();
  do_html_header("登陆|工业控制产品的备件销售管理系统");
  display_login_form();
  do_html_footer();
?>
