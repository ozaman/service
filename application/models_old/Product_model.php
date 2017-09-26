<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {


public function loaddata($params) {
$select = array("a.topic_en AS topic_en",
       "a.topic_cn AS topic_cn",
       "a.topic_th AS topic_th",
       "a.onsale_top AS pro_ontop",
       "a.id AS transfer_id",
       "a.stay",
       "a.stay_to",
       "a.cartype",
       "a.cost_a_sell AS cost_a_agent_all",
       "a.type",
       "a.post_date",
       "b.id AS car_id",
       "b.person AS person",
       "b.topic_en AS car_topic_en",
       "b.topic_th AS car_topic_th",
       "b.topic_cn AS car_topic_cn",
       "b.pax AS pax_en",
       "b.pax_th AS pax_th",
       "b.pax_cn AS pax_cn",
       "b.topic AS topic_car",
       "b.car_model",
       "c.id AS province_id",
       "c.front_transfer AS front_transfer",
       "c.name AS province_name_en",
       "c.name_cn AS province_name_cn",
       "c.name_th AS province_name_th",
       "d.id AS province_id_to",
       "d.name_th AS province_name_to",
       "d.name_cn AS province_name_to_cn",
       "d.name AS province_name_to_th",
       "e.post_date AS transfer_icon");
/* $select = array(
       "a.id AS transfer_id");*/
$array = array();

if($params['place_default']!="" or $params['place_default']!=NULL and $params['place_default_to']!="" or $params['place_default_to']!=NULL and $params['aum_to']!="" or $params['aum_to']!=NULL and $params['aum_from']!="" or $params['aum_from']!=NULL){
		  	$place_default_to = $params['place_default_to'];
		  	$aum_to = $params['aum_to'];
		  	$aum_from = $params['aum_from'];
		  	foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->join('web_province c', 'c.id=a.stay', 'left');
			$this->db->join('web_province d', 'd.id=a.stay_to', 'left');
			$this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
			$this->db->where('aum_from',$aum_from);
			$this->db->where('place_default_to',$place_default_to);
			$this->db->where('aum_to',$aum_to);
			$this->db->where('aum_from',$aum_from);
			$this->db->group_by('a.id'); 
			$query = $this->db->get(); 
			if($query->num_rows() > 0) {
		      foreach($query->result() as $row) {
		       $data[] = $row;
		       array_push($array,$row);
		      }
		 }
	}		

if($params['place_default']!="" or $params['place_default']!=NULL and $params['place_default_to']!="" or $params['place_default_to']!=NULL){
		  	$place_default_to = $params['place_default_to'];
		  	$place_default = $params['place_default'];
		  	foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->join('web_province c', 'c.id=a.stay', 'left');
			$this->db->join('web_province d', 'd.id=a.stay_to', 'left');
			$this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
			$this->db->where('place_default',$place_default);
			$this->db->where('place_default_to',$place_default_to);
			$this->db->group_by('a.id'); 
			$query = $this->db->get(); 
			if($query->num_rows() > 0) {
		      foreach($query->result() as $row) {
		       //$data[] = $row;
		       array_push($array,$row);
		      }
		 }
	}	

if($params['place_default']!="" or $params['place_default']!=NULL and $params['aum_to']!="" or $params['aum_to']!=NULL){
		  	$aum_to = $params['aum_to'];
		  	$place_default = $params['place_default'];
		  	foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->join('web_province c', 'c.id=a.stay', 'left');
			$this->db->join('web_province d', 'd.id=a.stay_to', 'left');
			$this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
			$this->db->where('a.place_default',$place_default);
			$this->db->where('a.aum_to',$aum_to);
			$this->db->group_by('a.id'); 
			
			//$query = $this->db->get('web_transferproduct');
			$query = $this->db->get(); 
			if($query->num_rows() > 0) {
		      foreach($query->result() as $row) {
		      
		       array_push($array,$row);
		      }
		 }
	}

if($params['aum_from']!="" or $params['aum_from']!=NULL and $params['place_default_to']!="" or $params['place_default_to']!=NULL){
		  	$aum_from = $params['aum_from'];
		  	$place_default_to = $params['place_default_to'];
		  	foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->join('web_province c', 'c.id=a.stay', 'left');
			$this->db->join('web_province d', 'd.id=a.stay_to', 'left');
			$this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
			$this->db->where('aum_from',$aum_from);
			$this->db->where('place_default_to',$place_default_to);
			$this->db->group_by('a.id'); 
			$query = $this->db->get(); 
			if($query->num_rows() > 0) {
		      foreach($query->result() as $row) {
		       //$data[] = $row;
		       array_push($array,$row);
		      }
		 }
	}	
		
if($params['aum_to']!="" or $params['aum_to']!=NULL and $params['aum_from']!="" or $params['aum_from']!=NULL){
		  	$aum_to = $params['aum_to'];
		  	$aum_from = $params['aum_from'];
		  	foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->join('web_province c', 'c.id=a.stay', 'left');
			$this->db->join('web_province d', 'd.id=a.stay_to', 'left');
			$this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
			$this->db->where('aum_to',$aum_to);
			$this->db->where('aum_from',$aum_from);
			$this->db->group_by('a.id'); 
			$query = $this->db->get(); 
			if($query->num_rows() > 0) {
		      foreach($query->result() as $row) {
		       //$data[] = $row;
		       array_push($array,$row);
		      }
		 }
	}
	 
return $array;



  }

public function querydata($params) {
$select = array("f.topic_en AS topic_en",
       "f.topic_cn AS topic_cn",
       "f.topic_th AS topic_th",
       "a.onsale_top AS pro_ontop",
       "a.id AS transfer_id",
       "a.stay",
       "a.stay_to",
       "a.cartype",
       "a.cost_a_sell AS cost_a_agent_all",
       "a.type",
       "a.post_date",
       "b.id AS car_id",
       "b.person AS person",
       "b.topic_en AS car_topic_en",
       "b.topic_th AS car_topic_th",
       "b.topic_cn AS car_topic_cn",
       "b.pax AS pax_en",
       "b.pax_th AS pax_th",
       "b.pax_cn AS pax_cn",
       "b.topic AS topic_car",
       "b.car_model",
       "c.id AS province_id",
       "c.front_transfer AS front_transfer",
       "c.name AS province_name_en",
       "c.name_cn AS province_name_cn",
       "c.name_th AS province_name_th",
       "d.id AS province_id_to",
       "d.name_th AS province_name_to",
       "d.name_cn AS province_name_to_cn",
       "d.name AS province_name_to_th",
       "e.post_date AS transfer_icon",
       "a.aum_from",
       "a.aum_to",
       "a.place_default",
       "a.place_default_to");
/* $select = array(
       "a.id AS transfer_id");*/
$data_find = array();
$data_not_find = array();
if(($params['place_default']==!"" or $params['place_default']==!NULL) and ($params['place_default_to']==!"" or $params['place_default_to']==!NULL)){
		$this->db->select('aum');
		$this->db->from('web_transferplace_new'); 
		$this->db->where('id',$params['place_default']);
		$query = $this->db->get(); 
		$data_aum_from = $query->row()->aum;
		
		$this->db->select('aum');
		$this->db->from('web_transferplace_new'); 
		$this->db->where('id',$params['place_default_to']);
		$query = $this->db->get(); 
		$data_aum_to = $query->row()->aum;
		
		$place_default = $params['place_default'];
		$place_default_to = $params['place_default_to'];

//		aum_from <-> aum_to
			$query = $this->callselect($select,'aum_to',$data_aum_from ,'aum_from',$data_aum_to,"");
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
			      array_push($data_find,$row);
			      }
			}
			
			//		place_default <-> $place_default_to
			$query = $this->callselect($select,'place_default',$place_default ,'place_default_to',$place_default_to,"");
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
			      array_push($data_find,$row);
			      }
			}
			 
			 //		aum_from <-> place_default_to
			$query = $this->callselect($select,'aum_from',$data_aum_from ,'place_default_to',$place_default_to,"");
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
			      array_push($data_find,$row);
			      }
			}
			
			 //		place_default <-> aum_to
			$query = $this->callselect($select,'place_default',$place_default ,'aum_to',$data_aum_to,"");
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
			      array_push($data_find,$row);
			      }
			}
			
