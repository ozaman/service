<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model_dash extends CI_Model {


public function get_product($params){
	
			$product_id = $params['product_id'];
			$this->db->select('a.id,
			a.topic_en AS topic_en,
			a.topic_th AS topic_th,
			a.topic_cn AS topic_cn,
			b.topic_en AS car_topic_en,
			b.topic_th AS car_topic_th,
			b.topic_cn AS car_topic_cn,
			b.pax AS pax_en,
			a.post_date as date_tran,
			a.aum_from as aum_f,
			a.aum_to as aum_t,
			a.place_default as place_f,
			a.place_default_to as place_t');
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->where('a.id',$product_id);
			$query = $this->db->get(); 
			if($query->num_rows() > 0) {
		      foreach($query->result() as $row) {
		       
		      
		       $data[] = $row;
		       
		       
		      }
		      return $data;
		 }			
	
}

public function get_product_v2($params){
	
			$product_id = $params['product_id'];
			$this->db->select('a.id,
			a.topic_en AS topic_en,
			a.topic_th AS topic_th,
			a.topic_cn AS topic_cn,
			b.topic_en AS car_topic_en,
			b.topic_th AS car_topic_th,
			b.topic_cn AS car_topic_cn,
			b.pax AS pax_en,
			a.post_date as date_tran,
			a.aum_from as aum_f,
			a.aum_to as aum_t,
			a.place_default as place_f,
			a.place_default_to as place_t');
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->where('a.id',$product_id);
			$query = $this->db->get(); 
			if($query->num_rows() > 0) {
		      foreach($query->result() as $row) {
		       
		       $data[] = $row;
		       
		       
		       
		      }
		      return $data;
		 }			
	
}














}