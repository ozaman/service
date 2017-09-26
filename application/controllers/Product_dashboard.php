<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_dashboard extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Product_model_dash');
  }


public function index()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		
				$data = $this->Product_model_dash->get_product($params);
				//$this->load->view('product_view',$data);
	
		echo json_encode($data);
		
	}
public function normal()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		
				$data = $this->Product_model_dash->get_product_v2($params);
				//$this->load->view('product_view',$data);
	
		echo json_encode($data);
		
	}


  //////////////////////////// End
}
?>