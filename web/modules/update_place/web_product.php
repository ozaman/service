<?php
$db->connectdb('admin_tbkmanagement',DB_USERNAME,DB_PASSWORD);
mysql_query("SET NAMES UFT8"); 
mysql_query("SET character_set_results=utf-8"); 
$res[project] = $db->select_query("SELECT * FROM web_product where update_utf8_topic = '0' ");
/*$res[project] = $db->select_query("SELECT * FROM web_product limit 409,100");*/

 while($arr[project] = $db->fetch($res[project])) {
 	
 	mysql_query("SET NAMES UFT8"); 
	mysql_query("SET character_set_results=utf-8"); 
 	$topic_cn = $arr[project][topic_cn];
 	$topic_th = $arr[project][topic_th];
 	$topic_jp = $arr[project][topic_jp];
 	$topic_kr = $arr[project][topic_kr];
 	$detail_cn = $arr[project][detail_cn];
 	$detail_en = $arr[project][detail_en];
 	$detail_th = $arr[project][detail_th];
 	$detail_jp = $arr[project][detail_jp];
 	$topic = $arr[project][topic];

 	echo $arr[project][id]." : ".$topic."  ";
 	//echo $star."<br>";
 	
$db->connectdb('admin_tbkmanagement',DB_USERNAME,DB_PASSWORD);
	mysql_query("SET NAMES utf8"); 
	mysql_query("SET character_set_results=utf-8"); 
	$reuslt = $db->update_db("web_product",array(
   /*"topic_cn"=>addslashes($topic_cn),
   "topic_th"=>addslashes($topic_th),
   "topic_jp"=>addslashes($topic_jp),
   "topic_kr"=>addslashes($topic_kr),
   "detail_cn"=>addslashes($detail_cn),
   "detail_th"=>addslashes($detail_th),
   "detail_en"=>addslashes($detail_en),
   "detail_jp"=>addslashes($detail_jp),*/
   "update_utf8_topic"=>"1",
   "topic"=>$topic
   
   ),"id = '".$arr[project][id]."'"); 
   echo $reuslt."<br>";
 }

?>