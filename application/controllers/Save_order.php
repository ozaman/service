<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Save_order extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Save_order_model');
  }


public function index()
	{
		$data_book = json_decode(file_get_contents('php://input'), TRUE);
		if(isset($data_book)){
				$data = $this->Save_order_model->createdata($data_book);
				$this->load->view('save_order_view',$data);
				//print_r($data);
		}else{
			
			echo "Please check your json from";
		}
		
		
	}


  //////////////////////////// End
}
?>