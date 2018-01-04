<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_model extends CI_Model {


  	public function queryData($param) {
		 $select = array('tbl_web_product.topic', 
'tbl_web_product.detail_en', 
'tbl_web_product.detail_cn',
'tbl_web_product.detail_th', 
'tbl_web_product.cost_a_agent_all',
'tbl_web_product.cost_b_agent_all', 
'tbl_web_product.type', 
'tbl_web_product.topic_en_web as topic_en',
'tbl_web_product.topic_cn_web as topic_cn',
'tbl_web_product.topic_th_web as topic_th',
'tbl_web_product.onsale_front', 
'tbl_web_product.onsale_enable', 
'tbl_web_product.onsale_promotion', 
'tbl_web_product.onsale_top',
'tbl_web_product.image_crop',
'tbl_web_product.id',
'tbl_web_product.round_en',
'tbl_web_product.province',
'tbl_web_product.open_Sun',
'tbl_web_product.open_Mon', 
'tbl_web_product.open_Tue',
'tbl_web_product.open_Wed',
'tbl_web_product.open_Thu',
'tbl_web_product.open_Fri',
'tbl_web_product.open_Sat',
'tbl_web_admin.company',
'tbl_web_product.province',
'tbl_province.name_th as province_name');

		  $pd_type = $param[type];
		  foreach ($select as $key => $value){
				$this->db->select($value);
			}	
			
			$this->db->from('web_product tbl_web_product'); 
			$this->db->join('web_admin tbl_web_admin', 'tbl_web_product.company=tbl_web_admin.id', 'left');
			$this->db->join('web_province tbl_province', 'tbl_web_product.province=tbl_province.id', 'left');
		 	$this->db->where('tbl_web_product.onsale_enable =','1');
		 	$this->db->where('tbl_web_product.type like ',''.$pd_type.'');
		 	$query = $this->db->get(); 
		 	if($query->num_rows() > 0) {
		 	 foreach($query->result() as $row){	
				$data_query[] = $row;
				}
				$status = '202';
				$messge = "Load Data Success";
			 }else{
			 		$data = false;
			 		$status = '404';
			 		$messge = "No data row";
			 }
		 	
		 	$this->db->select('t1.province as,t2.name_th,t2.name,t2.name_cn');
		 	$this->db->from('web_product t1'); 
		 	$this->db->join('web_province t2', 't1.province=t2.id', 'left');
		 	$this->db->where('t1.onsale_enable =','1');
		 	$this->db->where('t1.type like ',''.$pd_type.'');
      		$this->db->group_by('t1.province');
      		$query2 = $this->db->get(); 

      		foreach($query2->result() as $row){  	
				$pv[] = $row;
			}
			
			$data['status'] = $status;
      		$data['messge'] =  $messge;
      		$data['size'] =  sizeof($query->result());	
      		$data['province'] = $pv;
      		$data['data'] = $data_query;
      		$data['params'] = $param;
//			return $data;
			
			return array('status' => 200,"response"=>$data);
		
	}

	
} 

?>