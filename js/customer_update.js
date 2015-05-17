// JavaScript Document
$(function(){
	var update_customer = $("#update_customer");
	var true_update = $("#true_update");
	update_customer.click(function(){
		var customerlist = $(".customerList");
		$("#waringInformation").find("span").empty();
		customerlist.find("input").attr("disabled",false);
		true_update.show();
		$(this).hide();
	}),true_update.click(function(){
		
		var customerid = $("#customer_id").val();
		var company_name = $("#company_name").val();
		var address = $("#address").val();
		var tell = $("#tell").val();
		var fax = $("#fax").val();
		var name = $("#name").val();
		var billing_address = $("#billing_address").val();
		
		if(company_name != "" && name !=""){
			
			$.ajax({
					url:"functions/update_customer.php",
					data:{"customer_id":customerid,"company_name":company_name,
					"address":address,"tell":tell,"fax":fax,"name":name,"billing_address":billing_address},
					type:"post",
					dataType:"json",
					success:function(data){
						if(data.error == 1){
							$(".customerList").find("input").attr("disabled",true);
							true_update.hide();
							update_customer.show();
							$("#waringInformation").find("span").html("客户编号： "+data.customer_id+" 修改成功");
						}else{
							$("#waringInformation").find("span").html("客户编号： "+$("#customer_id").val()+" 修改失败，请联系管理员");
							$(".customerList").find("input").attr("disabled",true);
							true_update.hide();
							update_customer.show();
						}
					}
			});
		}
	});
	var $searchcus_button = $("#searchcustomer_butn");
	$searchcus_button.click(function(){
		var $search_customer = $("#searchcustomer_id").val();
		if($search_customer != ""){
			$.ajax({
					url:"functions/search_all_customer.php",
					data:{"search":$search_customer},
					type:"post",
					dataType:"html",
					success:function(data){
						$("#customer_all_information").empty();
						$("#customer_all_information").html(data);
					}
			});
		}
	})
})