// JavaScript Document
$(function(){
	var $contract_list = $(".contract_list");
	
	$contract_list.each(function(index, element) {
		var $this = $(this);
		var $contractName = $this.find(".contract-name");
		var index = $this.index();
		
		$contractName.mousemove(function(){
			$(this).find(".contract-address").show();
		})
		$contractName.mouseleave(function(){
			$(this).find(".contract-address").hide(1);
		})
	});
	
	var $searchcontract_btn = $("#searchcontract_butn");
	$searchcontract_btn.click(function(){
		var $searchcontract = $("#searchcontract_id").val();
		var $ouContract = $(".outContract");
		if($searchcontract != ""){
			$.ajax({
				url:"functions/search_contract.php",
				data:{"searchcontract":$searchcontract},
				type:"get",
				dataType:"html",
				success: function(data){
					$ouContract.empty();
					$ouContract.html(data);	
				}
			});
		}
	});
	//修改合同产品状态
	var $contract_pro = $(".contract-pro-list").find(".contract-pro-list-all");
	var $contract_id = $("#contract_id_select").html();
	
	$contract_pro.each(function(index, element) {
        $this = $(this);
		$this.find(".state_button").click(function(){
			var $state = $this.find(".state_button_value").val();
			var $pro_id = $(".contract-pro-list").find(".pro_id").eq(index).html();
			
			if($state < 3){
				$state = parseInt($state) + 1;
				$.ajax({
					url:"functions/update_state.php",
					data:{"state":$state,"pro_id":$pro_id,"contract_id":$contract_id},
					type:"post",
					dataType:"json",
					success: function(data){
						if(data.error == 1){
							window.location.href=window.location.href;
						}
						if(data.error == 0){
							alert("修改失败");
						}
					}
					
				});
			}
		});
    });
});