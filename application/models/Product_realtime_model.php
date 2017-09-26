<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_realtime_model extends CI_Model {


public function getProduct($params) {
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
       "d.name_th AS province_name_to_th",
       "d.name_cn AS province_name_to_cn",
       "d.name AS province_name_to_en",
       "e.post_date AS transfer_icon",
       "a.aum_from",
       "a.aum_to",
       "a.place_default",
       "a.place_default_to",
       "a.area,
       a.code,
       a.cost_a");

$data_find = array();
$data_not_find = array();
if(($params['lat_f']==!"" or $params['lng_f']==!NULL) and ($params['lat_t']==!"" or $params['lng_t']==!NULL)){
	
	    $arr = array();
        $lat_f = $params['lat_f'];
        $lng_f = $params['lng_f'];
        
        $lat_t = $params['lat_t'];
        $lng_t = $params['lng_t'];
        $distance = $params['dist'];

//		7.886645743483469,98.42643588781357 from 
//		7.891970015092479,98.36815685033798 to 
		
		$pro = $this->googleService($lat_f,$lng_f);		
		//// from 	
		$data_from = $this->calculator($lat_f,$lng_f,$pro,$distance);
		
		//// to
		$data_to = $this->calculator($lat_t,$lng_t,$pro,$distance);
		
		$aum_from = $data_from['aum'];
		$place_from = $data_from['id'];
		
		$aum_to = $data_to['aum'];
		$place_to = $data_to['id'];
		
		$fromlatlng['lat'] = $lat_f;  
		$fromlatlng['lng'] = $lng_f; 
		
		$fromlatlngT['lat'] = $lat_t;  
		$fromlatlngT['lng'] = $lng_t;  
		
		$detail['from'] = $fromlatlng;
		$detail['to'] = $fromlatlngT;
		
		$place['from'] = $place_from;
		$place['to'] = $place_to;
		
		$detail['aum'] = '{"aum_from":"'.$aum_from.'","aum_to":"'.$aum_to.'"}';
		$detail['place'] = '{"place_from":"'.$place_from.'","place_to":"'.$place_to.'"}';
		
//		$result = $this->productMain($select,$aum_from,$aum_to,$place_from,$place_to,$data_find);			
		
		/*$car_topic = array();
		$car_topic_result = array();
		$sub = array();
		
		foreach($result as $key=>$row){
			array_push($car_topic,$row->car_topic_en);
				
			}
		$num_cartype = array_unique($car_topic);	
		
		$car_topic_lang = array('en','cn','th');

		foreach ($car_topic_lang as $key=>$value){
			
			foreach($result as $key2=>$row){
				
				if($value=="en"){
					$sub[$key2] = $row->car_topic_en;
				}else if($value=="cn"){
					$sub[$key2] = $row->car_topic_cn;
				}else if($value=="th"){
					$sub[$key2] = $row->car_topic_th;
				}
				
			}	
	
			$sub_unique = array_unique($sub);	
			$q[$value] = $sub_unique;
		}
	
	$final_arr = array();
	foreach ($q as $key=>$value){
		
		foreach($value as $key2=>$row2){
			if($key=='en'){
				$en[] = $row2;
			}
			else if($key=='cn'){
				$cn[] = $row2;
			}
			else if($key=='th'){
				$th[] = $row2;
			}
			
		}
	}
	array_push($final_arr,$en);
	array_push($final_arr,$cn);
	array_push($final_arr,$th);
				

		
		$data_find_all['status'] =  "202";	
		$data_find_all['messge'] =  "Load Data Success";
		$data_find_all['cartype'] =  $final_arr;
		$data_find_all['size'] = sizeof($result);		
		$data_find_all['data1'] = $result;
		$data_find_all['detail'] = $detail;			

				 return array('status' => 200,"response"=>$data_find_all);*/
				 
			return $place;	 
				 
		}
		
  else{
		$status['status']="200. bad request";  	
		return array('status' => 200,"response"=>$status);
  }
  
}

function productMain($select,$data_aum_from,$data_aum_to,$from,$to,$data_find){
	
			$query = $this->callselect($select,'aum_to',$data_aum_to ,'aum_from',$data_aum_from,"",$from,$to);
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			     array_push($data_find,$row);
			      }
			}
			
			//		place_default <-> $to
			$query = $this->callselect($select,'place_default',$from ,'place_default_to',$to,"",$from,$to);
			if($query->num_rows() > 0) {
			       foreach($query->result() as $row) {
			      array_push($data_find,$row);
			     
			      }
			}
			 
			 //		aum_from <-> place_default_to
			$query = $this->callselect($select,'aum_from',$data_aum_from ,'place_default_to',$to,"",$from,$to);
			if($query->num_rows() > 0) {
			       foreach($query->result() as $row) {
			       //$data[] = $row;
			     array_push($data_find,$row);
			      }
			}
			
			 //		place_default <-> aum_to
			$query = $this->callselect($select,'place_default',$from ,'aum_to',$data_aum_to,"",$from,$to);
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       array_push($data_find,$row);
			     
			      }
			}
		$this->db->select('pro');
		$this->db->from('web_transferplace_new'); 
		$this->db->where('id',$from);
		$query = $this->db->get(); 
		$data_pro_from = $query->row()->pro;
		
		$this->db->select('pro');
		$this->db->from('web_transferplace_new'); 
		$this->db->where('id',$to);
		$query = $this->db->get(); 
		$data_pro_to = $query->row()->pro;
		
