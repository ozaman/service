<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tour extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Tour_model');
  }


public function index()
	{
	//echo 123;
		/*$params = json_decode(file_get_contents('php://input'), TRUE);
		if(isset($params)){
				$data['results'] = $this->Product_model->loaddata($params);
				$this->load->view('product_view',$data);
		}else{
			
			echo "Please check your json from";
		}*/
		$params = json_decode(file_get_contents('php://input'), TRUE);
		$data = $this->Tour_model->queryData($params);
		echo json_encode($data);
		
	}


}
?>