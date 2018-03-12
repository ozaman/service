<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transfer_order extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Transfer_order_mode');
  }


public function order_list()
	{
		
//		$params = json_decode(file_get_contents('php://input'), TRUE);
		
		$data = $this->Transfer_order_mode->query_data();
		json_output($data['status'],$data['response']);

	}
	

}
?>