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
if(isset($decode['Question'])) $Question = $decode['Question']; //store data in variable 
if(isset($decode['Answer'])) $Answer = $decode['Answer'];
if(isset($decode['level'])) $level = $decode['level']; 
if(isset($decode['topic'])) $topic = $decode['topic'];
if(isset($decode['testcases'])) $testcases = $decode['testcases'];
if(isset($decode['word'])) $word = $decode['word'];
//if(isset($decode['output'])) $input = $decode['output'];


//if ($level=="easy"){
//  $points = 10;
//  }
//if ($level=="medium"){
//  $points = 15;
//  }
//if ($level =="hard"){
//  $points = 20;
//  } 
  
 // echo "here";
  
//  echo "here";
$inp =array();
$outp = array();
//echo "here";
for($j=0;$j<count($testcases);$j++){
  if($j%2==0){
    //$input.push($testcases[$j]);
    //array_push($input, $testcases[$j]);
    $inp[]=$testcases[$j];
    //$inp[]=",";
  }
  if($j%2!=0){
    //$output.push($testcases[$j]);
    //array_push($input, $testcases[$j]);
    $outp[]=$testcases[$j];
    //$outp[]=",";
  }
  //echo count($input); 

}
//$input= implode(" ", $inp);
//$output= implode(" ", $outp);

$input= implode(",", $inp);
$output= implode(",", $outp);
//
//echo $input;

function insert($Question, $Answer, $word, $input, $output, $level, $topic, $points, $db)
{
//insert
$s = "insert into gradeT values ( '$Question', '$Answer', '$word', '$input', '$output', '$level', '$topic', DEFAULT, '$points')";  
//echo "<br>SQL insert statement is: $s "; 
($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
//echo "<br>SQL insert TT statement was transmitted for execution.<br>"; 
//echo $output;
}


insert($Question, $Answer, $word, $input, $output, $level, $topic, $points, $db);  

?>