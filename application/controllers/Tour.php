<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tour extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Tour_model');
  }


public function index()
	{

		$params = json_decode(file_get_contents('php://input'), TRUE);
		$data = $this->Tour_model->queryData($params);

		json_output($data['status'],$data['response']);
		
	}

public function get_detail()
	{
		
		$params = json_decode(file_get_contents('php://input'), TRUE);
		$data = $this->Tour_model->query_detail($params);
		json_output($data['status'],$data['response']);
	}

public function get_each()
	{
		
		$params = json_decode(file_get_contents('php://input'), TRUE);
		$data = $this->Tour_model->query_each_data($params);
		json_output($data['status'],$data['response']);
	}


}
?>