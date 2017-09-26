<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model {


  public function loaddata() {
$this->db->select('*'); 	
$this->db->limit(50); 	
$query = $this->db->from('web_transferproduct_ts')->get();
    if($query->num_rows() > 0) {
      foreach($query->result() as $row) {
        $data[] = $row;
      }
      
      return $data;
 
 }
}


}