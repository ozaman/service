<?php
function GETMODULE($name,$file){
	global $MODPATH, $MODPATHFILE ;
	if(!$name){
		$name = "main";
	}
	if(!$file){
		$file = "manage";
	}
$modpathfile="modules/".$name."/".$file.".php";
if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = "/modules/".$name."/";
	}else{
//	die ("Not found");
	//header("Location: index.php?name=main&file=manage"); /* Redirect browser */
	//header("Location: index.php?name=main&file=manage", true, 301);
	exit();
	}
}

//require_once("includes/config.in.php");
require_once("includes/class.mysql.php");
//require_once("includes/fuction.php");


$db = New DB();
//$fc = New FC();

?>