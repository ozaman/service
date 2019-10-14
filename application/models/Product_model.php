<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function querydata2($params) {
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
            "b.id AS pax_id",
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
            "a.area",
            "a.code",
            "a.cost_a",
            "a.cost_a_sell",
            "a.cost_a_nett",
            "a.all_area",
            "a.pier_from",
            "a.pier_to");
        /* ,
          g.id as id_typearea,
          g.title */
        $not = 'Service';


        $from = $params['from'];
        $to = $params['to'];


        $data_filter1 = array();
        $data_find = array();
        $data_not_find = array();




        $this->db->select('pro,pier');
        $this->db->from('web_transferplace_new');
        $this->db->where('id', $from);
        $query = $this->db->get();
        $data_pro_from = $query->row()->pro;
        $data_pier_from = $query->row()->pier;

        $this->db->select('pro,pier');
        $this->db->from('web_transferplace_new');
        $this->db->where('id', $to);
        $query = $this->db->get();
        $data_pro_to = $query->row()->pro;
        $data_pier_to = $query->row()->pier;

        /*       $data_pro_from = $params['stay_from'];
          $data_pro_to = $params['stay_to']; */
        foreach ($select as $key => $value) {
            $this->db->select($value);
        }
        $this->db->from('web_transferproduct a');
        $this->db->join('web_car b', 'b.id=a.cartype', 'left');
        $this->db->join('web_province c', 'c.id=a.stay', 'left');
        $this->db->join('web_province d', 'd.id=a.stay_to', 'left');
        $this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
        $this->db->join('web_transferproduct_utf f', 'f.id=a.id', 'left');
//			$this->db->join('web_typearea g', 'g.id=a.cartype', 'left');
        $this->db->where('a.place_default_to !=', '' . $from . '');
        $this->db->where('a.place_default !=', '' . $to . '');

        $this->db->where('a.stay =', '' . $data_pro_from . '');
        $this->db->where('a.stay_to =', '' . $data_pro_to . '');
        $this->db->where('a.status =', '1');

        $this->db->group_by('a.id');
        $this->db->order_by("a.cost_a", "asc");
        /* if($limit!=""){
          $this->db->limit($limit);
          } */

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                array_push($data_filter1, $row);
            }
        }

        $this->db->select('aum');
        $this->db->from('web_transferplace_new');
        $this->db->where('id', $params['from']);
        $query = $this->db->get();
        $data_aum_from = $query->row()->aum;

        $this->db->select('aum');
        $this->db->from('web_transferplace_new');
        $this->db->where('id', $params['to']);
        $query = $this->db->get();
        $data_aum_to = $query->row()->aum;
        $check;
        $checkfronORto;
        $ssss;
        $data_find3 = array();





        foreach ($data_filter1 as $key => $data) {
            if ($data_filter1[$key]->place_default == $from || $data_filter1[$key]->place_default_to == $to) {
                $check = 1;
                if ($data_filter1[$key]->place_default == $from and $data_filter1[$key]->place_default_to != $to) {
                    $checkfronORto = 'From';
                }
                if ($data_filter1[$key]->place_default != $from and $data_filter1[$key]->place_default_to == $to) {
                    $checkfronORto = 'To';
                }
            } else {
                $check = 0;
            }
        }

        //		aum_from <-> aum_to
        foreach ($data_filter1 as $key => $data) {
            if ($data_filter1[$key]->aum_from == $data_aum_from and $data_filter1[$key]->aum_to == $data_aum_to) {
                array_push($data_find, $data);
            }
        }
        //		place_default <-> place_default_to
        foreach ($data_filter1 as $key => $data) {
            if ($data_filter1[$key]->place_default == $from and $data_filter1[$key]->place_default_to == $to) {
                array_push($data_find, $data);
            }
        }
        //		aum_from <-> place_default_to
        foreach ($data_filter1 as $key => $data) {
            if ($data_filter1[$key]->aum_from == $data_aum_from and $data_filter1[$key]->place_default_to == $to) {
                array_push($data_find, $data);
            }
        }
        //			place_default <-> aum_to
        foreach ($data_filter1 as $key => $data) {
            if ($data_filter1[$key]->place_default == $from and $data_filter1[$key]->aum_to == $data_aum_to) {
                array_push($data_find, $data);
            }
        }

        $data_return['place_from'] = $from;
        $data_return['place_to'] = $to;
        $data_return['aum_from'] = $data_aum_from;
        $data_return['aum_to'] = $data_aum_to;
        $data_return['stay'] = $data_pro_from;
        $data_return['stay_to'] = $data_pro_to;
        $data_return['pier_to'] = $data_pier_to;
        $data_return['pier_from'] = $data_pier_from;

