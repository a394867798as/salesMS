<?php
function do_html_header($title){
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<script src="js/jquery-2.1.3.min.js"></script>
<link href="css/login.css" rel="stylesheet" type="text/css">
<script src="js/login.js"></script>
</head>
<body>
<header>
 <h1><?php echo $title;?></h1>
 <?php out_account_info(); ?>
</header>
<?php 
}
function do_html_index_header($title){
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<script src="js/jquery-2.1.3.min.js"></script>
<link href="css/index.css" rel="stylesheet" type="text/css">

<script src="js/insert_proinfo.js"></script>
<script src="js/out_proinfo.js"></script>

</head>
<body>
<header>
 <h1><a href="<?php SERVER_NAME ?>/salesMS/"><?php echo $title;?></a> </h1>
 <?php out_account_info(); ?>
</header>
<?php 
}
function do_html_footer(){
?>
<footer style="text-align:center">
Done
</footer>
</body>
</html>
<?php 
}
function display_login_form(){
?>
<section>
 <div id="main-inner">
 </div>
 <!--登陆框-->
 <div id="loginBlock">
  <div class="loginfunc">员工登陆</div>
  <form id="loginSales" name="loginSales" action="functions/login.php" method="post">
  <!--用户名输入框-->
  <div  class="loginFormIpt">
   <b class="ico ico-uid"></b>
   <input class="formIpt formIpt-focus" 
   tabindex="1" autofocus title="请输入用户名" id="idInput"  required placeholder="请输入用户名" name="username" type="text" maxlength="50" 
   autocomplete="off" />
  </div>
  <div  class="loginFormIpt">
   <b class="ico ico-pwd"></b>
   <input class="formIpt formIpt-focus" 
   tabindex="1" autofocus title="密码" id="pwdInput"  required placeholder="密码" name="password" type="password" maxlength="50" autocomplete="off" />
  </div>
  <div class="loginFormBtn">
   <button id="loginBtn" tabindex="6" class="btn-login" type="submit">登&nbsp;&nbsp;陆</button>
   <a id="lfBtnReg" class="btn-reg" href="register.php"  tabindex="7">注&nbsp;&nbsp;册</a>
  </div>
 </form>
 <div>
 </div>
 
 </div>
</section>
<?php 
}
function display_register_form(){
?>
<section>
 <div id="main-inner">
 </div>
 <!--注册框-->
 <div id="loginBlock">
  <div class="loginfunc">员工注册</div>
  <form id="registerSales" name="registerSales" action="functions/register.php" method="post">
  <!--用户名输入框-->
  <div  class="loginFormIpt">
   <b class="ico ico-phone"></b>
   <input class="formIpt formIpt-focus" 
   tabindex="1" autofocus title="请输入注册手机号" id="phoneInput"  required placeholder="请输入注册手机号" name="phoneNumber" type="text" maxlength="50" 
   autocomplete="off" onblur="return register()" />
  </div>
  <span id="warnWord"></span>
  <div  class="loginFormIpt">
   <b class="ico ico-name"></b>
   <input class="formIpt formIpt-focus" 
   tabindex="2"  title="姓名" id="nameInput"  required placeholder="姓名" name="name" type="text" maxlength="50" 
   autocomplete="off" />
  </div>
  <div  class="loginFormIpt">
   <b class="ico ico-uid"></b>
   <input class="formIpt formIpt-focus" 
   tabindex="3"  title="请输入用户名" id="idInput"  required placeholder="请输入用户名" name="username" type="text" maxlength="50" 
   autocomplete="off" />
  </div>
  <div  class="loginFormIpt">
   <b class="ico ico-pwd"></b>
   <input class="formIpt formIpt-focus" 
   tabindex="4" autofocus title="输入密码" id="pwdInput"  required placeholder="输入密码" name="password" type="password" maxlength="50" autocomplete="off" />
  </div>
  <div class="loginFormBtn">
   <button id="loginBtn" tabindex="6" class="btn-login" type="submit" onclick="return register()">注&nbsp;&nbsp;册</button>
   <a id="lfBtnReg" class="btn-reg" href="login.php"  tabindex="7">已有账号？</a>
  </div>
 </form>
 <div>
 </div>
 
 </div>
</section>
<?php 
}
//调用员工信息
function out_account_info(){
	if(isset($_SESSION['username']) && isset($_SESSION['name'])){
		
		echo "<div class='individual_info'>
			 ";
		echo "<p>欢迎登陆：".$_SESSION['name']."</p>
			  <a href='?action=logout'>退出登陆</a>";//
		echo "</div>";
	}
}
//输出index中心内容
function display_center_content($username, $name,$action = "",$position,$state = "", $contractid="",$customerid="",$page=""){
	
	$nav = array();
	$nav['合同中心'] = (array('发布合同','查看合同','修改客户信息'));
	$nav['产品中心'] = (array('录入产品','查看产品'));
	$nav['统计'] = (array('查看统计信息'));
	if($position == 0){//如果是经理登入
		$nav['员工管理'] = array('添加新员工','查看员工信息');
		$nav['发票管理'] = array('开具发票');
	}
	if($position === 2 ){
		$nav['发票管理'] = array('开具发票');
	}else{
		$nav['出库管理'] = array('产品出库');
	}
?>
<div  id="container">

 <div class="w">
 
  <div id="content">
 
      <div id="sub">
       <?php display_nav_left($nav, $action); ?>
      </div>
      <div id="main">
       <?php  display_main_all($username, $name,$action ,$position,$state,$contractid,$customerid,$page); ?>
      </div>
  </div>
 </div>
</div>
<?php 

}
//输出菜单
function display_nav_left($nav,$action = ""){
	
	foreach ($nav as $key=>$value){
		
		$count = count($value);
		echo "<dl>
				<dt>".$key."</dt>";
		if($count === 1){
			if($action === "" || $action !== $value[0]){
				echo "<dd ><a href='?action=".$value[0]."' class='listcolor'>".$value[0]."</a></dd>";
			}elseif($action !== "" && $action === $value[0]){
				echo "<dd ><a href='?action=".$value[0]."' class='clear active'>".$value[0]."</a></dd>";
			}
		}else{
			for($i = 0; $i<$count; $i++){
				
				if($action === "" || $action !== $value[$i]){
					echo "<dd ><a href='?action=".$value[$i]."' class='listcolor'>".$value[$i]."</a></dd>";
				}elseif($action === $value[$i]){
					echo "<dd ><a href='?action=".$value[$i]."' class='clear active'>".$value[$i]."</a></dd>";
				}
			}
		}
		echo "</dl>";
	}
}
//初始化页面内容
function display_main_all($username, $name,$action ="",$position, $state="", $contractid = "",$customerid = "",$page = ""){
	//如果action为空，则为初始化页面

	switch ($action){
		case "":
			display_index_html( $name,$action,$position);
			break;
		case "发布合同":
			display_submit_contract($name,$position,$username,$state);
			break;
		case "fabuhetong":
			display_submit_contract($name,$position,$username,$state);
			break;
		case "录入产品":
			display_input_proinfo($action,$state);
			break;
		case "查看产品":
			display_select_proinfo($action,$state);
			break;
		
		case "查看合同";
			display_select_contract($action,$state,$contractid);
			break;
		case "chakanhetong";
			display_select_contract($action,$state,$contractid);
			break;
		case "修改客户信息":
			display_customer_information($action,$customerid,$page);
			break;
		case "查看统计信息":
			display_all_tongjixinxi($action,$state);
			break;
		case "产品出库":
			display_product_outstore($action,$contractid);
			break;
		case "开具发票":
			display_bill_out($action,$contractid);
			break;
		case "添加新员工":
			display_staff_insert($action);
			break;
		case "查看员工信息":
			display_account_info($action);
			break;
	}
}
//输出主页内容
function display_index_html( $name,$action = "",$position){
	//连接数据库，定义变量
	$array_contract = get_contract_state($name, $position);
	$contract_array = get_contract_list("","",10);
	echo "<script src='js/select_contract.js'></script>";
?>
	<div class="ly-c-0">
	  <div id="user_info">
    	<div class="info_icol">
         <div class="u-name"><?php echo $name; ?></div>
         <div class="u-position"><?php echo  get_position($position);?></div>
        </div>
        <div class="info_rocl">
        <?php if($position != 3){ ?>
         <ul>
         <li><a href='?action=查看合同&&state=0'>已签订<em><?php print($array_contract[0]); ?></em></a></li>
         <li><a href='?action=查看合同&&state=1'>汇款已到账<em><?php print($array_contract[1]); ?></em></a></li>
         <li><a href='?action=查看合同&&state=2'>已定货<em><?php print($array_contract[2]); ?></em></a></li>
         <li><a href='?action=查看合同&&state=3'>已出库<em><?php print($array_contract[3]); ?></em></a></li>
         <li><a href='?action=查看合同&&state=4'>已开具发票<em><?php print($array_contract[4]); ?></em></a></li>
         </ul>
         <?php }else{?>
          <ul>
           <li><a href='?action=查看合同&&state=0'>已签订<em><?php print($array_contract[0]); ?></em></a></li>
           <li><a href='?action=查看合同&&state=3'>需要开具发票<em><?php print($array_contract[3]); ?></em></a></li>
         </ul>
         <?php }?>
        </div>
      </div>
    </div>
    <div style='background-color: #fff; width:1000px; padding:10px; margin-top:10px; border-radius:10px;'>
    <h1 style="color: green;font-size:16px; width:200px; float:left">最近签署的合同</h1>
    <h1 style="color: green;font-size:16px;width:200px;float:right;"><a href='?action=查看合同'>查看全部合同</a></h1>
   <?php display_contract_array($contract_array) ?>
   </div>
<?php 
}

