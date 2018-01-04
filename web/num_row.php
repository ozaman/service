<?php
$con=mysqli_connect("localhost","root","123","garage");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT id FROM cost_spare where date = '".$_POST[date]."' ";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  echo $rowcount;
  // Free result set
  mysqli_free_result($result);
  }

mysqli_close($con);
?>