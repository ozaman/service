<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyModel extends CI_Model {
  //////////////////////// ==================== Check Agent  
  public function check_agent() {
    $users_id = $this->input->get_request_header('User-ID', TRUE);
    $token = $this->input->get_request_header('API-KEY', TRUE);
    $q = $this->db->select('id,levelstar')->from('web_admin')->where('apikey',$token)->get()->row();
    if($q == "") {
      return json_output(400,array('status' => 401,'message'=> 'Unauthorized.'));
    }
    else {
      return array('status' => 200,'message'=> 'Authorized.','agent'  =>''.$q->id.'','star'   =>''.$q->levelstar.'');
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
    $order = $this->db->select(' * ')->from('web_order')->where('api',1)->where('ref',$id)->where('agent',$data['agent'])->get()->row();
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
      if(!$order->sub_reject) {
        $order->sub_reject = 0;
      }        
      if($order->transfer_in == 1) {
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
          'remark'      =>$order->remark,
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
          'remark'     =>$order->remark,
          'status_book'=>$order->status,
          'sub_confirm'=>$order->sub_confirm,
          'sub_reject' =>$order->sub_reject
        );
      }          
    }      
  }
  //////////////////////// ==================== Create 
  public function book_create_data($data) {
    $agent = $this->db->select('username')->from('web_admin')->where('id',$data['agent'])->get()->row();
    if($data['product_type'] == 'transfer') {
      /////////////  transfer product Zone
      $admin = $this->db->select('admin_company,cartype')->from('web_transferproduct')->where('id',$data['product_id'])->get()->row();
      $cartype_transfer = $admin->cartype;
    }
    else {
      /////////////  Tour product Zone
      $admin = $this->db->select('admin_company')->from('web_product')->where('id',$data['product_id'])->get()->row();
    }
    $admin_company = $admin->admin_company;
    $code_book = substr(str_shuffle('1234567890'),0,30); //////////////Code for booking random
    /////////////  Start
    /*  Check for use 3 TB  */
    /////////////  Check for use 3 TB
    /////////////  Check for Pax
    if(isset($data['adult'])) {
      /////////////  For TB web_book_agent
      $data_book['adult'] = $data['adult'];
      /////////////  For TB web_account all
      $data_acc['adult'] = $data['adult'];
      /////////////  For TB web_order
      $data_order['adult'] = $data['adult'];
    }
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
    $data_pickup_place = $data['place_default'];
    $data_to_place = $data['place_default_to'];
    $data_acc['pickup_place'] = $data_pickup_place;
    $data_acc['to_place'] = $data_to_place;
    $tbl_acc_all = $DB2->dbprefix('web_account');
    $db2_insert = $DB2->insert($tbl_acc_all, $data_acc);
    $db2_insert = $DB2->where('id',$last_id_acc)->update($tbl_acc, $data_acc);
    //////////////////////// Add Order ===================================
    $data_order['admin_company'] = $admin_company;
    $data_order['invoice'] = $invoice;
    $data_order['total'] = $data['agent'] + $data['child'];
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
    $data_pickup_place = $data['place_default'];
    $data_to_place = $data['place_default_to'];
    $data_order['pickup_place'] = $data_pickup_place;
    $data_order['to_place'] = $data_to_place;
   
    $data_order['typevc'] = 'new';
    $data_order['api'] = 1;
    if($data['baggage'] > 0) {
      $total_baggage = " Total Baggage ".$data['baggage']." ";
    }
    if($data['car_use_plan']) {
      $car_use_plan = " Car Using Plan ".$data['car_use_plan']." ";
    }
    $data_order['remark'] = $data['remark']." ".$total_baggage." ".$car_use_plan;
    if($data['number_car']) {
      $data_order['numcar'] = $data['number_car'];
    }
    if($data['cartype'] == 2) {
      $data_order['numcar'] = 1;
    }
    $tbl_book = $this->db->dbprefix('web_order');
    $this->db->insert($tbl_book, $data_order);
    //*/
    return array(
      'status'   => 202,
      'agent_ref'=> $data_order['agent_ref'],
      'message'  => 'Data has been created.'
    );
  }
  ///////////////////////// CANCEL
  public function book_cancel_data($id,$data) {
    $q = $this->db->select('*')->from('web_order')->where('api',1)->where('ref',$id)->where('agent',$data['agent'])->get()->row();
    if($q == '') {
      return array('status' => 401,'message'=> 'Not found Order ID for Cancel.'.$id);
    }
    elseif($q->ondate < date('Y-m-d')) {
      return array('status' => 401,'message'=> 'This Order ID '.$id.' Past ondate '.$q->ondate);
    }
    else {
      $this->db->where('ref',$id)->update('web_order',$data);
      $DB2 = $this->load->database('admin_acc', TRUE);
      $DB2->where('ref',$id)->update('web_account',$data);
      $DB2->where('ref',$id)->update('web_account_vat',$data);
      $DB2->where('ref',$id)->update('web_account_nonvat',$data);
      $DB2->where('ref',$id)->update('web_account_nonvat_transfer',$data);
      return array('status' => 202,'message'=> 'Data has been Cancel Order ID '.$id);
    }
  }
  ///////////////////////// REJECT
  public function book_reject_data($id,$data) {
    $q = $this->db->select('*')->from('web_order')->where('api',1)->where('ref',$id)->where('sub_reject',1)->where('agent',$data['agent'])->get()->row();
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
      if($q == '') {        
        $data = array('status' => 401,'message'=> 'Not found product.');
      }
      else {
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
          $number_car = $data['total_pax'];
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
            'area_transfer'      =>$q->area,
          );
        }
      }
    }
    else {
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
        'total_sub'          =>$unit_a_sub + $unit_b_sub ,
        'total_finish_profit'=>$total_finish_profit,
        'air'                =>'',
        'area'=>0,
        'place_default'      =>0,
        'place_default_to'   =>0,
        'transfer_in'        =>$q->in_transfer,
        'area_transfer'      =>'',
      );
    }
    return $data;
  }
  public function chk_parameter_agent_ref($data) {
    ////////  Check  REF
    if(isset($data['agent_ref'])) {
      $q = $this->db->select('id')->from('web_book_agent')->where('agent_ref',$data['agent_ref'])->get()->row();
      if($q == "") {
        $resp = array('status'=> 202);
      }
      else {
        $resp = array('status' => 401,'message'=> 'Order ID Alerdy in system');
      }
    }
    else {
      $resp = array('status' => 401,'message'=> 'Please enter Order ID  By parameter agent_ref');
    }
    return $resp;
  }
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
  public function chk_parameter_adult($data) {
    ////////  Check  adult
    if($data['product_type'] == 'transfer') {
      if(isset($data['total_pax'])) {
        $resp = array('status' => 202,'message'=> 'OK');
      }
      else {
        $resp = array('status' => 401,'message'=> 'Please enter Total Pax  By parameter total_pax');
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
  public function chk_parameter_ondate($data) {
    ////////  Check  guest
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
    return $resp;
  }
  public function chk_parameter_program_start($data) {
    ////////  Check  guest
    if($data['product_type'] == 'transfer') {
      if($data['area'] == 'In') {
        if(isset($data['arrival_time'])) {
          $program_start = $data['arrival_time'];
          if(preg_match("/(2[0-4]|[01][1-9]|10):([0-5][0-9])/",$program_start)) {
            $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start);
          }
          else {
            // $resp = array('status' => 401,'message'=> 'Arrival time format not available ex 14:30');
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
          if(preg_match("/(2[0-4]|[01][1-9]|10):([0-5][0-9])/",$program_start)) {
            $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start); 
          }
          else { 
            //$resp = array('status' => 401,'message'=> 'Departure time format not available ex 14:30'); 
            $resp = array('status' => 202,'message'=> 'OK','time_ok'=> $program_start); 
          }
        }
        else {
          $resp = array('status' => 401,'message'=> 'Please enter Departure time  By parameter departure_time');  
        }
      }
      else {
        if(isset($data['service_time'])) {
          $program_start = $data['service_time'];
          if(preg_match("/(2[0-4]|[01][1-9]|10):([0-5][0-9])/",$program_start)) { 
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
      
if($chk_time == 1){
	$q_time = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->get()->row();
	$data['program_start'] = $q_time->show_h.":".$q_time->show_m;
	/////////////  Load DB Account and ADD
    $DB3 = $this->load->database('admin_time', TRUE);
    $db2_insert = $DB3->insert($tbl_acc, $data_acc);
    if(isset($data['pickup_place'])) {
    	$pickup_place = $data['pickup_place'];
      $place = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
      $place_id = $place->id;
      }else{
	  	$place_id = 00;
	  }
	$pickup_time = $DB3->select('*')->from('web_transfercharge_hotel')->where('hotel',$place_id)->where('product',$data['product_id'])->where('showtime',$q_time->id)->get()->row();
	
	if($pickup_time->time_h){
		$time_pickup = $pickup_time->time_h.":".$pickup_time->time_m;
	}else{
		$time_pickup = "00:00";
	}
	
	
}else{
	$time_start = explode(':',$data['program_start']);
       $q_time_row_pro = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->get()->num_rows();
       $q_time_arr_pro = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->get()->result();
       $q_time_row = $this->db->select('id')->from('web_showtime')->where('product',$data['product_id'])->where('show_h',$time_start[0])->where('show_m',$time_start[1])->get()->num_rows();
       $q_time = $this->db->select('*')->from('web_showtime')->where('product',$data['product_id'])->where('show_h',$time_start[0])->where('show_m',$time_start[1])->get()->row();
	//$data['program_start'] = $q_time->show_h.":".$q_time->show_m;
	/////////////  Load DB Account and ADD
    $DB3 = $this->load->database('admin_time', TRUE);
    $db2_insert = $DB3->insert($tbl_acc, $data_acc);
    if(isset($data['pickup_place'])) {
    	$pickup_place = $data['pickup_place'];
      $place = $this->db->select('id')->from('web_transferplace')->where('topic',$pickup_place)->get()->row();
      $place_id = $place->id;
      }else{
	  	$place_id = 00;
	  }
	$pickup_time = $DB3->select('*')->from('web_transfercharge_hotel')->where('hotel',$place_id)->where('product',$data['product_id'])->where('showtime',$q_time->id)->get()->row();
	
	if($pickup_time->time_h){
		$time_pickup = $pickup_time->time_h.":".$pickup_time->time_m;
	}else{
		$time_pickup = "00:00";
	}
	if($q_time_row_pro > 0){
		if($q_time_row > 0){
			
		}else{
			$data_txt = "";
			$i=1;
			foreach($q_time_arr_pro as $data_time){
				$data_txt .= $i.".[ ".$data_time->show_h.":".$data_time->show_m." ] ";
				$i++;
			}
			$data['program_start'] = NULL;
		}
	}else{
		
	}
}      
      if(isset($data['program_start'])) {
        $program_start = $data['program_start'];
        if(preg_match("/(2[0-4]|[01][1-9]|10):([0-5][0-9])/",$program_start)) {
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
    return $resp;
  }
  /////////////  check_pickup_place
  public function check_pickup_place($data) {
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
            $data_order_new['topic'] = $pickup_place;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            $data_order['id'] = $last_id_book;
            $data_order['address'] = $pickup_place_address;
            $data_order_new['id'] = $last_id_book;
            $data_order_new['address'] = $pickup_place_address;
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace_api');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_api_new');
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
            $data_order_new['topic'] = $pickup_place;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            $data_order['id'] = $last_id_book;
            $data_order['address'] = $pickup_place_address;
            $data_order_new['id'] = $last_id_book;
            $data_order_new['address'] = $pickup_place_address;
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace_api');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_api_new');
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
    if($data['product_type'] == 'transfer') {
      if($data['area'] == 'Out') {
        return array('status' => 202,'message'=> 'OK');
      }
      else {
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
            $data_order_new['topic'] = $to_place;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            $data_order['id'] = $last_id_book;
            $data_order['address'] = $to_place_address;
            $data_order_new['id'] = $last_id_book;
            $data_order_new['address'] = $to_place_address;
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order_new);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace_api');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_api_new');
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
        }
        else {
          $data['to_place'] = $data['pickup_place'];
        }
        
        if(isset($data['to_place'])) {
          $to_place = $data['to_place'];
          $q = $this->db->select('id')->from('web_transferplace')->where('topic',$to_place)->get()->row();
          if($q == "") {
            $data_order['topic'] = $to_place;
            $tbl_book = $this->db->dbprefix('web_transferplace');
            $book_insert = $this->db->insert($tbl_book, $data_order);
            $last_id_book = $this->db->insert_id($book_insert);
            $data_order['id'] = $last_id_book;
            ///////////// Transferplace NEW
            $tbl_book_new = $this->db->dbprefix('web_transferplace_new');
            $book_insert = $this->db->insert($tbl_book_new, $data_order);
            $DB_CN = $this->load->database('admin_web_cn', TRUE);
            $tbl_book_cn = $DB_CN->dbprefix('web_transferplace_api');
            $db2_insert = $DB_CN->insert($tbl_book_cn, $data_order);
            $tbl_book_cn_new = $DB_CN->dbprefix('web_transferplace_api_new');
            $db2_insert_new = $DB_CN->insert($tbl_book_cn_new, $data_order);
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
  /**
  * *********** End
  */
}