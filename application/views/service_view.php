<?php header('Content-type: text/html; charset=utf-8'); ?>
<?php

if($results){

	foreach($results as $data){
		$row_data[] = $data;
		
		//echo $data->id;
	}
	
	
echo $json = json_encode($row_data);
// $json = json_encode($row_data);
}else{
	echo "Not found";
}
//print_r(json_decode($json)) ;
//echo "<br/>".sizeof($row_data);
//print_r(json_decode($json));
?>