//		if not find product query Nearby Products
        $arry_check_private = array();
        foreach ($data_find as $key => $data) {
            if ($data_find[$key]->type == "Private") {
                array_push($arry_check_private, $data);
            }
        }
        $data_find_private = array();



        /* if($data_filter1[$key]->pier_from==$data_pier_from){

          } */

        foreach ($data_filter1 as $key => $data) {

            if ($data_filter1[$key]->all_area == 1) {
                if ($check == 0) {
                    if ($data_filter1[$key]->area != "In" and $data_filter1[$key]->area != "Out") {
                        if ($data_filter1[$key]->stay == $data_pro_from and $data_filter1[$key]->stay_to == $data_pro_to) {
                            if ($data_filter1[$key]->aum_from == $data_aum_from or $data_filter1[$key]->aum_from == $data_aum_to) {
                                array_push($data_find, $data);
                            }
                        }
                    }
                }
            }
            // foreach($data_filter1 as $key=>$data){
            // ($data_filter1[$key]->all_area==1 and $data_filter1[$key]->pier_from != 1) and $data_filter1[$key]->pier_to != 1)
            if ($data_filter1[$key]->all_area == 1) {

                if ($data_filter1[$key]->area == "Out") {
                    if (($data_filter1[$key]->stay == $data_pro_from and $data_filter1[$key]->stay_to == $data_pro_to) and ( $data_filter1[$key]->place_default_to == $to and $data_filter1[$key]->place_default == "")) {
                        if ($data_filter1[$key]->aum_from == "" or $data_filter1[$key]->aum_from == 0) {
                            array_push($data_find, $data);
                        }
                    }
                } else if ($data_filter1[$key]->area == "In") {
                    if ($data_filter1[$key]->stay == $data_pro_from and $data_filter1[$key]->stay_to == $data_pro_to and $data_filter1[$key]->place_default == $from and $data_filter1[$key]->place_default_to == "") {
                        if ($data_filter1[$key]->aum_to == "" or $data_filter1[$key]->aum_from == 0) {
                            array_push($data_find, $data);
                        }
                    }
                }
            }
        }
        // }
        // if($check == 1){
        // 	if($data_filter1[$key]->area=="Out"){
        // 		if(($data_filter1[$key]->stay==$data_pro_from and $data_filter1[$key]->stay_to==$data_pro_to) and ($data_filter1[$key]->place_default_to==$to and $data_filter1[$key]->place_default=="")){
        // 			if($data_filter1[$key]->aum_from=="" or $data_filter1[$key]->aum_from==0){
        // 					array_push($data_find3,$data);
        // 			}
        // 		}
        // 	}
        // 	if($data_filter1[$key]->area=="In"){
        // 		if($data_filter1[$key]->stay==$data_pro_from and $data_filter1[$key]->stay_to==$data_pro_to and $data_filter1[$key]->place_default==$from and $data_filter1[$key]->place_default_to==""){
        // 			if($data_filter1[$key]->aum_to=="" or $data_filter1[$key]->aum_from==0){
        // 					array_push($data_find3,$data);
        // 			}
        // 		}					
        // 	}
        // }
        // if($data_filter1[$key]->area=="Out"){
        // 		if(($data_filter1[$key]->stay==$data_pro_from and $data_filter1[$key]->stay_to==$data_pro_to) and ($data_filter1[$key]->place_default_to==$to and $data_filter1[$key]->place_default=="")){
        // 			if($data_filter1[$key]->aum_from=="" or $data_filter1[$key]->aum_from==0){
        // 				array_push($data_find,$data);
        // 			}
        // 	}
        // }
        // if($data_filter1[$key]->area=="In"){
        // 	if($data_filter1[$key]->stay==$data_pro_from and $data_filter1[$key]->stay_to==$data_pro_to and $data_filter1[$key]->place_default==$from and $data_filter1[$key]->place_default_to==""){
        // 			if($data_filter1[$key]->aum_to=="" or $data_filter1[$key]->aum_from==0){
        // 				array_push($data_find,$data);
        // 			}
        // 	}
        // }


        /* else{

          if($data_filter1[$key]->stay==$data_pro_from and $data_filter1[$key]->stay_to==$data_pro_to and $data_filter1[$key]->place_default=="" and $data_filter1[$key]->place_default_to=="" and ($data_filter1[$key]->aum_from=="" or $data_filter1[$key]->aum_from==0) and ($data_filter1[$key]->aum_to=="" or $data_filter1[$key]->aum_to==0))
          {
          if($data_filter1[$key]->pier_to==$data_pier_to){
          if($data_filter1[$key]->aum_to=="" or $data_filter1[$key]->aum_from==0){
          array_push($data_find,$data);
          }
          }
          }

          } */





        // 	else if($data_filter1[$key]->pier_from == 1 and $data_filter1[$key]->pier_from == 1){
        // 		if ($data_filter1[$key]->pier_from == 1 and $data_filter1[$key]->pier_to == 0) {			
        // 			array_push($data_find,$data);
        // 		}
        // 		else if ($data_filter1[$key]->pier_to == 1 and $data_filter1[$key]->pier_from == 0) {			
        // 			array_push($data_find,$data);
        // 		}
        // 		else{
        // 			array_push($data_find,$data);
        // 		}
        // }	


        if (sizeof($data_find) == 0) {

            $ssss = 1;
            foreach ($data_filter1 as $key => $data) {
                // ($data_filter1[$key]->all_area==1 and $data_filter1[$key]->pier_from != 1) and $data_filter1[$key]->pier_to != 1)
                if ($data_filter1[$key]->all_area == 1) {

                    if ($data_filter1[$key]->area == "Out") {
                        if (($data_filter1[$key]->stay == $data_pro_from and $data_filter1[$key]->stay_to == $data_pro_to) and ( $data_filter1[$key]->place_default_to == $to and $data_filter1[$key]->place_default == "")) {
                            if ($data_filter1[$key]->aum_from == "" or $data_filter1[$key]->aum_from == 0) {
                                array_push($data_find, $data);
                            }
                        }
                    } else if ($data_filter1[$key]->area == "In") {
                        if ($data_filter1[$key]->stay == $data_pro_from and $data_filter1[$key]->stay_to == $data_pro_to and $data_filter1[$key]->place_default == $from and $data_filter1[$key]->place_default_to == "") {
                            if ($data_filter1[$key]->aum_to == "" or $data_filter1[$key]->aum_from == 0) {
                                array_push($data_find, $data);
                            }
                        }
                    }
                }
                if (($data_filter1[$key]->stay == $data_pro_from and $data_filter1[$key]->stay_to == $data_pro_to) and $data_filter1[$key]->area == 'Point'and $data_filter1[$key]->all_area == 1) {
                    // if($data_filter1[$key]->aum_from==$data_aum_from or $data_filter1[$key]->aum_from==$data_aum_to){
                    if ($data_filter1[$key]->area != "In" and $data_filter1[$key]->area != "Out") {
                        array_push($data_find, $data);
                    }
                    // }
                }
            }
        } else {
            $ssss = 0;
        }
        // foreach($data_filter as $key=>$data){
        // 	if($data_filter[$key]->all_area==1 and ){
        // 		if ($check == 0) {
        // 			if($data_filter1[$key]->area !="In" and $data_filter1[$key]->area!="Out"){
        // 			if($data_filter1[$key]->stay==$data_pro_from and $data_filter1[$key]->stay_to==$data_pro_to){
        // 					if($data_filter1[$key]->aum_from==$data_aum_from or $data_filter1[$key]->aum_from==$data_aum_to){
        // 						array_push($data_find,$data);
        // 					}
        // 				}
        // 		}
        // 		if ($check == 1) {
        // 		}
        // 		}
        // 			}	
        // }




        $car_topic = array();
        $car_topic_result = array();
        $sub = array();
        $datatopic = array();

        foreach ($data_find as $key => $row) {
            array_push($car_topic, $row->car_topic_en);
        }
        $num_cartype = array_unique($car_topic);

        $car_topic_lang = array('en', 'cn', 'th');


        foreach ($data_find as $key2 => $row) {
            $sub[$key2] = $row->pax_id;
        }

        $sub_unique = array_unique($sub);


        foreach ($sub_unique as $i2 => $value2) {
            foreach ($data_find as $i => $row) {
                if ($row->pax_id == $value2 && $value2 != null) {
                    $datatopic[$i2] = $row;
                }
            }
        }



        foreach ($car_topic_lang as $key => $value) {
            foreach ($sub_unique as $key2 => $value2) {
                foreach ($data_find as $key4 => $row) {
                    if ($row->pax_id == $value2) {
                        if ($value == "en") {
                            $q[$key4] = $row->car_topic_en;
                            $subpax[$key4] = $row->pax_en;
                        } else if ($value == "cn") {
                            $q[$key4] = $row->car_topic_cn;
                            $subpax[$key4] = $row->pax_cn;
                        } else if ($value == "th") {
                            $q[$key4] = $row->car_topic_th;
                            $subpax[$key4] = $row->pax_th;
                        }
                    }
                }
            }
        }




        $arrayname['status'] = "202";
        $arrayname['messge'] = "Load Data Success";
        $arrayname['return'] = $data_return;
