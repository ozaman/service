
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handbook extends CI_Controller {
  public function __construct() {
   		 parent::__construct();
   		 //$this->load->model('Service_model');
  }
  public function index()
	{
		$this->load->view('handbook/index.php');

//		 echo 123;
	}
   public function ttt()
	{
		echo 5555;
	}
  
 }
?>

