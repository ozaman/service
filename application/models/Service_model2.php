<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model2 extends CI_Model {


  public function testload($params) {
  	
 $select = array( 	   "a.topic",
       "a.detail_en",
       "a.detail_cn",
       "a.detail_th",
       "a.cost_a_agent_all",
       "a.cost_b_agent_all",
       "a.type",
       "a.topic_en",
       "a.topic_cn",
       "a.topic_th",
       "a.onsale_front",
       "a.onsale_enable",
       "a.onsale_promotion",
       "a.onsale_top",
       "a.image_crop",
       "a.id",
       "a.round_en",
       "a.province",
       "a.open_Sun",
       "a.open_Mon",
       "a.open_Tue",
       "a.open_Wed",
       "a.open_Thu",
       "a.open_Fri",
       "a.open_Sat",
       "b.company"); 
      
  	foreach ($select as $key => $value){
				$this->db->select($value);
			}
    $this->db->from('web_product a');
	$this->db->join('web_admin b', 'a.company = b.id');
	//$this->db->where('',);
    $query = $this->db->get();
    
    if($query->num_rows() > 0) {
      foreach($query->result() as $row) {
        $data[] = $row;
      }
       
    }else{
		$data['status'] = '402';

	}
 
 return $data;
}


}