<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_place extends CI_Model {

  public function place($id) {

   // $query = $this->db->select('*')->from('web_transferplace')->get();
   if($id){
   	$this->db->where('pro',$id);
   }
   
    $query = $this->db->select('topic,address,amphur,province')->where('status',1)->get('web_transferplace_new_api');
       foreach($query->result() as $row){
        	
				$data[] = $row;
			}
			return $data;
    } 
    public function province() {

    $query = $this->db->select('id,name')->order_by('id','asc')->get('web_province');
       foreach($query->result() as $row){
        	
				$data[] = $row;
			}
			return $data;
    }    
 

  /**
  * *********** End
  */
}