//		$arrayname['cartype'] =  $final_arr ;

        $arrayname['car_topic'] = $datatopic;
        $arrayname['size'] = sizeof($data_find);
        $arrayname['data1'] = $data_find;

//		$arrayname['check'] = $ssss;
//		$arrayname['checkfronORto'] =$checkfronORto ;



        $enddata = array();
        array_push($enddata, $arrayname);


        return array('status' => 200, "response" => $enddata);
//	return $arrayname;
    }

    public function query_eachdata($id) {
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
            "a.time_start_h",
            "a.time_start_m",
            "a.time_end_h",
            "a.time_end_m",
            "a.time_for_h",
            "a.time_start_h2",
            "a.time_start_m2",
            "a.time_end_h2",
            "a.time_end_m2",
            "a.time_to_h2",
            "a.time_to_m2",
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
            "a.area",
            "a.time_limit",
            "a.cost_a",
            "a.cost_a_sell",
            "a.code,
        a.cost_a_nett");

        foreach ($select as $key => $value) {
            $this->db->select($value);
        }
        $this->db->from('web_transferproduct a');
        $this->db->join('web_car b', 'b.id=a.cartype', 'left');
        $this->db->join('web_province c', 'c.id=a.stay', 'left');
        $this->db->join('web_province d', 'd.id=a.stay_to', 'left');
        $this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
        $this->db->join('web_transferproduct_utf f', 'f.id=a.id', 'left');
        $this->db->where('a.id', $id);
        $this->db->order_by("cost_a", "asc");

        $this->db->group_by('a.id');
        $query = $this->db->get();

        /* $arrayname['status'] =  "202";
          $arrayname['messge'] =  "Load Data False"; */
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
                // array_push($data_not_find,$row);
            }
