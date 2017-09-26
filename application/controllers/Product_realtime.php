<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_realtime extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Product_realtime_model');
    $this->load->model('Product_model');
  }



public function index()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		if(isset($params)){
		
			$resp = $this->Product_realtime_model->getProduct($params);
//			json_output($resp['status'],$resp['response']);
			$fromto = json_encode($resp);
			/*echo $fromto;*/
			$resp2 = $this->Product_model->querydata2($resp);
			echo json_encode($resp2[response][0]);
//			json_output($resp2['status'],$resp2['response']);	
		}else{
			
			echo "Please check your json from";
		}
//		echo 5555;
		
	}
	
public function findPlaceId()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		if(isset($params)){
		
			$resp = $this->Product_realtime_model->getPlaceId($params);
//			json_output($resp['status'],$resp['response']);
			echo json_encode($resp);
				
		}else{
			
			echo "Please check your json from";
		}
//		echo 5555;
		
	}


  //////////////////////////// End
}
?>