<?php 
if($_GET[date]!=""){
	$sql_date = "where date = '".$_GET[date]."' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result_num_row = $db->num_rows(COST,"id","date = '".$_GET[date]."'"); 
$row_on_page = 10 ;
$result_page = ceil($result_num_row/$row_on_page);
//echo $result_page;
$res[product] = $db->select_query("SELECT id,product_id,program,car_model,net_total,num_bill,date,num,price_unit FROM ".COST." ".$sql_date." order by id asc 
limit ".$_GET[num].",".$row_on_page." ");

//echo "SELECT id,product_id,program,car_model,net_total,num_bill,date,num,price_unit FROM ".COST." ".$sql_date." order by id asc limit ".$_GET[num].",".$row_on_page." ";
?>
<input type="hidden" id="number" value="<?=$row_on_page;?>"/>
<table class="table table-sm " id="mini_report">
  <thead>
    <tr class="success">
      <th>ID</th>
      <th>Program</th>
      <th>NetPrice</th>
      <th>Date</th>
      <th>Username</th>
    </tr>
  </thead>
  <tbody>
  <?php
      while($arr[product] = $db->fetch($res[product])){  
   ?>
    <tr>
      <th scope="row"><?=$arr[product][id];?></th>
      <td><?=$arr[product][program];?></td>
      <td><?=$arr[product][net_total];?></td>
      <td><?=$arr[product][date];?></td>
      <td>@mdo</td>
    </tr>
<? } ?>
  </tbody>
</table>
             
<div class="pagination" id="next_page" onclick="test()">
<a href="#">&laquo;</a>
	<!--<a href="#">1</a>      --> 	
	<?php
	$page=0;
	for($i=0;$i<$result_page;$i++){ ?>
		<a href="#" id="<?=$i*$row_on_page;?>"><?=$i+1;?></a>
	<? }
	 ?>	
	
  <a href="#">&raquo;</a> 
   
</div>         


   