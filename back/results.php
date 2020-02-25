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

function insert($Name, $id, $real, $Question, $Answer, $word, $input, $output, $got, $points, $db)
{
//insert

$s = "insert into StudentExam values ('$Name', '$id', '$real', '$Question', '$Answer', '$word', '$input', '$output', '$got','$points')";  
($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
}
//echo $decode;
$Name=$decode[0];
//echo "$decode.length";
for($i=1;$i<count($decode);$i++){ 
  //echo "look nigha $i<br>";
  //echo "<br>";
  if(($i%2) == 0){
  //echo "This index $i";
  //echo "<br>";
  //echo "This ID $decode[$i]<br>";
  $id=$decode[$i];
  $Answer=$decode[$i-1];
  //echo "<br>";
  $a="select * from TeacherExam where ID = '$decode[$i]'"; 
  //$i++;
($b = mysqli_query ( $db,  $a  ) )  or die ( mysqli_error ($db) );
while ( $r = mysqli_fetch_array ( $b, MYSQL_ASSOC) )   
  {
    $Question = $r[ "question" ] ;
    $real = $r[ "answer" ] ;
    $points = $r[ "points" ] ;
    //$word = $r[ "word" ];
} 

 $u="select * from gradeT where ID = '$decode[$i]'"; 
  //$i++;
($v = mysqli_query ( $db,  $u  ) )  or die ( mysqli_error ($db) );
while ( $p = mysqli_fetch_array ( $v, MYSQL_ASSOC) )   
  {
    $word = $p[ "word" ];
    $input = $p[ "input" ];
    $output = $p[ "output" ];     
} 
$got=NULL;
//function insert($Name, $id, $real, $Question, $Answer, $got, $points, $db)
//{
////insert
//
//$s = "insert into StudentExam values ('$Name', '$id', '$real', '$Question', '$Answer', '$got','$points')";  
//($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
//}

insert($Name, $id, $real, $Question, $Answer, $word, $input, $output, $got, $points, $db);
  
  }
  
}
echo "<center><h3>Your Exam has been Submitted</h3></center>";
?>