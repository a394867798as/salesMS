//控制前段输入
$(function(){
	
	update_pro();
	function update_pro(){
	var $outForm = $(".outForm");//产品表单
	var $outpro_li= $outForm.find("li");//单向产品表单
	$outpro_li.each(function(index) {
        var $this = $(this);
		var $button = $this.find("button");
		//当鼠标移入产品所有动作
		$this.mousemove(function(){
			$button.eq(0).show();
			$this.find("div").css("box-shadow","0 0 5px #0c9");
			
		}),$button.eq(0).click(function(){
				$this.find(".outpro_info .prompting").empty();
				$button.eq(1).show();
				$this.find("input").attr("disabled",false);
				$this.find("select").attr("disabled",false);
		}),$button.eq(1).click(function(){
					
					var pro_id = $this.find(".outpro_info input").eq(0).val();
					var pro_name = $this.find(".outpro_info input").eq(1).val();
					var pro_unit = $this.find(".outpro_info select").eq(0).val();
					var id = $this.find(".outpro_info b").html();
					if(pro_id != "" && pro_name != ""){
						$.ajax({
							url:"functions/update_proinfo.php",
							data:{"pro_id":pro_id,"id":id,"pro_name":pro_name,"pro_unit":pro_unit},
							type:"post",
							dataType:"text",
							success: function(data){
								if(data == 1){
									$this.find(".outpro_info .prompting").html("修改成功");
									$this.find(".outpro_info .prompting").css("color","#0c9","border","1px silod #fff");
									$button.eq(1).hide();
									$this.find("input").attr("disabled",true);
									$this.find("select").attr("disabled",true);
								}else{
									$this.find(".outpro_info .prompting").html("修改失败");
									$this.find(".outpro_info .prompting").css("color","red","border","1px silod #fff");
								}
							}
						});
					}
		});
			
		
	//当鼠标离开
	$outpro_li.mouseleave(function(){
		$this.find("button").hide();
		$this.find("div").css("box-shadow","0 0 5px #999");
		$this.find("input").attr("disabled",true);
		$this.find("select").attr("disabled",true);
	});
	});
	}
	//搜索产品功能
	
	$searchpro_btn = $("#searchpro_butn");
	var $outForm = $(".outForm");//产品表单
	var $outpro_li= $outForm.find("li");//单向产品表单
	
	$searchpro_btn.click(function(){
		$searchpro_id = $("#searchpro_id");
		$searchpro_val = $searchpro_id.val();
		
		if($searchpro_id.val() != ""){
			$.ajax({
				url:"functions/search_proinfo.php",
				data:{"search_data":$searchpro_val},
				type:"get",
				dataType:"html",
				success: function(data){
					$outForm.empty();
					$outForm.eq(0).append("<h2>查询结果</h2><ul>"+data+"</ul>");
					update_pro();
				}
			})
		}
	});
	
	
});