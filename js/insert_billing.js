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
	var $update_bill_btn = $("#update_bill_button");
	$update_bill_btn.click(function(){
		
		var insertType = $("#insertType");
		insertType.slideDown();
		var bill_insert_btn = $("#bill_insert_btn");
		bill_insert_btn.click(function(){
			var customer_id = $("#customer_id").html();
			var bill_name = $("#bill_name").val();
			var bill_address = $("#bill_address").val();
			var bill_tell = $("#bill_tell").val();
			var bill_bankName = $("#bill_bankName").val();
			var bill_bankNumber = $("#bill_bankNumber").val();
			var bill_itin = $("#bill_itin").val();
			if(bill_name != "" && bill_address !="" && bill_bankName != ""
			 && bill_bankNumber != "" && bill_itin != ""){
				 
				 $.ajax({
					url:"functions/insert_bill_info.php",
					data:{"customer_id":customer_id,"bill_name":bill_name,"bill_address":bill_address,
					"bill_tell":bill_tell,"bill_bankName":bill_bankName,"bill_bankNumber":bill_bankNumber,"bill_itin":bill_itin},
					type:"post",
					dataType:"html",
					success: function(data){
						var $waring = $("#waringInformation");
						var $enter_true = $("#enter_true");
						$waring.find("span").html(data);
						$enter_true.show();
						$enter_true.click(function(){
							window.location.reload();
						})
					}
				});
			}
		})
	});
});