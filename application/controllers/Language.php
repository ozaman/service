<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Language extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Language_model');
  }


  public function index() {
  	
     $params = json_decode(file_get_contents('php://input'), TRUE);
	
				$data = $this->Language_model->get_lang($params);
				//$this->load->view('product_view',$data);
		echo json_encode($data);
     
  }



  //////////////////////////// End
}