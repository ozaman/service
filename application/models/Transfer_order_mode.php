<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_order_mode extends CI_Model {


  public function query_data() {
  	
//  	
		$this->db->select($value);
		$this->db->from('web_transferproduct a'); 
		$query = $this->db->get(); 
		if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       $data[] = $row;
			    // array_push($data_not_find,$row);
			      }
//			      $arrayname['data'] =  $data;
			      
			     return array('status' => 200,"response"=>$data);
			}
		return 123;
  }


}