//			      $arrayname['data'] =  $data;

            return array('status' => 200, "response" => $data);
        } else {
            $status['status'] = "200. data not find";
            $status['messge'] = "data not find";
            return array('status' => 200, "response" => $status);
        }
    }

    function callselect($select, $str1, $where1, $str2, $where2, $limit) {

        foreach ($select as $key => $value) {
            $this->db->select($value);
        }
        $this->db->from('web_transferproduct a');
        $this->db->join('web_car b', 'b.id=a.cartype', 'left');
        $this->db->join('web_province c', 'c.id=a.stay', 'left');
        $this->db->join('web_province d', 'd.id=a.stay_to', 'left');
        $this->db->join('web_gallerycar e', 'e.category=b.car_model', 'left');
        $this->db->join('web_transferproduct_utf f', 'f.id=a.id', 'left');
        $this->db->where('' . $str1 . '', '' . $where1 . '');
        $this->db->where('' . $str2 . '', '' . $where2 . '');
        $this->db->order_by("cost_a", "asc");
        $this->db->group_by('a.id');

        if ($limit != "") {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query;
    }

    public function querydata_service($params) {

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
            "a.code",
            "a.cost_a",
            "a.cost_a_sell",
            "a.cost_a_nett",
            "a.area");

        $from = $params['from'];
        $to = $params['to'];
        $lng = $params['lng'];
        $return['from'] = $from;
        $return['to'] = $to;
        $data_find = array();
        $data_null = array();



        $query = "SELECT f.topic_en AS topic_en,
		       f.topic_cn AS topic_cn,
		       f.topic_th AS topic_th,
		       a.onsale_top AS pro_ontop,
		       a.id AS transfer_id,
		       a.stay,
		       a.stay_to,
		       a.cartype,
		       a.cost_a_sell AS cost_a_agent_all,
		       a.type,
		       a.post_date,
		       b.id AS car_id,
		       b.person AS person,
		       b.topic_en AS car_topic_en,
		       b.topic_th AS car_topic_th,
		       b.topic_cn AS car_topic_cn,
		       b.id AS pax_id,
		       b.pax AS pax_en,
		       b.pax_th AS pax_th,
		       b.pax_cn AS pax_cn,
		       b.topic AS topic_car,		       
		       b.car_model,
		       c.id AS province_id,
		       c.front_transfer AS front_transfer,
		       c.name AS province_name_en,
		       c.name_cn AS province_name_cn,
		       c.name_th AS province_name_th,
		       d.id AS province_id_to,
		       d.name_th AS province_name_to_th,
		       d.name_cn AS province_name_to_cn,
		       d.name AS province_name_to_en,
		       e.post_date AS transfer_icon,
		       a.aum_from,
		       a.aum_to,
		       a.place_default,
		       a.place_default_to,
		       a.code,
		       a.cost_a,
		       a.cost_a_sell,
		       a.cost_a_nett,
		       a.area
            FROM web_transferproduct as a 
            left join web_car as b ON b.id = a.cartype
            left join web_province as c ON c.id = a.stay 
            left join web_province as d ON d.id = a.stay_to 
            left join web_gallerycar as e ON e.category = b.car_model 
            left join web_transferproduct_utf as f ON f.id = a.id

            WHERE a.status = 1 and a.stay = " . $from . " and a.stay_to = " . $to . " and (a.area = 'Service' or a.area = 'Service_day')
            group by a.id ORDER BY a.cost_a*100 ASC ";
        $query2 = $this->db->query($query);

        if ($query2->num_rows() > 0) {
            foreach ($query2->result() as $row) {
                array_push($data_find, $row);
                if ($row->car_topic_en == null) {
                    array_push($data_null, $row);
                }
            }
        }



        $car_topic = array();
        $car_topic_result = array();
        $sub = array();
        $datatopic = array();

        foreach ($data_find as $key => $row) {
            array_push($car_topic, $row->car_topic_en);
        }
        $num_cartype = array_unique($car_topic);

        $car_topic_lang = array('en', 'cn', 'th');


        foreach ($data_find as $key2 => $row) {
            $sub[$key2] = $row->pax_id;
        }

        $sub_unique = array_unique($sub);


        foreach ($sub_unique as $i2 => $value2) {
            foreach ($data_find as $i => $row) {
                if ($row->pax_id == $value2 && $value2 != null) {
                    $datatopic[$i2] = $row;
                }
            }
        }



        foreach ($car_topic_lang as $key => $value) {
            foreach ($sub_unique as $key2 => $value2) {
                foreach ($data_find as $key4 => $row) {
                    if ($row->pax_id == $value2) {
                        if ($value == "en") {
                            $q[$key4] = $row->car_topic_en;
                            $subpax[$key4] = $row->pax_en;
                        } else if ($value == "cn") {
                            $q[$key4] = $row->car_topic_cn;
                            $subpax[$key4] = $row->pax_cn;
                        } else if ($value == "th") {
                            $q[$key4] = $row->car_topic_th;
                            $subpax[$key4] = $row->pax_th;
                        }
                    }
                }
            }
        }




        $arrayname['status'] = "202";
        $arrayname['messge'] = "Load Data Success";
        $arrayname['return'] = $return;
        $arrayname['cartype'] = $final_arr;
        $arrayname['car_topic'] = $datatopic;
        $arrayname['size'] = sizeof($data_find);
        $arrayname['data1'] = $data_find;
        //$arrayname['typecar_null'] =  $data_null;

        $enddata = array();
        array_push($enddata, $arrayname);


        return array('status' => 200, "response" => $enddata);


//	return $data;
    }

    public function group_by($params) {

        $stay = $params['stay'];
        $lng = $params['lng'];
        $return['stay'] = $stay;
        $return['lng'] = $lng;
        if ($lng == "en") {
            $sort = "b.name";
        } else if ($lng == "th") {
            $sort = "b.name_th";
        } else if ($lng == "cn") {
            $sort = "b.name_cn";
        }

//
        $query = "SELECT a.stay_to,b.name,b.name_cn,b.name_th,b.code
            FROM web_transferproduct as a left join
            web_province as b 
            ON b.id = a.stay_to
            WHERE  a.stay = " . $stay . " and (a.area = 'Service' OR a.area = 'Service_day')
            group by a.stay_to 
            order by REPLACE(" . $sort . ", ' ', '') asc";
        $query = $this->db->query($query);

        $data_find_stayto = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                array_push($data_find_stayto, $row);
            }
        } else {
            $data_find_stayto = "false";
        }

        $arrayname['status'] = "202";
        $arrayname['messge'] = "Load Data Success";
        $arrayname['return'] = $return;
        $arrayname['size'] = sizeof($data_find_stayto);
        $arrayname['data1'] = $data_find_stayto;
