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
$decode = json_decode($str_json, true); //decode JSON

//echo "THIS $decode";
echo "<style> p.one {
  border-style: solid;
  border-color: black;
  background: #FFFEFE;
  padding: 10px;
   margin-bottom: -15px;
}</style>"; //NEWW
echo "<style> p.two {
  border-style: solid;
  border-color: black;
  background: #E56D6F;
  padding: 10px;
   margin-bottom: -15px;
}</style>";
echo "<style> p.three {
  border-style: solid;
  border-color: black;
  padding: 10px;
  background: #FFFCC3;
   margin-bottom: -15px;
}</style>";
echo "<style> body {background-color: #B3ECFF;} </style>";
echo "<body>";



$f   =  "select * from score where user = '$decode' " ;
  ($g = mysqli_query ( $db,  $f   ) )  or die ( mysqli_error ($db) );
  echo "<br><center><h1>Review Exam</h1></center><br><br>";
    $tot=array();
    $have=array();
  while ( $h = mysqli_fetch_array ( $g, MYSQL_ASSOC) ) 
  {
    $question1 = $h[ "question" ] ;
    $answer1 = $h[ "answer" ] ;
    $spts1 = $h[ "spts" ] ;
    $fullpts1= $h[ "fullpts" ] ;
    $comments1 = $h[ "comments" ] ;
    $match1= $h[ "match" ];
    $ansinfos= $h["ansinfo"];
    $tot[]=$fullpts1;
    $have[]=$spts1;
    $newfullpts1=$fullpts1;
    //echo "<center>" ; 
    //echo "LOOK $match1<br>"; 
    echo "<p class='two'>Question: $question1<br>" ;
    echo "</p>";
    echo "<p class='one'>Your Answer: $answer1<br>";
    echo "</p>";
    $LOOK=explode("<br>",$ansinfos);
    for($t=0;$t<count($LOOK)-1;$t++){
      if(strpos($LOOK[$t], 'Incorrect') !== false){
        echo "<p class='one'><font color='red'>$LOOK[$t]</font>";
      echo "</p>";
 
      }
      else if(strpos($LOOK[$t], 'Correct!') !== false){
        echo "<p class='one'><font color='green'>$LOOK[$t]</font>";
      echo "</p>";
 
      }
      else{
      echo "<p class='one'>$LOOK[$t]";
      echo "</p>";
      }
      if(strpos($LOOK[$t], 'Testcase') !== false){
        echo "<br>";
 
      }
      //echo "<br>";

    
    }
    echo "<p class='three'>Points Received: $spts1 out of $newfullpts1<br>";
    echo "</p>";
    //echo " $newfullpts1<br>";
    echo "<p class='one'>Teacher comment: $comments1</p><br><br>";
         echo "<br><br>";
    //echo "</center>" ;
    };

    $ab=array_sum($tot);
    $ggoott=array_sum($have);
echo "<center><h1>Total Score of: $ggoott out of $ab</h1></center><br>"; 
echo "</body>";
?>