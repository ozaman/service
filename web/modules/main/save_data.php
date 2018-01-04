<?php 
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "garage";
$conn = new mysqli($servername, $username, $password, $dbname);
$date = date('Y-m-d H:i:s');
$num_check = 0;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

while (list($key, $val) = each($_POST[arr])) {

 $str_explode = explode(",",$val);
 $count = count($str_explode) - 1;
 $str_post = "";
 for($i=0;$i<$count;$i++){
 	$str_post .= " '".$str_explode[$i]."', ";
 }
$sql = "INSERT INTO cost_spare (program, car_model,license_plate, num_bill, receiver_product,date,price_unit,num,discount,net_total,last_update)
VALUES ( ".$str_post." '".$date."' )";

	if (mysqli_query($conn, $sql)) {
   $num_check++;
	} 
}

if($num_check==$_POST[count]){
	echo 1;
}



?>

