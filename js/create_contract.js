// JavaScript Document
function divClose(){
		var oDiv1 = document.getElementById("insertType");
		oDiv1.style.display = "none";
		
}
		document.onkeydown = function (ev){
		var oDiv1 = document.getElementById("insertType");
		
		var oEvent = ev || event;
		if(oEvent.keyCode==27 ){
			oDiv1.style.display = "none";
	
		}
	}


$(function(){
	
	
	
	//检测客户是否存在，若存在直接获取信息
	var $company = $("#buy_company");
	$company.blur(function(){
		var $companyname = $(this).val();
		
		if($companyname.length >=4){
		$(this).siblings(".waringText").empty();	
		$.ajax({
			url:"functions/search_customer.php",
			data:{"companyname":$companyname},
			type:"get",
			dataType:"json",
			success: function(data){
				if(data.error==0){
					$company.siblings(".waringText").empty().html("新用户，请输入客户信息");
				}else{
					$company.val(data[0].company_name);
					$("#buy_address").val(data[0].address);
					$("#buy_tell").val(data[0].tell);
					$("#buy_fax").val(data[0].fax);
					$("#buy_name").val(data[0].name);
					$("#buy_billing").val(data[0].billing_address);
				}
			}
		});
		}else{
			$(this).siblings(".waringText").empty().html("请输入有效的公司名称");
		}
	});
	//获取每一种产品的单价和数量，计算出总价
	var $contractProList = $(".contract_pro_list");
	var $contractProListUl = $contractProList.find("ul");
	var pro_count = $contractProListUl.find(".pos").length;
	$("#pro_count").val(pro_count);
	var $contract_count = $("#contract_count");
	//计算总价 
	function celactionList(e){
		var count = e.length;
		var sum = 0;
		for(var i=0; i<count; i++){
			if(e.eq(i).val() === ""){
				
				sum = sum + 0;
			}else{
				var value = parseInt(e.eq(i).val());
				sum = sum + value;
			}
		}
		sum = new Number(sum);
		return sum.toFixed(2);
	}
	
	$contractProListUl.each(function(index, element) {
        var $this = $(this);
		var $contractQty = $this.find(".qty");
		var $contractUprice = $this.find(".Uprice");
		var $extension = $this.find(".extension");
		var $contractType = $this.find(".type");
		var $unit = $this.find(".unit");
		var $typecheck = $this.find("a");
		var index = $this.index();
		
		$contractQty.blur(function(){
			var $qtyValue = $(this).val();
			
			if($qtyValue !== ""){
				$qtyValue = parseInt($qtyValue);
				
				$(this).val($qtyValue);
				
		
				var $upriceValue = $contractUprice.val();
				
				if($qtyValue !== "" && $upriceValue !== "" ){
					var sum = $qtyValue * $upriceValue ;
					var sumVal = new Number(sum);
					
					$extension.val(sumVal.toFixed(2));
				}
				
			}else{
				$extension.val("0.00");
			}
			$contract_count.val(celactionList($contractProListUl.find(".extension")));
		});
		$contractUprice.blur(function(){
			
			var $upriceValue = $(this).val();
			
			
			if($upriceValue !== ""){
				var $upriceValue = new Number($upriceValue);
				var $upriceValue = $upriceValue.toFixed(2);
				$(this).val($upriceValue);
				var $qtyValue = $contractQty.val();
		
				
				
				if($qtyValue !== "" && $upriceValue !== "" ){
					var sum = $qtyValue * $upriceValue ;
					var sumVal = new Number(sum);
					
					$extension.val(sumVal.toFixed(2));
				}
				
			}else{
				$extension.val("0.00");
			}
			$contract_count.val(celactionList($contractProListUl.find(".extension")));
		});
		$contractType.blur(function(){
			var $type = $(this).val();
			if($(this).val() !== ""){
				$.ajax({
				url:"functions/search_proinfo.php",
				data:{"search_type":$type},
				type:"get",
				dataType:"json",
				success: function(data){
					if(data.error == 0){
						$unit.eq(index).empty();
						$contractProListUl.find("a").eq(index).empty().css("color","red").html("*添加");
					}else{
						$contractProListUl.find("a").eq(index).css("color","green").html("OK");
						$contractProListUl.find(".type").eq(index).val(data[0].pro_id);
						$contractProListUl.find(".unit").eq(index).val(data[0].pro_unit);
					}
				}
				});
			}else{
				$contractProListUl.find("a").eq(index).empty();
			}
		});
		$typecheck.click(function(){
			
			var oDiv1 = document.getElementById("insertType");
			var $typeA = $(this).html();
			
			if($typeA !== "" && $typeA === "*添加"){
				$("#waringInformation span").empty();
				oDiv1.style.display = "block";
			
				$("#pro_id").val($contractProListUl.find(".type").eq(index).val());
				checkProidValue();
				$("#insertProButton").click(function(){
				var pro_id = $("#pro_id").val();
				var pro_name = $("#pro_name").val();
				var brand = $("#brand").val();
				var $unit = $("#unit").val();
				if(pro_id !== ""){
					$.ajax({
						url:"functions/insert_proinfoContract.php",
						data:{"pro_id":pro_id,"pro_name":pro_name,"brand":brand,"unit":$unit},
						type:"post",
						dataType:"json",
						success: function(data){
							if(data.error === 1){
								$contractProListUl.find("a").eq(index).css("color","green").html("OK");
								$("#waringInformation span").html("型号:"+pro_id+"</br>插入成功</br>请返回继续添加产品</br>(or ESC)");
							}
							if(data.error === 2){
								$("#waringInformation span").html("型号:"+pro_id+"</br>插入失败");
							}
							if(data.error === 3){
								$("#waringInformation span").html("型号:"+pro_id+"</br>已经存在");
							}
							
						}
					});
				}
			});
			}
		})
		
    });
	function checkProidValue(){
		var pValue = $("#pro_id").val();
		
		if(pValue.length<=0){
			
			$("div .text").empty();
			$("div .text").css("color","red");
			$("#pro_id").css("border-color","red");
			$("div .text").html("请输入产品型号");
		}else{
			$.ajax({
				url:"functions/insert_proinfo.php",
				data:{"pro_id":pValue},
				type:"post",
				dataType:"text",
				success: function(data){
					
					if(data == "0"){
						$("div .text").empty();
						$("div .text").css("color","red");
						$("#pro_id").css("border-color","red");
						$("div .text").html("产品型号已存在");
					}else if(data=="1"){
						
						$("div .text").empty();
						$("div .text").css("color","#0c9");
						$("#pro_id").css("border-color","#0c9");
						$("div .text").html("OK");
					}
				}
			});
		}
	}
	
});