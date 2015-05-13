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
<script src="js/create_contract.js"></script>
</head>
<body>
<header>
 <h1><?php echo $title;?></h1>
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
function display_center_content($username, $name,$action = "",$position,$state = "", $contractid=""){
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
       <?php  display_main_all($username, $name,$action ,$position,$state,$contractid); ?>
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
function display_main_all($username, $name,$action ="",$position, $state, $contractid = ""){
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
	}
}
//输出主页内容
function display_index_html( $name,$action = "",$position){
	//连接数据库，定义变量
	$array_contract = get_contract_state($name, $position);
	
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
         <li><a href='?action=查看合同&&state=4'>需要开具发票<em><?php print($array_contract[4]); ?></em></a></li>
         </ul>
         <?php }else{?>
          <ul>
           <li><a href='?action=查看合同&&state=0'>已签订<em><?php print($array_contract[0]); ?></em></a></li>
           <li><a href='?action=查看合同&&state=4'>需要开具发票<em><?php print($array_contract[4]); ?></em></a></li>
         </ul>
         <?php }?>
        </div>
      </div>
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
function display_submit_contract($name,$position,$username,$state = ""){
	if($state != ""){
		echo "<script src='js/checkstate.js'></script>";
	}
?>

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
    for($i = 0; $i<3; $i++){
		if($i == 0){
   ?>
    <ul>
     <li>
     <input type="text" name="pos_<?php echo $i; ?>" id="pos_<?php echo $i; ?>"
      class="pos" required value="<?php echo $i+1; ?>" style="width:50px;" />
      
      </li>
     <li style="width:300px;">
     <input type="text" name="type_<?php echo $i; ?>" id="type_<?php echo $i; ?>" class="type" required style="width:250px;" />
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
     <input type="text" name="type_<?php echo $i; ?>" id="type_<?php echo $i; ?>" class="type"  style="width:250px;" />
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
function display_html_top(){
	?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加合同中。。。。</title>
<link href="../css/lonading.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>添加合同中。。。。。</h1>
	<?php 
}
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
function display_select_contract($action,$state = "",$contractid = ""){
   
	if($contractid != ""){
		display_contract($contractid);
	}elseif($contractid != "" && $state == "all"){
		display_contract($contractid,$state);
		
	}
	if($state != "" ){
		
		display_state_contract($state);
	
	}
	if($state == "" && $contractid == ""){
		display_all_contract();	
		
	}
	
}
function display_all_contract(){
	
	$contract_array_list = get_contract_list();
	
	?>
	<div class="select-contract">
     <h2>查看合同</h2>
     <div class="search">
       <form method="post" action="#" onSubmit="return false" name="form1">
           <input type="text"  placeholder="合同号 | 客户名称" id="searchpro_id" class="text" title="产品型号"  required/>
           <input type="submit" value="GO" class="btn" id="searchpro_butn"  />
       </form>
     </div>
     <div class="outContract">
     <!-- 合同列表开始 -->
     <?php 
     foreach ($contract_array_list as $key => $value){
     	
     ?>
      <div class="contract_list">
      <div class="contract-box">
       <div class="contract-top">
        <table>
         <tr>
          <td width="110px">已签合同</td>
          <td width="90px">合同总额</td>
          <td width="100px">送货至</td>
          <td width="500px" align="right">订单编号</td>
         </tr>
         <tr>
          <td style="color:#272727;"><?php echo date("Y年m月d日",strtotime($value['date'])); ?></td>
          <td style="color:#272727;"> ￥ <?php echo $value['amount']; ?></td>
          <td> 
          <div class="contract-name">
          <span><?php echo $value['name']; ?></span>^
          <span class="contract-address">
           <ul>
            <li><b><?php echo $value['name']; ?></b></li>
            <li><?php echo $value['address']; ?></li>
            <li>电话:<?php echo $value['tell']; ?></li>
           </ul>
          </span>
          </div>
          </td>
          <td align="right" style="color:#093;"><?php echo $value['contract_id']; ?></td>
         </tr>
        </table>
       </div>
      </div>
      
       <div class="contract-pro">
        
        <div class="contract-pro-list">
         <?php 
        foreach ($value['pro_list'] as $pro_key => $pro_value){
      	 ?>
         <div class="contract-pro-list-all">
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
           <a href='http://127.0.0.1/salesMS/?action=查看合同&&contractid=<?php echo $key; ?>'>查看合同详情</a>
         </div>
        </div>
       </div>
      </div>
     <!-- -->
     <?php 
     }
     ?>
     </div>
    </div>
	<?php 
}

function display_contract($contractid,$state = ""){
	$contract_array_list = get_contract_list($contractid);
	$contract_array = $contract_array_list[$contractid];
?>
<div class="contractinput">
 <h1 align="center">工业备件合同</br>CONTRACT</h1>
 
 <div class="contractForm">
  <!-- 头部开始 -->
  <div id="contract_top">
   <table>
    <tr>
     <td align="right"><span>*</span>合同号: </td>
     <td style="font-family:Arial; text-decoration:underline;"><?php echo $contractid; ?></td>
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
   
   
   <?php
    $i = 1;
    foreach ($contract_array['pro_list'] as $key => $value){
    	
   ?>
   <div class="contract_pro_list">
    <ul>
     <li style="width:50px; "><?php echo $i; ?></li>
     <li style="width:300px;text-align:center; border:1px solid #ccc;height:25px;"><?php echo $value['pro_id']; ?>
     
        <button style="color:red;"><?php echo display_contract_state($value['state']); ?></button>
     </li>
     <li style="width:100px;text-align:center;border:1px solid #ccc;height:25px;"><?php echo $value['unit']; ?></li>
     <li style="width:100px;text-align:center;border:1px solid #ccc;height:25px;"><?php echo $value['maxdelivery'] == 0?"现货":$value['maxdelivery']." 周"; ?></li>
     <li style="width:100px;text-align:center;border:1px solid #ccc;height:25px;"><?php echo $value['quantity']; ?></li>
     
     <li style="width:150px;text-align:center;border:1px solid #ccc;height:25px;"><?php echo $value['pro_price']; ?></li>
     <li style="width:150px;text-align:center;border:1px solid #ccc;height:25px;">
     <?php $pro_price = $value['pro_price'] * $value['quantity']; echo number_format($pro_price,2,".","")?></li>
    </ul>
    
   </div>
   <?php 
   $i++;
    }
   
   ?>
     
   <ul>
     <li style="width:962px; border:1px solid #ccc;height:25px;line-height:25px;">
     总价（含17%增值税人民币价格）：
     <input type="text" id="contract_count" name="contract_count" style=" text-align:center;float:right; width:150px; border:0px " value="￥ <?php echo $contract_array['amount'] ?>" placeholder="0.00" readonly />
     </li>
    </ul>
  </div>


 
</div>
<?php
}
?>