//插入产品表单
function display_input_proinfo($action,$state = ""){
?>
<div class="proinput">
 <h1>录入产品</h1>
 <form action="functions/insert_proinfo.php" method="post">
 <div class="infoForm">
   <div class="item">
   <em>*</em><span>产品型号：</span>
   <div class="form1">
    <input type="text"  maxlength="20"  id="pro_id"  name="pro_id" autocomplete="off"  tabindex="1" required />
    <div class="text">请输入产品型号</div>
   </div>
  </div>
  <div class="item">
   <em>*</em><span>产品名称：</span>
   <div class="form1">
    <input type="text"  maxlength="20"  id="pro_name" name="pro_name"  autocomplete="off"  tabindex="2" required  value="电气配件"/>
   </div>
  </div>
 <div class="item">
  <span> <em>*</em>产品品牌：</span>
   <div class="form1">
    <select name="brand" id="brand" style="float:left; height:25px;" tabindex="3">
     <option value="siemens">siemens</option>
     <option value="HEIDENHAIN">HEIDENHAIN</option>
     <option value="EBMPAPST">EBMPAPST</option>
     <option value="ZIEHL-ABEGG">ZIEHL-ABEGG</option>
     <option value="其它">其它</option>
    </select>
    <input id="otherBrand" type="text"  style="width:50px; height:20px; float:left; display:none;"/>
   </div>
  </div>
  <div class="item">
   <em>*</em><span>计量单位：</span>
   <div class="form1">
    <select name="unit" id="unit" tabindex="4">
     <option value="个">个</option>
     <option value="台">台</option>
     <option value="件">件</option>
    </select>
   </div>
  </div>
  <div class="item">
   <div class="form1">
    <button class="btn-submit" style="height:30px;">提交</button>
   </div>
   </div>
   </form>
 </div>
 <div id="waringInformation">
 <span><?php echo $state; ?></span>
 </div>
</div>
<?php 
}
function display_select_proinfo($action,$state = ""){
?>
<div class="proinput">
 <h1><?php echo $action; ?></h1>
   <div class="search">
       <form method="post" action="#" onSubmit="return false" name="form1">
           <input type="text"  placeholder="产品型号" id="searchpro_id" class="text" title="产品型号"  required/>
           <input type="submit" value="GO" class="btn" id="searchpro_butn"  />
       </form>
  </div>
 <?php display_product_information(); ?>
</div>
<?php
}
//输出产品信息
function display_product_information(){
	
	$brand_array = array('siemens','HEIDENHAIN','ZIEHL-ABEGG','EBMPAPST','其它');
	$conn = db_connect();
	
	for($i = 0;$i<5; $i++){
		$query = "select * from product_info 
				  where brand = '".$brand_array[$i]."'";
		$result = $conn->query($query);
		echo "<div class='outForm'>
			  <h2>".$brand_array[$i]."</h2>
			  <ul>";
		while($pro_array = $result->fetch_array()){
?>
			<li>
			    <div class="outpro_info">
			     <form action="#" onSubmit="return false">
			     <table >
			      <tr>
			      <td align="right">序号：</td>
			       <td align="center" ><span style="font-size:16px; color:red;"><b><?php echo $pro_array['id'] ?></b></span></td>
			      </tr>
                  <tr><td colspan="2" align="center"><div class="prompting"></div></td></tr>
			      <tr>
			       <td align="right">产品型号:</td>
			       <td><input type="text" name="pro_id" value="<?php echo $pro_array['pro_id'] ?>" disabled /></td>
			      </tr>
			      <tr>
			       <td align="right">产品名称:</td>
			       <td><input type="text" name="pro_name" value="<?php echo $pro_array['name'] ?>"  class="pro_name" disabled /></td>
			      </tr>
			      <tr>
			       <td align="right">计量单位:</td>
			       <td>
			       		<select name="unit" disabled>
			       		 <option value="<?php echo $pro_array['unit'] ?>"><?php echo $pro_array['unit'] ?></option>
			             <option value="个" >个</option>
			             <option value="台" >台</option>
			             <option value="件">件</option>
			           </select>
			      </td>
			      </tr>
			      <tr>
			       <td colspan="2" align="right">
			         <button name="button" class="btn-submit" style=" display:none; margin-top:10px;">修改</button>
			         <button name="button1" class="btn-submit" style=" display:none;margin-top:10px;">确认修改</button>
			       </td>
			      </tr>
			     </table>
			     </form>
			    </div>
			   </li>
<?php 
		}
		echo " </ul>
            </div>";
	}
	$conn->close();
}
//输出发布合同表单
function display_submit_contract($name,$position,$username,$state = ""){
	if($state != ""){
		echo "<script src='js/checkstate.js'></script>";
	}
	$pro_num = isset($_REQUEST['pro_num'])?$_REQUEST['pro_num']:"";
	
	if($pro_num == ""){
		?>
		<div class="proinput">
 		<h1>输入合同含有几种型号产品</h1>
 		<form action='?action=发布合同' method='post'>
 		 <table style='margin: 50px;'>
 		  <tr>
 		   <td>请输入要“发布合同”有多少项产品：<input type="number" min='1' max= '10' required value='1' name='pro_num' /></td>
 		   <td><button>提交</button></td>
 		  </tr>
 		 </table>
 		</form>
 		</div>
		<?php 
	}else{
?>
<script src="js/create_contract.js"></script>
<div class="contractinput">
 <h1 align="center">工业备件合同</br>CONTRACT</h1>
 <form action="functions/insert_contract.php" method="post" name="contract">
 <div class="contractForm">
  <!-- 头部开始 -->
  <div id="contract_top">
   <table>
    <tr>
     <td align="right"><span>*</span>合同号: </td>
     <td><input type="text" id="contract_id" name="contract_id" style="width:100px;" required tabindex="1" placeholder="合同号" title="合同号" /></td>
    </tr>
    <tr>
     <td align="right"><span>*</span>签订日期:</td>
     <td><input type="date" tabindex="2" id="contract_date" name="contract_date" style="width:120px;" placeholder="日期"  title="日期" required /></td>
    </tr>
    <tr>
     <td align="right">签定地点:</td>
     <td style="text-decoration:underline; color:#333; font-size:14px;">&nbsp;&nbsp;北京&nbsp;&nbsp;</td>
    </tr>
   </table>
  </div>
  <div id="contract_customer">
   <div id="contract_sale">
    <h2>卖方</h2>
    <p><?php echo siswell_ifomation("name") ?></p>
    <p>地址: <?php echo siswell_ifomation("address") ?></p>
    <p>电话: <?php echo siswell_ifomation("tell") ?></p>
    <p>传真: <?php echo siswell_ifomation("fax")?></p>
    <p>联系人: <?php echo $name; ?></p>
   </div>
   <div id="contract_buy">
    <h2>买方</h2>
    <table cellpadding="0" cellspacing="2">
     <tr>
      
      <td><span>*</span>客户名称:</td>
      <td ><input type="text" id="buy_company" name="buy_company" style="width:250px" required placeholder="请输入客户名称（必填）" tabindex="3" /><span class="waringText"></span></td>
      
     </tr>
     <tr>
      <td><span>*</span>地址:</td>
      <td><input type="text" id="buy_address" name="buy_address" required placeholder="请输入地址" style="width:300px;" tabindex="4" /></td>
     </tr>
     <tr>
      <td><span>*</span>联系电话:</td>
      <td><input type="text" id="buy_tell" name="buy_tell" required placeholder="请输入客户联系电话" style="width:150px;" tabindex="5" /></td>
     </tr>
     <tr>
      <td><span>*</span>传真:</td>
      <td><input type="text" id="buy_fax" name="buy_fax" required placeholder="请输入客户联系传真" style="width:150px;" tabindex="6" /></td>
     </tr>
     <tr>
      <td><span>*</span>联系人:</td>
      <td><input type="text" id="buy_name" name="buy_name" required placeholder="请输入联系人姓名" style="width:150px;" tabindex="7" /></td>
     </tr>
     <tr>
      <td>收票地址:</td>
      <td><input type="text" id="buy_billing" name="buy_billing"  placeholder="请输入收票地址（如果和收货地址不一样）" style="width:300px;" tabindex="8" /></td>
     </tr>
    </table>
   </div>
  </div>
  <div id="contract_pro">
   <table cellpadding="0" cellspacing="0">
    <tr>
     <td width="50px" align="center">序号</td>
     <td width="300px" align="center">型号</td>
     <td width="100px" align="center">单位</td>
     <td width="100px" align="center">交货期</td>
     <td width="100px" align="center">数量</td>
     
     <td width="150px" align="center">单价</td>
     <td width="150px" align="center">总价</td>
    </tr>
   </table>
   <input type="hidden" name="pro_count" id="pro_count" />
   <div class="contract_pro_list">
   
   <?php
    for($i = 0; $i<$pro_num + 1; $i++){
		if($i == 0){
   ?>
    <ul>
     <li>
     <input type="text" name="pos_<?php echo $i; ?>" id="pos_<?php echo $i; ?>"
      class="pos" required value="<?php echo $i+1; ?>" style="width:50px;" />
      
      </li>
     <li style="width:300px;">
     <input type="text" name="type_<?php echo $i; ?>" id="type_<?php echo $i; ?>" class="type" required style="width:246px;" />
     <a href="javascript:;" ></a></li>
     <li><input type="text" name="unit_<?php echo $i; ?>" id="unit_<?php echo $i; ?>" class="unit" required style="width:100px;" /></li>
     <li>
     <select  name="lead_<?php echo $i; ?>" id="lead_<?php echo $i; ?>" class="lead" required style="width:100px; height:29px;"/>
     <option value="0" >现货</option>
     <?php
	  for($j=1; $j<21;$j++){
	?>
      <option value="<?php echo $j; ?>"><?php echo $j; ?> 周</option>
    <?php
	  }
	 ?>
     </select>
     </li>
     <li><input type="text" name="qty_<?php echo $i; ?>" id="qty_<?php echo $i; ?>"  class="qty" required style="width:100px;" /></li>
     
     <li><input  type="text" name="Uprice_<?php echo $i; ?>" id="Uprice_<?php echo $i; ?>" class="Uprice" required style="width:150px;" placeholder="0.00"/></li>
     <li>
     <input type="text" name="extension_<?php echo $i; ?>" class="extension" id="extension_<?php echo $i; ?>" required style="width:150px;" placeholder="0.00" readonly />
     </li>
    </ul>
    <?php
		}else{
?>
    <ul>
     <li>
     <input type="text" name="pos_<?php echo $i; ?>" id="pos_<?php echo $i; ?>"
      class="pos" value="<?php echo $i+1; ?>" style="width:50px;" />
      
      </li>
     <li style="width:300px;">
     <input type="text" name="type_<?php echo $i; ?>" id="type_<?php echo $i; ?>" class="type"  style="width:246px;" />
     <a href="javascript:;" ></a></li>
     <li><input type="text" name="unit_<?php echo $i; ?>" id="unit_<?php echo $i; ?>" class="unit"  style="width:100px;" /></li>
     <li>
     <select  name="lead_<?php echo $i; ?>" id="lead_<?php echo $i; ?>" class="lead" required style="width:100px; height:29px;"/>
     <option value="0" >现货</option>
     <?php
	  for($j=1; $j<21;$j++){
	?>
      <option value="<?php echo $j; ?>"><?php echo $j; ?> 周</option>
    <?php
	  }
	 ?>
     </select>
     </li>
     <li><input type="text" name="qty_<?php echo $i; ?>" id="qty_<?php echo $i; ?>"  class="qty" style="width:100px;" /></li>
     
     <li><input  type="text" name="Uprice_<?php echo $i; ?>" id="Uprice_<?php echo $i; ?>" class="Uprice"  style="width:150px;" placeholder="0.00"/></li>
     <li>
     <input type="text" name="extension_<?php echo $i; ?>" class="extension" id="extension_<?php echo $i; ?>"  style="width:150px;" placeholder="0.00" readonly />
     </li>
    </ul>        
<?php
		}
    }
	?>
    <ul>
     <li style="width:962px; border:1px solid #ccc;">
     总价（含17%增值税人民币价格）：
     <input type="text" id="contract_count" name="contract_count" style="float:right; width:150px; border:0px" placeholder="0.00" readonly />
     </li>
    </ul>
   </div>
   
  </div>
  <div id="contract_button">
    <input  type="submit" value="发布合同" />
   </div>
 </div>

 </form>
</div>

<?php 
	}
}
//如果产品不存在，插入新产品
function insertTypeForm($state){
	?>
<div id="insertType" style="display:none;" >

 <div class="proinput">
 <div id="close" onclick="divClose()"><a href="javascript:">×</a></div>
<div id="goback" onclick="divClose()"><a href="javascript:"><span style="color:#C30; font-size:14px;"><</span>返回</a></div>
 <h1>录入产品</h1>
 <form action="" onSubmit="return false" method="post">
 <div class="infoForm">
   <div class="item">
   <em>*</em><span>产品型号：</span>
   <div class="form1">
    <input type="text"  maxlength="20"  id="pro_id"  name="pro_id" autocomplete="off"  tabindex="1" required />
    <div class="text">请输入产品型号</div>
   </div>
  </div>
  <div class="item">
   <em>*</em><span>产品名称：</span>
   <div class="form1">
    <input type="text"  maxlength="20"  id="pro_name" name="pro_name"  autocomplete="off"  tabindex="2" required  value="电气配件"/>
   </div>
  </div>
 <div class="item">
  <span> <em>*</em>产品品牌：</span>
   <div class="form1">
    <select name="brand" id="brand" style="float:left; height:25px;" tabindex="3">
     <option value="siemens">siemens</option>
     <option value="HEIDENHAIN">HEIDENHAIN</option>
     <option value="EBMPAPST">EBMPAPST</option>
     <option value="ZIEHL-ABEGG">ZIEHL-ABEGG</option>
     <option value="其它">其它</option>
    </select>
    <input id="otherBrand" type="text"  style="width:50px; height:20px; float:left; display:none;"/>
   </div>
  </div>
  <div class="item">
   <em>*</em><span>计量单位：</span>
   <div class="form1">
    <select name="unit" id="unit" tabindex="4">
     <option value="个">个</option>
     <option value="台">台</option>
     <option value="件">件</option>
    </select>
   </div>
  </div>
  <div class="item">
   <div class="form1">
    <button class="btn-submit" id="insertProButton" style="height:30px;">提交</button>
   </div>
   </div>
   </form>
 </div>
 <div id="waringInformation">
 <span></span>
 </div>
</div>
</div>
    <?php
}
//插入页面头部
function display_html_top($title){
	?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="http://127.0.0.1/salesMS/css/lonading.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1><?php echo $title;?></h1>
<?php 
}
//等待效果
function display_loading(){
	?>


	<div class='loader'>
	  <div class='blob'></div>
	  <div class='blob'></div>
	  <div class='blob'></div>
	  <div class='blob'></div>
	  <div class='blob'></div>
	  <div class='blob'></div>
	  <div class='blob'></div>
	</div>
</body>
</html>
	<?php 
}
//根据不同状态，显示不同的合同信息
function display_select_contract($action,$state = "",$contractid = ""){
    echo "<script src='js/select_contract.js'></script>";
	if($contractid != "" && $state == ""){
		
		display_contract($contractid);
	}elseif($contractid != "" && $state == "all"){
		
		display_contract($contractid,$state);
		
	}
	if($contractid == "" && $state != ""){
		display_all_contract($state);
	}
	if($state == "" && $contractid == ""){
		display_all_contract();	
		
	}
	
}
//显示所有合同，并可以搜索
function display_all_contract($state = ""){
	if($state == ""){
		$contract_array_list = get_contract_list();
		
	}else{
		$contract_array_list = get_contract_state_list($state);
		
	}
	?>
	<div class="select-contract">
     <h2>查看合同</h2>
     <div class="search">
       <form method="post" action="#" onSubmit="return false" name="form1">
           <input type="text"  placeholder="合同号 | 客户名称" id="searchcontract_id" class="text" title="合同号或着客户名称"  required/>
           <input type="submit" value="GO" class="btn" id="searchcontract_butn"  />
       </form>
     </div>
     <div class="outContract">
     <!-- 合同列表开始 -->
     <?php
     display_contract_array($contract_array_list);
     ?>
     </div>
    </div>
	<?php 
}
//列出数组项
function display_contract_array($contract_array_list, $search = ""){
	foreach ($contract_array_list as $key => $value){
	
		?>
	      <div class="contract_list">
	      <div class="contract-box">
	       <div class="contract-top">
	        <table>
	         <tr>
	          <td width="110px">已签合同</td>
	          <td width="90px">合同总额</td>
	          <td width="200px">送货至</td>
	          <td width="400px" align="right">合同编号</td>
	         </tr>
	         <tr>
	          <td style="color:#272727;"><?php echo date("Y年m月d日",strtotime($value['date'])); ?></td>
	          <td style="color:#272727;"> ￥ <?php echo $value['amount']; ?></td>
	          <td> 
	          <div class="contract-name">
	          <span style="margin-bottom:5px;"><?php echo get_search_value($value['company_name'],$search);?></span>^
	          <span class="contract-address">
	           <ul>
	            <li><b><?php echo $value['name']; ?></b></li>
	            <li><?php echo $value['address']; ?></li>
	            <li>电话:<?php echo $value['tell']; ?></li>
	           </ul>
	          </span>
	          </div>
	          </td>
	          <td align="right" style="color:#093;"><?php echo get_search_value($value['contract_id'],$search); ?></td>
	         </tr>
	        </table>
	       </div>
	      </div>
	      
	       <div class="contract-pro">
	        
	        <div class="contract-pro-list" style="margin-right:250px;">
	         <?php 
	        foreach ($value['pro_list'] as $pro_key => $pro_value){
	        	
	      	 ?>
	         <div class="contract-pro-list-all" >
	         <h1><?php echo  display_contract_state($pro_value['state']);?></h1>
	         <table>
	          <tr>
				<td align="right">产品型号:</td>
				<td ><span style="font-size:14px; color:blue; cursor:pointer;" ><?php echo $pro_value['pro_id']; ?></span></td>
			  </tr>
			  <tr>
			   <td align="right">产品名称:</td>
			   <td><span style="color:#666; font-size:14px;"><?php echo $pro_value['name']; ?></span></td>
			  </tr>
			  <tr>
			   <td align="right">数量:</td>
			   <td><?php echo $pro_value['quantity'].$pro_value['unit'] ?></td>
			  </tr>
			 </table>
	         </div>
	         <?php 
	        }
	         ?>
	        </div>
	        <div class="contract-button">
	         <div class="contract-button-list"> 
	           <a href='?action=查看合同&&contractid=<?php echo $key; ?>'>查看合同详情</a>
	         </div>
	        </div>
	       </div>
	      </div>
	     <!-- -->
	     <?php 
	     }
}
//根据不同状态输出单个合同
function display_contract($contractid,$state = ""){
	$contract_array_list = get_contract_list($contractid);
	$contract_array = $contract_array_list[$contractid];
	
?>
<div class="contractinput">
 <?php

  if($state == "all"){
	  echo "<h1 align='center' style='color:#fff;  border:1px solid #f6f6f6; border-radius:5px; background:green'>合同 <span style='color:red;'>"
	  .$contractid ."</span> 成功发布</h1>";
  }
 ?>
 <h1 align="center" style="">工业备件合同</br>CONTRACT</h1>
 
 <div class="contractForm">
  <!-- 头部开始 -->
  <div id="contract_top">
   <table>
    <tr>
     <td align="right"><span>*</span>合同号: </td>
     <td style="font-family:Arial; text-decoration:underline;"><div id="contract_id_select"><?php echo $contractid; ?></div></td>
    </tr>
    <tr>
     <td align="right"><span>*</span>签订日期:</td>
     <td><?php echo date("Y年m月d日",strtotime($contract_array['date'])); ?></td>
    </tr>
    <tr>
     <td align="right">签定地点:</td>
     <td style="text-decoration:underline; color:#333; font-size:14px;">&nbsp;&nbsp;北京&nbsp;&nbsp;</td>
    </tr>
   </table>
  </div>
  <div id="contract_customer">
   <div id="contract_sale">
    <h2>卖方</h2>
    <p><?php echo siswell_ifomation("name") ?></p>
    <p>地址: <?php echo siswell_ifomation("address") ?></p>
    <p>电话: <?php echo siswell_ifomation("tell") ?></p>
    <p>传真: <?php echo siswell_ifomation("fax")?></p>
    <p>联系人: <?php echo $_SESSION['name']; ?></p>
   </div>
   <div id="contract_buy">
    <h2>买方</h2>
    <table cellpadding="0" cellspacing="2">
     <tr>
      
      <td>客户名称:</td>
      <td ><span style="color:#066; font-size:16px;background-color:yellow;" ><?php echo $contract_array['company_name'] ?></span></td>
      
     </tr>
     <tr>
      <td>地址:</td>
      <td><span style="color:#066; font-size:16px;background-color:yellow;"><?php echo $contract_array['address'] ?></span></td>
     </tr>
     <tr>
      <td>联系电话:</td>
      <td><span style="color:#000; font-size:14px;background-color:yellow;"><?php echo $contract_array['tell'] ?></span></td>
     </tr>
     <tr>
      <td>传真:</td>
      <td><span style="color:#000; font-size:14px;"><?php echo $contract_array['fax'] ?></span></td>
     </tr>
     <tr>
      <td>联系人:</td>
      <td><span style="color:#000; font-size:14px;background-color:yellow;"><?php echo $contract_array['name'] ?></span></td>
     </tr>
     <tr>
      <td>收票地址:</td>
      <td><span style="color:#ccc; font-size:12px;">
      <?php echo $contract_array['billing_address'] == "" ?"同收货地址":$contract_array['billing_address']; ?></span></td>
     </tr>
    </table>
   </div>
  </div>
  <div class="contract-pro contractid_pro">
   <h1 style="color:#666;">订购产品:</h1>
   <?php
    $i = 0;	
    $pro_state = array();
   ?>
   <div class="contract-pro-list" style="width:980px;">
	         <?php 
	        foreach ($contract_array['pro_list'] as $pro_key => $pro_value){
	        	$pro_state[$i] = $pro_value['state'];
	      	 ?>
	         <div class="contract-pro-list-all" style="width:980px; padding:5px;">
	         <h1><?php echo  display_contract_state($pro_value['state']);?></h1>
	         <table style="float: left; width:350px;">
	          <tr>
				<td align="right" colspan="">产品型号:</td>
				<td ><span style="font-size:14px; color:blue; cursor:pointer;" class="pro_id" ><?php echo $pro_value['pro_id']; ?></span></td>
			  </tr>
			   <tr>
				<td align="right">生产厂家:</td>
				<td ><span style="font-size:14px; color:green; cursor:pointer;" ><?php echo $pro_value['brand']; ?></span></td>
			  </tr>
			  <tr>
			   <td align="right">产品名称:</td>
			   <td><span style="color:#666; font-size:14px;"><?php echo $pro_value['name']; ?></span></td>
			  </tr>
			  <tr>
			   <td align="right">数量:</td>
			   <td><?php echo $pro_value['quantity'].$pro_value['unit'] ?></td>
			  </tr>
              <tr>
			   <td align="right">价格:</td>
			   <td>
			   <?php 
			   $pro_price = $pro_value['quantity'] * $pro_value['pro_price'];
			   $pro_price = number_format($pro_price, 2, '.', '');
			   echo "<span style='color:#333;'>￥".$pro_price."<span>";
			    ?>
                </td>
			  </tr>
			 </table>
			 <?php  display_outdata_state($pro_value,$contract_array,$pro_value['pro_id']);?>
	         </div>
             
	         <?php 
	         $i++;
	        }
	       
	         ?>
	 </div>
	 
  </div>
  <div class='contract-pro bill_state' >
	  <h1 style="color:#666;">发票状态：</h1>
	  <div class="contract-pro-list-all" style="width:980px; padding:5px; margin-top:10px;">
       
      <?php 
	  foreach($pro_state as $key =>$state_value){
		  $key++;
		  echo "<h1>第 ".$key." 项：".display_contract_state($state_value)."</h1>";
	  }
      if(check_all_state($pro_state, 3) == true){
      	$value = "开具发票？";
      	$contract_id = $contractid;
      	$maxdelivery = $pro_value['maxdelivery'];
      	//输出开票按钮
      	$bill_info_array = check_billing_information($contract_array['customer_id']);
      	 
      	?>
      	      	 <h1 style="text-align:center;">
      	      	 合同所涉及产品已经全部出库，需要开具发票
      	         <?php   
      	            echo $bill_info_array == false?"<span style='color:red;'>（缺少开票信息）</span>":"<span style='color:green;'>(有开票信息)</span>";
      	          ?>
      	         
      	          </h1>
      	      	<?php 
      	      	//判断是否有开票信息
      	      	if($bill_info_array != false){
      				
      	      		echo "<table align='center'>
      					  <tr ><td colspan='2' align='center' style='border:1px solid #ccc; bachground-color:#ddd;'>开票信息</td></tr>
      					  <tr><td align='right'>公司名称：</td><td>".$bill_info_array['name']."</td></tr>
      					  <tr><td align='right'>开票地址：</td><td>".$bill_info_array['address']."</td></tr>
      					  <tr><td align='right'>注册电话：</td><td>".$bill_info_array['tell']."</td></tr>
      					  <tr><td align='right'>开户行：</td><td>".$bill_info_array['bankName']."</td></tr>
      					  <tr><td align='right'>银行账号：</td><td>".$bill_info_array['bankNumber']."</td></tr>
      	 				  <tr><td align='right'>纳税人识别号：</td><td>".$bill_info_array['ITIN']."</td></tr>
      					 </table>";
      	      		
      	      	}
      	      		?>
      	      		
      	      		<div class="contract-button" style="width:980px; margin-top:10px;" >
      	                     <div class="contract-button-list" style="margin:0 auto;" id="update_bill_button"> 
      	                      <a >
      	                      <?php echo $bill_info_array==false?"添加开票资料":"修改开票资料"; ?></a> 
      	                     </div>
      	             </div>
      	      		<?php 
      	display_button($value, 3, $maxdelivery,$contract_id);
      }
      //判断合同发票状态
      if(check_all_state($pro_state, 4)){
      	
      	$bill_info_array = check_billing_information($contract_array['customer_id']);
      	
      	?>
      	 <h1 style="text-align:center;">
      	 合同所涉及产品已经全部出库，并开具发票
         <?php   
            echo $bill_info_array == false?"<span style='color:red;'>（缺少开票信息）</span>":"<span style='color:green;'>(有开票信息)</span>";
          ?>
          <br/>开票时间：<?php echo $contract_array['billoutDate'] ?>
          </h1>
      	<?php 
      	//判断是否有开票信息
      	if($bill_info_array != false){
			
      		echo "<table align='center'>
				  <tr ><td colspan='2' align='center' style='border:1px solid #ccc; bachground-color:#ddd;'>开票信息</td></tr>
				  <tr><td align='right'>公司名称：</td><td>".$bill_info_array['name']."</td></tr>
				  <tr><td align='right'>开票地址：</td><td>".$bill_info_array['address']."</td></tr>
				  <tr><td align='right'>注册电话：</td><td>".$bill_info_array['tell']."</td></tr>
				  <tr><td align='right'>开户行：</td><td>".$bill_info_array['bankName']."</td></tr>
				  <tr><td align='right'>银行账号：</td><td>".$bill_info_array['bankNumber']."</td></tr>
 				  <tr><td align='right'>纳税人识别号：</td><td>".$bill_info_array['ITIN']."</td></tr>
				 </table>";
      		
      	}
      		?>
      		
      		<div class="contract-button" style="width:980px; margin-top:10px;" >
                     <div class="contract-button-list" style="margin:0 auto;" id="update_bill_button"> 
                      <a >
                      <?php echo $bill_info_array==false?"添加开票资料":"修改开票资料"; ?></a> 
                     </div>
             </div>
      		<?php 

      }
      ?>
      
      </div>
	 </div>
</div>

<?php

}
//插入开票资料表单
function insert_bill_Form($contract_id){
	
	$bill_info_array = get_billing_information($contract_id);
	if(!isset($bill_info_array['name'])){
	
	?>
<script src="js/insert_billing.js"></script>
<div id="insertType" style="display: none;" >

 <div class="proinput">
 <div id="close" onclick="divClose()"><a href="javascript:">×</a></div>
<div id="goback" onclick="divClose()"><a href="javascript:"><span style="color:#C30; font-size:14px;"><</span>返回</a></div>
 <h1>修改/录入开票资料</h1>
 <form action="" onSubmit="return false" method="post">
 <div class="infoForm">
   <div class="item">
   <span>客户id号：</span>
   <div class="form1">
    
    <div class="text"><span id="customer_id"><?php echo $bill_info_array['customer_id'];?></span></div>
   </div>
  </div>
  <div class="item">
   <em>*</em><span>客户名称：</span>
   <div class="form1">
    <input type="text"  style="width: 250px;"  id="bill_name" name="bill_name"  autocomplete="off"  tabindex="2" required />
   </div>
  </div>
 <div class="item">
  <span> <em>*</em>注册地址：</span>
   <div class="form1">
    
    <input id="bill_address" type="text"  style="width:300px; height:20px; " required />
   </div>
  </div>
  <div class="item">
   <span>注册电话：</span>
   <div class="form1">
   <input id="bill_tell" type="text"  style="width:200px; height:20px; "/>
   
   </div>
  </div>
  <div class="item">
   <em>*</em><span>开户行：</span>
   <div class="form1">
   <input id="bill_bankName" type="text"  style="width:200px; height:20px; " required />
   
   </div>
  </div>
  <div class="item">
   <em>*</em><span>银行账号：</span>
   <div class="form1">
   <input id="bill_bankNumber" type="text"  style="width:250px; height:20px; " required />
   
   </div>
  </div>
  <div class="item">
   <em>*</em><span>纳税号：</span>
   <div class="form1">
   <input id="bill_itin" type="text"  style="width:250px; height:20px; " required />
   
   </div>
  </div>
  <div class="item">
   <div class="form1">
    <button class="btn-submit" id="bill_insert_btn" style="height:30px;">提交</button>
   </div>
   </div>
   </form>
 </div>
 <div id="waringInformation">
 <span></span>

    <button class="btn-submit" id="enter_true" style="height:30px; margin-top:100px; display:none;" onclick="divClose()" >确认</button>
 
 </div>
</div>
</div>
    <?php
	}else{
		?>
<script src="js/insert_billing.js"></script>
<div id="insertType" style="display: none;" >

 <div class="proinput">
 <div id="close" onclick="divClose()"><a href="javascript:">×</a></div>
<div id="goback" onclick="divClose()"><a href="javascript:"><span style="color:#C30; font-size:14px;"><</span>返回</a></div>
 <h1>修改/录入开票资料</h1>
 <form action="" onSubmit="return false" method="post">
 <div class="infoForm">
   <div class="item">
   <span>客户id号：</span>
   <div class="form1">
    
    <div class="text"><span id="customer_id"><?php echo $bill_info_array['customer_id'];?></span></div>
   </div>
  </div>
  <div class="item">
   <em>*</em><span>客户名称：</span>
   <div class="form1">
    <input type="text"  style="width: 250px;" value="<?php echo $bill_info_array['name']; ?>"  id="bill_name" name="bill_name"  autocomplete="off"  tabindex="2" required />
   </div>
  </div>
 <div class="item">
  <span> <em>*</em>注册地址：</span>
   <div class="form1">
    
    <input id="bill_address" type="text"  style="width:300px; height:20px; " 
    value="<?php echo $bill_info_array['address']; ?>" required />
   </div>
  </div>
  <div class="item">
   <span>注册电话：</span>
   <div class="form1">
   <input id="bill_tell" type="text"  style="width:200px; height:20px; "
   value="<?php echo $bill_info_array['tell']; ?>"/>
   
   </div>
  </div>
  <div class="item">
   <em>*</em><span>开户行：</span>
   <div class="form1">
   <input id="bill_bankName" type="text"  style="width:200px; height:20px; "
   value="<?php echo $bill_info_array['bankName']; ?>" required />
   
   </div>
  </div>
  <div class="item">
   <em>*</em><span>银行账号：</span>
   <div class="form1">
   <input id="bill_bankNumber" type="text"  style="width:250px; height:20px; "
   value="<?php echo $bill_info_array['bankNumber']; ?>" required />
   
   </div>
  </div>
  <div class="item">
   <em>*</em><span>纳税号：</span>
   <div class="form1">
   <input id="bill_itin" type="text"  style="width:250px; height:20px; "
   value="<?php echo $bill_info_array['ITIN']; ?>" required />
   
   </div>
  </div>
  <div class="item">
   <div class="form1">
    <button class="btn-submit" id="bill_insert_btn" style="height:30px;">提交</button>
   </div>
   </div>
   </form>
 </div>
 <div id="waringInformation">
 <span></span>
 
    <button class="btn-submit" id="enter_true" style="height:30px; margin-top:100px;display:none;" onclick="divClose()" >确认</button>
   
 </div>
</div>
</div>
		<?php 
	}
}
//显示出库信息
function display_out_store($contractid,$pro_id){
 $outstore_array = get_outstore_info($contractid,$pro_id);
 ?>
 <div class="contract_outstore">
 <table style="border:1px dashed #ddd;">
  <tr>
   <td colspan="2" align='center' >出库信息</td>
  </tr>
  <tr>
   <td align="right" width="80px;">收货地址：</td>
   <td width="350px"><?php echo $outstore_array['address']; ?></td>
  </tr>
  <tr>
   <td align="right">联系电话：</td>
   <td><?php echo $outstore_array['tell'];?></td>
  </tr>
  <tr>
   <td align="right">联系人：</td>
   <td><?php echo $outstore_array['name'] ?></td>
  </tr>
  <tr>
   <td align="right">承运人：</td>
   <td><?php echo $outstore_array['express_nam'] ?></td>
  </tr>
  <tr>
   <td align="right">运单号：</td>
   <td><?php echo $outstore_array['express_number']; ?></td>
  </tr>
  <tr>
   <td align="right">出库时间：</td>
   <td><?php echo $outstore_array['time']; ?></td>
  </tr>
  </table>
 </div>
 <?php 
}
//根据不同状态输出不同的按钮
function display_button($value,$state,$maxdelivery,$contractid = "",$pri_id = ''){
	if(($state == 1 && $maxdelivery == 0) || $state == 2 ){
?>
<div class="contract-button" style="float: right;">
  <div class="contract-button-list">
  <a href="?action=产品出库&contractid=<?php echo $contractid;  ?>&out_me=<?php echo $pri_id; ?>">产品出库?</a>	
  </div>     
</div>
 		
<?php 
	}elseif($state == 3){
	?>
<div class="contract-button"  style="float: left;  width:980px;">
  <div class="contract-button-list" style="margin:10px auto;">
  <a href="functions/update_sateforbill.php?contractid=<?php echo $contractid;  ?>">已经开具发票?</a>	
  </div>     
</div>
	<?php 	
	}else{
?>
<div class="contract-button" style="float: left;">
	         <div class="contract-button-list"> 
	           <button class="state_button" style="width:148px; height:30px;" ><?php echo $value; ?></button>
	           <input type="hidden" class="state_button_value" value="<?php echo $state; ?>" />
	         </div>
	    </div>
<?php
	} 
}
//输出客户信息
function display_customer_information($action,$customerid = "",$page = ""){
	//获取所有客户的数组
	$customer_array = get_customer_array($customerid);
?>
<script src="js/customer_update.js"></script>
<div class="customeroutput">
 <h1><?php echo $action; ?></h1>
   <div class="search">
       <form method="post" action="#" onSubmit="return false" name="form1">
           <input type="text"  placeholder="客户名称 客户编码" id="searchcustomer_id" class="text" title="产品型号"  required/>
           <input type="submit" value="GO" class="btn" id="searchcustomer_butn"  />
       </form>
  </div>
  <div id="customer_all_information">
 <?php display_customer_info($customerid, $page);  ?>
 </div>
</div>
<?php
}
function display_customer_info($customerid = "",$page = ""){
	
	if($customerid == ""){

	    if($page == ""){
	    	$page = 1;
	    }
		$showNumber = 50;
		$conn = db_connect();//连接数据库
		$query = "select count(*) from customer_information";
		$resut = $conn->query( $query) or die($conn->error);
		
	    $list_count = $resut->fetch_assoc();
		$list_count = $list_count['count(*)'];
	    $count_page = ceil($list_count/$showNumber);//计算出页数，总条数除以每页显示的条数，小数进1取整
	    $page_list = 50*($page-1);
	    
	    $query = "select * from customer_information limit ".$page_list.",50";
	    
	    $customer_array = get_customer_show_array($query);
	    $conn->close();
	    $i = 1;
	    fenye_button($page, $count_page);
		?>
        
         <div class='customerList' style='background-color:#FFF; border:1px solid #ccc; margin-top:10px;'>
         <ul >
          <li style="width:50px; ">编号</li>
          <li style="width:270px; background-color:#f6f6f6;">公司名称</li>
          <li style="width:380px;">地址</li>
          <li style="width:50px; background-color:#f6f6f6;">联系人</li>
          <li style="width:198px; text-align:center">查看详细信息</li>
         </ul>
        </div>
        <?php
	    foreach ($customer_array as $key => $value){
			if($i%2 == 0){
				echo "<div class='customerList' style='background-color:#fff;' >";
			}else{
				echo "<div class='customerList' style='background-color:#ccc;'>";
			}
	 	?>
	    
         <ul>
          <li style="width:50px;"><?php printf("%s",$key); ?></li>
          <li style="width:270px;"><?php printf("%s",$value['company_name']);?></li>
          <li style="width:380px;"><?php printf("%s",select_char_length($value['address'], 25));?></li>
          <li style="width:50px;"><?php printf("%s",$value['name']);?></li>
          <li style="width:200px;">
          
	         <div class="coustomer-button-list" > 
	           <a href='?action=修改客户信息&&customerid=<?php echo $key; ?>'>查看详细信息</a>
	         </div>
	     </li>
         </ul>
        </div>
        
	    <?php 
		$i++;
		
	    }
	    
		fenye_button($page, $count_page);
        
	}else{
		$query = "select * from customer_information
		   		 where customer_id = '".$customerid."'";
		$customer_array = get_customer_show_array($query);
		$customer_this = $customer_array[$customerid];
	?>
    
    <div class='customerList' style='background-color:#FFF; border:1px solid #ccc; margin-top:10px;'>
     <form onSubmit="return false">
     <table width="600px" style="float:left;">
       <tr>
		<td align="right">客户编号:</td>
		<td><span ><?php echo $customer_this['customer_id']; ?></span>
        <input type="hidden" id="customer_id" value="<?php echo $customer_this['customer_id']; ?>" /></td>
	   </tr>
       <tr>
		<td align="right">公司名称:</td>
		<td><input type="text"  value="<?php echo $customer_this['company_name'] ?>" style="width:200px;"  id="company_name" disabled /></td>
	   </tr>
       <tr>
		<td align="right">地址:</td>
		<td><input type="text"  value="<?php echo $customer_this['address'] ?>" style="width:400px;"  id="address" disabled /></td>
	   </tr>
       <tr>
		<td align="right">联系电话:</td>
		<td><input type="text"  value="<?php echo $customer_this['tell'] ?>" style="width:200px;"  id="tell" disabled /></td>
	   </tr>
       <tr>
		<td align="right">传真:</td>
		<td><input type="text"  value="<?php echo $customer_this['fax'] ?>" style="width:200px;"  id="fax" disabled /></td>
	   </tr>
       <tr>
		<td align="right">联系人:</td>
		<td><input type="text"  value="<?php echo $customer_this['name'] ?>" style="width:200px;"  id="name" disabled /></td>
	   </tr>
       <tr>
		<td align="right">收票地址:</td>
		<td><input type="text"  value="<?php echo $customer_this['billing_address'] ?>" style="width:400px;"  id="billing_address" disabled /></td>
	   </tr>
       <tr>
        <td></td>
        <td align="left" >
         <button id="update_customer" style="height:30px; cursor:pointer;">修改客户信息</button>
         <button id="true_update" style="height:30px; cursor:pointer; display:none;">确认修改客户信息</button>
        </td>
       </tr>
     </table>
      <div id="waringInformation" style="width:300px;">
      <span></span>
 	  </div>
     </form>
    </div>
    <?php
	}
}
function fenye_button($page = "",$count_page = ""){
	echo "<div class='fenye' style='margin:20px 0 1px 0; '>";
		if($page>1 && $page<$count_page){
			echo "<div class='fenye_button' style='float:left;'>
				 <a href='?action=修改客户信息&&page=".($page>1?$page-1:$page)."'>上一页</a>
				</div><div class='fenye_button' style='float:right'>
				 <a  href='?action=修改客户信息&&page=".($page<$count_page?$page+1:$page)."'>下一页</a>
				</div>";
		} 
		if($page == 1){
			echo "<div class='fenye_button' style='float:right'>
				 <a href='?action=修改客户信息&&page=".($page<$count_page?$page+1:$page)."'>下一页</a>
				</div>";
		}
		if($page == $count_page){
			echo "<div class='fenye_button' style='float:left'>
				 <a href='?action=修改客户信息&&page=".($page>1?$page-1:$page)."'>上一页</a>
				</div>";
		}
        echo  "</div>";
}
function display_all_tongjixinxi($action,$state = ""){
	
		
		?>
        <div class="tongji_informattion">
         <h1><?php echo $action; ?></h1>
         <?php show_tongji_information($action,$state); ?>
        </div>
        <?php

}
function show_tongji_information($action,$state = ""){
	if($state == ""){
		$checkdate = "2014-12-31";
		$nowday = date("Y年m月d日",time());
		$query = "select sum(amount) from contract
		 		where date > '".$checkdate."'";
		$conn = db_connect();
		
		$result = $conn->query($query) or die($conn->error);
		$contract_sum = $result->fetch_assoc();
		//使用关联查询满足合同列表条件的合同产品列表的统计信息
		$query1 = "select contract_id from contract
				  where date>'".$checkdate."'";
		$query = "select pro_id,count(pro_id),sum(pro_price) from contract_list
 		 		  where contract_id IN (".$query1.")
				  group by pro_id";
		$result = $conn->query($query) or die($conn->error);
		$contract_procount_array = array();
		while($array = $result->fetch_assoc()){
			$contract_procount_array[$array['pro_id']] = $array;
		}
		?>
		<div class="tongji_year">
         
         <h4>今年截至到 <span style="color:yellow;"><?php echo $nowday; ?></span> 
         	所有签订合同总额：RMB<span style="color:red;"> <?php echo $contract_sum['sum(amount)']; ?></span> 元整</h4>
         <table width="900px" align="center"  style="border:1px solid #666;"  cellspacing="0">
         <thead>
          
           
            <th width="50px;">序号</th>
            <th width="350px">产品型号</th>
            <th>销售数量</th>
            <th>销售总价(RMB)</th>
           
           </thead>
           <?php
           $i = 1;
            foreach ($contract_procount_array as $key => $value){
            ?>
             <tr>
              <td align="center"><?php echo $i; ?></td>
              <td align="left"><?php echo $value['pro_id'] ?></td>
              <td align="center"><?php echo $value['count(pro_id)']; ?></td>
              <td align="right"><?php echo $value['sum(pro_price)'];?></td>
             </tr>
            <?php 
			$i++;
            } 
           ?>
         
         </table>
        </div>
		<?php 
		
	}
}

