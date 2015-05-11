<?php
include '../include_fns.php';
@$searchpro_id = $_GET['search_data'];
@$searchType = $_GET['search_type'];
if($searchpro_id != "" && !isset($searchType)){
	$data = array();
	$conn = db_connect();
	$searchpro_id = $conn->real_escape_string(trim($searchpro_id));
	$query = "select * from product_info
			  where  pro_id like '%".$searchpro_id."%'
			  or brand = '".$searchpro_id."'";
	$result = $conn->query($query);
	if($result->num_rows >0){
	while($search_array = $result->fetch_array()){
?>
			<li>
			    <div class="outpro_info">
			     <form action="#" onSubmit="return false">
			     <table >
			      <tr>
			      <td align="right">序号：</td>
			       <td align="center" ><span style="font-size:16px; color:red;"><b><?php echo $search_array['id'] ?></b></span></td>
			      </tr>
                  <tr><td colspan="2" align="center"><div class="prompting"></div></td></tr>
			      <tr>
			       <td align="right">产品型号:</td>
			       <td><input type="text" name="pro_id" value="<?php echo $search_array['pro_id'] ?>" disabled /></td>
			      </tr>
			      <tr>
			       <td align="right">产品名称:</td>
			       <td><input type="text" name="pro_name" value="<?php echo $search_array['name'] ?>"  class="pro_name" disabled /></td>
			      </tr>
			      <tr>
			       <td align="right">计量单位:</td>
			       <td>
			       		<select name="unit" disabled>
			       		 <option value="<?php echo $search_array['unit'] ?>"><?php echo $search_array['unit'] ?></option>
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
	}else{
		echo "<p>没有搜索结果。。。</p>";
	}

	
	
}
if($searchType != "" && !isset($searchpro_id)){
	$data = array();
	$conn = db_connect();
	$searchpro_id = $conn->real_escape_string(trim($searchType));
	$query = "select * from product_info
			  where  pro_id like '%".$searchpro_id."%'";
	$result = $conn->query($query);
	if($result->num_rows > 0){
		$i = 0;
		while($search_array = $result->fetch_assoc()){
			$data[$i] = $search_array;
			$data[$i]['pro_unit'] = $data[$i]['unit'];
			$i++;
		}
		$data = json_encode($data);
			
		echo $data;
	}else{
		echo '{"error":0}';
	}
}
$conn->close();
?>