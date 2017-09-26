<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Save_order_model extends CI_Model {

//ea1b6d331a20b66041369a63251410d4ec748f27
  public function createdata($data_book) {
  	
  	$array_data['agent_ref'] = $data_book['agent_ref'];
  	$array_data['guest_english'] = $data_book['guest_english'];
  	$array_data['guest_other'] = $data_book['guest_other'];
  	$array_data['phone'] = $data_book['phone'];
  	$array_data['email'] = $data_book['email'];
  	$array_data['product'] = $data_book['product'];
  	$array_data['arrival_date'] = $data_book['arrival_date'];
  	$array_data['arrival_time'] = $data_book['arrival_time'];
  	$array_data['arrival_visa'] = $data_book['arrival_visa'];
  	$array_data['total_pax'] = $data_book['total_pax'];
  	$array_data['baggage'] = $data_book['baggage'];
  	$array_data['number_car'] = $data_book['number_car'];
  	$array_data['to_place'] = $data_book['to_place'];
    $array_data['to_place_address'] = 	$data_book['to_place_address'];
  	$array_data['remark'] = $data_book['remark'];
  
  $this->db->insert('mytable', $array_data); 
  
 return $array_data;
 
}

  public function check_agent() {
    $users_id = $this->input->get_request_header('User-ID', TRUE);
    $token = $this->input->get_request_header('API-KEY', TRUE);
    $q = $this->db->select('id,levelstar,api_balance,auto_acc_cut')->from('web_admin')->where('apikey',$token)->get()->row();
    if($q == "") {
      return json_output(400,array('status' => 401,'message'=> 'Unauthorized.'));
    }
    else {
      //////////////// check balance for booking
      if($q->api_balance == 1){
      	////////////// check money
      	/////////////  Load DB Account and ADD
    	$DB2 = $this->load->database('admin_acc', TRUE);
      	$tbl_acc = $DB2->dbprefix('web_all_agent_account');
      	$db2_select = $DB2->select('debit,credit,total_used')->from($tbl_acc)->where('agent',$q->id)->get()->row();
      	$all_money = $db2_select->debit + $db2_select->credit;
      	$all_used = $db2_select->total_used;
      	$now_balance = $all_money - $all_used ;
      	/////////// Auto cut Money == True
      	if($q->auto_acc_cut == 1){
			if($all_used >= $all_money){
			return json_output(400,array('status' => 401,'message'=> 'Your money not enough , Now your Balance is '.$now_balance.' THB Please topup. Thank you. '));
			}else{
				return array('status' => 200,'message'=> 'Authorized.','agent'  =>''.$q->id.'','star'   =>''.$q->levelstar.'');
			}
			
		}
		//////////// Open Agent Booking
		else{
			return array('status' => 200,'message'=> 'Authorized.','agent'  =>''.$q->id.'','star'   =>''.$q->levelstar.'');
		}
      	
	  }
	  ///////////////// Open booking Free
	  else{
	  	return array('status' => 200,'message'=> 'Authorized.','agent'  =>''.$q->id.'','star'   =>''.$q->levelstar.'');
	  }
      
    }
  }

}