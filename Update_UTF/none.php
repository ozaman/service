<?php
$_SESSION['admin_user'] = 'admin_admin';
//error_reporting(0);
require_once("mainfile.php");
$PHP_SELF = "index.php";
GETMODULE($_GET['name'],$_GET['file']);
?>

<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>

		<?php include ("".$MODPATHFILE."");?>
	</body>
</html>


