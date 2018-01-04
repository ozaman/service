<?php
function GETMODULE($name,$file){
	global $MODPATH, $MODPATHFILE ;
	if(!$name){$name = "main";
	}
	if(!$file){$file = "web";
	}
$modpathfile="modules/".$name."/".$file.".php";
if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = "/modules/".$name."/";
	}else{
	die ("Not found");
	}
}

require_once("includes/config.in.php");
require_once("includes/class.mysql.php");
require_once("includes/fuction.php");


$db = New DB();
$fc = New FC();

if($_GET['lang']){
	include("includes/lang/".$_GET['lang']."/menu.php");
}else{
	include("includes/lang/en/menu.php");
}

?>