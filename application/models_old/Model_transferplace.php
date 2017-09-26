<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transferplace extends CI_Model {

  public function place($id) {

   $chk_product = $this->db->select('*')->where('code',$id)->from('web_product')->get()->row();
   
   if($chk_product->id != ''){
   	
   	
   	//////////// check province
   	$res[project] = $db->select_query("SELECT * FROM ".TB_product_transfer." where product = '".$_GET[program_tour]."' ");
while($arr[project] = $db->fetch($res[project])){
$province_in .= " or pro = '".$arr[project][province]."'";
$province_in_l = "  pro = '".$arr[project][province]."'";
}
   	
   	
   	
   	
   }else{
   	$chk_product = $this->db->select('*')->where('code',$id)->from('web_transferproduct')->get()->row();
   	if($chk_product->id != ''){



if($chk_product->stay != '' and $chk_product->stay != '0' ){
	//$stay_ok = " and pro = '".$chk_product->stay."' ";
	$this->db->where('pro',$chk_product->stay);
}

if($chk_product->aum_from != '' and $chk_product->aum_from != '0' ){
	//$aum_ok = " and aum = '".$arr[product][aum_from]."' ";
	$this->db->where('aum',$chk_product->aum_from);
}

$query = $this->db->select('topic,address,amphur,province')->where('status',1)->get('web_transferplace_new');
       foreach($query->result() as $row){
        	
				$data[] = $row;
			}
			return $data;


	}else{
		return "Not Found";
	}
   }
   
   
   // $query = $this->db->select('*')->from('web_transferplace')->get();
  /*
   if($id){
   	$this->db->where('pro',$id);
   }
   //*/
    
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