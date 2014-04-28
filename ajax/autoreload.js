request = function(url, target, result) {

var changeListener; 
var xhr = new XMLHttpRequest();
changeListener = function() 
{
	if(xhr.readyState === 4)
{
	if(xhr.status == 200)
{
	target.innerHTML = xhr.responseText; 
} else
 { 
 	target.innerHTML = "<p>Something didn't work right.</p>"; } } 
 else { 
 	target.innerHTML = "<p>Hold Up...</p>"; } }; 
 	xhr.open("GET", url, true); 
 	xhr.onreadystatechange = changeListener; xhr.send(result); }; 
 	changeCart = function() { 
 		var target; 
 		target = document.getElementById("mybasket"); 
 		request("display_added_product_number.php", target); };

 	window.onload= changeCart;
  // if(cart) // { // cart.addEventListener("click", changeCart); // } changeCart(); }; window.onload = pageLoaded;