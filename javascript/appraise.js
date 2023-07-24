//this script takes the list of ebay queries built in display_games.php based on the games selected for display
//it executes when the 'appraise games' btn is clicked

//var appraise_btn = document.getElementById("appraise_btn");
//
//appraise_btn.addEventListener("click", function(){
//	var xhr = new XMLHttpRequest();
//
//	var url = "../php/display_games.php";
//	var params = "ebay_list=" + encodeURIComponent(scrape_list);
//	
//	xhr.open("POST", url, true);
//	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//
//	xhr.onreadystatechange = function(){
//		if(xhr.readyState == 4 && xhr.status == 200){
//			console.log(xhr.responseText);
//		}
//	};
//	
//	xhr.send(params);
//});
//
////when a list of games is generated enable the appraisal button
//function enable_appraisal(){
//	var appraise_btn = document.getElementById("appraise_btn");
//	appraise_btn.disabled = false;
//}
