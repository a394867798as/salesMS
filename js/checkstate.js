// JavaScript Document
function GetRequest() {
  	
	  var url = location.search; //获取url中"?"符后的字串
	   var theRequest = new Object();
	   if (url.indexOf("?") != -1) {
		  var str = url.substr(1);
		  strs = str.split("&&");
		  for(var i = 0; i < strs.length; i ++) {
			 theRequest[strs[i].split("=")[0]]=(strs[i].split("=")[1]);
		  }
	   }
	   
	   return theRequest;
	   
	}
$(function(){
	var Request = new Object();
	Request = GetRequest();
	if(Request["state"] !== ""){
		//转换JSON
		var $state = decodeURI(Request["state"]);//转换url编码
		$state = eval("("+$state+")");
		//分别获取json的键和值
		for(var i in $state){
			$("#"+i).val($state[i]);
		}
		$("#contract_id").css({"border":"1px solid red","color":"red"});
		$("#contract_id").blur(function(){
			if($(this).val() !== $state.contract_id){
				$("#contract_id").css({"border":"1px solid green","color":"green"});
			}
		});
	}
});