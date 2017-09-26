<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyModel extends CI_Model {
  //////////////////////// ==================== Check Agent
  public function check_agent() {
    $users_id = $this->input->get_request_header('User-ID', TRUE);
    $token = $this->input->get_request_header('API-KEY', TRUE);
    $q = $this->db->select('id,levelstar,api_balance,auto_acc_cut')->from('web_admin')->where('apikey',$token)->get()->row();
    if($q == "") {
      return json_output(400,array('status' => 401,'message'=> 'Unauthorized.'));
    }
    else {
      //////////////// check balance for booking
      if($q->api_balance == 1){
      	////////////// check money
      	/////////////  Load DB Account and ADD
    	$DB2 = $this->load->database('admin_acc', TRUE);
      	$tbl_acc = $DB2->dbprefix('web_all_agent_account');
      	$db2_select = $DB2->select('debit,credit,total_used')->from($tbl_acc)->where('agent',$q->id)->get()->row();
      	$all_money = $db2_select->debit + $db2_select->credit;
      	$all_used = $db2_select->total_used;
      	$now_balance = $all_money - $all_used ;
      	/////////// Auto cut Money == True
      	if($q->auto_acc_cut == 1){
			if($all_used >= $all_money){
			return json_output(400,array('status' => 401,'message'=> 'Your money not enough , Now your Balance is '.$now_balance.' THB Please topup. Thank you. '));
			}else{
				return array('status' => 200,'message'=> 'Authorized.','agent'  =>''.$q->id.'','star'   =>''.$q->levelstar.'');
			}
			
		}
		//////////// Open Agent Booking
		else{
			return array('status' => 200,'message'=> 'Authorized.','agent'  =>''.$q->id.'','star'   =>''.$q->levelstar.'');
		}
      	
	  }
	  ///////////////// Open booking Free
	  else{
	  	return array('status' => 200,'message'=> 'Authorized.','agent'  =>''.$q->id.'','star'   =>''.$q->levelstar.'');
	  }
      
    }
  }
  
 
  //////////////////////// ==================== Check Ref
  public function check_ref($ref) {
    $q = $this->db->select('id')->from('web_book_agent')->where('agent_ref',$ref)->get()->row();
    if($q == "") {
      return array('status'=> 202);
    }
    else {
      return array('status'=> 401);
    }
  }
  //////////////////////// ==================== Show Booking
  public function book_detail_data($id,$data) {

    if($data['agent'] == '13') {
      $bind = array('13', '1563');
      $order = $this->db->select(' * ')->from('web_order')->where('api',1)->where('ref',$id)->where_in('agent',$bind)->get()->row();
    }
    else {
      $order = $this->db->select(' * ')->from('web_order')->where('api',1)->where('ref',$id)->where('agent',$data['agent'])->get()->row();
    }

    if($order == '') {
      return array(
        'status' =>'401',
        'message'=>'Not found '.$id
      );
    }
    else {
      $book = $this->db->select('*')->from('web_book_agent')->where('id',$order->orderid)->get()->row();
      if($order->type == 'transfer') {
        $web_product = 'web_transferproduct';
      }
      else {
        $web_product = 'web_product';
      }
      $product = $this->db->select('*')->from($web_product)->where('id',$order->product)->order_by('id','desc')->get()->row();
      $pickup_place = $this->db->select('*')->from('web_transferplace')->where('id',$order->pickup_place)->get()->row();
      $to_place = $this->db->select('*')->from('web_transferplace')->where('id',$order->to_place)->get()->row();
      $back_place = $this->db->select('*')->from('web_transferplace')->where('id',$order->back_place)->get()->row();
      $over_hotel = $this->db->select('*')->from('web_transferplace')->where('id',$order->over_hotel)->get()->row();
      if($pickup_place == '') {
        $topic_from = '';
      }
      else {
        $topic_from = $pickup_place->topic;
      }

      if($to_place == '') {
        $topic_to = '';
      }
      else {
        $topic_to = $to_place->topic;
      }
      if($over_hotel == '') {
        $topic_over_hotel = '';
      }
      else {
        $topic_over_hotel = $over_hotel->topic;
      }


      if($back_place == '') {
        $topic_back = '';
      }
      else {
        $topic_back = $back_place->topic;
      }


      if(!$order->sub_reject) {
        $order->sub_reject = 0;
      }
      else {

        if($data['agent'] == 13 || $data['agent'] == 1563) {
          $order->sub_reject = 2;
          $update_reject['sub_reject'] = 2;
          $this->db->where('api',1)->where('ref',$id)->where('agent',$data['agent'])->update('web_order',$update_reject);
        }
        //$update_reject['sub_reject'] = 2;
        //$this->db->where('api',1)->where('ref',$id)->where('agent',$data['agent'])->update('web_order',$update_reject);
      }
      $remark_tbooking = "";
      if(trim($order->code_confirm) != '') {
        $remark_tbooking .= " Code : ".$order->code_confirm;
      }
      if(trim($order->sub_remark) != '') {
        $remark_tbooking .= "  T-booking.com : ".$order->sub_remark;
      }

      ///////////////////////////////// Pickup Time
      $time_of_join = "";
      //////////////////////// Transfer Join
      if($order->type == 'transfer') {
        if($product->cartype == '2') {
          $add_m = trim($order->airout_m) + 20;
          if($add_m == 60) {
            $hhhhh = trim($order->airout_h) + 1; $add_mnm = ".00";
            $time_of_join = " ~ ".  $hhhhh.".".$add_mnm;
          }
          if($add_m > 60) {
            $add_mnm = $add_m - 60;
            if($add_mnm < 10) {
              $add_mnm = "0".$add_mnm;
            }
            $hhhhh = trim($order->airout_h) + 1;
            if($hhhhh < 10) {
              $hhhhh = "0".$hhhhh;
            }

            $time_of_join = " ~ ".  $hhhhh.".".$add_mnm;
          }
          if($add_m < 60) {
            $time_of_join = "~".trim($order->airout_h).".".$add_m;
          }
        }
      }
      //////////////////////// Tour
      if($order->type <> 'transfer') {
        $company = $this->db->select('pickup_time_over')->from("web_admin")->where('id',$order->company)->get()->row();
        $time_limit_company = $company->pickup_time_over;
        if($time_limit_company > 0) {
          $add_m = trim($order->airout_m) + $time_limit_company;
          if($add_m == 60) {
            $hhhhh = trim($order->airout_h) + 1; $add_mnm = ".00";
            $time_of_join = " ~ ".  $hhhhh.".".$add_mnm;
          }
          if($add_m > 60) {
            $add_mnm = $add_m - 60;
            if($add_mnm < 10) {
              $add_mnm = "0".$add_mnm;
            }
            $hhhhh = trim($order->airout_h) + 1;
            if($hhhhh < 10) {
              $hhhhh = "0".$hhhhh;
            }
            $time_of_join = " ~ ".  $hhhhh.".".$add_mnm;
          }
          if($add_m < 60) {
            $time_of_join = " ~ ".trim($order->airout_h).".".$add_m;
          }
        }
      }



      $order->airout_time = trim($order->airout_h).":".trim($order->airout_m).$time_of_join;

      ///////////// Link Real
      //$link_url = "http://www.t - booking.com / ";
      ///////////// Link Demo
      $link_url = "http://www.t-booking.com/demo/";

      //////////// Callcenter contact
      $callcenter_contact = "Customer Service / 客服（中文） 0630781168 WeChat ID/ 微信: GBT call center3, GBT call center5";

      $voucher_url = $link_url."print.php?name=admin/voucher&file=".$order->type."&no=".$order->id."&order=".$order->orderid."&code=".$order->code;

      ////////////////// Code confirm
      if($data['agent'] == 13 || $data['agent'] == 1563) {
        //$code_confirm = "";
        $code_confirm = $order->code_confirm;
      }
      else {
        $code_confirm = $order->code_confirm;
      }
      if($order->charge > 0) {
        $transfer_charge = $order->charge;
      }
      else {
        $transfer_charge = "";
      }

      if($order->transfer_in == 1 and $order->over_in < 1) {
        if($order->type == 'transfer') {
          return array(
            'status'      =>202,
            "message"     =>"Data loads success. ",
            'agent_ref'   =>$order->agent_ref,
            'guest'       =>$book->guest,
            'phone'       =>$book->phone,
            'invoice'     =>$order->invoice,
            'product'     =>$product->topic_en,
            'ondate'      =>$order->ondate,
            'start_time'  =>$order->airin_time,
            'pickup_place'=>$topic_from,
            'pickup_date' =>$order->outdate,
            'pickup_time' =>$order->airout_time,
            'to_place'    =>$topic_to,
            'remark'      =>$order->remark." ".$remark_tbooking,

            'callcenter_contact'  =>$callcenter_contact,
            'code_confirm'  =>$code_confirm,
            'transfer_charge'  =>$transfer_charge,
            'voucher_url'  =>$voucher_url,
            'status_book' =>$order->status,
            'sub_confirm' =>$order->sub_confirm,
            'sub_reject'  =>$order->sub_reject
          );
        }
        else {
          return array(
            'status'      =>202,
            "message"     =>"Data loads success. ",
            'agent_ref'   =>$order->agent_ref,
            'guest'       =>$book->guest,
            'phone'       =>$book->phone,
            'invoice'     =>$order->invoice,
            'product'     =>$product->topic_en,
            'ondate'      =>$order->ondate,
            'start_time'  =>$order->airin_time,
            'pickup_place'=>$topic_from,
            'pickup_date' =>$order->outdate,
            'pickup_time' =>$order->airout_time,
            'back_place'    =>$topic_back,
            'remark'      =>$order->remark." ".$remark_tbooking,
            'callcenter_contact'  =>$callcenter_contact,
            'code_confirm'  =>$code_confirm,
            'transfer_charge'  =>$transfer_charge,
            'voucher_url'  =>$voucher_url,
            'status_book' =>$order->status,
            'sub_confirm' =>$order->sub_confirm,
            'sub_reject'  =>$order->sub_reject
          );
        }



      }
      elseif($order->transfer_in == 1 and $order->over_in > 0) {
        return array(
          'status'      =>202,
          "message"     =>"Data loads success. ",
          'agent_ref'   =>$order->agent_ref,
          'guest'       =>$book->guest,
          'phone'       =>$book->phone,
          'invoice'     =>$order->invoice,
          'product'     =>$product->topic_en,
          'ondate'      =>$order->ondate,
          'start_time'  =>$order->airin_time,
          'pickup_place'=>$topic_from,
          'pickup_date' =>$order->outdate,
          'pickup_time' =>$order->airout_time,
          'overnight_hotel'    =>$topic_over_hotel,
          'back_date'    =>$order->over_ondate,
          'back_time'    =>$order->over_time_h.":".$order->over_time_m,
          'back_place'    =>$topic_back,
          'remark'      =>$order->remark." ".$remark_tbooking,
          'callcenter_contact'  =>$callcenter_contact,
          'code_confirm'  =>$code_confirm,
          'transfer_charge'  =>$transfer_charge,
          'voucher_url'  =>$voucher_url,
          'status_book' =>$order->status,
          'sub_confirm' =>$order->sub_confirm,
          'sub_reject'  =>$order->sub_reject
        );
      }
      elseif($order->transfer_in < 1 and $order->over_in > 0) {
        return array(
          'status'     =>202,
          "message"    =>"Data loads success. ",
          'agent_ref'  =>$order->agent_ref,
          'guest'      =>$book->guest,
          'phone'      =>$book->phone,
          'invoice'    =>$order->invoice,
          'product'    =>$product->topic_en,
          'ondate'     =>$order->ondate,
          'start_time' =>$order->airin_time,
          'overnight_hotel'    =>$topic_over_hotel,
          'back_date'    =>$order->over_ondate,
          'back_time'    =>$order->over_time_h.":".$order->over_time_m,
          'remark'      =>$order->remark." ".$remark_tbooking,
          'callcenter_contact'  =>$callcenter_contact,
          'code_confirm'  =>$code_confirm,
          'transfer_charge'  =>$transfer_charge,
          'voucher_url'  =>$voucher_url,
          'status_book' =>$order->status,
          'sub_confirm' =>$order->sub_confirm,
          'sub_reject'  =>$order->sub_reject
        );
      }
      else {
        return array(
          'status'     =>202,
          "message"    =>"Data loads success. ",
          'agent_ref'  =>$order->agent_ref,
          'guest'      =>$book->guest,
          'phone'      =>$book->phone,
          'invoice'    =>$order->invoice,
          'product'    =>$product->topic_en,
          'ondate'     =>$order->ondate,
          'start_time' =>$order->airin_time,
          'remark'      =>$order->remark." ".$remark_tbooking,
          'callcenter_contact'  =>$callcenter_contact,
          'code_confirm'  =>$code_confirm,
          'transfer_charge'  =>$transfer_charge,
          'voucher_url'  =>$voucher_url,
          'status_book' =>$order->status,
          'sub_confirm' =>$order->sub_confirm,
          'sub_reject'  =>$order->sub_reject
        );
      }
    }
  }
  //////////////////////// ==================== Create
  public function book_create_data($data) {

    /////////////  transfer product Zone
    if($data['product_type'] == 'transfer') {
      $admin = $this->db->select('admin_company,cartype,stay')->from('web_transferproduct')->where('id',$data['product_id'])->get()->row();
      $cartype_transfer = $admin->cartype;
      $province_id = $admin->stay;
    }
    else {
      /////////////  Tour product Zone
      $admin = $this->db->select('admin_company,province')->from('web_product')->where('id',$data['product_id'])->get()->row();
      $province_id = $admin->province;
    }
    ////////////////// check ctrip CM
    if($data['agent'] == '13') {
      if($admin->admin_company == '2') {
        $data['agent'] = "1563";
        $ctrip_cm = $this->db->select('levelstar')->from('web_admin')->where('id',1563)->get()->row();
        $data['star'] = $ctrip_cm->levelstar;
      }
    }


    ///////////////// Agent user posted
    $agent = $this->db->select('username')->from('web_admin')->where('id',$data['agent'])->get()->row();
    //////////////// Ctrip Check API
    if($data['agent'] == '13' || $data['agent'] == '1563') {
      $data['status_book'] = "NEW";
      $data_order['ctrip_ondate'] = $data['ondate'];
      $data_order['ctrip_airin_time'] = $data['airin_time'];
    }
    /////////////  For TB web_account all
    $data_acc['province_id'] = $province_id;
    /////////////  For TB web_order
    $data_order['province_id'] = $province_id;

    $admin_company = $admin->admin_company;
    $code_book = substr(str_shuffle('1234567890'),0,30); //////////////Code for booking random
    /////////////  Start
    ///////////// Check OVER NIGHT
    if($data['overnigth_in'] > 0) {
      $data_order['over_in'] = 1;
      $data_order['over_hotel'] = $data['over_hotel'];
      $data_order['over_ondate'] = $data['over_ondate'];
      $data_order['over_time_h'] = $data['over_time_h'];
      $data_order['over_time_m'] = $data['over_time_m'];
    }
    if($data['transfer_in'] > 0) {
      $data_pickup_place = $data['place_default'];
      $data_to_place = $data['place_default_to'];
      /////////////  For TB web_account all
      $data_acc['pickup_place'] = $data_pickup_place;
      $data_acc['to_place'] = $data_to_place;
      /////////////  For TB web_order
      $data_order['pickup_place'] = $data_pickup_place;
      $data_order['to_place'] = $data_to_place;
      if($data['product_type'] <> 'transfer') {
        /////////////  For TB web_account all
        $data_acc['back_place'] = $data_to_place;
        /////////////  For TB web_order
        $data_order['back_place'] = $data_to_place;
      }
    }



    /*  Check for use 3 TB  */
    /////////////  Check for use 3 TB
    /////////////  Check for Pax
    if(isset($data['pax'])) {
      /////////////  For TB web_book_agent
      $data_book['adult'] = $data['pax'];
      $data_book['child'] = 0;
      /////////////  For TB web_account all
      $data_acc['pax'] = $data['pax'];
      $data_acc['adult'] = $data['pax'];
      $data_acc['child'] = 0;
      /////////////  For TB web_order
      $data_order['pax'] = $data['pax'];
      $data_order['adult'] = $data['pax'];
      $data_order['child'] = 0;
    }
    $chk_adult_child = substr($data['product'], - 1);
    if($chk_adult_child == 'c' or $chk_adult_child == 'C') {
      /////////////  For TB web_book_agent
      $data_book['child'] = $data['pax'];
      $data_book['adult'] = 0;
      /////////////  For TB web_account all
      $data_acc['pax'] = $data['pax'];
      $data_acc['child'] = $data['pax'];
      $data_acc['adult'] = 0;
      /////////////  For TB web_order
      $data_order['pax'] = $data['pax'];
      $data_order['child'] = $data['pax'];
      $data_order['adult'] = 0;

    }
    if(isset($data['adult'])) {
      /////////////  For TB web_book_agent
      $data_book['adult'] = $data['adult'];
      /////////////  For TB web_account all
      $data_acc['adult'] = $data['adult'];
      /////////////  For TB web_order
      $data_order['adult'] = $data['adult'];
    }
    if(isset($data['child'])) {
      /////////////  For TB web_book_agent
      $data_book['child'] = $data['child'];
      /////////////  For TB web_account all
      $data_acc['child'] = $data['child'];
      /////////////  For TB web_order
      $data_order['child'] = $data['child'];
    }
    if(isset($data['total_pax'])) {
      /////////////  For TB web_book_agent
      $data_book['total'] = $data['total_pax'];
      $data_book['adult'] = $data['total_pax'];
      $data_book['child'] = 0;
      /////////////  For TB web_account all
      $data_acc['pax'] = $data['total_pax'];
      $data_acc['total'] = $data['total_pax'];
      $data_acc['adult'] = $data['total_pax'];
      $data_acc['child'] = 0;
      /////////////  For TB web_order
      $data_order['pax'] = $data['total_pax'];
      $data_order['total'] = $data['total_pax'];
      $data_order['adult'] = $data['total_pax'];
      $data_order['child'] = 0;
    }
    else {
      /////////////  For TB web_book_agent
      $data_book['total'] = $data_book['adult'] + $data_book['child'];
      /////////////  For TB web_account all
      $data_acc['pax'] = $data_book['adult'] + $data_book['child'];
      $data_acc['total'] = $data_book['adult'] + $data_book['child'];
      /////////////  For TB web_order
      $data_order['pax'] = $data_book['adult'] + $data_book['child'];
      $data_order['total'] = $data_book['adult'] + $data_book['child'];
    }
    /////////////  Use 3 TB
    ///////////// Program start time
    if(isset($data['air'])) {
      /////////////  For TB web_account all
      $data_acc['air'] = $data['air'];
      /////////////  For TB web_order
      $data_order['air'] = $data['air'];
    }
    if($data['airin_time']) {
      /////////////  For TB web_account all
      $data_acc['airin_time'] = $data['airin_time'];
      /////////////  For TB web_order
      $data_order['airin_time'] = $data['airin_time'];

    }
    if($data['airin_h']) {
      /////////////  For TB web_account all
      $data_acc['airin_h'] = $data['airin_h'];
      /////////////  For TB web_order
      $data_order['airin_h'] = $data['airin_h'];
    }
    if($data['airin_m']) {
      /////////////  For TB web_account all
      $data_acc['airin_m'] = $data['airin_m'];
      /////////////  For TB web_order
      $data_order['airin_m'] = $data['airin_m'];
    }
    /////// pickuptime
    if($data['product_type'] == 'transfer') {
      ///////////// Pickup Time transfer area Out
      if($data['area'] == 'Out') {
        if(isset($data['service_time'])) {
          $service_time = explode(':',$data['service_time']);
        }
        else {
          $service_time = "23:59";
        }
        $time_service = $data['ondate']." ".$service_time.":59";
        $q = $this->db->select('time_limit')->from('web_transferproduct')->where('id',$data['product_id'])->get()->row();
        $time_h_ok = $data['airin_h'] - $q->time_limit;
        if($time_h_ok < 0) {
          $time_h_ok = 24 + $time_h_ok;
          $data['outdate'] = date('Y-m-d ', strtotime($data['ondate'] . ' -1 day'));
        }
        if($time_h_ok < 10) {
          $time_h_ok = "0".$time_h_ok;
        }
        $time_auto_h_m = $time_h_ok.":".$data['airin_m'];
        $time_auto = $data['outdate']." ".$time_auto_h_m.":00";
        if($time_service >= $time_auto) {
          $service_time_all = $time_auto_h_m;
          $service_time_h = $time_h_ok;
          $service_time_m = $data['airin_m'];
        }
        else {
          $service_time_all = $data['service_time'];
          $service_time_h = $service_time[0];
          $service_time_m = $service_time[1];
        }
        /////////////  For TB web_account all
        $data_acc['airout_time'] = $service_time_all."";
        $data_acc['airout_h'] = $service_time_h."";
        $data_acc['airout_m'] = $service_time_m."";
        $data_acc['outdate'] = $data['outdate'];
        /////////////  For TB web_order
        $data_order['airout_time'] = $service_time_all."";
        $data_order['airout_h'] = $service_time_h."";
        $data_order['airout_m'] = $service_time_m."";
        $data_order['outdate'] = $data['outdate'];
        if($data['airin_h'] < 6) {
          $data['transfer_date'] = date('Y-m-d ', strtotime($data['ondate'] . ' -1 day'));
          $data_order['transfer_date'] = $data['transfer_date'];
        }
        else {
          $data_order['transfer_date'] = $data['outdate'];
        }
      }
      ///////////// Pickup Time transfer area Other
      else {
        /////////////  For TB web_account all
        $data_acc['airout_time'] = $data['airout_time'];
        $data_acc['airout_h'] = $data['airout_h'];
        $data_acc['airout_m'] = $data['airout_m'];
        $data_acc['outdate'] = $data['outdate'];
        /////////////  For TB web_order
        $data_order['airout_time'] = $data['airout_time'];
        $data_order['airout_h'] = $data['airout_h'];
        $data_order['airout_m'] = $data['airout_m'];
        $data_order['outdate'] = $data['outdate'];

        if($data['airin_h'] < 6) {
          $data['transfer_date'] = date('Y-m-d ', strtotime($data['ondate'] . ' -1 day'));
          $data_order['transfer_date'] = $data['transfer_date'];
        }
        else {
          $data_order['transfer_date'] = $data['outdate'];
        }
      }
    }
    ///////////// Pickup Time tour product
    else {
      if($data['transfer_in'] > 0) {
        /////////////  For TB web_account all
        $data_acc['airout_time'] = $data['airout_time'];
        $data_acc['airout_h'] = $data['airout_h'];
        $data_acc['airout_m'] = $data['airout_m'];
        $data_acc['outdate'] = $data['outdate'];
        /////////////  For TB web_order
        $data_order['airout_time'] = $data['airout_time'];
        $data_order['airout_h'] = $data['airout_h'];
        $data_order['airout_m'] = $data['airout_m'];
        $data_order['outdate'] = $data['outdate'];
      }
    }
    /////////////  For TB web_account all
    //$data_acc['transfer'] = $data['transfer_in'];
    /////////////  For TB web_order
    $data_order['transfer_in'] = $data['transfer_in'];
    $data_order['transfer'] = $data['transfer_in'];


    /////////////  End
    /*  Check for use 3 TB  */
    /////////////  Check for use 3 TB
    /////////////  Check Parameter Guest name
    $guest_name = "";
    if(isset($data['guest_english'])) {
      $guest_name .= $data['guest_english'];
    }
    if(isset($data['guest_other'])) {
      $guest_name .= $data['guest_other'];
    }
    $data_book['guest'] = $guest_name;
    /////////////  Check Parameter Phone
    $guest_phone = "";
    if(isset($data['phone'])) {
      $guest_phone .= $data['phone']." ";
    }
    if(isset($data['phone_th'])) {
      $guest_phone .= $data['phone_th']." ";
    }
    if(isset($data['phone_cn'])) {
      $guest_phone .= $data['phone_cn']." ";
    }
    $data_book['phone'] = $guest_phone;
    $data_book['agent_ref'] = $data['agent_ref'];  ///////////// Agent ref
    $data_book['posted'] = $agent->username;   ///////////// Post By
    $data_book['api'] = 1; ///////////// API Check
    $data_book['post_date'] = time(); ///////////// Post time
    $data_book['update_date'] = time(); ///////////// Update time
    $data_book['agent'] = $data['agent'];
    $data_book['star'] = $data['star'];
    $data_book['bookid'] = $data['agent'];
    $data_book['booklevel'] = 2;
    $data_book['bookowner'] = $data['agent'];
    $data_book['status_all'] = 1;
    $data_book['status'] = $data['status_book'];
    if($data['status_book'] == 'NEW') {
      $data_book['vc_new'] = 1;
    }
    if($data['status_book'] == 'CONFIRM') {
      $data_book['vc_confirm'] = 1;
    }

    /////////////  Check E - mail
    if(isset($data['email'])) {
      $data_book['email'] = $data['email'];
      $data_book['guestemail'] = $data['email'];
    }
    /////////////  Insert to web_book_agent
    $tbl_book = $this->db->dbprefix('web_book_agent');
    $book_insert = $this->db->insert($tbl_book, $data_book);
    /////////////  Check last ID web_book_agent
    $last_id_book = $this->db->insert_id($book_insert);
    if($last_id_book >= 10000) {
      $book_invoice = "0$last_id_book" ;
    }
    elseif($last_id_book >= 1000) {
      $book_invoice = "00$last_id_book" ;
    }
    elseif($last_id_book >= 100) {
      $book_invoice = "000$last_id_book" ;
    }
    elseif($last_id_book >= 10) {
      $book_invoice = "0000$last_id_book" ;
    }
    else {
      $book_invoice = "00000$last_id_book" ;
    }
    $data_book['invoice'] = $book_invoice;
    /////////////  Update TB web_book_agent
    $this->db->where('id',$last_id_book)->update($tbl_book, $data_book);
    /////////////  Load DB Account and ADD
    $DB2 = $this->load->database('admin_acc', TRUE);
    /////////////  Booking Prefix  9
    if($data['product_vat'] == 1) {
      $tbl_acc = $DB2->dbprefix('web_account_vat');
      $pre_invoice = 9;
    }
    else {
      /////////////  Booking Prefix  8
      $tbl_acc = $DB2->dbprefix('web_account_nonvat');
      $pre_invoice = 8;
    }
    /////////////  Booking Prefix  7
    if($data['product_type'] == 'transfer') {
      $tbl_acc = $DB2->dbprefix('web_account_nonvat_transfer');
      $pre_invoice = 7;
    }
    /////////////  Insert to web_account follow prefix
    $data_acc['agent_ref'] = $data['agent_ref'];
    $db2_insert = $DB2->insert($tbl_acc, $data_acc);
    /////////////  Check last ID for make Invoice
    $last_id_acc = $DB2->insert_id($db2_insert);
    /////////////  Make Invoice
    if($last_id_acc >= 10000) {
      $member_in = "0$last_id_acc" ;
    }
    elseif($last_id_acc >= 1000) {
      $member_in = "00$last_id_acc" ;
    }
    elseif($last_id_acc >= 100) {
      $member_in = "000$last_id_acc" ;
    }
    elseif($last_id_acc >= 10) {
      $member_in = "0000$last_id_acc" ;
    }
    else {
      $member_in = "00000$last_id_acc" ;
    }


    if($data['product_type'] == 'transfer') {
      /////////////  For TB web_account all
      //$data_acc['cartype'] = $cartype_transfer;
      /////////////  For TB web_order
      $data_order['cartype'] = $cartype_transfer;
    }


    /////////////  Var  Invoice
    $invoice = $pre_invoice.$member_in;
    /////////////  Col for insert data ACC
    $data_acc['admin_company'] = $admin_company;
    $data_acc['rsvn'] = $book_invoice;
    $data_acc['invoice'] = $invoice;
    $data_acc['product'] = $data['product_id'];
    $data_acc['program'] = $data['product_id'];
    $data_acc['code'] = $code_book;
    $data_acc['status'] = $data['status_book'];
    $data_acc['ref'] = $data['agent_ref'];
    $data_acc['type'] = $data['product_type'];
    $data_acc['company'] = $data['product_company'];
    $data_acc['ondate'] = $data['ondate'];
    $data_acc['agent'] = $data['agent'];
    $data_acc['star'] = $data['star'];
    $data_acc['posted'] = $agent->username;
    $data_acc['post_date'] = time();
    $data_acc['update_date'] = time();
    $data_acc['orderid'] = $last_id_book;
    $data_acc['unit_a_agent'] = $data['unit_a_agent'];
    $data_acc['unit_a_sub'] = $data['unit_a_sub'];
    $data_acc['total_a_agent'] = $data['total_a_agent'];
    $data_acc['total_a_sub'] = $data['total_a_sub'];
    $data_acc['total_a_profit'] = $data['total_a_profit'];
    $data_acc['unit_c_agent'] = $data['unit_b_agent'];
    $data_acc['unit_c_sub'] = $data['unit_b_sub'];
    $data_acc['total_c_agent'] = $data['total_b_agent'];
    $data_acc['total_c_sub'] = $data['total_b_sub'];
    $data_acc['total_c_profit'] = $data['total_b_profit'];
    $data_acc['total_agent'] = $data['total_agent'];
    $data_acc['total_sub'] = $data['total_sub'];
    $data_acc['total_finish_profit'] = $data['total_finish_profit'];


    $data_acc['api'] = 1;
    if($data['baggage'] > 0) {
      $total_baggage = " Total Baggage ".$data['baggage']." ";
    }
    if($data['car_use_plan']) {
      $car_use_plan = " Car Using Plan ".$data['car_use_plan']." ";
    }
    $data_acc['remark'] = $data['remark']." ".$total_baggage." ".$car_use_plan;
    if($data['number_car']) {
      $data_acc['numcar'] = $data['number_car'];
    }
    if($data['cartype'] == 2) {
      $data_acc['numcar'] = 1;
    }

    $tbl_acc_all = $DB2->dbprefix('web_account');
    $db2_insert = $DB2->insert($tbl_acc_all, $data_acc);
    $db2_insert = $DB2->where('id',$last_id_acc)->update($tbl_acc, $data_acc);
    //////////////////////// Add Order ===================================
    $data_order['admin_company'] = $admin_company;
    $data_order['invoice'] = $invoice;
    $data_order['company'] = $data['product_company'];
    $data_order['status'] = $data['status_book'];
    $data_order['posted'] = $agent->username;
    $data_order['update_date'] = time();
    $data_order['post_date'] = time();
    $data_order['code'] = $code_book;
    $data_order['baby'] = 0;
    $data_order['rsvn'] = $book_invoice;
    $data_order['agent_ref'] = $data['agent_ref'];
    $data_order['ref'] = $data['agent_ref'];
    $data_order['product'] = $data['product_id'];
    $data_order['program'] = $data['product_id'];
    $data_order['program2'] = $data['product_id'];
    $data_order['type'] = $data['product_type'];
    $data_order['ondate'] = $data['ondate'];
    $data_order['agent'] = $data['agent'];
    $data_order['star'] = $data['star'];
    /////
    $data_order['orderid'] = $last_id_book;


    $data_order['typevc'] = 'new';
    $data_order['api'] = 1;
    if($data['baggage'] > 0) {
      $total_baggage = " Total Baggage ".$data['baggage']." ";
    }
    if($data['car_use_plan']) {
      $car_use_plan = " Car Using Plan ".$data['car_use_plan']." ";
    }
    if($data['program_start_extra']) {
      $program_start_extra = "If first time fully please use this time :  ".$data['program_start_extra']." ";
    }
    if($data['area'] == 'Out') {
      if($data['service_time'] != '') {
        $service_time_remark = " Pickup time request ".$data['service_time'];
      }
    }

    $data_order['remark'] = $data['remark']." ".$service_time_remark." ".$total_baggage." ".$car_use_plan." ".$program_start_extra;
    if($data['number_car']) {
      $data_order['numcar'] = $data['number_car'];
    }
    if($data['cartype'] == 2) {
      $data_order['numcar'] = 1;
    }
    ////////// check api order
    if($data_order['adult'] > 0) {
      $data_order['ctrip_check_adult'] = $data_order['adult'];
    }
    if($data['agent'] == 13 || $data['agent'] == 1563) {
      $new_orderid = explode('-',$data['agent_ref']);
      $data_order['ctrip_orderid'] = $new_orderid[0];
      $data_order['api_approve'] = 0;
    }
    else {
      $data_order['ctrip_orderid'] = $data['agent_ref'];
    }
    $data_order['code_product'] = $data['product'];
    $tbl_book = $this->db->dbprefix('web_order');
    $order_insert = $this->db->insert($tbl_book, $data_order);
    $last_id_order = $this->db->insert_id($order_insert);
    //*/
    ///////////////////// web_order_api_forcheck
    $data_api_forcheck['order_id'] = $last_id_order;
    $data_api_forcheck['code_product'] = $data['product'];
    $data_api_forcheck['remark'] = $data['remark']." ".$service_time_remark." ".$total_baggage." ".$car_use_plan." ".$program_start_extra;
    if($data['pickup_place']) {
      $data_api_forcheck['pickup_place_name'] = $data['pickup_place'];
    }
    if($data['pickup_place_address']) {
      $data_api_forcheck['pickup_place_address'] = $data['pickup_place_address'];
    }
    if($data['to_place']) {
      $data_api_forcheck['to_place_name'] = $data['to_place'];
    }
    if($data['to_place_address']) {
      $data_api_forcheck['to_place_address'] = $data['to_place_address'];
    }
    if($data['overnight_hotel']) {
      $data_api_forcheck['over_place_name'] = $data['overnight_hotel'];
    }
    if($data['overnight_hotel_address']) {
      $data_api_forcheck['over_place_address'] = $data['overnight_hotel_address'];
    }


    $tbl_api_forcheck = $this->db->dbprefix('web_order_api_forcheck');
    $this->db->insert($tbl_api_forcheck, $data_api_forcheck);


    /////////// Add History
    $DB_HIS = $this->load->database('admin_his', TRUE);
    if($data['product_type'] == 'transfer') {
      $chk_typeee = "Transfer";
    }
    else {
      $chk_typeee = "Tour";
    }
    $history_add['api'] = "1";
    $history_add['topic'] = "Add new ".$chk_typeee." Voucher No. ".$invoice." in Agent Reservation No. ".$book_invoice." By API";
    $history_add['type'] = "Add New Voucher";
    $history_add['sender'] = date('Y-m-d');
    $history_add['posted'] = $agent->username;
    $history_add['post_date'] = time();;
    $history_add['vc'] = $invoice;
    $history_add['rsvn'] = $book_invoice;
    $DB_HIS->insert('web_box', $history_add);


    return array(
      'status'   => 202,
      'agent_ref'=> $data_order['agent_ref'],
      'message'  => 'Data has been created.'
    );
  }
  ///////////////////////// CANCEL
  public function book_cancel_data($id,$data) {

    if($data['agent'] == '13') {
      $bind = array('13', '1563');
      $q = $this->db->select('*')->from('web_order')->where('api',1)->where('ref',$id)->where_in('agent',$bind)->get()->row();
    }
    else {
      $q = $this->db->select('*')->from('web_order')->where('api',1)->where('ref',$id)->where('agent',$data['agent'])->get()->row();
    }




    if($q == '') {
      return array('status' => 401,'message'=> 'Not found Order ID for Cancel.'.$id);
    }
    elseif($q->ondate <= date('Y-m-d') and $q->sub_reject < 1) {
      return array('status' => 401,'message'=> 'This Order ID '.$id.' Past ondate '.$q->ondate);
    }
    else {

      if($q->type == 'transfer') {
        $update_report['status'] = $data['status'];
        $this->db->where('invoice',$q->invoice)->update('web_transfer_report',$update_report);
        /*
        $date = date('Y-m-d');
        $date_p_3 = date('Y-m-d', strtotime($date .' +3 day'));
        if($q->ondate >= $date_p_3){
        $data_sub['sub_confirm'] = 1;
        $this->db->where('ref',$id)->where('api',1)->update('web_order',$data_sub);
        }
        //*/
        if($q->carno < 1) {
          $data_sub['sub_confirm'] = 1;
          $this->db->where('ref',$id)->where('api',1)->update('web_order',$data_sub);
        }

      }
      if(trim($data['remark']) != '') {
        $reamrk_add = " => [".date('Y-m-d H:i:s')."] : ".$data['remark'];
      }
      $remark_update = $q->remark.$reamrk_add;

      $data['remark'] = $remark_update;
      $update['remark'] = $remark_update;


      $update['status'] = $data['status'];
      $update['update_date'] = time();
      $update['agent'] = $data['agent'];
      if($q-> sub_reject == 1) {
        $update['sub_reject'] = 2;
        $return_txt = 'Data has been REJECTED Order ID '.$id;
      }
      else {
        $return_txt = 'Data has been Cancel Order ID '.$id;
      }

      $this->db->where('ref',$id)->where('api',1)->update('web_order',$update);
      $DB2 = $this->load->database('admin_acc', TRUE);
      $DB2->where('ref',$id)->where('api',1)->update('web_account',$data);
      $DB2->where('ref',$id)->where('api',1)->update('web_account_vat',$data);
      $DB2->where('ref',$id)->where('api',1)->update('web_account_nonvat',$data);
      $DB2->where('ref',$id)->where('api',1)->update('web_account_nonvat_transfer',$data);

      /////////// Add History
      $DB_HIS = $this->load->database('admin_his', TRUE);
      if($q->type == 'transfer') {
        $chk_typeee = "Transfer";
      }
      else {
        $chk_typeee = "Tour";
      }
      $history_add['api'] = "1";
      $history_add['topic'] = "Update Status ".$chk_typeee." Voucher No. ".$q->invoice." to CANCLE By API";
      $history_add['type'] = "Update Voucher";
      $history_add['sender'] = date('Y-m-d');
      $history_add['posted'] = $q->posted;
      $history_add['post_date'] = time();;
      $history_add['vc'] = $q->invoice;
      $history_add['rsvn'] = $q->rsvn;
      $DB_HIS->insert('web_box', $history_add);


      return array('status' => 202,'message'=> $return_txt);
    }
  }
  ///////////////////////// REJECT
  public function book_reject_data($id,$data) {


    if($data['agent'] == '13') {
      $bind = array('13', '1563');
      $q = $this->db->select('*')->from('web_order')->where('api',1)->where('ref',$id)->where('sub_reject',1)->where_in('agent',$bind)->get()->row();
    }
    else {
      $q = $this->db->select('*')->from('web_order')->where('api',1)->where('ref',$id)->where('sub_reject',1)->where('agent',$data['agent'])->get()->row();
    }

    if($q == '') {
      return array('status' => 401,'message'=> 'Not found Order ID for Reject.'.$id);
    }
    //elseif($q->ondate < date('Y - m - d')){
    //  return array('status' => 401,'message' => 'This Order ID '.$id.' Past ondate '.$q->ondate);
    //}
    else {
      $this->db->where('ref',$id)->update('web_order',$data);
      return array('status' => 202,'message'=> 'Data has been REJECTED Order ID '.$id);
    }
  }
  ///////////////////////// book_search_product
  public function book_search_product($data) {
    $ondate = $data['ondate'];
    $id = $data['product'];
    $agent = $data['agent'];



    $star = $data['star'];


    if($data['pax']) {
      $data['adult'] = $data['pax'];
    }
    $chk_adult_child = substr($id, - 1);
    if($chk_adult_child == 'c' or $chk_adult_child == 'C') {
      $data['child'] = $data['pax'];
      $data['adult'] = 0 ;
      $id_new = explode($chk_adult_child,$id);
      $id = $id_new[0];
    }



    $total = $data['adult'] + $data['child'];
    $adult = $data['adult'];
    $child = $data['child'];
    //if(isset($data['program_start'])){  $flight_time = $data['program_start'];}else{$flight_time = '00:00';  }
    //$airin_time = explode(':',$flight_time);
    ///  check product Tour
    /// $q = $this->db->select(' * ')->from('web_product')->where('code',$id)->where('status',1)->get()->row(); // status 1
    $q = $this->db->select('*')->from('web_product')->where('code',$id)->get()->row(); // All status
    if($q == '') {
      //// check product transfer
      //$q = $this->db->select(' * ')->from('web_transferproduct')->where('code',$id)->where('status',1)->get()->row(); //status 1
      $q = $this->db->select('*')->from('web_transferproduct')->where('code',$id)->get()->row(); // All status
      ////////// Not have transfer product
      if($q == '') {
        $data = array('status' => 401,'message'=> 'Not found product.');
      }
      else {

        //////////  have transfer product check extren Off Ctrip
        /**
        *
        * @var ***************** have transfer product check extren Off Ctrip
        *
        */
        if($data['agent'] == '13' || $data['agent'] == 1563) {
          if($q->code_suvarn != '' || $q->code_hotel != '') {
            if($q->area == 'In') {
              if($data['pickup_place'] == '素万那普国际机场（Suvarnabhumi Airport）') {
                $q = $this->db->select('*')->from('web_transferproduct')->where('code',$q->code_suvarn)->get()->row(); // All status
              }
              elseif($data['pickup_place'] == '廊曼机场（Don Mueang International Airport）') {
                $q = $this->db->select('*')->from('web_transferproduct')->where('code',$id)->get()->row(); // All status
              }
              else {
                $q = $this->db->select('*')->from('web_transferproduct')->where('code',$q->code_hotel)->get()->row(); // All status
              }
            }
            if($q->area == 'Out') {
              if($data['to_place'] == '素万那普国际机场（Suvarnabhumi Airport）') {
                $q = $this->db->select('*')->from('web_transferproduct')->where('code',$q->code_suvarn)->get()->row(); // All status
              }
              elseif($data['to_place'] == '廊曼机场（Don Mueang International Airport）') {
                $q = $this->db->select('*')->from('web_transferproduct')->where('code',$id)->get()->row(); // All status
              }
              else {
                $q = $this->db->select('*')->from('web_transferproduct')->where('code',$q->code_hotel)->get()->row(); // All status
              }
            }
          }

        }
        //////////  have transfer product check extren Off Ctrip
        /**
        *
        * @var ***************** have transfer product check extren Off Ctrip
        *
        */
        ////////////////// check star ctrip CM
        if($data['agent'] == '13') {
          if($q->admin_company == '2') {
            $ctrip_cm = $this->db->select('levelstar')->from('web_admin')->where('id',1563)->get()->row();
            $star = $ctrip_cm->levelstar;
          }
        }



        $supp = $this->db->select('vat,id')->from('web_admin')->where('id',$q->company)->get()->row();
        if(isset($data['number_car'])) {
          $number_car = $data['number_car'];
        }
        else {
          $number_car = '';
        }
        $val_cost = 'cost_a_s'.$star;
        if($star < 10) {
          if($star == 1) {
            $cost_a = $q->cost_a_s;
          }
          else {
            $cost_a = $q->$val_cost;
          }
        }
        else {
          $cost_a = $q->cost_a;
        }
        if($q->cartype == 2) {
          if($q->area == 'Rental') {
          	$number_car = $data['pax'];
          }else{
		  	$number_car = $data['total_pax'];
		  }
          
          $check_car = 0;
        }
        else {
          $check_car = 1;
        }
        if($q->area == 'In' || $q->area == 'Out') {
          $check_area = 1;
        }
        else {
          $check_area = 0;
        }
        $unit_a_agent = $cost_a;
        $unit_a_sub = $q->cost_a_nett;
        $total_a_agent = $unit_a_agent * $number_car;
        $total_a_sub = $unit_a_sub * $number_car;
        $total_a_profit = $total_a_agent - $total_a_sub;
        $total_finish_profit = $total_a_profit;
        if($q->area == 'In') {
          if(isset($data['arrival_flight'])) {
            $flight = $data['arrival_flight'];
          }
          else {
            $flight = '';
          }
          $txt_flight = "Please input Arrival Flight By parameter arrival_flight";
        }
        if($q->area == 'Out') {
          if(isset($data['departure_flight'])) {
            $flight = $data['departure_flight'];
          }
          else {
            $flight = '';
          }
          $txt_flight = "Please input Departure Flight By parameter departure_flight";
        }
        if($check_car == 1 and $number_car == '') {
          $data = array('status' => 401,'message'=>'Please input Number of car. By parameter number_car');
        }
        elseif($check_area == 1 and  $flight == '') {
          $data = array('status' => 401,'message'=>$txt_flight);
        }
        else {
          if($q->auto_confirm == 1) {
            $status_book = 'CONFIRM';
          }
          else {
            $status_book = 'NEW';
          }
          $data = array(
            'status'             => 202,
            'cartype'            => $q->cartype,
            'id'                 => $q->id,
            'type'               => 'transfer',
            'vat'                =>$supp->vat,
            'company'            =>$supp->id ,
            'status_book'        =>$status_book,
            'unit_a_agent'       =>$unit_a_agent,
            'unit_a_sub'         =>$unit_a_sub,
            'total_a_agent'      =>$total_a_agent,
            'total_a_sub'        =>$total_a_sub,
            'total_a_profit'     =>$total_a_profit,
            'unit_b_agent'       =>0,
            'unit_b_sub'         =>0,
            'total_b_agent'      =>0,
            'total_b_sub'        =>0,
            'total_b_profit'     =>0,
            'total_agent'        =>$total_a_agent,
            'total_sub'          =>$total_a_sub,
            'total_finish_profit'=>$total_finish_profit,
            'air'                =>$flight,
            'area'=>$q->area,
            'place_default'      =>$q->place_default,
            'place_default_to'   =>$q->place_default_to,
            'transfer_in'        =>1,
            'overnigth_in'        =>0,
            'area_transfer'      =>$q->area,
          );
        }
      }
    }
    else {

      ////////////////// check star ctrip CM
      if($data['agent'] == '13') {
        if($q->admin_company == '2') {
          $ctrip_cm = $this->db->select('levelstar')->from('web_admin')->where('id',1563)->get()->row();
          $star = $ctrip_cm->levelstar;
        }
      }


      $supp = $this->db->select('vat,id')->from('web_admin')->where('id',$q->company)->get()->row();
      $val_cost_a = 'cost_a_agent_'.$star;
      $val_cost_b = 'cost_b_agent_'.$star;
      if($star < 10) {
        $cost_a = $q->$val_cost_a;
        $cost_b = $q->$val_cost_b;
      }
      else {
        $cost_a = $q->cost_a_agent_all;
        $cost_b = $q->cost_b_agent_all;
      }
      $unit_a_agent = $cost_a;
      $unit_b_agent = $cost_b;
      $unit_a_sub = $q->cost_a_s;
      $unit_b_sub = $q->cost_b_s;
      $total_a_agent = $unit_a_agent * $adult;
      $total_b_agent = $unit_b_agent * $child;
      $total_a_sub = $unit_a_sub * $adult;
      $total_b_sub = $unit_b_sub * $child;
      $total_a_profit = $total_a_agent - $total_a_sub;
      $total_b_profit = $total_b_agent - $total_b_sub;
      $total_finish_profit = $total_a_profit + $total_b_profit;
      if($q->type == 'Day Tour') {
        $type = 'tour';
      }
      if($q->type == 'Show') {
        $type = 'show';
      }
      if($q->type == 'Spa') {
        $type = 'spa';
      }
      if($q->type == 'Golf') {
        $type = 'golf';
      }
      if($q->type == 'Diving') {
        $type = 'diving';
      }
      if($q->type == 'Boat') {
        $type = 'boat';
      }
      if($q->type == 'Wedding') {
        $type = 'wedding';
      }
      if($q->type == 'Plane') {
        $type = 'plane';
      }
      $data = array(
        'status'             => 202,
        'id'                 => $q->id,
        'cartype'            => 0,
        'type'               => $type,
        'vat'                =>$supp->vat,
        'company'            =>$supp->id,
        'status_book'        =>'NEW',
        'unit_a_agent'       =>$unit_a_agent,
        'unit_a_sub'         =>$unit_a_sub,
        'total_a_agent'      =>$total_a_agent,
        'total_a_sub'        =>$total_a_sub,
        'total_a_profit'     =>$total_a_profit,
        'unit_b_agent'       =>$unit_b_agent,
        'unit_b_sub'         =>$unit_b_sub,
        'total_b_agent'      =>$total_b_agent,
        'total_b_sub'        =>$total_b_sub,
        'total_b_profit'     =>$total_b_profit,
        'total_agent'        =>$total_a_agent + $total_b_agent,
        'total_sub'          =>$total_a_sub + $total_b_sub ,
        'total_finish_profit'=>$total_finish_profit,
        'air'                =>'',
        'area'=>0,
        'place_default'      =>0,
        'place_default_to'   =>0,
        'transfer_in'        =>$q->in_transfer,
        'overnigth_in'        =>$q->in_overnigth,
        'area_transfer'      =>'',
      );
    }
    return $data;
  }
  ////////  Check  REF
  public function chk_parameter_agent_ref($data) {
    ////////  Check  REF
    if(isset($data['agent_ref'])) {
      $q = $this->db->select('id')->from('web_book_agent')->where('agent_ref',$data['agent_ref'])->get()->row();
      if($q == "") {
        $resp = array('status'=> 202);
      }
      else {
        $invoice = $this->db->select('invoice')->from('web_order')->where('ref',$data['agent_ref'])->where('api',1)->get()->row();
        $resp = array('status' => 401,'message'=> 'Order ID Alerdy in system',"invoice"=>$invoice->invoice);
      }
    }
    else {
      $resp = array('status' => 401,'message'=> 'Please enter Order ID  By parameter agent_ref');
    }
    return $resp;
  }
  ////////  Check  guest
  public function chk_parameter_guest_english($data) {
    ////////  Check  guest
    if(isset($data['guest_english']) or isset($data['guest_other'])) {
      $resp = array('status' => 202,'message'=> 'OK');
    }
    else {
      $resp = array('status' => 401,'message'=> 'Please enter Guest name English or Chinese By parameter guest_english or guest_other ');
    }
    return $resp;
  }
  ////////  Check  guest
  public function chk_parameter_guest_other($data) {
    ////////  Check  guest
    if(isset($data['guest_other'])) {
      $resp = array('status' => 202,'message'=> 'OK');
    }
    else {
      $resp = array('status' => 202,'message'=> 'OK');
      //$resp = array('status' => 401,'message' => 'Please enter Guest name of your country By parameter guest_other');
    }
    return $resp;
  }
  ////////  Check  adult
  public function chk_parameter_adult($data) {
    ////////  Check  adult
    if($data['product_type'] == 'transfer') {
      if($data['area'] == 'Rental') {
        if(isset($data['pax'])) {
          $resp = array('status' => 202,'message'=> 'OK');
        }
        else {
          $resp = array('status' => 401,'message'=> 'Please enter pax  By parameter pax');
        }
      }
      else {
        if(isset($data['total_pax'])) {
          $resp = array('status' => 202,'message'=> 'OK');
        }
        else {
          $resp = array('status' => 401,'message'=> 'Please enter Total Pax  By parameter total_pax');
        }
      }

    }
    else {
      if(isset($data['adult'])) {
        $resp = array('status' => 202,'message'=> 'OK');
      }
      else {


        if(isset($data['pax'])) {
          $resp = array('status' => 202,'message'=> 'OK');
        }
        else {
          $resp = array('status' => 401,'message'=> 'Please enter pax  By parameter pax');
        }
      }
      /*

      //*/
    }
    return $resp;
  }
  ////////  Check  child
  public function chk_parameter_child($data) {
    ////////  Check  child
    if($data['product_type'] == 'transfer') {
      $resp = array('status' => 202,'message'=> 'OK');
    }
    else {
      $resp = array('status' => 202,'message'=> 'OK');
      /*
      if(isset($data['child'])) {
      $resp = array('status' => 202,'message'=> 'OK');
      }
      else {
      $resp = array('status' => 401,'message'=> 'Please enter Child  By parameter child');
      }
      //*/
    }
    return $resp;
  }
  ////////  Check  phone
  public function chk_parameter_phone($data) {
    ////////  Check  phone
    if(isset($data['phone'])) {
      $resp = array('status' => 202,'message'=> 'OK');
    }
    else {
      //$resp = array('status' => 401,'message' => 'Please enter Phone  By parameter phone');
      $resp = array('status' => 202,'message'=> 'OK');
    }
    return $resp;
  }
  ////////  Check  product
  public function chk_parameter_product($data) {
    ////////  Check  product
    if(isset($data['product'])) {
      $resp = array('status' => 202,'message'=> 'OK');
    }
    else {
      $resp = array('status' => 401,'message'=> 'Please enter Product Code By parameter product');
    }
    return $resp;
  }
  /////////////  chk_parameter_ondate
  public function chk_parameter_ondate($data) {
    ///////////////// For Ctrip
    if($data['agent'] == 13 || $data['agent'] == 1563) {
      if($data['product_type'] == 'transfer') {
        if($data['area'] == 'In') {
          if(isset($data['arrival_date'])) {
            $date = $data['arrival_date'];
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
            else {
              //////////// For Ctrip
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Arrival date  By parameter arrival_date');
          }
        }
        elseif($data['area'] == 'Out') {
          if(isset($data['departure_date'])) {
            $date = $data['departure_date'];
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
            else {
              //////////// For Ctrip
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Departure date  By parameter departure_date');
          }
        }
        elseif($data['area'] == 'Rental') {
          if(isset($data['ondate'])) {
            $date = $data['ondate'];
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
            else {
              //////////// For Ctrip
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Service date  By parameter ondate');
          }
        }
        else {
          if(isset($data['service_date'])) {
            $date = $data['service_date'];
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
            else {
              //////////// For Ctrip
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Service date  By parameter service_date');
          }
        }
      }
      else {
        if(isset($data['ondate'])) {
          $date = $data['ondate'];
          if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
          }
          else {
            //////////// For Ctrip
            $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
          }
        }
        else {
          $resp = array('status' => 401,'message'=> 'Please enter Ondate  By parameter ondate');
        }
      }
    }
    else {
      ///////////////// For Another Agent
      if($data['product_type'] == 'transfer') {
        if($data['area'] == 'In') {
          if(isset($data['arrival_date'])) {
            $date = $data['arrival_date'];
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
            else {
              $resp = array('status' => 401,'message'=> 'Date format not available ex 2016-03-10');
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Arrival date  By parameter arrival_date');
          }
        }
        elseif($data['area'] == 'Out') {
          if(isset($data['departure_date'])) {
            $date = $data['departure_date'];
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
            else {
              $resp = array('status' => 401,'message'=> 'Date format not available ex 2016-03-10');
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Departure date  By parameter departure_date');
          }
        }
        else {
          if(isset($data['service_date'])) {
            $date = $data['service_date'];
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
            }
            else {
              $resp = array('status' => 401,'message'=> 'Date format not available ex 2016-03-10');
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Service date  By parameter service_date');
          }
        }
      }
      else {
        if(isset($data['ondate'])) {
          $date = $data['ondate'];
          if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            $resp = array('status' => 202,'message'=> 'OK','date_ok'=> $date);
          }
          else {
            $resp = array('status' => 401,'message'=> 'Date format not available ex 2016-03-10');
          }
        }
        else {
          $resp = array('status' => 401,'message'=> 'Please enter Ondate  By parameter ondate');
        }
      }
    }

    return $resp;
  }
  /////////////  chk_parameter_program_start
  public function chk_parameter_program_start($data) {
    ///////////////// For Ctrip
    if($data['agent'] == 13 || $data['agent'] == 1563) {
      if($data['product_type'] == 'transfer') {
        if($data['area'] == 'In') {
          if(isset($data['arrival_time'])) {
            $program_start = $data['arrival_time'];
            if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
              //if(preg_match(" / (2[0 - 4] | [01][1 - 9] | 10):([0 - 5][0 - 9]) / ",$program_start)) {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
            else {
              //$resp = array('status' => 401,'message'=> 'Arrival time format not available ex 14:30');
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Arrival time  By parameter arrival_time');
          }
        }
        elseif($data['area'] == 'Out') {
          if(isset($data['departure_time'])) {
            $program_start = $data['departure_time'];
            if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
            else {
              //$resp = array('status' => 401,'message'=> 'Departure time format not available ex 14:30 ');
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Departure time  By parameter departure_time');
          }
        }
        elseif($data['area'] == 'Rental') {
          if(isset($data['service_time'])) {
            $program_start = $data['service_time'];
            if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
            else {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
          }
          else {
            
            $q = $this->db->select('*')->from('web_transferproduct')->where('code',$data['product'])->get()->row(); // All status
            $program_start = $q->start_time_h.':'.$q->start_time_m;
            if($program_start){
				$resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
			}else{
				$resp = array('status' => 401,'message'=> 'Please enter Service time  By parameter service_time');
			}
            
            
            
          }
        }
        else {
          if(isset($data['service_time'])) {
            $program_start = $data['service_time'];
            //if(preg_match(" / (2[0 - 4] | [01][1 - 9] | 10):([0 - 5][0 - 9]) / ",$program_start)) {
            if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
            else {
              //$resp = array('status' => 401,'message'=> 'Service time format not available ex 14:30');
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Service time  By parameter service_time');
          }
        }
      }
      else {


        $chk_time = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->get()->num_rows();

        if($chk_time == 1) {
          $q_time = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->get()->row();
          $data['program_start'] = $q_time->show_h.":".$q_time->show_m;
          /////////////  Load DB Account and ADD
          $DB3 = $this->load->database('admin_time', TRUE);

          if(isset($data['pickup_place'])) {
            $pickup_place = $data['pickup_place'];
            $place = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
            $place_id = $place->id;
          }
          else {
            $place_id = 00;
          }
          $pickup_time = $DB3->select('*')->from('web_transfercharge_hotel')->where('hotel',$place_id)->where('product',$data['product_id'])->where('showtime',$q_time->id)->get()->row();

          if($pickup_time->time_h) {
            $time_pickup = $pickup_time->time_h.":".$pickup_time->time_m;
          }
          else {
            $time_pickup = "00:00";
          }


        }
        else {
          $time_start = explode(':',$data['program_start']);
          $q_time_row_pro = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->get()->num_rows();
          $q_time_arr_pro = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->get()->result();
          $q_time_row = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->where('show_h',$time_start[0])->where('show_m',$time_start[1])->get()->num_rows();
          $q_time = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->where('show_h',$time_start[0])->where('show_m',$time_start[1])->get()->row();
          //$data['program_start'] = $q_time->show_h.":".$q_time->show_m;
          /////////////  Load DB Account and ADD
          $DB3 = $this->load->database('admin_time', TRUE);

          if(isset($data['pickup_place'])) {
            $pickup_place = $data['pickup_place'];
            $place = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
            $place_id = $place->id;
          }
          else {
            $place_id = 00;
          }
          $pickup_time = $DB3->select('*')->from('web_transfercharge_hotel')->where('hotel',$place_id)->where('product',$data['product_id'])->where('showtime',$q_time->id)->get()->row();

          if($pickup_time->time_h) {
            $time_pickup = $pickup_time->time_h.":".$pickup_time->time_m;
          }
          else {
            $time_pickup = "00:00";
          }
          if($q_time_row_pro > 0) {
            if($q_time_row > 0) {

            }
            else {
              $data_txt = "";
              $i = 1;
              foreach($q_time_arr_pro as $data_time) {
                $data_txt .= $i.".[ ".$data_time->show_h.":".$data_time->show_m." ] ";
                $i++;
              }
              $data['program_start'] = $data['program_start'];
            }
          }
          else {

          }
        }
        if(isset($data['program_start'])) {
          $program_start = $data['program_start'];
          //if(preg_match(" / (2[0 - 4] | [01][1 - 9] | 10):([0 - 5][0 - 9]) / ",$program_start)) {
          if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
            $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start,'time_pickup'=> $time_pickup);
          }
          else {
            //$resp = array('status' => 401,'message'=> 'Program Start format not available ex 14:30 '.$data['program_start'].' aaa  '.$time_pickup);
            $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start,'time_pickup'=> $time_pickup);
          }
        }
        else {
          //$resp = array('status' => 401,'message'=> 'Please enter Program Start  By parameter program_start This product have program start '.$q_time_row_pro.' time please chose '.$data_txt.'  ');
          $resp = array('status' => 401,'message'=> 'Please enter Program Start  By parameter program_start This product have program start '.$q_time_row_pro.' time please chose '.$data_txt.'  ');
          //$resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start,'time_pickup'=> $time_pickup);
          //$resp = array('status' => 202,'message'=> 'OK','time_ok'=> "09:30");
        }
      }
    }
    else {
      if($data['product_type'] == 'transfer') {
        if($data['area'] == 'In') {
          if(isset($data['arrival_time'])) {
            $program_start = $data['arrival_time'];
            if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
              //if(preg_match(" / (2[0 - 4] | [01][1 - 9] | 10):([0 - 5][0 - 9]) / ",$program_start)) {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
            else {
              $resp = array('status' => 401,'message'=> 'Arrival time format not available ex 14:30');
              //$resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Arrival time  By parameter arrival_time');
          }
        }
        elseif($data['area'] == 'Out') {
          if(isset($data['departure_time'])) {
            $program_start = $data['departure_time'];
            if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
            else {
              $resp = array('status' => 401,'message'=> 'Departure time format not available ex 14:30 ');
              //$resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Departure time  By parameter departure_time');
          }
        }
        else {
          if(isset($data['service_time'])) {
            $program_start = $data['service_time'];
            //if(preg_match(" / (2[0 - 4] | [01][1 - 9] | 10):([0 - 5][0 - 9]) / ",$program_start)) {
            if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
              $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
            }
            else {
              $resp = array('status' => 401,'message'=> 'Service time format not available ex 14:30');
            }
          }
          else {
            $resp = array('status' => 401,'message'=> 'Please enter Service time  By parameter service_time');
          }
        }
      }
      else {


        $chk_time = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->get()->num_rows();

        if($chk_time == 1) {
          $q_time = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->get()->row();
          $data['program_start'] = $q_time->show_h.":".$q_time->show_m;
          /////////////  Load DB Account and ADD
          $DB3 = $this->load->database('admin_time', TRUE);

          if(isset($data['pickup_place'])) {
            $pickup_place = $data['pickup_place'];
            $place = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
            $place_id = $place->id;
          }
          else {
            $place_id = 00;
          }
          $pickup_time = $DB3->select('*')->from('web_transfercharge_hotel')->where('hotel',$place_id)->where('product',$data['product_id'])->where('showtime',$q_time->id)->get()->row();

          if($pickup_time->time_h) {
            $time_pickup = $pickup_time->time_h.":".$pickup_time->time_m;
          }
          else {
            $time_pickup = "00:00";
          }


        }
        else {
          $time_start = explode(':',$data['program_start']);
          $q_time_row_pro = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->get()->num_rows();
          $q_time_arr_pro = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->get()->result();
          $q_time_row = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->where('show_h',$time_start[0])->where('show_m',$time_start[1])->get()->num_rows();
          $q_time = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->where('show_h',$time_start[0])->where('show_m',$time_start[1])->get()->row();
          //$data['program_start'] = $q_time->show_h.":".$q_time->show_m;
          /////////////  Load DB Account and ADD
          $DB3 = $this->load->database('admin_time', TRUE);

          if(isset($data['pickup_place'])) {
            $pickup_place = $data['pickup_place'];
            $place = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
            $place_id = $place->id;
          }
          else {
            $place_id = 00;
          }
          $pickup_time = $DB3->select('*')->from('web_transfercharge_hotel')->where('hotel',$place_id)->where('product',$data['product_id'])->where('showtime',$q_time->id)->get()->row();

          if($pickup_time->time_h) {
            $time_pickup = $pickup_time->time_h.":".$pickup_time->time_m;
          }
          else {
            $time_pickup = "00:00";
          }
          if($q_time_row_pro > 0) {
            if($q_time_row > 0) {

            }
            else {
              $data_txt = "";
              $i = 1;
              foreach($q_time_arr_pro as $data_time) {
                $data_txt .= $i.".[ ".$data_time->show_h.":".$data_time->show_m." ] ";
                $i++;
              }
              $data['program_start'] = NULL;
            }
          }
          else {

          }
        }
        if(isset($data['program_start'])) {
          $program_start = $data['program_start'];
          //if(preg_match(" / (2[0 - 4] | [01][1 - 9] | 10):([0 - 5][0 - 9]) / ",$program_start)) {
          if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$program_start)) {
            $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start,'time_pickup'=> $time_pickup);
          }
          else {
            $resp = array('status' => 401,'message'=> 'Program Start format not available ex 14:30 '.$data['program_start'].' aaa  '.$time_pickup);
          }
        }
        else {
          $resp = array('status' => 401,'message'=> 'Please enter Program Start  By parameter program_start This product have program start '.$q_time_row_pro.' time please chose '.$data_txt.'  ');
          //$resp = array('status' => 202,'message'=> 'OK','time_ok'=> "09:30");
        }
      }
    }
    return $resp;
  }
  /////////////  check_pickup_place
  public function check_pickup_place($data) {
    $agent = $this->db->select('username')->from('web_admin')->where('id',$data['agent'])->get()->row();
    if($data['product_type'] == 'transfer') {
      if($data['area'] == 'In') {
        return array('status' => 202,'message'=> 'OK');
      }
      else {
        if(isset($data['pickup_place'])) {
          $pickup_place = $data['pickup_place'];
          if($data['pickup_place_address']) {
            $pickup_place_address = $data['pickup_place_address'];
          }
          else {
            $pickup_place_address = " ";
          }
          $q = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
          if($q == "") {
            $data_order['topic'] = $pickup_place;
            $data_order['approve'] = 0;
            $data_order['api'] = 1;
            $data_order_new['topic'] = $pickup_place;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            ///////////// Place only
            $data_order['id'] = $last_id_book;

            //////////////// New
            $data_order_new['id'] = $last_id_book;
            $data_order_new['address'] = $pickup_place_address;
            $data_order_new['approve'] = 0;
            $data_order_new['api'] = 1;
            $data_order_new['posted'] = $agent->username;
            $data_order_new['post_date'] = time();
            $data_order_new['update_date'] = time();
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_new');
            $db2_insert_new = $DB_CN->insert($tbl_book_cn_new, $data_order_new);
            return array('status' => 202,'message'=> 'OK' ,'id'     => $last_id_book);
          }
          else {
            return array('status' => 202,'message'=> 'OK' ,'id'     => $q->id);
          }
        }
        else {
          return array('status' => 401 ,'message'=> 'Please enter Pickup place  By parameter pickup_place');
        }
      }
    }
    else {
      if($data['transfer_in'] == '1') {
        if(isset($data['pickup_place'])) {
          $pickup_place = $data['pickup_place'];
          if($data['pickup_place_address']) {
            $pickup_place_address = $data['pickup_place_address'];
          }
          else {
            $pickup_place_address = " ";
          }
          $q = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
          if($q == "") {
            $data_order['topic'] = $pickup_place;
            $data_order['approve'] = 0;
            $data_order['api'] = 1;
            $data_order_new['topic'] = $pickup_place;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            ///////////// Place only
            $data_order['id'] = $last_id_book;

            //////////////// New
            $data_order_new['id'] = $last_id_book;
            $data_order_new['address'] = $pickup_place_address;
            $data_order_new['approve'] = 0;
            $data_order_new['api'] = 1;
            $data_order_new['posted'] = $agent->username;
            $data_order_new['post_date'] = time();
            $data_order_new['update_date'] = time();
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_new');
            $db2_insert_new = $DB_CN->insert($tbl_book_cn_new, $data_order_new);
            return array('status' => 202,'message'=> 'OK' ,'id'     => $last_id_book);
            //return array('status' => 401 , 'message' => 'Please enter Pickup place  By parameter pickup_place');
          }
          else {
            return array('status' => 202,'message'=> 'OK' ,'id'     => $q->id);
            //return array('status' => 401 , 'message' => 'Please enter Pickup place  By parameter pickup_place');
          }
        }
        else {
          return array('status' => 401 ,'message'=> 'Please enter Pickup place  By parameter pickup_place');
        }
      }
      else {
        return array('status' => 202,'message'=> 'OK');
        //return array('status' => 401 , 'message' => 'Please enter Pickup place  By parameter pickup_place');
      }
    }
  }
  /////////////  check_to_place
  public function check_to_place($data) {
    $agent = $this->db->select('username')->from('web_admin')->where('id',$data['agent'])->get()->row();
    if($data['product_type'] == 'transfer') {
      if($data['area'] == 'Out') {
        return array('status' => 202,'message'=> 'OK');
      }
      else {
        if($data['area'] == 'Rental') {
        	
        	if(isset($data['to_place'])){
				$data['to_place'] = $data['to_place'];
        		$data['to_place_address'] = $data['to_place_address'];
			}else{
				$data['to_place'] = $data['pickup_place'];
        		$data['to_place_address'] = $data['pickup_place_address'];
			}
        	
        }
        
        if(isset($data['to_place'])) {
          $to_place = $data['to_place'];
          if($data['to_place_address']) {
            $to_place_address = $data['to_place_address'];
          }
          else {
            $to_place_address = " ";
          }
          $q = $this->db->select('id')->from('web_transferplace')->where('topic',$to_place)->get()->row();
          if($q == "") {
            $data_order['topic'] = $to_place;
            $data_order['approve'] = 0;
            $data_order['api'] = 1;
            $data_order_new['topic'] = $to_place;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            ///////////// Place only
            $data_order['id'] = $last_id_book;

            //////////////// New
            $data_order_new['id'] = $last_id_book;
            $data_order_new['address'] = $to_place_address;
            $data_order_new['approve'] = 0;
            $data_order_new['api'] = 1;
            $data_order_new['posted'] = $agent->username;
            $data_order_new['post_date'] = time();
            $data_order_new['update_date'] = time();
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_new');
            $db2_insert_new = $DB_CN->insert($tbl_book_cn_new, $data_order_new);
            return array('status' => 202,'message'=> 'OK' ,'id'     => $last_id_book);
          }
          else {
            return array('status' => 202,'message'=> 'OK' ,'id'     => $q->id);
          }
        }
        else {
          return array('status' => 401 ,'message'=> 'Please enter To place  By parameter to_place');
        }
      }
    }
    else {
      if($data['transfer_in'] == '1') {

        if(isset($data['to_place'])) {
          $data['to_place'] = $data['to_place'];
          $to_place_address = $data['to_place_address'];
        }
        else {
          $data['to_place'] = $data['pickup_place'];
          $to_place_address = $data['pickup_place_address'];
        }

        if(isset($data['to_place'])) {
          $to_place = $data['to_place'];
          $q = $this->db->select('id')->from('web_transferplace')->where('topic',$to_place)->get()->row();
          if($q == "") {
            $data_order['topic'] = $to_place;
            $data_order['approve'] = 0;
            $data_order['api'] = 1;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            ///////////// Place only
            $data_order['id'] = $last_id_book;

            //////////////// New
            $data_order_new['id'] = $last_id_book;
            $data_order_new['topic'] = $to_place;
            $data_order_new['address'] = $to_place_address;
            $data_order_new['approve'] = 0;
            $data_order_new['api'] = 1;
            $data_order_new['posted'] = $agent->username;
            $data_order_new['post_date'] = time();
            $data_order_new['update_date'] = time();
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_new');
            $db2_insert_new = $DB_CN->insert($tbl_book_cn_new, $data_order_new);
            return array('status' => 202,'message'=> 'OK' ,'id'     => $last_id_book);
          }
          else {
            return array('status' => 202,'message'=> 'OK' ,'id'     => $q->id);
          }
        }
        else {
          //return array('status' => 401 ,'message'=> 'Please enter To place  By parameter to_place');
          return array('status' => 202,'message'=> 'OK' ,'id'     =>'');
        }
      }
      else {
        return array('status' => 202,'message'=> 'OK');
      }
    }
  }
  /////////////  chk_parameter_overnight_hotel
  public function chk_parameter_overnight_hotel($data) {
    if(isset($data['overnight_hotel'])) {
      $overnight_hotel = $data['overnight_hotel'];
      $overnight_hotel_address = $data['overnight_hotel_address'];
      $q = $this->db->select('id')->from('web_transferplace')->where('topic',$overnight_hotel)->get()->row();
      if($q == "") {
        $data_order['topic'] = $overnight_hotel;
        $data_order['approve'] = 0;
        $data_order['api'] = 1;
        $tbl_book = $this->db->dbprefix('web_transferplace');
        $book_insert = $this->db->insert($tbl_book, $data_order);
        $last_id_book = $this->db->insert_id($book_insert);
        ///////////// Place only
        $data_order['id'] = $last_id_book;
        //////////////// New
        $data_order_new['id'] = $last_id_book;
        $data_order_new['topic'] = $overnight_hotel;
        $data_order_new['address'] = $overnight_hotel_address;
        $data_order_new['approve'] = 0;
        $data_order_new['api'] = 1;
        $data_order_new['posted'] = $agent->username;
        $data_order_new['post_date'] = time();
        $data_order_new['update_date'] = time();
        ///////////// Transferplace NEW
        $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
        $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
        $DB_CN = $this->load->database('admin_web_cn', TRUE);
        $tbl_book_cn = $DB_CN->dbprefix('web_transferplace');
        $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
        $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_new');
        $db2_insert_new = $DB_CN->insert($tbl_book_cn_new, $data_order_new);
        return array('status' => 202,'message'=> 'OK' ,'id'     => $last_id_book);
      }
      else {
        return array('status' => 202,'message'=> 'OK' ,'id'     => $q->id);
      }
    }
    else {
      return array('status' => 401 ,'message'=> 'Please enter Overnight place name  By parameter overnight_hotel');
    }
  }
  /////////////  chk_parameter_overnight_date
  public function chk_parameter_overnight_date($data) {
    if(isset($data['back_date'])) {
      $date = $data['back_date'];
      if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
        $resp = array('status' => 202,'message'=> 'OK','back_date'=> $date);
      }
      else {
        $resp = array('status' => 401,'message'=> 'Back date format not available ex 2016-03-10');
      }
    }
    else {
      $resp = array('status' => 401 ,'message'=> 'Please enter Overnight Back date  By parameter back_date');
    }
    return $resp;
  }
  /////////////  chk_parameter_overnight_time
  public function chk_parameter_overnight_time($data) {


    $chk_time = $this->db->select('id')->from('web_backtime')->where('product',$data['product_id'])->get()->num_rows();
    if($chk_time == 1) {
      $q_time = $this->db->select('*')->from('web_backtime')->where('product',$data['product_id'])->get()->row();
      $data['back_time'] = $q_time->show_h.":".$q_time->show_m;

    }
    elseif($chk_time > 1) {
      $q_time = $this->db->select('*')->from('web_backtime')->where('product',$data['product_id'])->get()->row();
      //$data['back_time'] = $q_time->show_h.":".$q_time->show_m;

      $time_start = explode(':',$data['back_time']);
      $q_time_row_pro = $this->db->select('id')->from('web_backtime')->where('product',$data['product_id'])->get()->num_rows();
      $q_time_arr_pro = $this->db->select('*')->from('web_backtime')->where('product',$data['product_id'])->get()->result();
      $q_time_row = $this->db->select('id')->from('web_backtime')->where('product',$data['product_id'])->where('show_h',$time_start[0])->where('show_m',$time_start[1])->get()->num_rows();
      if($q_time_row_pro > 0) {
        if($q_time_row > 0) {

        }
        else {
          $data_txt = "";
          $i = 1;
          foreach($q_time_arr_pro as $data_time) {
            $data_txt .= $i.".[ ".$data_time->show_h.":".$data_time->show_m." ] ";
            $i++;
          }
          $data['back_time'] = NULL;
        }
      }
      else {

      }

    }
    else {
      $data['back_time'] = $data['airin_time'];

    }

    //*

    if(isset($data['back_time'])) {
      $back_time = $data['back_time'];
      //if(preg_match(" / (2[0 - 4] | [01][1 - 9] | 10):([0 - 5][0 - 9]) / ",$back_time)) {
      if(preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/",$back_time)) {
        $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $back_time,'time_pickup'=> $back_time);
        //$resp = array('status' => 401,'message'=> $back_time.$chk_1,'time_ok'=> $back_time,'time_pickup'=> $back_time);

      }
      else {
        $resp = array('status' => 401,'message'=> 'Program Start format not available ex 14:30 '.$data['back_time']);
      }
    }
    else {
      $resp = array('status' => 401,'message'=> 'Please enter back time  By parameter back_time This product have back time '.$q_time_row_pro.' time please chose '.$data_txt.'  ');
      //$resp = array('status' => 202,'message'=> 'OK','time_ok'=> "09:30");
      // $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $back_time,'time_pickup'=> $back_time);
    }
    //*/
    //$resp = array('status' => 202,'message'=> 'OK','time_ok'=> "09:00",'time_pickup'=> "09:00");
    return $resp;
  }


  /**
  * *********** End
  */
}