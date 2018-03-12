<?php

class FC{

	var $host_th = "localhost" ;
	var $host_cn = "localhost" ;
	var $database ;
	var $connect_db ;
	var $selectdb ;
	var $db ;
	var $sql ;
	var $table ;
	var $where; 
	var $ses_username;
	var $ses_userpass;
	
	function checkUserEachPage($user="Username",$pass="Password"){ 
	session_start();
	//$_SESSION[$user] = $user;
	//$_SESSION[$pass] = $pass;
	//$ses_username = $_SESSION[$user];
	//$ses_userpass = $_SESSION[$pass];
	if($user ==””){
	echo "คุณยังไม่ได้ทำการ Log in";
	echo "<meta http-equiv=’refresh’ content=’2;URL=project/login.php?name=login&file=login.php’ />";
	}
	else {
	mysql_connect("localhost","root","123");
	mysql_select_db("programer_management");
	$objQuery = mysql_query("SELECT * FROM member where UserName='".$user."' AND Password='".$pass."'");
	$num = mysql_num_rows($objQuery);
	
	if($num==0) { 
	echo '<script type="text/javascript">'; 
	echo 'alert("Please login");'; 
	echo 'window.location.href = "login.php?name=login&file=login";';
	echo '</script>';
	}else {
	$result = $res['check'];
	while ($data = mysql_fetch_array($objQuery) ) {
	echo $data[Username],"<br />";
		}
	}
}
	 
	 function checkAdmin ($status="status"){
	 if($status=="ADMIN"){
	 return true;
				 }
		else if ($status=="USER"){
		return false;
		}

	 }
	 
	
	 
	
	}
}
?>