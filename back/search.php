<?php
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
//if(isset($decode['Question'])) $Question = $decode['Question']; //store data in variable  
//if(isset($decode['Answer'])) $Answer = $decode['Answer'];
if(isset($decode['keyword'])) $keyword=$decode['keyword'];
//if(isset($decode['levels'])) $levels = $decode['levels']; 
//if(isset($decode['topicSort'])) $topicSort = $decode['topicSort'];
//echo $topicSort;



echo $keyword;
//$array= json_encode($y);
//$send = json_encode ($array);
//echo ($send);
//jw556 
//Nasty123

//https://web.njit.edu/~jw556/Cs490/front/login.html
//instructor 
?>
