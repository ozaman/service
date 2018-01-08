<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Service_model');
    $this->load->model('Service_model2');
  }


public function index()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		
			$data['response'] = $this->Service_model->loaddata($params);
			$data['status'] = '202';
		json_output($data['status'],$data['response']);
		//$data['code'] = $params['code'];
//		$this->load->view('service_view',$data);
	}
	
	public function sub_product()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		
			$data['results'] = $this->Service_model2->testload($params);
		
		
		//$data['code'] = $params['code'];
		$this->load->view('service_view',$data);
	}
	
	public function getplace()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		
			$data['response'] = $this->Service_model->get_place($params);
			$data['status'] = '202';
			json_output($data['status'],$data['response']);
			//$data['code'] = $params['code'];
			//$this->load->view('service_view',$data);
	}
	
	public function search_keyword()
	{
		$params = json_decode(file_get_contents('php://input'), TRUE);
		
		$data['response'] = $this->Service_model->search($params);
		$data['status'] = '202';
		json_output($data['status'],$data['response']);
		//$data['code'] = $params['code'];
//		$this->load->view('service_view',$data);
	}


  //////////////////////////// End
}
?>