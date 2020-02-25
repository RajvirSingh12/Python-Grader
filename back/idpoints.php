<?php
error_reporting(E_ERORR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors' , 1);
include "db.php";
 $db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
mysqli_select_db( $db, $project ); 

$str_json = file_get_contents('php://input'); 
$decode = json_decode($str_json, true); 

function insert($Question, $Answer, $level, $topic, $id, $points, $db)
{

$s = "insert into TeacherExam values ( '$Question', '$Answer', '$level', '$topic', '$id', '$points')";
($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );

}
//echo "this is $decode";
for($i=0;$i<count($decode);$i++){
  if($decode[$i]%2==0){
   $id= $decode[$i];
  }
  if($decode[$i]%2 !=0 ){
    $points= $decode[$i];
  }
  
$a="select * from gradeT where ID = '$id'";  
($b = mysqli_query ( $db,  $a   ) )  or die ( mysqli_error ($db) );
while ( $r = mysqli_fetch_array ( $b, MYSQL_ASSOC) ) 
  {
    $Question = $r[ "question" ] ;
    $Answer = $r[ "answer" ] ;
    $level = $r[ "level" ] ; 
    $topic = $r[ "topic" ] ; 
   // $points = $r[ "points" ] ; 
}    
}
insert($Question, $Answer, $level, $topic, $id, $points, $db) 

?>