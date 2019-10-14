<?php

class Main_model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  /*
   * @return
   */

  // ==============================================================================================
  public function NoBlurImage($fileName) {
    header('Content-Type: image/jpeg');
    $file = $fileName;
    $image = imagecreatefromjpeg($file);
    imagejpeg($image);
    imagedestroy($image);
  }

  // ==============================================================================================
  public function BlurImage($fileName) {
    header('Content-Type: image/jpeg');
    $file = $fileName;
    //$file = 'uploads/vip/noimage.jpg';
    $image = imagecreatefromjpeg($file);

    /* Get original image size */
    list($w,$h) = getimagesize($file);

    /* Create array with width and height of down sized images */
    $size = array('sm' => array('w' => intval($w / 4),'h' => intval($h / 4)),
        'md' => array('w' => intval($w / 2),'h' => intval($h / 2))
    );

    /* Scale by 25% and apply Gaussian blur */
    $sm = imagecreatetruecolor($size['sm']['w'],$size['sm']['h']);
    imagecopyresampled($sm,$image,0,0,0,0,$size['sm']['w'],$size['sm']['h'],$w,$h);

    for ($x = 1; $x <= 12; $x++) {
      imagefilter($sm,IMG_FILTER_GAUSSIAN_BLUR,777);
    }

    imagefilter($sm,IMG_FILTER_SMOOTH,77);
    imagefilter($sm,IMG_FILTER_BRIGHTNESS,10);

    /* Scale result by 200% and blur again */
    $md = imagecreatetruecolor($size['md']['w'],$size['md']['h']);
    imagecopyresampled($md,$sm,0,0,0,0,$size['md']['w'],$size['md']['h'],$size['sm']['w'],$size['sm']['h']);
    imagedestroy($sm);

    for ($x = 1; $x <= 12; $x++) {
      imagefilter($md,IMG_FILTER_GAUSSIAN_BLUR,777);
    }

    imagefilter($md,IMG_FILTER_SMOOTH,55);
    imagefilter($md,IMG_FILTER_BRIGHTNESS,10);

    /* Scale result back to original size */
    imagecopyresampled($image,$md,0,0,0,0,$w,$h,$size['md']['w'],$size['md']['h']);
    imagedestroy($md);

// Apply filters of upsized image if you wish, but probably not needed
//imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR); 
//imagefilter($image, IMG_FILTER_SMOOTH,99);
//imagefilter($image, IMG_FILTER_BRIGHTNESS, 10);       

    imagejpeg($image);
    imagedestroy($image);
  }

  // ==============================================================================================
  public function chkBrowser($nameBroser) {
    return preg_match("/".$nameBroser."/",$_SERVER['HTTP_USER_AGENT']);
  }

  // ==============================================================================================
  public function getBrowser() {
    if ($this->chkBrowser("MSIE") == 1) {
      if ($this->chkBrowser("MSIE 8") == 1) {
        $i_browser = 4;
      }
      elseif ($this->chkBrowser("MSIE 7") == 1) {
        $i_browser = 5;
      }
      elseif ($this->chkBrowser("MSIE 6") == 1) {
        $i_browser = 6;
      }
      else {
        $i_browser = 7;
      }
    }
    elseif ($this->chkBrowser("Firefox") == 1) {
      $i_browser = 2;
    }
    elseif ($this->chkBrowser("Chrome") == 1) {
      $i_browser = 1;
    }
    elseif ($this->chkBrowser("Chrome") == 0 && chkBrowser("Safari") == 1) {
      $i_browser = 3;
    }
    elseif ($this->chkBrowser("Opera") == 1) {
      $i_browser = 8;
    }
    elseif ($this->chkBrowser("Netscape") == 1) {
      $i_browser = 9;
    }
    else {
      $i_browser = 10;
    }
    return $i_browser;
  }

  // ==============================================================================================
  public function create_Logs($info,$table) {
    $logs = array();
    $logs[s_detail] = $info[s_detail];
    $logs[i_status] = $info[i_status];
    $logs[i_create] = $this->Main_model->login_id();
    $logs[i_level] = $this->Main_model->level_id();
    $logs[i_owner] = $this->Main_model->owner_id();
    $logs[s_tbl_create] = TBL_PROFILE;
    $logs[i_id] = $info[i_id];
    $logs[d_create] = date("Y-m-d h:i:s");
    $logs[s_ip] = $this->Main_model->get_client_ip();
    $this->db->insert($table,$logs);
    return $logs;
  }

  // ==============================================================================================
  public function getNumber($info,$data) {
    $sys = $info[s_result];
    $sys1 = substr($sys,1);
    $_a = str_split($sys1);
    if ($data->i_result == 1) {
      $output = $this->Main_model->permutation($_a);
      $result_mix = '';
      foreach ($output as $val) {
        //$result_mix .= substr($val, $data->i_start, $data->i_max)." ";
        $result_mix .= $val." ";
      }
    }
    else {
      $result_mix = substr($sys,$data->i_start,$data->i_max);
    }
    return $result_mix;
  }

  // ==============================================================================================
  public function permutation($_a,$buffer = '',$delimiter = '') {
    $output = array();
    $num = count($_a);
    if ($num > 1) {
      foreach ($_a as $key => $val) {
        $temp = $_a;
        unset($temp[$key]);
        sort($temp);

        $return = $this->permutation($temp,trim($buffer.$delimiter.$val,$delimiter),$delimiter);

        if (is_array($return)) {
          $output = array_merge($output,$return);
          $output = array_unique($output);
        }
        else {
          $output[] = $return;
        }
      }
      return $output;
    }
    else {
      return $buffer.$delimiter.$_a[0];
    }
  }

  // ==============================================================================================
  public function time_hm($time) {
    return date('H:i',strtotime($time));
  }

  // ==============================================================================================
  public function webconfig() {
    $query = $this->db->get('tbl_webconfig');
    $data = $query->row();
    $newdata = array(
        'wc_webconfig' => 'webconfig',
        'wc_title' => ''.SITE_TITLE.'',
        'wc_keyword' => ''.$data->keyword.'',
        'wc_description' => ''.$data->description.'',
        'wc_title_member' => ''.$data->title_member.'',
        'wc_title_search' => ''.$data->title_search.'',
        'wc_title_search_des' => ''.$data->title_search_des.'',
        'wc_amount_per_day' => ''.$data->amount_per_day.'',
        'wc_title_bar' => ''.$data->title_bar.'',
        'wc_title_add' => ''.$data->title_add.'',
        'wc_title_post' => ''.$data->title_post.'',
        'wc_title_type' => ''.$data->title_type.'',
        'wc_title_descript' => ''.$data->title_descript.'',
        'wc_title_vip' => ''.$data->title_vip.'',
        'wc_title_top' => ''.$data->title_top.'',
        'wc_logo' => ''.$data->logo.'',
        'wc_webstats' => ''.$data->webstats.'',
        'wc_fav' => ''.$data->fav.'',
        'wc_vip_rule' => ''.$data->vip_rule.'',
        'wc_maximum' => ''.$data->i_maximum.'',
    );
    $this->session->set_userdata($newdata);
  }

  // ==============================================================================================
  public function i_max_list() {
    $this->db->select('i_max_list');
    $query = $this->db->get('tbl_webconfig');
    $data = $query->row();
    return $data->i_max_list;
  }

  // ==============================================================================================
  public function maximum_bet() {
    $this->db->select('i_maximum');
    $query = $this->db->get('tbl_webconfig');
    $data = $query->row();
    return $data->i_maximum;
  }

  // ==============================================================================================
  public function Pagination($info) {
    if ($f == $l) {
      return ' selected="selected" ';
    }
  }

  // ==============================================================================================
  public function select_option($f,$l) {
    if ($f == $l) {
      return ' selected="selected" ';
    }
  }

  // ==============================================================================================
  public function check_empty($str) {
    return ($_POST[$str] == '') ? false : true;
  }

  // ==============================================================================================
  public function i_level() {
    $id = $this->session->userdata(SESS_ID);
    return $this->getNameCol(TBL_PROFILE,array('id' => $id),'i_level');
  }

  // ==============================================================================================
  public function login_id() {
    return $this->session->userdata(SESS_ID);
  }

  // ==============================================================================================
  public function owner_id() {
    $i_level = $this->session->userdata(SESS_LEVEL_ID);
    if ($i_level == 1) {
      return $this->session->userdata(SESS_ID);
    }
    else {
      return $this->session->userdata(SESS_OWNER_ID);
    }
  }

  // ==============================================================================================
  public function level_id() {
    return $this->session->userdata(SESS_LEVEL_ID);
  }

  // ==============================================================================================
  public function level_name() {
    $i_level = $this->session->userdata(SESS_LEVEL_ID);
    return $this->getNameCol(TBL_PROFILE_LEVEL,array('id' => $i_level),'s_name');
  }

  // ==============================================================================================
  public function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data),'+/','-_'),'=');
  }

  // ==============================================================================================
  public function base64url_decode($data) {
    return base64_decode(strtr($data,'-_','+/').str_repeat('=',3 - ( 3 + strlen($data)) % 4));
  }

  // ==============================================================================================
  public function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

  // ==============================================================================================
  public function getNameCol($table,$arr_where,$col) {
    $chk = explode('_',$table);
    $table = ($chk[0] == 'tbl' ? $table : 'tbl_'.$table);
    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }
    $this->db->select($col);
    $query = $this->db->get($table)->row();
    return $query->$col;
  }

  // ==============================================================================================
  public function delete($id,$table) {
    $chk = explode('_',$table);
    if ($chk[0] == 'tbl') {
      
    }
    else {
      $table = 'tbl_'.$table;
    }
    $s_detail = $this->Main_model->rowdata($table,array('id' => $id),array('*'));
    $s_detail = json_encode($s_detail);
    $this->db->where('id',$id);
    $query = $this->db->delete($table);
    /////////// Logs
    $logs = array();
    $logs[s_detail] = $s_detail;
    $logs[i_status] = 3;
    $logs[i_create] = $this->Main_model->login_id();
    $logs[i_level] = $this->Main_model->level_id();
    $logs[i_owner] = $this->Main_model->owner_id();
    $logs[s_tbl_create] = TBL_PROFILE;
    $logs[i_id] = $id;
    $logs[d_create] = date("Y-m-d h:i:s");
    $logs[s_ip] = $this->Main_model->get_client_ip();
    $this->db->insert($table.'_logs',$logs);

    return $query;
  }

  // ==============================================================================================
  public function updateStatus() {
    ///////////// Time
    $id = $this->input->post('id');
    $status = $this->input->post('status');
    if ($status == 0) {
      $status = 1;
    }
    else {
      $status = 0;
    }
    $table = $this->input->post('tbl');
    $chk = explode('_',$table);
    if ($chk[0] == 'tbl') {
      
    }
    else {
      $table = 'tbl_'.$table;
    }
    $this->i_status = $status;
    $this->db->update($table,$this,array('id' => $id));
    $this->session->set_userdata(array('savedata' => 1));
    /////////// Logs
    $s_detail = $this->Main_model->rowdata($table,array('id' => $id),array('*'));
    $s_detail = json_encode($s_detail);
    $logs = array();
    $logs[s_detail] = $s_detail;
    $logs[i_status] = 6;
    $logs[i_create] = $this->Main_model->login_id();
    $logs[i_level] = $this->Main_model->level_id();
    $logs[i_owner] = $this->Main_model->owner_id();
    $logs[s_tbl_create] = TBL_PROFILE;
    $logs[i_id] = $id;
    $logs[d_create] = date("Y-m-d h:i:s");
    $logs[s_ip] = $this->Main_model->get_client_ip();
    $this->db->insert($table.'_logs',$logs);


    return $id;
  }

  // ==============================================================================================
  public function rows($table,$arr_where) {
    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }
    $query = $this->db->get($table);
    return $query->num_rows();
  }

  public function num_row($table,$arr_where) {
    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }
    $query = $this->db->get($table);
    return $query->num_rows();
  }

  public function rows_between($table,$arr_where,$arr_between) {
    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }
    if ($arr_between) {
      foreach ($arr_between as $key => $value) {
        $data_get = explode(':',$value);
        $this->db->where($key.' BETWEEN "'.date('Y-m-d',strtotime($data_get[0])).'" and "'.date('Y-m-d',strtotime($data_get[1])).'"');
      }
    }
    $query = $this->db->get($table);
    return $query->num_rows();
  }

  public function rows_query($table,$arr_query) {
    if ($arr_query) {
      $this->db->query($arr_query);
      $query = $this->db->get();
      return $query->num_rows();
    }
  }

  public function fetch_data($limit,$start,$table,$arr_where,$arr_select,$arr_between = "") {
    if ($limit) {
      $this->db->limit($limit,$start);
    }



    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }
    if ($arr_select) {
      foreach ($arr_select as $val_select) {
        $this->db->select($val_select);
      }
    }
    else {
      $this->db->select('*');
    }
    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function fetch_data_order($limit,$start,$table,$arr_where,$arr_select,$arr_order) {

    $chk = explode('_',$table);
    if ($chk[0] == 'tbl') {
      
    }
    else {
      $table = 'tbl_'.$table;
    }

    if ($limit) {
      $this->db->limit($limit,$start);
    }



    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }


    if ($arr_select) {
      foreach ($arr_select as $val_select) {
        $this->db->select($val_select);
      }
    }
    else {
      $this->db->select('*');
    }

    if ($arr_order) {
      foreach ($arr_order as $key => $value) {
        $this->db->order_by($key,$value);
      }
    }
    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function fetch_data_between($limit,$start,$table,$arr_where,$arr_select,$arr_order,$arr_between) {

    $chk = explode('_',$table);
    if ($chk[0] == 'tbl') {
      
    }
    else {
      $table = 'tbl_'.$table;
    }

    //*
    if ($limit) {
      $this->db->limit($limit,$start);
    }

    if ($arr_between) {
      foreach ($arr_between as $key => $value) {
        $data_get = explode(':',$value);
        $this->db->where($key.' BETWEEN "'.date('Y-m-d',strtotime($data_get[0])).'" and "'.date('Y-m-d',strtotime($data_get[1])).'"');
      }
    }
    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }

    if ($arr_select) {
      foreach ($arr_select as $val_select) {
        $this->db->select($val_select);
      }
    }
    else {
      $this->db->select('*');
    }

    if ($arr_order) {
      foreach ($arr_order as $key => $value) {
        $this->db->order_by($key,$value);
      }
    }
    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function fetch_data_query($limit,$start,$table,$arr_query) {
    if ($limit) {
      $this->db->limit($limit,$start);
    }
    if ($arr_query) {
      $this->db->query($arr_query);
    }

    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function rowdata($table,$arr_where,$arr_select) {
    if ($arr_where) {
      foreach ($arr_where as $key => $value) {
        $this->db->where($key,$value);
      }
    }
    if ($arr_select) {
      foreach ($arr_select as $val_select) {
        $this->db->select($val_select);
      }
    }
    else {
      $this->db->select('*');
    }
    $query = $this->db->get($table)->row();
    return $query;
  }

  /////////////////// English
  public function ThaiMonth($req,$t) {
    $thaiweek = array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัส","วันศุกร์","วันเสาร์");
    $thaimonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    if ($t == 1) {
      $res = date('H:i',strtotime($req));
    }
    else {
      $res = "".date('j ',strtotime($req)).$thaimonth[date('m',strtotime($req)) - 1]." ".(date('Y',strtotime($req)) + 543);
    }
    return $res;
  }

  /////////////////// English
  public function integerToEng($number) {
//trail off all the zero at the beginning
    $number = ltrim($number,' 0');
    if ($number == '') {
      return 'Zero';
    }
    if ($number == '1') {
      return 'One';
    }
//it is easier to work in an inverted one
    $number = strrev($number);
    return $this->millionToEngHelper($number,'',true);
  }

//a helper function that takes care of > million number
  public function millionToEngHelper($rnumber,$sofar,$first) {

    //return strcmp($rnumber, '0');

    if (strcmp($rnumber,'1') == 0) {
      if ($first) {
        return 'One'.$sofar;
        //return 'หนึ่ง' . $sofar;
      }
      else {
        return 'One Million'.$sofar;
        //return 'หนึ่งล้าน' . $sofar;
      }
    }
    else {
      if (strlen($rnumber) > 6) {
        if ($first) {
          return $this->millionToEngHelper(substr($rnumber,6),$this->integerToEngHelper($rnumber,1,'').$sofar,false);
        }
        else {
          return $this->millionToEngHelper(substr($rnumber,6),$this->integerToEngHelper($rnumber,1,'').'Million'.$sofar,false);
        }
      }
      else {
        if ($first) {
          return $this->integerToEngHelper($rnumber,1,'').$sofar;
        }
        else {
          return $this->integerToEngHelper($rnumber,1,'').' Million'.$sofar;
        }
      }
    }
  }

// the same as integer to Eng but this guy can do only up to 10^6-1
// this function takes in an reversed number that is
// one hundred is represented by 001
// digit represents current working digit.
// tail recursion implementation
// if the number is more than million it will return แค่หลักแสน
  public function integerToEngHelper($rnumber,$digit,$sofar) {
    if ($digit > 6) {
      return $sofar;
    }
    if ($rnumber == '') {
      return '';
    }
    else {

      $bahttext_reading = array(
          1 => array('',' One',' Two',' Three',' Four',' Five',' Six',' Seven',' Eight',' Nine'),
          11 => array('',' Eleven',' Twelve',' Thirteen',' Fourteen',' Fifteen',' Sixteen',' Seventeen',' Eighteen',' Nineteen'),
          11 => array('',' Eleven',' Twelve',' Thirteen',' Fourteen',' Fifteen',' Sixteen',' Seventeen',' Eighteen',' Nineteen'),
          2 => array('',' Ten',' Twenty',' Thirty',' Forty','Fifty',' Sixty',' Seventy',' Eighty',' Ninety'),
          3 => array('',' One hundred',' Two hundred',' Three hundred',' Four hundred',' Five hundred',' Six hundred',' Seven hundred',' Eight hundred',' Nine hundred'),
          4 => array('',' One thousand',' Two thousand',' Three thousand',' Four thousand',' Five thousand',' Six thousand',' Seven thousand',' Eight thousand',' Nine thousand'),
          5 => array('',' Ten thousand',' Twenty thousand',' Thirty thousand',' Forty thousand',' Fifty thousand',' Sixty thousand',' Seventy thousand',' Eighty thousand',' Ninety thousand'),
          6 => array('',' One hundred Thousand',' Two hundred Thousand',' Three hundred Thousand',' Four hundred Thousand',' Five hundred Thousand',' Six hundred Thousand',' Seven hundred Thousand',' Eight hundred Thousand',' Nine hundred Thousand')
      );
//echo $rnumber.' '.$sofar.' '.substr($rnumber,0,1).' '.$reading[$digit][$rnumber[0]].'<br>';
      if (strlen($rnumber) == 1) {
        return $bahttext_reading[$digit][$rnumber].$sofar;
        //return strlen($rnumber)." -- ";
      }
      else {
        return $this->integerToEngHelper(substr($rnumber,1),($digit + 1),$bahttext_reading[$digit][substr($rnumber,0,1)].$sofar);
        //return strlen($rnumber)." -- ";
        //return $sofar;
      }
    }
  }

  public function ReplaceNumberTxt($txt) {
    if (strpos($txt,'Ten One') !== false) {
      return str_replace('Ten One','Eleven',$txt);
    }
    elseif (strpos($txt,'Ten Two') !== false) {
      return str_replace('Ten Two','Twelve',$txt);
    }
    elseif (strpos($txt,'Ten Three') !== false) {
      return str_replace('Ten Three','Thirteen',$txt);
    }
    elseif (strpos($txt,'Ten Four') !== false) {
      return str_replace('Ten Four','Fourteen',$txt);
    }
    elseif (strpos($txt,'Ten Five') !== false) {
      return str_replace('Ten Five','Fifteen',$txt);
    }
    elseif (strpos($txt,'Ten Six') !== false) {
      return str_replace('Ten Six','Sixteen',$txt);
    }
    elseif (strpos($txt,'Ten Seven') !== false) {
      return str_replace('Ten Seven','Seventeen',$txt);
    }
    elseif (strpos($txt,'Ten Eight') !== false) {
      return str_replace('Ten Eight','Eighty',$txt);
    }
    elseif (strpos($txt,'Ten Nine') !== false) {
      return str_replace('Ten Nine','Nineteen',$txt);
    }
    else {
      return $txt;
    }
  }

//convert numeric string to Eng reading in baht
//warning bahtText('2345678234234273784723894.234324342') (with quotes)
//is not the same as bahtText(2345678234234273784723894.234324342) because
//php round the number.
//If you wish to use this function with a large number call it with quotes
  public function EngbahtText($number) {
    if (!is_numeric($number) || $number < 0) {
      die('bahtText error: the argument is not a valid positive number');
    }
    if (is_float($number)) {//for weird formats such as 2E5
      echo 'float';
      $whole = floor($number);
      $decimal = round(($number - $whole) * 100);
    }
    else {
      $temp = explode('.',$number);
      if (count($temp) == 1) {
        $whole = $temp[0];
        $decimal = 0;
      }
      else {
        $whole = $temp[0];
        $length = strlen($temp[1]);
        if ($length > 2) {
          $decimal .= '0';
          $decimal = substr($temp[1],0,3);
          $decimal = round($decimal / (10.0));
        }
        else if ($length == 2) {
          $decimal = $temp[1];
        }//0.5 ==> ห้าสิบสตางค์
        else {
          $decimal = $temp[1].'0';
        }
      }
    }
    if ($decimal == 0) {
      return $this->integerToEng($whole).' THB';
    }
    else {
      if ($whole != 0) {
        return $this->integerToEng($whole).' THB';
//return $this->integerToEng($whole) . 'บาท' . $this->integerToEng($decimal) . 'สตางค์';
      }
      else {
        return $this->integerToEng($whole).' THB';
//return $this->integerToEng($decimal) . 'สตางค์';
      }
    }
  }

  //////////////
//Thai text for that number
  public function integerToThai($number) {
//trail off all the zero at the beginning
    $number = ltrim($number,' 0');
    if ($number == '') {
      return 'ศูนย์';
    }
    if ($number == '1') {
      return 'หนึ่ง';
    }
//it is easier to work in an inverted one
    $number = strrev($number);
    return $this->millionToThaiHelper($number,'',true);
  }

//a helper function that takes care of > million number
  public function millionToThaiHelper($rnumber,$sofar,$first) {
    if (strcmp($rnumber,'1') == 0) {
      if ($first) {
        return 'One'.$sofar;
        //return 'หนึ่ง' . $sofar;
      }
      else {
        return 'One Million'.$sofar;
        //return 'หนึ่งล้าน' . $sofar;
      }
    }
    else {
      if (strlen($rnumber) > 6) {
        if ($first) {
          return $this->millionToThaiHelper(substr($rnumber,6),$this->integerToThaiHelper($rnumber,1,'').$sofar,false);
        }
        else {
          return $this->millionToThaiHelper(substr($rnumber,6),$this->integerToThaiHelper($rnumber,1,'').'ล้าน'.$sofar,false);
        }
      }
      else {
        if ($first) {
          return $this->integerToThaiHelper($rnumber,1,'').$sofar;
        }
        else {
          return $this->integerToThaiHelper($rnumber,1,'').'ล้าน'.$sofar;
        }
      }
    }
  }

// the same as integer to Thai but this guy can do only up to 10^6-1
// this function takes in an reversed number that is
// one hundred is represented by 001
// digit represents current working digit.
// tail recursion implementation
// if the number is more than million it will return แค่หลักแสน
  public function integerToThaiHelper($rnumber,$digit,$sofar) {
    if ($digit > 6) {
      return $sofar;
    }
    if ($rnumber == '') {
      return '';
    }
    else {

      $bahttext_reading = array(
          1 => array('','เอ็ด','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า'),
          2 => array('','สิบ','ยี่สิบ','สามสิบ','สี่สิบ','ห้าสิบ','หกสิบ','เจ็ดสิบ','แปดสิบ','เก้าสิบ'),
          3 => array('','หนึ่งร้อย','สองร้อย','สามร้อย','สี่ร้อย','ห้าร้อย','หกร้อย','เจ็ดร้อย','แปดร้อย','เก้าร้อย'),
          4 => array('','หนึ่งพัน','สองพัน','สามพัน','สี่พัน','ห้าพัน','หกพัน','เจ็ดพัน','แปดพัน','เก้าพัน'),
          5 => array('','หนึ่งหมื่น','สองหมื่น','สามหมื่น','สี่หมื่น','ห้าหมื่น','หกหมื่น','เจ็ดหมื่น','แปดหมื่น','เก้าหมื่น'),
          6 => array('','หนึ่งแสน','สองแสน','สามแสน','สี่แสน','ห้าแสน','หกแสน','เจ็ดแสน','แปดแสน','เก้าแสน')
      );
//echo $rnumber.' '.$sofar.' '.substr($rnumber,0,1).' '.$reading[$digit][$rnumber[0]].'<br>';
      if (strlen($rnumber) == 1) {
        return $bahttext_reading[$digit][$rnumber].$sofar;
      }
      else {
        return $this->integerToThaiHelper(substr($rnumber,1),($digit + 1),$bahttext_reading[$digit][substr($rnumber,0,1)].$sofar);
      }
    }
  }

//convert numeric string to thai reading in baht
//warning bahtText('2345678234234273784723894.234324342') (with quotes)
//is not the same as bahtText(2345678234234273784723894.234324342) because
//php round the number.
//If you wish to use this function with a large number call it with quotes
  public function bahtText($number) {
    if (!is_numeric($number) || $number < 0) {
      die('bahtText error: the argument is not a valid positive number');
    }
    if (is_float($number)) {//for weird formats such as 2E5
      echo 'float';
      $whole = floor($number);
      $decimal = round(($number - $whole) * 100);
    }
    else {
      $temp = explode('.',$number);
      if (count($temp) == 1) {
        $whole = $temp[0];
        $decimal = 0;
      }
      else {
        $whole = $temp[0];
        $length = strlen($temp[1]);
        if ($length > 2) {
          $decimal .= '0';
          $decimal = substr($temp[1],0,3);
          $decimal = round($decimal / (10.0));
        }
        else if ($length == 2) {
          $decimal = $temp[1];
        }//0.5 ==> ห้าสิบสตางค์
        else {
          $decimal = $temp[1].'0';
        }
      }
    }
    if ($decimal == 0) {
      return $this->integerToThai($whole).'บาทถ้วน';
    }
    else {
      if ($whole != 0) {
        return $this->integerToThai($whole).'บาท'.$this->integerToThai($decimal).'สตางค์';
      }
      else {
        return $this->integerToThai($decimal).'สตางค์';
      }
    }
  }

  /*
   * 
   * 	Function
   * 
   * @return
   */

  function price_filter($id) {
    $array_price = array("0" => "ไม่จำกัดราคา",
        "1" => "<1,000,000",
        "2" => "1,000,001-5,000,000",
        "3" => "5,000,001-10,000,000",
        "4" => "10,000,001>");
    if ($id == "") {
      $return = $array_price;
    }
    else {
      $return = $array_price[$id];
    }
    return $return;
  }

  function method($id) {
    $array = array("1" => "ขาย","2" => "เช่า");
    if ($id == "") {
      $return = $array;
    }
    else {
      $return = $array[$id];
    }
    return $return;
  }

  function thai_date($time) {
    $thai_day_arr = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
    $thai_month_arr = array(
        "0" => "",
        "1" => "มกราคม",
        "2" => "กุมภาพันธ์",
        "3" => "มีนาคม",
        "4" => "เมษายน",
        "5" => "พฤษภาคม",
        "6" => "มิถุนายน",
        "7" => "กรกฎาคม",
        "8" => "สิงหาคม",
        "9" => "กันยายน",
        "10" => "ตุลาคม",
        "11" => "พฤศจิกายน",
        "12" => "ธันวาคม"
    );
//    global $thai_day_arr,$thai_month_arr;
//    $thai_date_return = "วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return .= " ".date("j",$time);
    $thai_date_return .= " ".$thai_month_arr[date("n",$time)];
    $thai_date_return .= " พ.ศ.".(date("Yํ",$time) + 543);
    $thai_date_return .= "  ".date("H:i",$time)." น.";
    return $thai_date_return;
  }

}
