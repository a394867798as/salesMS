// JavaScript Document
$(function(){
	$("#cell_phone").blur(function(){

		var cell_phone = $(this).val();
		
		if(cell_phone.length<11){
			
			$("div .text").empty();
			$("div .text").css("color","red");
			$(this).css("border-color","red");
			$("div .text").html("请输入正确的11位手机号");
		}else{
			$.ajax({
				url:"functions/insert_account.php",
				data:{"cell_phone":cell_phone},
				type:"post",
				dataType:"text",
				success: function(data){
					
					if(data == "0"){
						$("div .text").empty();
						$("div .text").css("color","red");
						$("#cell_phone").css("border-color","red");
						$("div .text").html("员工手机号已经存在");
					}else if(data=="1"){
						
						$("div .text").empty();
						$("div .text").css("color","#0c9");
						$("#cell_phone").css("border-color","#0c9");
						$("div .text").html("OK");
					}
				}
			});
		}
	});
	var accountBtn = $("#account_btn");
	accountBtn.click(function(){
		var cell_phone = $("#cell_phone").val();
		var starff_name = $("#starff_name").val();
		var postion = $("#postion").val();
		if(cell_phone !="" && starff_name != "" && postion !=""){
			$.ajax({
				url:"functions/insert_account.php",
				data:{"cell_phone":cell_phone,"starff_name":starff_name,"postion":postion},
				type:"post",
				dataType:"html",
				success: function(data){
					alert(data);
					var $warring = $("#waringInformation");
					$warring.find("span").html(data);
				}
			});
		}
	});
});