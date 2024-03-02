const pw_length = 6;//minimum password length
const username = document.getElementById('new_uname');
const password = document.getElementById('new_pword');
const confirm_password = document.getElementById('confirm_new_pword');
const submit_button = document.getElementById('submit_new_account');

let valid_uname = false;
let valid_pword = false;

username.addEventListener('input', function(event){
	const text = this.value;
	if(text.trim() != '') valid_uname = true;
	else valid_uname = false;
	check_validity();
});

function password_check_event_handler(event){
	const pw_text = password.value;
	const pw_text_length = pw_text.length;
	const confirm_pw_text = confirm_password.value;

	if(pw_text_length >= pw_length && pw_text == confirm_pw_text) valid_pword = true;
	else valid_pword = false;
	check_validity();

}

password.addEventListener('input', password_check_event_handler);
confirm_password.addEventListener('input', password_check_event_handler);

function check_validity(){
	if(valid_uname && valid_pword){
		submit_button.disabled = false;		
	}else{
		submit_button.disabled = true;
	}
}

function toggle_signup_form(){
	event.preventDefault();
	console.log("function called");
	var login = document.getElementById("login_form");	
	var signup = document.getElementById("signup_form");	
	console.log("vars set");

	if (signup.style.display === "block") {
		console.log("none");
		signup.style.display = "none";
		login.style.display = "block";
	}else{
		console.log("block");
		signup.style.display = "block";
		login.style.display = "none";
	}
}

