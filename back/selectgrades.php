<?php
//$ucid = $_SESSION["ucid"];
$s = "select * from examm where authority = 'student'" ;
($t = mysqli_query($db, $s)) or die(mysqli_error($db));

  while ($r= mysqli_fetch_array($t,MYSQLI_ASSOC)) {
      $account = $r["account"];
      $balance = $r["current"];
    echo "<br><input type = radio name = \"account\" value = \"$account\">";
    echo "Account: $account  Balance: $balance<br>";
    }
    
?>