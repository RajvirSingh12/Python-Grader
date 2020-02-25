?>
//Get json string from front
$str_json = file_get_contents('php://input');
// decoding json string to array
$read = json_decode($str_json, true);


// setting the name and pass from json array
$name="none";$pass="none";
if(isset($read['name']))
    $name = $read['name'];
if(isset($read['pass']))
    $pass = $read['pass'];


//echo"$name <br> $pass";

// check njit

define('URL1', 'https://cp4.njit.edu/cp/home/login');
$info = array("user" => $name, "pass" =>$pass, "uuid" => "0xACA021");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, URL1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
$read = curl_exec($ch);//response from njit
curl_close ($ch);
//echo "$read";
//check to see if njit accepts pass or not
if (strpos($read,"Error: Failed Login")== true )
    echo '<center><br>"NJIT HATES YOU"</center>';

else
    echo '<center><br>"NJIT LIKES YOU"</center>';


// send to backend
$info = array('name' => $name,'pass' =>$pass);
define('URL', 'https://web.njit.edu/~rs726/back/login.php');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
$read = curl_exec($ch);//response from backend
curl_close ($ch);
echo "<center>$read</center>";

?>
