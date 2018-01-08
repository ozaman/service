<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Test_model');
  }


public function index()
	{
		//$params = json_decode(file_get_contents('php://input'), TRUE);
		
			$data['results'] = $this->Test_model->loaddata();
		
		//echo $data['results'];
		//$data['code'] = $params['code'];
		$this->load->view('service_view',$data);
	}
	
	public function test_fnc()
	{
		//$params = json_decode(file_get_contents('php://input'), TRUE);
		
			$data['results'] = $this->Test_model->loaddata_test();
		
		//echo $data['results'];
		//$data['code'] = $params['code'];
		$this->load->view('service_view',$data);
	}


  //////////////////////////// End
}
?>