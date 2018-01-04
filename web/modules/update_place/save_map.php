<? include('../../includes/class.mysql.php');?>
<?php
$db = new DB;
mysql_query("SET NAMES UFT8"); 
mysql_query("SET character_set_results=utf-8"); 
$db->connectdb('admin_tbkmanagement','root','123');
	mysql_query("SET NAMES utf8"); 
	mysql_query("SET character_set_results=utf-8");
	if($_GET[pass]==1){
			$reuslt = $db->update_db("web_transferplace_new",array(
		   "place_id"=>$_POST[place_id],
		   "latitude"=>$_POST[lat],
		   "longitude"=>$_POST[lng],
		   "update_map"=>"1"
		   
		   ),"id = '".$_POST[id]."' "); 
		   echo $reuslt;
	} 
	else if ($_GET[pass]==0){
		$reuslt = $db->update_db("web_transferplace_new",array(
		   "false_update_map"=>$_POST[status],
		    "update_map"=>"1"
		   ),"id = '".$_POST[id]."' "); 
		   echo $reuslt;
	}

?>