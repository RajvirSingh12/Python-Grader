<?php include "conf.php";?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="login_front.js" type="text/JavaScript"></script>
</head>
<body>
<method="post" class="front">
<center><h2 style="color:blue";>Welcome to CS490</h2></center>   
<center>Username: <input name="username1" id="username" type="text" required autocomplete=off></center>  
<br>
<center>Password: <input name="password1" id="password" type="password" required autocomplete=off></center> 
<br>
<center><input type="button" onclick="Function1();" value="Send request"></center> 
<div id="ajaxID1"></div>
</html>         
