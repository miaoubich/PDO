// If user clicks anywhere outside of the sign-in or sign-up, it will close
	
var greyDiv = document.getElementById('empty-grey-div');
var formSignIn = document.getElementById('form_signIn');
var formSignUp = document.getElementById('form_signUp');
var formForgotPass = document.getElementById('forgotpswd_form');

window.onclick = function(event){

	if (event.target == greyDiv){

		greyDiv.style.display = "none";
		formSignIn.style.display = "none";
		formSignUp.style.display = "none";
		formForgotPass.style.display = "none";
	}
}
