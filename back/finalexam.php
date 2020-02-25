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
$decode = json_decode($str_json, true); //decode JSON
//echo $response[0];

if(isset($decode['ques'])) $ques = $decode['ques']; //store data in variable 
if(isset($decode['pts'])) $pts = $decode['pts'];



function insert($question, $answer, $level, $topic, $ID, $points, $db)
{
//insert
$a = "insert into TeacherExam values ( '$question', '$answer', '$level', '$topic', '$ID', '$points')";  
//echo "<br>SQL insert statement is: $s "; 
($j = mysqli_query( $db,  $a ) ) or die( "<br>SQL error: " . mysqli_error($db) );
//echo "<br>SQL insert TT statement was transmitted for execution.<br>"; 
//echo $output;
}

for ($i=0;$i<count($ques);$i++){
$ID=$ques[$i];
$points = $pts[$i];

//echo $points;


$s="select * from gradeT where ID = '$ID'";  //"select * from gradeT where level = '$levels' and topic='$topicSort'"
($t = mysqli_query ( $db,  $s   ) )  or die ( mysqli_error ($db) );
while ( $r = mysqli_fetch_array ( $t, MYSQL_ASSOC) ) 
  {
    $question = $r[ "question" ] ;
    $answer = $r[ "answer" ] ;
    $level = $r[ "level" ] ; 
    $topic = $r[ "topic" ] ; 
   // $points = $r[ "points" ] ; 
    
} 


insert($question, $answer, $level, $topic, $ID, $points, $db);  


}
$f   =  "select * from TeacherExam " ;
  ($g = mysqli_query ( $db,  $f   ) )  or die ( mysqli_error ($db) );
  echo "<br>Exam<br><br>";
  echo "<table     border=2  width = 120% >" ;
    echo "<tr>" ; 
    echo "<td>question</td>" ;
    echo "<td>answer</td>";
    echo "<td>level</td>"; 
    echo "<td>topic</td>";
    echo "<td>points</td>";
    //echo "<td>current</td>"; 
    //echo "<td>recent</td>";
    //echo "<td>plaintext</td>"; 
    echo "</tr>" ;
    echo "<style>tr:nth-child(even) {background-color: #add8e6;}</style>" ;
    $L=array(); //NEW
  while ( $h = mysqli_fetch_array ( $g, MYSQL_ASSOC) ) 
  {
    $question1 = $h[ "question" ] ;
    $answer1 = $h[ "answer" ] ;
    $level1 = $h[ "level" ] ;
    $topic1= $h[ "topic" ] ;
    $points1 = $h[ "points" ] ;
    $L[]=$points1; //NEW
    //$current = $h[ "current" ] ;
    //$recent = $h[ "recent" ] ;
    //$plaintext = $h[ "plaintext" ] ;
    echo "<tr>" ; 
    echo "<td>$question1</td>" ;
    echo"<td>$answer1</td>";
    echo "<td>$level1</td>";
    echo "<td>$topic1</td>";
    echo "<td>$points1</td>";
    //echo "<td>$current</td>"; 
    //echo "<td>$recent</td>";
    //echo "<td>$plaintext</td>"; 
    echo "</tr>" ;
    };
    echo "</table><br>";
    $ab=array_sum($L);
echo "Total Score of: $ab"; 

?>


