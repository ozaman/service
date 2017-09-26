<?php
if($results){
	foreach($results as $data){
		$row_data[] = $data;	
		//echo $data->id;
		//echo $data->code;
	}
	echo json_encode($row_data);
//	print_r($row_data);
	
}else{
	echo "Not found";
}
/*echo  sizeof($row_data);*/
?>