//$arrayname['typecar_null'] =  $data_null;

        $enddata = array();
        array_push($enddata, $arrayname);


        return array('status' => 200, "response" => $enddata);
    }

    public function group_by_stayfrom($params) {

        if (isset($params)) {
            $lng = $params['lng'];
        } else {
            $lng = 'en';
        }


        if ($lng == "en") {
            $sort = "b.name";
        } else if ($lng == "th") {
            $sort = "b.name_th";
        } else if ($lng == "cn") {
            $sort = "b.name_cn";
        }

        $query = "SELECT a.stay,b.name,b.name_cn,b.name_th,b.code,a.area
            FROM web_transferproduct as a 
            left join web_province as b 
            ON b.id = a.stay
            WHERE  (a.area = 'Service' OR a.area = 'Service_day')
            group by a.stay 
            order by REPLACE(" . $sort . ", ' ', '') asc";

        $query = $this->db->query($query);

        $data_find_stayfrom = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                array_push($data_find_stayfrom, $row);
            }
        } else {
            $data_find_stayfrom = "false";
        }

        $arrayname['status'] = "202";
        $arrayname['messge'] = "Load Data Success";
        $arrayname['size'] = sizeof($data_find_stayfrom);
        $arrayname['data1'] = $data_find_stayfrom;
        $arrayname['lng'] = $lng;

        $enddata = array();
        array_push($enddata, $arrayname);


        return array('status' => 200, "response" => $enddata);
    }
     public function prorecoment($params) {
      
         
        $_where = array();
        $_select = array('*');
        $_order = array();
        $_limit = 8;
        $this->db->where('place_default',$params['place_default']);
        $this->db->where('stay_to', $params['stay_to']);
        $this->db->where('status', 1);

        $data['WEB_TRANSFER'] = $this->Main_model->fetch_data($_limit,'' , TBL_WEB_TRANSFERPRODUCT, '' , $_select, '');        
        $data['post'] = $params;
         
        $enddata = array();
        array_push($enddata, $data);


        return array('status' => 200, "response" => $data);
    }

}
