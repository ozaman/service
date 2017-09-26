<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Place extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Model_place');
  }


  public function place($id) {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'GET' ) {
      json_output(401,array('status' => 401,'message' => 'Bad request.'));
    }
    else {
      $response = $this->MyModel->check_agent();
      if($response['status'] == 200) {
        $resp = $this->Model_place->place($id);
        json_output(202,$resp);
      }
    }

  }
  public function province() {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'GET' ) {
      json_output(401,array('status' => 401,'message' => 'Bad request.'));
    }
    else {
      $response = $this->MyModel->check_agent();
      if($response['status'] == 200) {
        $resp = $this->Model_place->province();
        json_output(202,$resp);
      }

    }
  }


  //////////////////////////// End
}