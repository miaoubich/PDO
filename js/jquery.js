$(document).ready(function(){

	//Sign-Up validation

	$('#u_mail').blur(function(){

		 var email = $(this).val();

		 $.ajax({
			url:'check.php',
			method:"POST",
			data:{user_email:email},
			success:function(data){
				if(data != '0'){
					$('#availability').html('<b><span style="color:red;">This email is Already used!</span></b>');
					$('#u_signup').attr("disabled", true);
			    }
			    else if(email === ''){

			    	$('#availability').html('<b><span style="color:red;">Please enter your e-mail!</span></b>');
			    	$('#u_signup').attr("disabled", true);

			    }
			    else if(data == '0'){
			    	$('#availability').html('<b><span></span></b>');
			    	
					$('#u_signup').attr("disabled", false);
			    }
			 }
		})
	});

	$('#u_mail').focusout(function(){

		var email1 = $('#u_mail').val();
		//var r =/\w+@\w+\.+\w/;
		var r = /^([A-Za-z0-9_\-\.]){1,}\@([A-Za-z0-9_\-\.]){1,}\.([A-Za-z]){2,4}$/;

		if(email1 === ""){
			$('#Notavailable').htmil('<div></div>');
			
		}else if(r.test(email1) == false){

			$('#Notavailable').html('<b><div style="color:red;">Not Valid Email!</div></b>');
			$('#u_signup').attr("disabled", true);
			
		}else if(r.test(email1)){

			$('#Notavailable').html('<div></div>');
			$('#u_signup').attr("disabled", false);
		}
	});

	$('#u_name').focusout(function(){

		var name = $(this).val();
		
		if(name==""){
			$('#emptyName').html('<b><div style="color:red;">Enter your Name please!</div></b>');
			$('#u_mail').attr("disabled", true);

		}else{
			$('#emptyName').html('<b><span style="color:red;"></span></b>');
			$('#u_mail').attr("disabled", false);
		}
	});

	//signIn for forgoten password form
	$('.btn-login').click(function(){
		$('#form_signIn').fadeIn('slow');
		//$('#empty-grey-div').fadeIn('slow');
		$('#forgotpswd_form').fadeOut('slow');
	});

	//signUn for forgoten password form
	$('.btn-logup').click(function(){
		$('#form_signUp').fadeIn('slow');
		//$('#empty-grey-div').fadeIn('slow');
		$('#forgotpswd_form').fadeOut('slow');
	});

	//login popup form
	$('#btn-login').click(function(){
		$('#form_signIn').fadeIn('slow');
		$('#empty-grey-div').fadeIn('slow');
		$('#forgotpswd_form').fadeOut('slow');
	});

	//close login popup form
	$('#close').click(function(){
		$('#form_signIn').fadeOut('slow');
		$('#empty-grey-div').fadeOut('slow');
	});

	//logup popup form
	$('#btn-logup').click(function(){
		$('#form_signUp').fadeIn('slow');
		$('#empty-grey-div').fadeIn('slow');
		$('#forgotpswd_form').fadeOut('slow');
	});

	//close logup popup form
	$('#closeUp').click(function(){
		$('#form_signUp').fadeOut('slow');
		$('#empty-grey-div').fadeOut('slow');
	});

	//forgot password popup form
	$('#forgot_pswd').click(function(){
		$('#forgotpswd_form').fadeIn('slow');
		$('#form_signIn').fadeOut('slow');
	});

	//close forgot password popup form
	$('#closeForgotForm').click(function(){
		$('#forgotpswd_form').fadeOut('slow');
		$('#empty-grey-div').fadeOut('slow');
	});

	//Logout popup form
	$('#signedIn').click(function(){
		$('#signOut_form').fadeIn('slow');
		$('#empty-grey-div').fadeIn('slow');
	});

	//close Logout popup form
	$('#closeSignOutForm').click(function(){
		$('#signOut_form').fadeOut('slow');
		$('#empty-grey-div').fadeOut('slow');
	});

	//close newslatter popup form
	$('#crossForm').click(function(){
		$('#pop-up').fadeOut('fast');
	});

	//show-hide password in login form
	$('#show_password').on('click', function(){  
		var passwordField = $('#password');  
		var passwordFieldType = passwordField.attr('type');
		
		if(passwordField.val() != ''){
			if(passwordFieldType == 'password'){  
				passwordField.attr('type', 'text');  
				$(this).text('Hide Password');  
			}
			else{  
				passwordField.attr('type', 'password');  
				$(this).text('Show Password');  
			}
		}
		else{
		   alert("Please Enter Password");
		}
	});

	
	//Contact Form validation
	$('#contact_name').focusout(function(){
		var contact_name = $('#contact_name').val();

		if(contact_name == ''){
			$('#submitContact').attr('disabled', true);
			$('#Empty_name').html('<span>Please enter your name.</span>');

		}else{
			$('#submitContact').attr('disabled', false);
			$('#Empty_name').html('<span></span>');
		}

	});

	$('#contact_tel').blur(function(){
		var contact_tel = $('#contact_tel').val();

		if(contact_tel == ''){
			$('#submitContact').attr('disabled', true);
			$('#Empty_tel').html('<span>Please enter your telephone number.</span>');

		}else{
			$('#submitContact').attr('disabled', false);
			$('#Empty_tel').html('<span></span>');
		}

	});

	$('#contact_email').blur(function(){
		var contact_email = $('#contact_email').val();

		if(contact_email == ''){
			$('#submitContact').attr('disabled', true);
			$('#Empty_email').html('<span>Please enter your e-mail address.</span>');

		}else{
			$('#submitContact').attr('disabled', false);
			$('#Empty_email').html('<span></span>');
		}

	});

	//Message Sent Div
	$('#sent_message_div').click(function(){
		$('#sent_message_div').fadeOut(2000);
	});

	//reset password validation
	$('#password2').focusout(function(){
		
		var pass1 = $('#password1').val();
		var pass2 = $('#password2').val();

		if(pass1 != pass2){
			$('#submitpass').attr('disabled', true);
			$('#passwordnotmatch').html('<span>Password does not match!</span>');

		}else{
			$('#submitpass').attr('disabled', false);
			$('#passwordnotmatch').html('<span></span>');
		}
	});

});

