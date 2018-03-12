<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Product_model');
  }


public function index()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		if(isset($params)){
				$data['results'] = $this->Product_model->loaddata($params);
				$this->load->view('product_view',$data);
		}else{
			
			echo "Please check your json from";
		}
		
		
	}

  //////////////////////////// End
}
?>