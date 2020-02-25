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
//print "Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project ); 

$str_json = file_get_contents('php://input'); 
$decode = json_decode($str_json, true); 

//echo $decode;

$x=array();
$y=array();

$s = "select * from StudentExam where name='$decode'";
($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
while ( $r = mysqli_fetch_array ( $b, MYSQL_ASSOC) ) 
  {
    $Question = $r[ "question" ] ;
    $Answer = $r[ "answer" ] ;
    $x[]=$Question;
    $y[]=$Answer;
}    

echo $x;
echo $y;
?>