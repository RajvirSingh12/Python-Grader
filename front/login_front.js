function Function1(){
	var Ajax;  
	try{
// Firefox, Safari
		Ajax = new XMLHttpRequest();    //allows to make Html request in javascript //plus helps you to change data with server
	} 
catch (e){// Internet Explorer 
		try{
		Ajax = new ActiveXObject("Msxml2.XMLHTTP");
		} 
catch (e) {
			try{
			Ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
 catch (e){// if error occurs 
				alert("OOPS!");
				return false;
			}}}
                                      
Ajax.onreadystatechange = function(){//receive data from server
	if(Ajax.readyState == 4){ //request finished and response is ready
	var ajaxDisplay = document.getElementById('ajaxID1');
	var res = Ajax.responseText;
 
  var stu_page="student_front.php";  
	var inst_page="instructor_front.php";
	var data=JSON.parse(res);
  if (data['authority']=="student") window.location.replace(stu_page);
	else if(data['authority']=="instructor") window.location.replace(inst_page);
  else ajaxDisplay.innerHTML = "<h3><center>Login Failed</center></h3>";
		}}
var name = document.getElementById('username').value; //getting username from html file
var pass = document.getElementById('password').value; //getting password from html file
if (name=="student"){
window.location.replace("https://web.njit.edu/~rs726/front/student_front.php");}
if(!pass||!name){  //checking values are null
alert("MISSING INFORMATION");
return false;
}	
  var passArray = {"name": name,"pass":pass}; 
	Ajax.open("POST", "https://web.njit.edu/~jw556/Cs490/middle.php", true); //POST, middle url 
	Ajax.send(JSON.stringify(passArray));
}
