<?php

$select = array(
"area",
"aum_from",
"aum_to",
"car_id",
"car_model",
"car_topic_cn",
"car_topic_en",
"car_topic_th",
"cartype",
"cost_a_agent_all",
"front_transfer",
"pax_cn",
"pax_en",
"pax_th",
"person",
"place_default",
"place_default_to",
"post_date",
"pro_ontop",
"province_id",
"province_id_to",
"province_name",
"province_name_cn",
"province_name_th",
"province_name_to",
"province_name_to_cn",
"province_name_to_th",
"stay","stay_to",
"topic_cn",
"topic_en",
"topic_th",
"transfer_id",
"type"
);
$db->connectdb('admin_tbkmanagement','root','123');
mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8"); 
foreach ($select as $key => $value){
	
	$print .= $value.",";
	
}

$total = rtrim($print,", ");





$res = $db->select_query('SELECT '.$total.' FROM web_transferproduct WHERE id="1" '); 
while ($arr = $db->fetch($res)) { 
	echo $arr[id]." : ".$arr[area]."<br/>";
}






?>