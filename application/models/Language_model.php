<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {

  public function get_lang($params) {
		$lang = $params['lang'];	
		if($lang=="en"){
			$select = "s_eng";
		}else if($lang=="cn"){
			$select = "s_cn";
		}	else if($lang=="th"){
			$select = "s_th";
		}	
		$db2 = $this->load->database('dd', TRUE);
		$tb_product = $db2->dbprefix('ap_language');
		$db2_select = $db2->select($select)->from($tb_product)->where('i_deleted',0)->get();
//   		$query = $this->db->select($select)->where('i_deleted',0)->get('ap_language');
//   		$this->db->where('pro',$id);
   		foreach($db2_select->result() as $key=>$value){
        	
			$row[$key]['i_id'] = $value->i_id;
            $row[$key]['s_eng'] = $value->s_eng;
            $row[$key]['s_cn'] = $value->s_cn;
            $row[$key]['s_th'] = $value->s_th;
            $row[$key]['d_last_update'] = $value->d_last_update;
            $row[$key]['key'] = $value->s_eng;
			}
			return $row;
	}
  /**
  * *********** End
  * 
  * @example 
{
"lang" : "en"
}

  * 
  */
  
}