<?if (eregi("class.mysql.php",$_SERVER['PHP_SELF'])) {
    Header("Location: ../index.php");
    die();
}
class DB{
	//??
	var $host_th = "localhost" ;
	//var $host_cn = "61.19.253.26" ;
	//var $host_cn = "223.223.218.85" ;
	
	var $host_cn = "localhost" ;
	var $database ;
	var $connect_db ;
	var $selectdb ;
	var $db ;
	var $sql ;
	var $table ;
	var $where; 
	////////////////////// ??? //////////////////////
		function connectdb($db_name="database",$user="username",$pwd="password"){
	////// loop 1
		$this->database = $db_name;
		$this->username = $user;
		$this->password = $pwd;
		$this->connect_db = mysql_connect ( $this->host_th, $this->username, $this->password ) or $this->_error();
		//$this->connect_db = mysql_pconnect ( $this->host, $this->username, $this->password ) or $this->_error();
		$this->db = mysql_select_db ( $this->database, $this->connect_db) or $this->_error();
		mysql_query("SET NAMES UFT8"); 
		mysql_query("SET character_set_results=utf-8"); 
		return true; 
	/////////////
	}
	//??
	function connectdb_th($db_name="database",$user="username",$pwd="password"){
	////// loop 1
		$this->database = $db_name;
		$this->username = $user;
		$this->password = $pwd;
		$this->connect_db = mysql_connect ( $this->host_th, $this->username, $this->password ) or $this->_error();
		//$this->connect_db = mysql_pconnect ( $this->host, $this->username, $this->password ) or $this->_error();
		$this->db = mysql_select_db ( $this->database, $this->connect_db) or $this->_error();
		mysql_query("SET NAMES UFT8"); 
		mysql_query("SET character_set_results=utf-8"); 
		return true; 
	/////////////
	}
		function connectdb_cn($db_name="database",$user="username",$pwd="password"){
	////// loop 1
		$this->database = $db_name;
		$this->username = $user;
		$this->password = $pwd;
		$this->connect_db = mysql_connect ( $this->host_cn, $this->username, $this->password ) or $this->_error();
		//$this->connect_db = mysql_pconnect ( $this->host, $this->username, $this->password ) or $this->_error();
		$this->db = mysql_select_db ( $this->database, $this->connect_db) or $this->_error();
		mysql_query("SET NAMES UFT8"); 
		mysql_query("SET character_set_results=utf-8"); 
		return true; 
	/////////////
	}
	//???
	function closedb( ){
		mysql_close ( $this->connect_db ) or $this->_error();
	}
	//
	//$db->add_db("table",array("field"=>"value")); 
	function add_db($table="table", $data="data"){
		global $insert_last_id;
		$key = array_keys($data); 
        $value = array_values($data); 
		$sumdata = count($key); 
		for ($i=0;$i<$sumdata;$i++) 
        { 
            if (empty($add)){ 
                $add="("; 
            }else{ 
                $add=$add.","; 
            } 
            if (empty($val)){ 
                $val="("; 
            }else{ 
                $val=$val.","; 
            } 
            $add=$add.$key[$i]; 
            $val=$val."'".$value[$i]."'"; 
        } 
        $add=$add.")"; 
        $val=$val.")"; 
        $sql="INSERT INTO ".$table." ".$add." VALUES ".$val; 
        if (mysql_query($sql)){ 
            $insert_last_id = mysql_insert_id();
			return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
	}
	//??� 
	//$db->update_db("tabel",array("field"=>"value"),"where"); 
    function update_db($table="table",$data="data",$where="where"){ 
		////// loop 1
        $key = array_keys($data); 
        $value = array_values($data); 
        $sumdata = count($key); 
        $set=""; 
        for ($i=0;$i<$sumdata;$i++) 
        { 
            if (!empty($set)){ 
                $set=$set.","; 
            } 
            $set=$set.$key[$i]."='".$value[$i]."'"; 
        } 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
		////// loop 2
		$db->connectdb_th(DB_NAME,DB_USERNAME,DB_PASSWORD);
        $key = array_keys($data); 
        $value = array_values($data); 
        $sumdata = count($key); 
        $set=""; 
        for ($i=0;$i<$sumdata;$i++) 
        { 
            if (!empty($set)){ 
                $set=$set.","; 
            } 
            $set=$set.$key[$i]."='".$value[$i]."'"; 
        } 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 
	//??
	//$db->update("table","set","where");
	function update($table="table",$set="set",$where="where"){ 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 
	//z
	//$db->del("table","where"); 
    function del($table="table",$where="where"){ 
        $sql="DELETE FROM ".$table." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 
	//????
	//$db->num_rows("table","field","where"); 
    function num_rows($table="table",$field="field",$where="where") { 
        if ($where=="") { 
            $where = ""; 
        } else { 
            $where = " WHERE ".$where; 
        } 
        $sql = "SELECT ".$field." FROM ".$table.$where; 
        if($res = mysql_query($sql)){ 
            return mysql_num_rows($res); 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 
	//Query 
	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
    function select_query($sql="sql"){ 
        if ($res = mysql_query($sql)){ 
		
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 
	//????
	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
	//$rows = $db->rows($res); 
    function rows($sql="sql"){ 
      if ($res = mysql_num_rows($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 
	//? array
	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
	//while ($arr = $db->fetch($res)) { 
	//		echo $arr['a']." - ".$arr['c']."<br>\n"; 
	//}
    function fetch($sql="sql"){ 
      if ($res = mysql_fetch_assoc($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 
	//????
    function _error(){ 
        $this->error[]=mysql_errno(); 
    } 
	
	 function checkWorking ($totalDate="totalDate",$id="id")
	 {
	mysql_connect("localhost","root","123");
	mysql_select_db("programer_management");
	if($totalDate<0){
	$objQuery = mysql_query("UPDATE work SET Status = 'Late' WHERE UserID = '".$id."'");		
		return $objQuery ;
		}
	else if($totalDate>=0){
		$objQuery = mysql_query("UPDATE work SET Status = 'Working' WHERE UserID = '".$id."'");
		return $objQuery ;
		}
	 }
	 
	  function DateTimeDiff($strDateTime1,$strDateTime2)
	 {
				return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60  ); // 1 Hour =  60*60
	 }
	 
	 function chkTime($time){
	 //$endDate = "endDate",$status = "Status",$lastUd="LastUpdate"
	 	//$current = date("Y-m-d H:i");
		//$last = date("Y-m-d H:i",$lastUd);
		//$time = DateTimeDiff($endDate,$current)*60;
		$thistime = $time;
		$hour = floor($thistime/3600);
		$hour = $hour%24;
		$T_minute = $thistime % 3600;
		$day = floor($thistime/86400);
		if($day<0){
		$day = $day+1;
		}
		$minute = floor($T_minute / 60);
		$second = $T_minute % 60;
		if($day==0){
		$word = abs($hour)." ชั่วโมง ".abs($minute)." นาที";
		}else if($minute==0){
		$word = abs($day)." วัน ".abs($hour)." ชั่วโมง ";
		}else{
		$word = abs($day)." วัน ".abs($hour)." ชั่วโมง ".abs($minute)." นาที";
		}
		//if(second<0){$word = "<span style=\"color: #FF3333;\">"."Day: ".abs($day)." Hour: ".abs($hour)." Minute: ".abs($minute)."</span>"; }
		return $word;
	}
}
?>