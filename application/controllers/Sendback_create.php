<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sendback_create extends CI_Controller {
  public function __construct() {
    parent::__construct();
    /*
    $check_auth_client = $this->MyModel->check_auth_client();
    if($check_auth_client != true){
    die($this->output->get_output());
    }
    */
    $this->load->model('Model_sendback');

  }
  public function index() {
  	$response['status'] = 200;
    $resp['Result'] = "OK create";
    $params = json_decode(file_get_contents('php://input'), TRUE);
    //$params['agent'] = $response['agent'];
    
    $update['api_sendback'] = '2';
    $this->db->where('ref',$params['agent_ref'])->where('api',1)->update('web_order',$update);
    json_output($response['status'],$resp);

  }
  
//////////////////////////// End
}