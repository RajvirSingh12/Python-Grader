<?php 
session_start();
error_reporting(E_ERORR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors' , 1);
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

echo "this is $response";
//$name=$_SESSION['name'];
//$flag=false;
//
//$str_json = file_get_contents('php://input'); 
//$decode = json_decode($str_json, true); //decode JSON
//
//if(isset($decode['user'])) $user = $decode['user'];
//if(isset($decode['ques'])) $ques = $decode['ques']; //store data in variable  
//if(isset($decode['ans'])) $ans = $decode['ans'];
//if(isset($decode['spts'])) $spts = $decode['spts']; 
//if(isset($decode['fullpts'])) $fullpts = $decode['fullpts']; 
//if(isset($decode['comments'])) $comments = $decode['comments'];
//
//
//echo"<br>user is: $name<br>";
//
//function insert($user, $ques, $ans, $spts, $fullpts, $comments, $db)
//{
////insert
//
//$s = "insert into score values ('$user', '$ques', '$ans', '$spts', '$fullpts', '$comments')";  
//($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
//}
////$grade =  GET("grade", $flag) ; echo"<br>grade is: $grade<br>";
////$comment =  GET("comment", $flag) ; echo"<br>comments made: $comment<br>";
////$account =  GET("account", $flag) ; echo"<br>account number is: $account<br>";
//


?>


