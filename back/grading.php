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
$response = json_decode($str_json, true); //decode JSON
//echo $response; //both answers saved in array 
$s = "select * from StudentExam " ;
($t = mysqli_query ( $db,  $s   ) )  or die ( mysqli_error ($db) );
//$num = mysqli_num_rows ($t) ;

//$e="";



$user=array();
$idd=array();
$ra=array();
$ques=array();
$ans = array();
$kword=array();
$inp=array();
$outp=array();
$pts=array();
$cc=0;
while ( $r = mysqli_fetch_array ( $t, MYSQL_ASSOC) ) 
  {
  $name = $r[ "name" ];
  $id = $r["ID"];
  $real= $r["real"];
  $question = $r[ "question" ];
  $answer = $r["answer"];
  $word= $r["word"];
  $input= $r["input"];
  $output= $r["output"];
  $points= $r["points"];
  
  //$ID= $r[ "ID" ];
  //$question="hi";
  //$e=$question;
  $user[]=$name;
  $idd[]= $id;
  $ra[]= $real;
  $ques[]= $question;
  $ans[]=$answer;
  $kword[]=$word;
  $inp[$cc]=$input;
  $outp[$cc]=$output;
  $pts[]=$points;
  $cc=$cc+1;
 }

$data= array('user' => $user, 'idd' => $idd, 'ra'=>$ra, 'ans' => $ans, 'ques' => $ques, 'kword'=> $kword, 'inp' => $inp, 'outp' => $outp, 'pts' => $pts );
 
//array_push($y,"$question");
//$y[]=$e;
$array=json_encode($data);
echo $array;

?>
