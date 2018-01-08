<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {


	public function loaddata($params) {
  	
  if(isset($params['from'])){
  	
 	  	 
  	if(isset($params['request'])){
  	  	if($params['request']!=""){
		$request[] = $params['request'];
		
		foreach($request as $key => $value){
			
			foreach($value as $key2 => $value2){
			$this->db->where(''.$key2.'',''.$value2.'');
		
				}			
			}
		}

	  }	 
	//$this->db->where('status','1');
	$from = $params['from'];
  	if(!empty($params['field'])){
		$field[] = $params['field'];
		
	  	foreach($field as $name){
				$this->db->select($name);
		}
	}
	else{
		$this->db->select('*');	
	}
//	$this->db->limit(1);	
  	$result_check = $this->db->table_exists($from) ;
  	
  	if($result_check==TRUE){
	$query = $this->db->from($from)->get();
    if($query->num_rows() > 0) {
      foreach($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    else{
    	$response['status'] = '402';
    	$response['m'] = 'no record';
 		return $response;	
	}
	}
  	else{
  		
		$data = array();
		array_push($data,'status','402');
		array_push($data,'m','no have this table');
 		return $data;
 			
	}
   

 }
  else{
 	$data = array();
		array_push($data,'status','402');
		array_push($data,'m','json is wrong');
 		return $data;
 }
 
 
}

	function table_exists($table_name){
    return ( ! in_array($this->_protect_identifiers($table_name, TRUE, FALSE, FALSE), $this->list_tables())) ? FALSE : TRUE;
}

	public function get_place($params){
	$field = array("place.id","place.topic","pro.name","aum.name","place.address");

	$from = $params['place_from'];
	$to = $params['place_to'];
		$array = array();
		if($from!=""){
			 	foreach($field as $name){
				$this->db->select($name);
			}
			$this->db->from('web_transferplace_new place'); 
			$this->db->join('web_province pro', 'place.pro = pro.id', 'left');
			$this->db->join(' web_amphur aum', 'place.aum = aum.id', 'left');
			$this->db->where('place.id',''.$from.'');		
		//	$this->db->where('place.status',1);		
			$query = $this->db->get(); 
		
       		if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
			   		array_push($array,$row);
			      }
	
				};
		}		
		if($to!=""){
			 	foreach($field as $name){
				$this->db->select($name);
			}
			$this->db->from('web_transferplace_new place'); 
			$this->db->join('web_province pro', 'place.pro = pro.id', 'left');
			$this->db->join(' web_amphur aum', 'place.aum = aum.id', 'left');
			$this->db->where('place.id',''.$to.'');		
			$query = $this->db->get(); 
		
       		if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
			   		array_push($array,$row);
			      }
	
				};
		}
		
	return $array;
	
}

	public function search($params){
	 
	 
if(isset($params['like'])){
		
		$value2 = $params['like'];
		
		
		$query = $this->db->query("select id,aum,pro,topic,address,latitude,longitude FROM web_transferplace_new
		WHERE topic LIKE  '%".$value2."%' and status = 1
		ORDER BY LOCATE(  '".$value2."' , topic )   ");
		
		/*$this->db->select('id,aum,pro,topic,address,latitude,longitude');	
		$this->db->like('topic', ''.$value2.'');
		$this->db->where('status','1');
		
  	 	 $query = $this->db->from('web_transferplace_new')->get();*/
  	 	 
  	 	 
	  	 if($query->num_rows() > 0) {
	      foreach($query->result() as $row) {
	        $data[] = $row;
	      }
	      
	      return $data;
	    }
	     else{
	    	$response['status'] = '402';
	    	$response['m'] = 'no record';
	 		return $response;	
		}

	
}else{
	 	$data = array();
			array_push($data,'status','402');
			array_push($data,'m','json is wrong');
	 		return $data;
	 }

}

}