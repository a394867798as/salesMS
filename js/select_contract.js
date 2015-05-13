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
});