$arrayname['status'] =  "202";
		$this->db->select('pro');
		$this->db->from('web_transferplace_new'); 
		$this->db->where('id',$params['place_default']);
		$query = $this->db->get(); 
		$data_pro_from = $query->row()->pro;
		
		$this->db->select('pro');
		$this->db->from('web_transferplace_new'); 
		$this->db->where('id',$params['place_default_to']);
		$query = $this->db->get(); 
		$data_pro_to = $query->row()->pro;
		
//		if not find product 
			$query = $this->callselect($select,'stay',$data_pro_from ,'stay_to',$data_pro_to,20);
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
			     array_push($data_not_find,$row);
			      }
			}
			
$arrayname['messge'] =  "Load Data False";
$arrayname['data1'] =  $data_find;
$arrayname['data2'] =  $data_not_find;


$enddata = $arrayname;
/*array_push($enddata,$arrayname);*/

$st = array();
return array('status' => 200,"response"=>$enddata);



		}
		
  else{
		$status['status']="402. bad request";  	
		return $status;
  }
  
}



function callselect($select,$str1,$where1,$str2,$where2,$limit){
	
	foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->join('web_province c', 'c.id=a.stay', 'left');
			$this->db->join('web_province d', 'd.id=a.stay_to', 'left');
			$this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
			$this->db->join('web_transferproduct_utf f', 'f.id=a.id', 'left');
			$this->db->where(''.$str1.'',''.$where1.'');
			$this->db->where(''.$str2.'',''.$where2.'');
			$this->db->group_by('a.id');
			if($limit!=""){
				$this->db->limit($limit); 
			} 
			
			$query = $this->db->get(); 
	return $query;
}
















}