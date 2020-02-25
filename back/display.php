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
$name=$_SESSION['name'];
$flag=false;

$tr= "TRUNCATE TABLE score";
($t = mysqli_query ( $db,  $tr   ) )  or die ( mysqli_error ($db) );

function insert($user, $ques, $ans, $spts, $fullpts, $comments, $match, $ansinfos, $db)
{
//insert

$s = "insert into score values ('$user', '$ques', '$ans', '$spts', '$fullpts', '$comments', '$match', '$ansinfos')";  
($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
}

$str_json = file_get_contents('php://input'); 
$decode = json_decode($str_json, true); //decode JSON

if(isset($decode['user'])) $userS = $decode['user'];
if(isset($decode['ques'])) $quesS = $decode['ques']; //store data in variable  
if(isset($decode['ans'])) $ansS = $decode['ans'];
if(isset($decode['spts'])) $sptsS = $decode['spts']; 
if(isset($decode['fullpts'])) $fullptsS = $decode['fullpts']; 
if(isset($decode['comments'])) $commentsS = $decode['comments'];
if(isset($decode['ansinfo'])) $ansinfo=$decode['ansinfo'];

echo "Grades Have been Released Now";
for($i=0;$i<count($userS);$i++){
  $user=$userS[$i];
  $ques=$quesS[$i];
  $ans=$ansS[$i];
  $spts=$sptsS[$i];
  $fullpts=$fullptsS[$i];
  $comments=$commentsS[$i];
  $ansinfos=$ansinfo[$i];
  //echo "$ansinfos<br>";
$a   =  "select * from gradeT where question = '$ques'" ;
  ($b = mysqli_query ( $db,  $a   ) )  or die ( mysqli_error ($db) );
while ( $c = mysqli_fetch_array ( $b , MYSQL_ASSOC) ) 
{ 
  $match=$c[ "answer" ];



insert($user, $ques, $ans, $spts, $fullpts, $comments, $match, $ansinfos, $db);
}
}


?>


