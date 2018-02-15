$(document).ready(function(){
	
	//Edit Profile Validation

	$('#user_name').focusout(function(event){
		var user_name = $('#user_name').val();
		if(user_name == ""){
			$('#user_name').css('border-color', 'red');
		}else{
			$('#user_name').css('border-color', 'green');
		}
	}); 

	$("#user_email").focusout(function(event){
		var user_email = $("#user_email").val();
		if(user_email == ""){
			$("#user_email").css("border-color", "red");
		}else{
			$('#user_email').css('border-color', 'green');
		}
	});

	$("#user_nickname").focusout(function(event){
		var user_nickname = $("#user_nickname").val();
		if(user_nickname == ""){
			$("#user_nickname").css("border-color", "blue");
		}else{
			$('#user_nickname').css('border-color', 'green');
		}
	});

	$("#user_dob").focusout(function(event){
		var user_dob = $("#user_dob").val();
		if(user_dob == ""){
			$("#user_dob").css("border-color", "blue");
		}else{
			$('#user_dob').css('border-color', 'green');
		}
	});

	$("#user_address").focusout(function(event){
		var user_address = $("#user_address").val();
		if(user_address == ""){
			$("#user_address").css("border-color", "blue");
		}else{
			$('#user_address').css('border-color', 'green');
		}
	});

	$("#user_state").focusout(function(event){
		var user_state = $("#user_state").val();
		if(user_state == ""){
			$("#user_state").css("border-color", "blue");
		}else{
			$('#user_state').css('border-color', 'green');
		}
	});

	$("#user_country").focusout(function(event){
		var user_country = $("#user_country").val();
		if(user_country == ""){
			$("#user_country").css("border-color", "blue");
		}else{
			$('#user_country').css('border-color', 'green');
		}
	});

	$("#user_phone").focusout(function(event){
		var user_phone = $("#user_phone").val();
		if(user_phone == ""){
			$("#user_phone").css("border-color", "blue");
		}else{
			$('#user_phone').css('border-color', 'green');
		}
	});//finish Edit profile validation

	//Change password validation
	$("#old_Pass").focusout(function(event){
		var old_Pass = $("#old_Pass").val();
		if(old_Pass == ""){
			$("#old_Pass").css("border-color", "red");
		}else{
			$('#old_Pass').css('border-color', 'green');
		}
	});

	$("#new_Pass").focusout(function(event){
		var new_Pass = $("#new_Pass").val();
		if(new_Pass == ""){
			$("#new_Pass").css("border-color", "red");
		}else{
			$('#new_Pass').css('border-color', 'green');
		}
	});

	$('#submit_new_pass').attr("disabled", true);

	$("#new_Pass2").focusout(function(event){
		var new_Pass2 = $("#new_Pass2").val();
		var new_Pass = $("#new_Pass").val();

		if(new_Pass2 == ""){

			$("#new_Pass2").css("border-color", "red");
			//$('#submit_new_pass').attr("disabled", true);

		}else if(new_Pass != new_Pass2){

			$("#new_Pass2").css("border-color", "red");
			document.getElementById("PassNotMatch").innerHTML="Password does not match!";
			//$('#submit_new_pass').attr("disabled", true);

		}else if(new_Pass == new_Pass2){

			$('#new_Pass2').css('border-color', 'green');
			document.getElementById("PassNotMatch").innerHTML="";
			$('#submit_new_pass').attr("disabled", false);
		}
	});
	//End password validation


});