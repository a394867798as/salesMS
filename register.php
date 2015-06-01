<?php 
session_start();
  include 'include_fns.php';
  do_html_header("注册|工业控制产品的备件销售管理系统");
  display_register_form();
  do_html_footer();
?>