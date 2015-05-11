//控制前段输入
$(function(){
	$("#pro_id").blur(function(){

		var pValue = $(this).val();
		
		if(pValue.length<=0){
			
			$("div .text").empty();
			$("div .text").css("color","red");
			$(this).css("border-color","red");
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
	});
	
});