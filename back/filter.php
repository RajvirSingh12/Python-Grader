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
if(isset($decode['keyword'])) $keyword = $decode['keyword']; 
if(isset($decode['levels'])) $levels = $decode['levels']; 
if(isset($decode['topicSort'])) $topicSort = $decode['topicSort'];
//echo $topicSort;
if ($keyword ==""){
$s = "select * from gradeT where level = '$levels' and topic='$topicSort' and question LIKE '%$keyword%'" ;
}
if ($keyword !=""){
$s="select * from gradeT where question LIKE '%$keyword%'";
}
($t = mysqli_query ( $db,  $s   ) )  or die ( mysqli_error ($db) );
//$num = mysqli_num_rows ($t) ;

//$e="";
$y=array();
while ( $r = mysqli_fetch_array ( $t, MYSQL_ASSOC) ) 
  {
  $question = $r[ "question" ];
  $ID= $r[ "ID" ];
  //$question="hi";
  //$e.=$question;
  $y[]= $question;
  $y[]=$ID;

 }
//array_push($y,"$question");
//$y[]=$e;
$array=json_encode($y);
echo $array;
//$array= json_encode($y);
//$send = json_encode ($array);
//echo ($send);
//jw556 
//Nasty123

//https://web.njit.edu/~jw556/Cs490/front/login.html
//instructor 
?>

