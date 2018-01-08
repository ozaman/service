<?php
$servername = "localhost";
$username = "admin_services";
$password = "252631@services";
$dbname = "admin_tbkmanagement";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, name FROM web_province";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo $row["id"]." : ".$row["name"]."<br/>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>