//输出产品出库信息
function display_product_outstore($action,$contractid = ""){
	$out_me = array();
	@$out_me = $_POST['out_me'];
	@$out_me[] = $_GET['out_me'];
	
	if($contractid == ""){
		$query = "select * from contract order by date desc";
		$outstore_array = get_contract_query($query, $state = 1);
		
		?>
		 <div class='outstore_infor'>
		  <h1><?php echo $action; ?></h1>
          <div class="contract_need_outstore_list">
           
          	<?php
			 foreach ($outstore_array as $key=>$value){
			 	if(isset($value['pro_list'])){
			 		
			?>
            <form action="?action=产品出库&&contractid=<?php echo $value['contract_id']; ?>" method="post" >
			<div class="contract_outstore_top">
            <h2>合同号：<?php echo $value['contract_id']." ".$value['company_name']; ?></h2>
            </div>
            <div class="outstore_list">
            
            <?php 
			
			foreach ($value['pro_list'] as $pro_value){ 
			?>
            
            <div class="contract-outstore-list-all">
	         <h1><?php echo  display_contract_state($pro_value['state']);?></h1>
	         <table style="float: left; width:400px;">
	          <tr>
				<td align="right">产品型号:</td>
				<td ><span style="font-size:14px; color:blue; cursor:pointer;" class="pro_id" ><?php echo $pro_value['pro_id']; ?></span></td>
			  </tr>
			   <tr>
				<td align="right">生产厂家:</td>
				<td ><span style="font-size:14px; color:green; cursor:pointer;" ><?php echo $pro_value['brand']; ?></span></td>
			  </tr>
			  <tr>
			   <td align="right">产品名称:</td>
			   <td><span style="color:#666; font-size:14px;"><?php echo $pro_value['name']; ?></span></td>
			  </tr>
			  <tr>
			   <td align="right">数量:</td>
			   <td><?php echo $pro_value['quantity'].$pro_value['unit'] ?></td>
			  </tr>
              <tr>
			   <td align="right">价格:</td>
			   <td>
			   <?php 
			   $pro_price = $pro_value['quantity'] * $pro_value['pro_price'];
			   $pro_price = number_format($pro_price, 2, '.', '');
			   echo "<span style='color:#333;'>￥".$pro_price."<span>";
			    ?>
                </td>
			  </tr>
			 </table>
             <div style="width:100px; float:left; margin-left:50px;">
             <span style="color:red; font-size:14px;">选择要出库产品</span>
			 <input type="checkbox" name="out_me[]" value="<?php echo $pro_value['pro_id']; ?>" style="" />
             </div>
	         </div>
            <?php
			 		}
			?>
            
             <div style=" text-align:center; margin-bottom:10px;">
              <button style="height:50px; line-height:50px; font-size:24px; cursor:pointer; color:#333;">确认选择产品出库</button>
             </div>
            </div>
            <?php
			
				 }
			
			echo "</form>";
			  }
			  ?>
           
          </div>
		 </div>
		<?php 
	}else{
		if($out_me == "" || $out_me['0'] == ""){
			echo "<script>alert('请选择要出库产品');window.location = '?action=产品出库';</script>";
			
		}
		$query = "select * from contract where contract_id = '".$contractid."' ";
		$outstore_array = get_contract_query($query, $state = 1);
		$outstore_array = $outstore_array[$contractid];
		
		?>
		<form name="outstore_form" method="post" action="functions/insert_outstore_info.php">
		<div class='outstore_infor'>
		  <h1 align="center">
		  <?php echo "合同 <span style='color:red;'>".$contractid."</span>". $action; ?>
		  <input type="hidden" id="contract_id" name="contract_id" value="<?php echo $contractid; ?>" /></h1>
          <div class="insert_outstore_info">
          
           <div class="outstore_form">
            <table width="500px" border="1" cellspacing="0" bgcolor="#fff">
             <caption>出库产品列表</caption>
             <tr>
              <th width="400px">产品型号</th>
              <th width="100px">合同数量</th>
             </tr>
             <?php
			  foreach($out_me as $value){
				  foreach($outstore_array['pro_list'] as $pro_value){
					  if($pro_value['pro_id'] == $value){
						  echo "<tr>
						  <td align='center'>".$value."<input type='hidden' name='pro_id[]' value=".$value."  /></td>
						  <td align='center'>".$pro_value['quantity']."<input type='hidden' name='quantity[]' value=".$pro_value['quantity']." /></td>
						  </tr>";
					  }
				  }
			  }
			 ?>
            </table>
             <table width="500px" style="border:1px solid #ddd; margin-top:10px;">
              <tr>
               <td colspan="2" 	>收货人信息：</td>
              </tr>
              <tr>
               <td align="right">公司名称：</td>
               <td>
               <input type="text" name="company_name" 
               value="<?php echo $outstore_array['company_name']; ?>" required style="width:250px;" />
               </td>
              </tr>
              <tr>
               <td align="right">地址：</td>
               <td><input type="text" name="address" value="<?php echo $outstore_array['address']; ?>" style="width:350px;" required /></td>
              </tr>
              <tr>
               <td align="right">联系人：</td>
               <td><input type="text" name="name" value="<?php echo $outstore_array['name']; ?>" style="width:100px;" required /></td>
              </tr>
              <tr>
               <td align="right">联系电话：</td>
               <td><input type="text" name="tell" value="<?php echo $outstore_array['tell']; ?>" required />
               <input type="hidden" name="fax" value="<?php echo $outstore_array['fax']; ?>" /></td>
              </tr>
              <tr>
               <td align="right">包装方式：</td>
               <td>
               <select name="store_nam" >
                <option value="纸箱">纸箱</option>
                <option value="纸箱木托">纸箱木托</option>
                <option value="木箱">木箱</option>
               </select>
               </td>
              </tr>
              <tr>
               <td align="right">承运人：</td>
               <td>
               <select name="express_nam" >
                <option value="顺丰速运">顺丰速运</option>
                <option value="德邦快递">德邦快递</option>
                <option value="EMS">EMS</option>
               </select>
               </td>
              </tr>
              <tr>
               <td align="right">运单号：</td>
               <td><input type="text" name="express_number"  required /></td>
              </tr>
              
             </table>
            <div style=" margin:10px auto; width:600px; ">
               <button name="outstore_button" style="margin-left:100px; height:30px; line-height:30px;
               font-size:18px; background-color:#096; border:1px solid #096; border-radius:4px; cursor:pointer;">确认出库</button>
            </div>
           </div>
          </div>
		</div>  
		</form>        
		<?php 
	}
}
//输出需要开具发票的合同
function display_bill_out($action,$contractid = ""){
	if($contractid == ""){	
		$query = "select * from contract order by date asc";
		$outstore_array = get_contract_query($query);
		
		//遍历数据，获取单个合同的信息
		
		echo "<div class='outBill_contract'>";
		echo "<h1>".$action."</h1>";
		foreach ($outstore_array as $contractid=>$contract_value){
			$billing_array = check_billing_information($contract_value['customer_id']);//获取客户的开票信息
			$i = 0;
			$pro_state = array();//单个合同包含的所有产品信息
			foreach ($contract_value['pro_list'] as $pro_key => $pro_value ){
				$pro_state[$i] = $pro_value['state'];
				$i++;
			}
			if(check_all_state($pro_state, 3)){
				insert_bill_Form($contractid);
				?>
                <div class="contract_list">
                  <div class="contract-box">
                   <div class="contract-top">
                   <table>
                     <tr>
                      <td width="110px">已签合同</td>
                      <td width="90px">合同总额</td>
                      <td width="200px">单位名称</td>
                      <td width="400px" align="right">合同编号</td>
                     </tr>
                     <tr>
                      <td style="color:#272727;"><?php echo date("Y年m月d日",strtotime($contract_value['date'])); ?></td>
                      <td style="color:#272727;"> ￥ <?php echo $contract_value['amount']; ?></td>
                      <td> 
                      <div class="contract-name">
                      <span style="margin-bottom:5px;">
                      <?php 
                      echo get_search_value($contract_value['company_name']);
                      ?></span>^
                      
                      </div>
                      </td>
                      <td align="right" style="color:#093;"><?php echo get_search_value($contract_value['contract_id']); ?></td>
                     </tr>
                    </table>
                   </div>
                   
                  </div>
                  <div class="contract-pro">
                    <div class="contract-pro-list" style="margin-right:0px; width:850px; margin-bottom:10px;">
                     <h1 style="text-align:center; wi">合同所涉及产品已经全部出库，请选择开具发票
                     <?php   
                      echo $billing_array == false?"<span style='color:red;'>（缺少开票信息）</span>":"<span style='color:green;'>(有开票信息)</span>";
                      ?>
                      </h1>
                     <table width="850px;" style='border:1px solid #000; border-radius:4px;' cellspacing="0">
                     <tr>
                      <td align="center" width="250px">产品型号</td>
                      <td align="center" width="100px;">名称</td>
                      <td align="center" width="50px">数量</td>
                      <td align="center" width="50px">单位</td>
                      <td align="center" width="100px">单价</td>
                      <td align="center" width="100px">总价</td>
                     </tr>
                     <?php 
                    foreach ($contract_value['pro_list'] as $pro_key => $pro_value){
                     ?>
                     <tr>
                      <td align="center"><?php echo $pro_value['pro_id']; ?></td>
                      <td align="center"><?php echo $pro_value['name']; ?></td>
                      <td align="center"><?php echo $quantity = $pro_value['quantity']; ?></td>
                      <td align="center"><?php echo $pro_value['unit']; ?></td>
                      <td align="center"><?php echo $pro_price = $pro_value['pro_price'];?></td>
                      <td align="center"><?php echo number_format($pro_price * $quantity,2,'.','') ?></td>
                     </tr>
                     <?php 
                    }
                     ?>
                      </table>
                      
                    </div>
                   <?php 
                   if($billing_array != false){
                   		
	                   	echo "<table align='center'>
					  <tr ><td colspan='2' align='center' style='border:1px solid #ccc; bachground-color:#ddd;'>开票信息</td></tr>
					  <tr><td align='right'>公司名称：</td><td>".$billing_array['name']."</td></tr>
					  <tr><td align='right'>开票地址：</td><td>".$billing_array['address']."</td></tr>
					  <tr><td align='right'>注册电话：</td><td>".$billing_array['tell']."</td></tr>
					  <tr><td align='right'>开户行：</td><td>".$billing_array['bankName']."</td></tr>
					  <tr><td align='right'>银行账号：</td><td>".$billing_array['bankNumber']."</td></tr>
	 				  <tr><td align='right'>纳税人识别号：</td><td>".$billing_array['ITIN']."</td></tr>
					 </table>";
	                   
	                  }
                   ?>
                    <div class="contract-button" style="width:400px; ">
                     <div class="contract-button-list" style="margin:0 auto;" id="update_bill_button"> 
                      <a >
                      <?php echo $billing_array==false?"添加开票资料":"修改开票资料"; ?></a> 
                     </div>
                    </div>
                   
                    <div class="contract-button" style="width:400px;">
                     <div class="contract-button-list" style="margin:0 auto;"> 
                       
                       <a href='functions/update_sateforbill.php?contractid=<?php echo $contractid;?>'>已开发票?</a>
                     </div>
                    </div>
                  
                </div>
                
                <?php
			}
			
		}
		echo "</div>";
	}
}
function display_staff_insert($action){
	?>
<script src="js/insert_account.js"></script>
<div class="proinput">
 <h1><?php echo $action; ?></h1>
 <form action="" onSubmit="return false" method="post">
 <div class="infoForm">
   <div class="item">
   <em>*</em><span>员工手机号：</span>
   <div class="form1">
    <input type="text"  maxlength="20"  id="cell_phone"  name="cell_phone" autocomplete="off"  tabindex="1" required />
    <div class="text">请输入员工手机号</div>
   </div>
  </div>
  <div class="item">
   <em>*</em><span>员工姓名：</span>
   <div class="form1">
    <input type="text"  maxlength="20"  id="starff_name" name="starff_name"  autocomplete="off"  tabindex="2" required  />
   </div>
  </div>
 <div class="item">
  <span> <em>*</em>员工职位：</span>
   <div class="form1">
    <select name="postion" id="postion" style="float:left; height:25px; width:100px;" tabindex="3">
     <option value="0">经理</option>
     <option value="1">销售</option>
     <option value="2">财务</option>
     
    </select>
    
   </div>
  </div>
  
  <div class="item">
   <div class="form1">
    <button class="btn-submit" id="account_btn" style="height:30px;">提交</button>
   </div>
   </div>
   </form>
 </div>
 <div id="waringInformation">
 <span></span>
 </div>
</div>
<?php 
}
function display_account_info($action){
	$account_array = get_account_information();
	?>
	<div class="proinput">
 	<h1><?php echo $action; ?></h1>
 	 <table width="900px" align="center" border='1' cellspacing='0'>
 	 <tr>
 	  <th>员工联系方式</th>
 	  <th>员工姓名</th>
 	  <th>员工职位</th>
 	 </tr>
 	  <?php
 	   foreach ($account_array as $accountId => $value){
 	   	
 	   		echo "<tr><td align='center'>".$value['accountId']."</td>
					<td align='center'>".$value['name']."</td>
					<td align='center'>".get_position($value['position'])."</td>
					</tr>";
 	   	
 	   }
 	  ?>
 	 </table>
 	</div>
	<?php 
}
?>