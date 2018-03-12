<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      #
    </td>
    <td>
      en
    </td>
    <td>
     cn
    </td>
    <td>
      th
    </td>
    <td>
      jp
    </td>
    <td>
      kr
    </td>
    <td>
      ru
    </td>
  </tr>
  <?php
  mysql_query("SET NAMES UFT8"); 
  mysql_query("SET character_set_results=utf-8");
  $db->connectdb("admin_tbkmanagement","admin_services","252631@services");
  $res[project] = $db->select_query("SELECT * FROM web_area ");
  $i = 1;
  while($arr[project] = $db->fetch($res[project])) {
    ?>
   <!-- <tr>
      <td>
        <?=$i;?>
      </td>
      <td>
        <?=$arr[project][topic_en];?>
      </td>
      <td>
        <?=$arr[project][topic_cn];?>
      </td>
      <td>
        <?=$arr[project][topic_th];?>
      </td>
      <td>
        <?=$arr[project][topic_jp];?>
      </td>
      <td>
        <?=$arr[project][topic_kr];?>
      </td>
      <td>
        <?=$arr[project][topic_ru];?>
      </td>
    </tr>-->
    <?php

    $i++;


//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->connectdb("admin_tbkmanagement","admin_services","252631@services");
$res[chk_utf] = $db->select_query("SELECT id from web_area_utf where id = '".$arr[project][id]."' ");
$arr[chk_utf] = $db->fetch($res[chk_utf]);
mysql_query("SET NAMES utf8"); 
mysql_query("SET character_set_results=utf-8");
$params['topic_en'] = $arr[project][topic_en];
$params['topic_cn'] = $arr[project][topic_cn];
$params['topic_th'] = $arr[project][topic_th];
$params['topic_jp'] = $arr[project][topic_jp];
$params['topic_kr'] = $arr[project][topic_kr];
$params['topic_ru'] = $arr[project][topic_ru];
/*$params['detail_en'] = mysql_real_escape_string($arr[project][detail_en]);
$params['detail_cn'] = mysql_real_escape_string($arr[project][detail_cn]);
$params['detail_th'] = mysql_real_escape_string($arr[project][detail_th]);
$params['detail_jp'] = mysql_real_escape_string($arr[project][detail_jp]);
$params['detail_kr'] = mysql_real_escape_string($arr[project][detail_kr]);
$params['detail_ru'] = mysql_real_escape_string($arr[project][detail_ru]);*/
if($arr[chk_utf][id] > 0){
 	$db->update_db('web_area_utf',$params," id = '".$arr[project][id]."' ");
}else{
$params['id'] = $arr[project][id];	
	$result = $db->add_db('web_area_utf',$params);
	?>
	<tr>
      <td>
        <?=$arr[project][id];?>
      </td>
      
      <td>
        <?=$arr[project][topic_en];?>
      </td>
      <td>
        <?=$arr[project][topic_cn];?>
      </td>
      <td>
        <?=$arr[project][topic_th];?>
      </td>
      <td>
        <?=$arr[project][topic_jp];?>
      </td>
      <td>
        <?=$arr[project][topic_kr];?>
      </td>
      <td>
        <?=$arr[project][topic_ru];?>
      </td>
      <td>
        <?=$result;?>
      </td>
    </tr>
	<?
}
mysql_query("SET NAMES UFT8"); 
mysql_query("SET character_set_results=utf-8");
 
  }
  ?>
</table>
