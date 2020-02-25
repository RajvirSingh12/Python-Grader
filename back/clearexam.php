<?php 
error_reporting(E_ERORR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors' , 1);
include "db.php";
//include "filter.php";
 $db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
$str_json = file_get_contents('php://input'); 
$decode = json_decode($str_json, true); //decode JSON

//if(isset($decode['clear'])) $clear = $decode['clear']; 

echo $decode;
$c=count($decode);

if ($c = 1 ){
  $tr= "TRUNCATE TABLE TeacherExam";
  ($t = mysqli_query ( $db,  $tr   ) )  or die ( mysqli_error ($db) );

//if($tr !== FALSE)
//{
//  ($t = mysqli_query ( $db,  $tr   ) )  or die ( mysqli_error ($db) );
//   echo("All rows have been deleted.");
//}
//else
//{
//   echo("No rows have been deleted.");
//}
} 
  
  
?>