//		if not find product query Nearby Products
			$query = $this->callselect($select,'stay',$data_pro_from ,'stay_to',$data_pro_to,20);
			if($query->num_rows() > 0) {
			      foreach($query->result() as $row) {
			       //$data[] = $row;
//			     array_push($data_not_find,$row);
			     array_push($data_find,$row);
			      }
			}
	return $data_find;
	
}

function googleService($lat,$lng){
	 $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=false";
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
        $status = $response_a->status;
               if ($status=="OK") {
                    $len = sizeof($response_a->results);
                    $pro = $response_a->results[$len-2]->address_components[0]->long_name;    
          
					return $pro;
            	}
}

function calculator($lat,$lng,$pro,$distance){
	                $this->db->select('id,topic,aum,pro,map,latitude,longitude,amphur');      
				
                    $this->db->from('web_transferplace_new');
                    $this->db->where('province', ''.$pro.'');
                    $query = $this->db->get();
                    if($query->num_rows() > 0) {
                    	$num = 1;
                        foreach($query->result() as $key=>$row) {
                           $theta = $lng - $row->longitude;
                           $dist = sin(deg2rad($lat)) * sin(deg2rad($row->latitude)) +  cos(deg2rad($lat)) * cos(deg2rad($row->latitude)) * cos(deg2rad($theta));
                                $dist = acos($dist);
                                $dist = rad2deg($dist);
                                $miles = $dist * 60 * 1.609344;
//								 $x = $miles-$distance;
                               					
                               					if(empty($find_form) ){
													$find_form['mil'] = $miles;
					                                $find_form['id'] = $row->id;
													$find_form['topic'] = $row->topic;
													$find_form['aum'] = $row->aum;
												}else{
													
													if($find_form['mil']>$miles){
														$find_form['mil'] = $miles;
						                                $find_form['id'] = $row->id;
														$find_form['topic'] = $row->topic;
														$find_form['aum'] = $row->aum;
														$find_form['lat'] = $row->latitude;
														$find_form['lng'] = $row->longitude;
													}
													
												}
												
								 
                           
                			}

                			return $find_form;
                	}
}

function callselect($select,$str1,$where1,$str2,$where2,$limit,$place_from,$place_to){
	
	foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			$this->db->from('web_transferproduct a'); 
			$this->db->join('web_car b', 'b.id=a.cartype', 'left');
			$this->db->join('web_province c', 'c.id=a.stay', 'left');
			$this->db->join('web_province d', 'd.id=a.stay_to', 'left');
			$this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
			$this->db->join('web_transferproduct_utf f', 'f.id=a.id', 'left');
			$this->db->where('a.place_default_to !=',''.$place_from.'');
			$this->db->where('a.place_default !=',''.$place_to.'');
			$this->db->where(''.$str1.'',''.$where1.'');
			$this->db->where(''.$str2.'',''.$where2.'');
			$this->db->where('a.area !=','Service');
			$this->db->group_by('a.id');
			if($limit!=""){
				$this->db->limit($limit); 
			} 
			
			$query = $this->db->get(); 
	return $query;
}



public function getPlaceId($params){
	 	$lat = $params['lat_c'];
        $lng = $params['lng_c'];
        
        $pro = $this->googleService($lat,$lng);		
		//// from 	
		$distance = '';
		$data_from = $this->calculator($lat,$lng,$pro,$distance);
		
		return $data_from;
        
}



}

