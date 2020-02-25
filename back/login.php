<?php 
include "db.php";
 $db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
//print "Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project ); 

$str_json = file_get_contents('php://input'); 
$decode = json_decode($str_json, true); //decode JSON
if(isset($decode['name'])) $name = $decode['name']; //store data in variables   
if(isset($decode['pass'])) $pass = $decode['pass'];
//print "$name<br>$pass"; //testing
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
password_verify($pass, $hashed_password);
$s="select * from examm where name = '$name' and pass = '$pass'"; 
//print "<br><br> $s";//testing
 
 
($t = mysqli_query ( $db,  $s   ) )  or die ( mysqli_error ($db) ); 
$num = mysqli_num_rows ($t) ; 
//echo "<br>The number of rows for $name is $num<br>"; 
$total_row = mysqli_num_rows($t);
//echo "<br><br>$total_row<br><br>"; //testing
if ($total_row == 1) {
   while ($c = mysqli_fetch_array ( $t, MYSQL_ASSOC)){
   $authority = $c["authority"];
   }
   if( $authority=="student"){
     $row = mysqli_fetch_assoc($t);
     $send = json_encode('21');
     echo ($send); //send back message
}
  elseif ($authority=="instructor"){
     $send = json_encode('11');
     echo ($send); //send back message
   }
if ($total_row != 1){
   $send = json_encode('DATA BASE REJECT');
   echo ($send); //send back message
}
}

?>
