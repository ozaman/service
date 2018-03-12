<?php 
//set_time_limit(100000000000);
$db->connectdb("admin_tbkmanagement","admin_services","252631@services");
$table = 'web_area';
//$res[other] = $db->select_query('SELECT topic_cn, topic_th, topic_jp,topic_ru FROM web_product_clone WHERE update_utf = 0'); 
//mysql_query("SET NAMES UTF8"); 
//mysql_query("SET character_set_results=utf-8"); 
$res[other] = $db->select_query('SELECT * FROM '.$table.' where id = "'.$_GET[id].'" '); 
while($arr[other] = $db->fetch($res[other])) {
	echo $i++;
	?>
	<form name="form" action="?name=main&file=update_utf&id=<?=$_GET[id]?>" method="post" id="sub">
		<input type="text" name="topic_en" id="topic_en" value="<?=$arr[other][topic_en];?>"  />
		<input type="text" name="topic_cn" id="topic_cn" value="<?=$arr[other][topic_cn];?>"  />
		<input type="text" name="topic_th" id="topic_th" value="<?=$arr[other][topic_th];?>"  />
		<input type="text" name="topic_jp" id="topic_jp" value="<?=$arr[other][topic_jp];?>"  />
		<input type="text" name="topic_kr" id="topic_kr" value="<?=$arr[other][topic_kr];?>"  />
		<input type="text" name="topic_ru" id="topic_ru" value="<?=$arr[other][topic_ru];?>"  />
		

		<input type="text" name="post" id="post" value="1"  />
		<button type="submit">SUBMIT</button>
	</form>	
	<script type="text/javascript">
   // document.getElementById('sub').submit(); // SUBMIT FORM
	</script>
	<?
//	$res[chk_utf] = $db->select_query("SELECT id, from web_product_utf where id = '".$arr[project][id]."' ");
//		$num = $db->num_rows("web_product_utf","id","id = '".$arr[other][id]."' ");
//		$params['topic_en'] = $arr[other][topic_en];
//		$params['topic_cn'] = $arr[other][topic_cn];
//		$params['topic_th'] = $arr[other][topic_th];
//		$params['topic_jp'] = $arr[other][topic_jp];
//		$params['topic_kr'] = $arr[other][topic_kr];
//		$params['topic_ru'] = $arr[other][topic_ru];
		/*if($num<=0){
		$params['id'] = $_GET[id];

		mysql_query("SET NAMES utf8"); 
		mysql_query("SET character_set_results=utf-8");
		$db->connectdb("admin_tbkmanagement","admin_services","252631@services");
		$params['result'] = $db->add_db('web_product_utf',$params);
		$params['type'] = 'insert';
		
		}
		else{
			mysql_query("SET NAMES utf8"); 
			mysql_query("SET character_set_results=utf-8");
			$params['result'] = $db->update_db('web_product_utf',$params," id = '".$arr[other][id]."' ");
			$params['type'] = 'update';
		}
		echo $arr[other][id]." : ".$arr[other][topic_en]." : ".$result."<br/>";
		echo json_encode($params);
		echo $num;*/
}

if($_POST['post']=='1'){
		$num = $db->num_rows("web_area_utf","id","id = '".$_GET[id]."' ");
		$params['topic_en'] = $_POST[topic_en];
		$params['topic_cn'] = $_POST[topic_cn];
		$params['topic_th'] = $_POST[topic_th];
		$params['topic_jp'] = $_POST[topic_jp];
		$params['topic_kr'] = $_POST[topic_kr];
		$params['topic_ru'] = $_POST[topic_ru];
	/*	$params['detail_en'] =  $_POST[detail_en];
		$params['detail_cn'] = $_POST[detail_cn];
	    $params['detail_th'] = $_POST[detail_th];
		$params['detail_jp'] = $_POST[detail_jp];
		$params['detail_kr'] = $_POST[detail_kr];
		$params['detail_ru'] = $_POST[detail_ru];*/
		if($num<=0){
		$params['id'] = $_GET[id];
		mysql_query("SET NAMES utf8"); 
		mysql_query("SET character_set_results=utf-8");
		$db->connectdb("admin_tbkmanagement","admin_services","252631@services");
		$params['result'] = $db->add_db('web_area_utf',$params);
		$params['type'] = 'insert';
		}else{
		mysql_query("SET NAMES utf8"); 
		mysql_query("SET character_set_results=utf-8");
		$params['result'] = $db->update_db('web_area_utf',$params," id = '".$_GET[id]."' ");
		$params['type'] = 'update';
		
		}
		echo json_encode($params);
		
}
?>