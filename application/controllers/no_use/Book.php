<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Book extends CI_Controller {
  public function __construct() {
    parent::__construct();
    /*
    $check_auth_client = $this->MyModel->check_auth_client();
    if($check_auth_client != true){
    die($this->output->get_output());
    }
    */
  }
  public function index() {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'GET') {
      json_output(401,array('status' => 401,'message' => 'Bad request.'));
    }
    else {
      $check_auth_client = $this->MyModel->check_auth_client();
      if($check_auth_client == true) {
        $response = $this->MyModel->auth();
        if($response['status'] == 202) {
          $resp = $this->MyModel->book_all_data();
          json_output($response['status'],$resp);
        }
      }
    }
  }
  public function search($id) {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'GET' ) {
      json_output(401,array('status' => 401,'message' => 'Bad request.'));
    }
    else {
      $response = $this->MyModel->check_agent();
      if($response['status'] == 200) {
        $params['agent'] = $response['agent'];
        $resp = $this->MyModel->book_detail_data($id,$params);
        json_output($response['status'],$resp);
      }
    }
  }
  public function create() {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'POST') {
      json_output(400,array('status' => 401,'message' => 'Bad request.'));
    }
    else {
      $response = $this->MyModel->check_agent();
      $respStatus = $response['status'];
      if($response['status'] == 200) {
        $params = json_decode(file_get_contents('php://input'), TRUE);
        $params['agent'] = $response['agent'];
        $params['star'] = $response['star'];
        $params['api'] = 1;
        //$response_ref = $this->MyModel->check_ref($params['agent_ref']);
        $chk_parameter_agent_ref = $this->MyModel->chk_parameter_agent_ref($params); 
        $chk_parameter_guest_english = $this->MyModel->chk_parameter_guest_english($params); 
        $chk_parameter_guest_other = $this->MyModel->chk_parameter_guest_other($params); 
        $chk_parameter_phone = $this->MyModel->chk_parameter_phone($params); 
        $chk_parameter_product = $this->MyModel->chk_parameter_product($params); 
        //$chk_parameter_ondate = $this->MyModel->chk_parameter_ondate($params); 
        //$chk_parameter_program_start = $this->MyModel->chk_parameter_program_start($params); 
        if($chk_parameter_agent_ref['status'] == 401) {
          $respStatus = 200;
          if($params['agent'] == 13){
		  	$resp = array('status' => 202,'invoice' => $chk_parameter_agent_ref['invoice'],'message' =>  $chk_parameter_agent_ref['message']);
		  }else{
		  	$resp = array('status' => 401,'message' =>  $chk_parameter_agent_ref['message']);
		  }
        }
        elseif($chk_parameter_guest_english['status'] == 401) {
          $respStatus = 200;
          $resp = array('status' => 401,'message' =>  $chk_parameter_guest_english['message']);
        }
        elseif($chk_parameter_guest_other['status'] == 401) {
          $respStatus = 200;
          $resp = array('status' => 401,'message' =>  $chk_parameter_guest_other['message']);
        }
        elseif($chk_parameter_phone['status'] == 401) {
          $respStatus = 200;
          $resp = array('status' => 401,'message' =>  $chk_parameter_phone['message']);
        }
        elseif($chk_parameter_product['status'] == 401) {
          $respStatus = 200;
          $resp = array('status' => 401,'message' =>  $chk_parameter_product['message']);
        }
        /*          
        elseif($chk_parameter_ondate['status'] == 401){
        $respStatus = 200;
        $resp = array('status' => 401,'message' =>  $chk_parameter_ondate['message']);
        }
        elseif($chk_parameter_program_start['status'] == 401){
        $respStatus = 200;
        $resp = array('status' => 401,'message' =>  $chk_parameter_program_start['message']);
        }
        //*/          
        else {
          $product = $this->MyModel->book_search_product($params);
          $params['product_status'] = $product['status'];
          //$alert_error_km = $chk_pickup_place;            
          $alert_error_km = '';            
          if($params['product_status'] == 202) {
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
            $params['total_sub'] = $product['total_sub'];
            $params['total_agent'] = $product['total_agent'];
            $params['total_finish_profit'] = $product['total_finish_profit'];
            $params['air'] = $product['air'];
            $params['cartype'] = $product['cartype'];
            /*
            $params['airin_time'] = $product['airin_time'];
            $params['airin_h'] = $product['airin_h'];
            $params['airin_m'] = $product['airin_m'];
            ////// pickup time
            $params['airout_time'] = $product['airout_time'];
            $params['airout_h'] = $product['airout_h'];
            $params['airout_m'] = $product['airout_m'];
            $params['outdate'] = $product['outdate'];
            //*/
            $params['area'] = $product['area'];
            $params['transfer_in'] = $product['transfer_in'];
            $params['overnigth_in'] = $product['overnigth_in'];
            ////////////////  Transfer check Place
            // db adding
            $chk_parameter_ondate = $this->MyModel->chk_parameter_ondate($params); 
            $chk_parameter_program_start = $this->MyModel->chk_parameter_program_start($params);
            $airin_time_ok = explode(':',$chk_parameter_program_start['time_ok']);
            if($chk_parameter_program_start['time_pickup']){
				$airout_time_ok = explode(':',$chk_parameter_program_start['time_pickup']);
				////// pickup time
	            $params['airout_time'] = $chk_parameter_program_start['time_pickup'];
	            $params['airout_h'] = $airout_time_ok[0];
	            $params['airout_m'] = $airout_time_ok[1];
			}else{
				////// pickup time
	            $params['airout_time'] = $chk_parameter_program_start['time_ok'];
	            $params['airout_h'] = $airin_time_ok[0];
	            $params['airout_m'] = $airin_time_ok[1];
			}
            
            //*
            $params['ondate'] = $chk_parameter_ondate['date_ok'];
            $params['airin_time'] = $chk_parameter_program_start['time_ok'];
            $params['airin_h'] = $airin_time_ok[0];
            $params['airin_m'] = $airin_time_ok[1];
            
            $params['outdate'] = $chk_parameter_ondate['date_ok'];
            //*/
            $chk_pickup_place = $this->MyModel->check_pickup_place($params);
            $chk_to_place = $this->MyModel->check_to_place($params);
            if($product['type'] == 'transfer') {
              if($product['area'] == 'In') {
                $params['place_default'] = $product['place_default'];
                $params['place_default_to'] = $chk_to_place['id'];
              }
              elseif($product['area'] == 'Out') {
                $params['place_default_to'] = $product['place_default_to'];
                $params['place_default'] = $chk_pickup_place['id'];
              }
              else {
                $params['place_default'] = $chk_pickup_place['id'];
                $params['place_default_to'] = $chk_to_place['id'];
              }
            }
            else {
              //////////////// Not Transfer check Place
              $params['place_default'] = $chk_pickup_place['id'];
              $params['place_default_to'] = $chk_to_place['id'];
            }
            $chk_parameter_adult = $this->MyModel->chk_parameter_adult($params); 
            $chk_parameter_child = $this->MyModel->chk_parameter_child($params); 
            ////////////// Check producr Over night
            if($params['overnigth_in'] > 0){
				$chk_overnight_hotel = $this->MyModel->chk_parameter_overnight_hotel($params);
				$chk_overnight_date = $this->MyModel->chk_parameter_overnight_date($params);
				$chk_overnight_time = $this->MyModel->chk_parameter_overnight_time($params);
				
				$time_ok = explode(':',$chk_overnight_time['time_ok']);
				$params['over_in'] = 1;
				$params['over_hotel'] = $chk_overnight_hotel['id'];
				$params['over_ondate'] = $chk_overnight_date['back_date'];
				$params['over_time_h'] = $time_ok[0];
				$params['over_time_m'] = $time_ok[1];
			}
            if($chk_parameter_adult['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_parameter_adult['message']);
            }
            elseif($chk_parameter_child['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_parameter_child['message']);
            }
            elseif($chk_parameter_ondate['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_parameter_ondate['message']);
            }
            elseif($chk_parameter_program_start['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_parameter_program_start['message']);
            }
            elseif($chk_pickup_place['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_pickup_place['message']);
            }
            elseif($chk_overnight_hotel['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_overnight_hotel['message']);
            }
            
            elseif($chk_overnight_date['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_overnight_date['message']);
            }
            elseif($chk_overnight_time['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_overnight_time['message']);
            }
            elseif($chk_to_place['status'] == 401) {
              $respStatus = 200;
              $resp = array('status' => 401,'message' =>  $chk_to_place['message']);
            }
            else {
              $params['chk_pickup_place'] = $chk_pickup_place['status'];
              /* =============================================================== //*/
              /* ======================== Add Booking ======================== //*/
              /* =============================================================== //*/
              if( $aaaaaa = $this->MyModel->book_create_data($params) ) {                
                $resp_book = $this->MyModel->book_detail_data($aaaaaa['agent_ref'],$params);      
                //if($product['transfer_in'] == 1) {
                if($product['transfer_in'] == 1 and $product['overnigth_in'] < 1) {	
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
                    'pickup_date'=>$resp_book['pickup_date'],
                    'pickup_time'=>$resp_book['pickup_time'],
                    'to_place'=>$resp_book['to_place'],
                    'remark'=>$resp_book['remark'],
                    'status_book'=>$resp_book['status_book'],
                    'sub_confirm'=>$resp_book['sub_confirm'],
                    'sub_reject'=>$resp_book['sub_reject']
                  );
                }
                elseif($product['transfer_in'] == 1 and $product['overnigth_in'] > 0) {	
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
                    'pickup_date'=>$resp_book['pickup_date'],
                    'pickup_time'=>$resp_book['pickup_time'],
                    'overnight_hotel'=>$resp_book['overnight_hotel'],
                    'back_date'=>$resp_book['back_date'],
                    'back_time'=>$resp_book['back_time'],
                    'to_place'=>$resp_book['to_place'],
                    'remark'=>$resp_book['remark'],
                    'status_book'=>$resp_book['status_book'],
                    'sub_confirm'=>$resp_book['sub_confirm'],
                    'sub_reject'=>$resp_book['sub_reject']
                  );
                }
                elseif($product['transfer_in'] < 1 and $product['overnigth_in'] > 0) {	
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
                    'overnight_hotel'=>$resp_book['overnight_hotel'],
                    'back_date'=>$resp_book['back_date'],
                    'back_time'=>$resp_book['back_time'],
                    'remark'=>$resp_book['remark'],
                    'status_book'=>$resp_book['status_book'],
                    'sub_confirm'=>$resp_book['sub_confirm'],
                    'sub_reject'=>$resp_book['sub_reject']
                  );
                }
                
                
                else {
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
                    'remark'=>$resp_book['remark'],
                    'status_book'=>$resp_book['status_book'],
                    'sub_confirm'=>$resp_book['sub_confirm'],
                    'sub_reject'=>$resp_book['sub_reject']
                  );
                }
              }
              else {
                // grrr error!!
                $resp = array('status' => 401,'message' => 'Unauthorized.');
              }  
              /* =============================================================== //*/
              /* ======================== Add Booking ======================== //*/
              /* =============================================================== //*/
            }
          }
          elseif($params['product_status'] == 402) {
            $respStatus = 200;
            $resp = array('status' => 401,'message' => 'Please enter From place by pickup_place '.$params['product_status']);
          }
          elseif($params['product_status'] == 403) {
            $respStatus = 200;
            $resp = array('status' => 401,'message' => $product['message']);
          }
          elseif($params['product_status'] == 401) {
            $respStatus = 200;
            $resp = array('status' => 401,'message' => $product['message']);
          }
          else {
            $respStatus = 200;
            $resp = array('status' => 401,'message' => 'Not found product.');
          }
        }
        /**
        * 
        * @var ********  Response
        * 
        */          
        json_output($respStatus,$resp);
      }
    }
  }
  public function cancel($id) {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'POST' ) {
      json_output(400,array('status' => 401,'message' => 'Bad request.'));
    }
    elseif($id == '') {
      json_output(400,array('status' => 401,'message' => 'Not found ID.'));
    }
    else {
      $response = $this->MyModel->check_agent();
      $respStatus = $response['status'];
      if($response['status'] == 200) {
        $params = json_decode(file_get_contents('php://input'), TRUE);
        $params['update_date'] = time();
        $params['agent'] = $response['agent'];
        $params['status'] = 'CANCEL';
        $resp_update = $this->MyModel->book_cancel_data($id,$params);
        
        $resp_book = $this->MyModel->book_detail_data($id,$params); 
        
        if($resp_update['status'] == '202'){
			
		    
                if($product['transfer_in'] == 1) {
                  $resp = array(
                    'status' => $resp_update['status'],
                    'message' => $resp_update['message'],
                    'agent_ref'=>$id,
                    'guest'=>$resp_book['guest'],
                    'phone'=>$resp_book['phone'],
                    'invoice'=>$resp_book['invoice'],
                    'product'=>$resp_book['product'],
                    'ondate'=>$resp_book['ondate'],
                    'start_time'=>$resp_book['start_time'],
                    'pickup_place'=>$resp_book['pickup_place'],
                    'pickup_date'=>$resp_book['pickup_date'],
                    'pickup_time'=>$resp_book['pickup_time'],
                    'to_place'=>$resp_book['to_place'],
                    'remark'=>$resp_book['remark'],
                    'status_book'=>$resp_book['status_book'],
                    'sub_confirm'=>$resp_book['sub_confirm'],
                    'sub_reject'=>$resp_book['sub_reject']
                  );
                }
                else {
                  $resp = array(
                    'status' => $resp_update['status'],
                    'message' => $resp_update['message'],
                    'agent_ref'=>$id,
                    'guest'=>$resp_book['guest'],
                    'phone'=>$resp_book['phone'],
                    'invoice'=>$resp_book['invoice'],
                    'product'=>$resp_book['product'],
                    'ondate'=>$resp_book['ondate'],
                    'start_time'=>$resp_book['start_time'],
                    'remark'=>$resp_book['remark'],
                    'status_book'=>$resp_book['status_book'],
                    'sub_confirm'=>$resp_book['sub_confirm'],
                    'sub_reject'=>$resp_book['sub_reject']
                  );
                }
        }else{
			$resp = array(
                    'status' => $resp_update['status'],
                    'message' => $resp_update['message']
                  );
		}
      }
      else {
        $respStatus = 200;
        $resp = array('status' => 401,'message' =>  'Not Found your Oder ID');
      }
      json_output($respStatus,$resp);
    }
  }
  ///////////////////// REJECT
  public function reject($id) {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'POST' ) {
      json_output(400,array('status' => 401,'message' => 'Bad request.'));
    }
    elseif($id == '') {
      json_output(400,array('status' => 401,'message' => 'Not found ID.'));
    }
    else {
      $response = $this->MyModel->check_agent();
      $respStatus = $response['status'];
      if($response['status'] == 200) {
        //$params = json_decode(file_get_contents('php://input'), TRUE);
        $params['update_date'] = time();
        $params['agent'] = $response['agent'];
        $params['sub_reject'] = 2;
        $resp = $this->MyModel->book_reject_data($id,$params);
      }
      else {
        $respStatus = 200;
        $resp = array('status' => 401,'message' =>  'Not Found your Oder ID');
      }
      json_output($respStatus,$resp);
    }
  }
  public function delete($id) {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
      json_output(401,array('status' => 401,'message' => 'Bad request.'));
    }
    else {
      $check_auth_client = $this->MyModel->check_auth_client();
      if($check_auth_client == true) {
        $response = $this->MyModel->auth();
        if($response['status'] == 202) {
          $resp = $this->MyModel->book_delete_data($id);
          json_output($response['status'],$resp);
        }
      }
    }
  }
//////////////////////////// End
}