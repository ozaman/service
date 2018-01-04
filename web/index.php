<!DOCTYPE html>
<html lang="en">
<?php

//error_reporting(0);
require_once("mainfile.php");
$PHP_SELF = "index.php";
GETMODULE($_GET['name'],$_GET['file']);


?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/sweetalert-master/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="js/sweetalert-master/dist/sweetalert.css">
  <script src="js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
  <link rel="stylesheet" type="text/css" href="js/datetimepicker-master/jquery.datetimepicker.css" />
<style>
	.trHover:hover {
  background-color: #d6f5f4;
}

</style>
<style>
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border: 1px solid #ddd;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.pagination a:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

.pagination a:last-child {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
</style>
<body> 
 <?php include ("".$MODPATHFILE."");?>



</body>

</html>
