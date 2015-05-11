$(function(){
	$("input").focus(function(){
		$(this).parent("div").addClass("loginFormIpt-focus");
	}).focusout(function(){
		$(this).parent("div").removeClass("loginFormIpt-focus");
	});
});

function register(){
	var phoneNumber = document.getElementById("phoneInput");
	var warnWord = document.getElementById("warnWord");
	var regx = /^\d{11}$/;
	var rs = regx.test(phoneNumber.value);
	if(rs === false){
		if(phoneNumber.value === ""){
			return false;
		}else{
			phoneNumber.parentNode.style.boxShadow = "0px 0px 5px red";
			$("#warnWord").empty().html("请输入正确的手机号").show();
			return false;
		}
	}else{
		
		phoneNumber.parentNode.style.boxShadow = "0px 0px 0px #fff";
		$("#warnWord").empty().hide();
		return true;
	}
	
}
//初始化页面


