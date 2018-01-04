
<?php 

$db->connectdb('admin_tbkmanagement','root','123');
mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8"); 
$json = '{
"aum_from":"1",
"aum_to" :"",
"place_default":"193",
"place_default_to":"407",
"stay":"1",
"stay_to":"1"
}';



	$url = $json;
    $json2 = json_decode($url);

foreach($json2->request as $request){
    $place_default = $request->place_default;
    $stay = $request->stay;
    $aum_from = $request->aum_from;
    $place_default_to = $request->place_default_to;
    $stay_to = $request->stay_to;
    $aum_to = $request->aum_to;
}

foreach($json2->field as $request){
     $id = $request->{"0"};
     $topic = $request->{"1"};
 }
$array = array();


$aum1 = 'aum_from = "'.$aum_from.'" ';
$aum2 = 'aum_to = "'.$aum_to.'" ';
$place_default_to = 'place_default_to = "'.$place_default_to.'" ';
$place_default = 'place_default = "'.$place_default.'" ';
/*mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8"); 
$res = $db->select_query('SELECT id,topic_th,cartype FROM web_transferproduct WHERE '.$aum2.' and '.$aum1.'  and '.$place_default.' and '.$place_default_to.' '); 
while ($arr = $db->fetch($res)) { 
	array_push($array,$arr[id]);
}
mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8"); 
$res = $db->select_query('SELECT id,topic_th,cartype FROM web_transferproduct WHERE '.$place_default.'  and '.$place_default_to.' '); 
while ($arr = $db->fetch($res)) { 
	array_push($array,$arr[id]);
}*/
mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8"); 
$res = $db->select_query('SELECT a.id,a.topic_th,a.cartype FROM web_transferproduct as a
left join web_car as b 
on b.id = a.cartype
left join web_gallerycar as e
on b.car_model = e.category
WHERE '.$aum2.' and '.$place_default.' 
group by a.id'); 
while ($arr = $db->fetch($res)) { 
	array_push($array,$arr[id]);
}

mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8"); 
$res = $db->select_query('SELECT id,topic_th,cartype FROM web_transferproduct WHERE '.$aum1.'  and '.$place_default_to.' group by id '); 
while ($arr = $db->fetch($res)) { 
	array_push($array,$arr[id]);
}
/*
mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8"); 
$res = $db->select_query('SELECT id,topic_th FROM web_transferproduct WHERE '.$aum1.' and '.$aum2.' '); 
while ($arr = $db->fetch($res)) { 
	array_push($array,$arr[id]);
}*/





//print_r($array);
//echo json_encode($array);
echo sizeof($array);

/*foreach ($array as $key=>$val){
	//echo $val."<br/>";
	mysql_query("SET NAMES utf8"); 
	mysql_query("SET character_set_results=utf-8"); 
	$res = $db->select_query('SELECT id,topic_th,cartype FROM web_transferproduct WHERE id = "'.$val.'" '); 
	while ($arr = $db->fetch($res)) { 
		echo $arr[id]." : ".$arr[topic_th]." : ".$arr[cartype]."<br/>";
	}
	
}
*/




 
// ORDER BY Sales DESC
?>

