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
