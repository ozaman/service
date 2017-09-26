<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        /*
        $check_auth_client = $this->MyModel->check_auth_client();
		if($check_auth_client != true){
			die($this->output->get_output());
		}
		*/
    }

	public function index()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->book_all_data();
	    			json_output($response['status'],$resp);
		        }
			}
		}
	}

	public function search($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' ){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {

		        $response = $this->MyModel->check_agent();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->book_detail_data($id);
					json_output($response['status'],$resp);
		        }

		}
	}

	public function create()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$response = $this->MyModel->check_agent();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					$params['agent'] = $response['agent'];
					$params['star'] = $response['star'];
					$params['api'] = 1;
					
					//$response_ref = $this->MyModel->check_ref($params['agent_ref']);
					$chk_parameter_agent_ref = $this->MyModel->chk_parameter_agent_ref($params); 
					$chk_parameter_guest = $this->MyModel->chk_parameter_guest($params); 
					$chk_parameter_adult = $this->MyModel->chk_parameter_adult($params); 
					$chk_parameter_child = $this->MyModel->chk_parameter_child($params); 
					$chk_parameter_phone = $this->MyModel->chk_parameter_phone($params); 
					$chk_parameter_product = $this->MyModel->chk_parameter_product($params); 
					$chk_parameter_ondate = $this->MyModel->chk_parameter_ondate($params); 
					$chk_parameter_program_start = $this->MyModel->chk_parameter_program_start($params); 
					/*
					if ($params['agent_ref'] == "" ) {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Order ID Not empty');
					}
					elseif($response_ref['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Order ID Alerdy in system');
					}
					else
					//*/
					if($chk_parameter_agent_ref['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_agent_ref['message']);
					}
					elseif($chk_parameter_guest['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_guest['message']);
					}
					elseif($chk_parameter_adult['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_adult['message']);
					}
					elseif($chk_parameter_child['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_child['message']);
					}
					elseif($chk_parameter_phone['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_phone['message']);
					}
					elseif($chk_parameter_product['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_product['message']);
					}
					elseif($chk_parameter_ondate['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_ondate['message']);
					}
					elseif($chk_parameter_program_start['status'] == 400){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $chk_parameter_program_start['message']);
					}
					
					else{
				
				$product = $this->MyModel->book_search_product($params);
				// db adding
		        if(isset($params['from_place'])){
					$params['from_place'] = $params['from_place'];
					$chk_from_place = 1;
				}
				else{
					$params['from_place'] = '';
					$chk_from_place = 0;
				}
				if(isset($params['to_place'])){
					$params['to_place'] = $params['to_place'];
					$chk_to_place = 1;
				}
				else{
					$params['to_place'] = '';
					$chk_to_place = 0;
				}		
		        		
		        		$vat_from = $params['from_place'];
		        		$vat_to = $params['to_place'];
		        		$from_place = $this->MyModel->check_from_place($vat_from);
		        		$to_place = $this->MyModel->check_to_place($vat_to);
		        		
		        		
		        		$params['product_status'] = $product['status'];
		        		$params['pickup_place'] = $from_place['id'];
		        		$params['to_place'] = $to_place['id'];
		        		
		        		
		        		
		        		if($product['area_transfer'] == 'In'){
							$params['from_place'] = '';
							$chk_from_place = 1;
						}
		        		
		        		if($product['area_transfer'] == 'Out'){
							$params['to_place'] = '';
							$chk_to_place = 1;
						}
		        		
		        		
		        		if($params['product_status'] == 200){
							
						 
		        		if($product['in_transfer'] == 1){
							if($chk_from_place == 0){
								$params['product_status'] = 402;
							}else{
								if($chk_to_place == 0){
								$params['product_status'] = 403;
								}else{
									$params['product_status'] = 200;
								}
							}
						}
						}
						
//$alert_error_km = $chk_from_place;						
$alert_error_km = '';						
		        		
		        		if($params['product_status'] == 200){

							$params['product_id'] = $product['id'];
		        			$params['product_vat'] = $product['vat'];
		        			$params['product_type'] = $product['type'];
		        			$params['product_company'] = $product['company'];
		        			$params['status_book'] = $product['status_book'];
							$params['unit_a_agent'] = $product['unit_a_agent'];
							$params['unit_a_sub'] = $product['unit_a_sub'];
							$params['total_a_agent'] = $product['total_a_agent'];
							$params['total_a_sub'] = $product['total_a_sub'];
							$params['total_a_profit'] = $product['total_a_profit'];
							$params['unit_b_agent'] = $product['unit_b_agent'];
							$params['unit_b_sub'] = $product['unit_b_sub'];
							$params['total_b_agent'] = $product['total_b_agent'];
							$params['total_b_sub'] = $product['total_b_sub'];
							$params['total_b_profit'] = $product['total_b_profit'];
							$params['total_finish_profit'] = $product['total_finish_profit'];
							$params['air'] = $product['air'];
							$params['airin_time'] = $product['airin_time'];
							$params['airin_h'] = $product['airin_h'];
							$params['airin_m'] = $product['airin_m'];
							$params['place_default'] = $product['place_default'];
							$params['place_default_to'] = $product['place_default_to'];
							$params['area'] = $product['area'];
							$params['in_transfer'] = $product['in_transfer'];

		        			
							
							
							if( $aaaaaa = $this->MyModel->book_create_data($params) ){
							    // logged in!!
							    
$resp_book = $this->MyModel->book_detail_data($aaaaaa['agent_ref']);							    
							    
							    
							    
							    
							    $resp = array(
							    'status' => $aaaaaa['status'],
							    'message' => 'Data has been created. ',
							    'agent_ref'=>$aaaaaa['agent_ref'],
							    'guest'=>$resp_book['guest'],
							    'phone'=>$resp_book['phone'],
							    'invoice'=>$resp_book['invoice'],
							    'product'=>$resp_book['product'],
							    'ondate'=>$resp_book['ondate'],
							    'start_time'=>$resp_book['start_time'],
							    'pickup_place'=>$resp_book['pickup_place'],
							    'to_place'=>$resp_book['to_place'],
							    'status_book'=>$resp_book['status_book']
							    
							    );
							}
							else{
							    // grrr error!!
							    $resp = array('status' => 401,'message' => 'Unauthorized.');
							}
						}

						elseif($params['product_status'] == 402){
							$resp = array('status' => 402,'message' => 'Please enter From place by from_place');
						}
						elseif($params['product_status'] == 403){
							$resp = array('status' => 403,'message' => 'Please enter To place by to_place'.$alert_error_km);
						}
						elseif($params['product_status'] == 400){
							$resp = array('status' => 400,'message' => $product['message']);
						}
						else{
							$resp = array('status' => 401,'message' => 'Not found product.');
						}
					}
					json_output($respStatus,$resp);
		        }

		}
	}

	public function cancel($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST' ){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		}
		elseif($id == ''){
			json_output(400,array('status' => 400,'message' => 'Not found ID.'));
		}
		else {
		        $response = $this->MyModel->check_agent();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					//$params = json_decode(file_get_contents('php://input'), TRUE);
					$params['update_date'] = time();
					$params['agent'] = $response['agent'];
					$params['status'] = 'CANCEL';
		        	$resp = $this->MyModel->book_cancel_data($id,$params);
		        }else{
					$respStatus = 400;
					$resp = array('status' => 400,'message' =>  'Not Found your Oder ID');
				}
				json_output($respStatus,$resp);
		}
		
	}

	public function delete($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->book_delete_data($id);
					json_output($response['status'],$resp);
		        }
			}
		}
	}

}
