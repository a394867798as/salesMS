<?php
include '../include_fns.php';
$search = $_POST['search'];
$query = "select * from customer_information
		  where customer_id like '%".$search."%'
		  or company_name like '%".$search."%' ";

$customer_array = get_customer_show_array($query);
$count = count($customer_array);
$i=1;
if(isset($customer_array['error'])){
	echo "<h4>共搜索到 <span style='color:red;'>0</span>条信息</h4>";
}else{
?>
<h4>共搜索到 <span style="color:red;"><?php echo $count;?></span>条信息</h4>
 <div class='customerList' style='background-color:#FFF; border:1px solid #ccc; margin-top:10px;'>
         <ul >
          <li style="width:50px;">编号</li>
          <li style="width:270px;">公司名称</li>
          <li style="width:380px;">地址</li>
          <li style="width:50px;">联系人</li>
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
          <li style="width:50px;"><?php printf("%s",get_search_value($key,$search)); ?></li>
          <li style="width:270px;"><?php printf("%s",get_search_value($value['company_name'],$search));?></li>
          <li style="width:380px;"><?php printf("%s",select_char_length($value['address'], 25));?></li>
          <li style="width:50px;"><?php printf("%s",$value['name']);?></li>
          <li style="width:200px;">
          
	         <div class="coustomer-button-list" > 
	           <a href='http://127.0.0.1/salesMS/?action=修改客户信息&&customerid=<?php echo $key; ?>'>查看详细信息</a>
	         </div>
	     </li>
         </ul>
        </div>
<?php 
		$i++;
        }
   }
?>