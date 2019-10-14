<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index() {
        $params = json_decode(file_get_contents('php://input'), TRUE);
        if (isset($params)) {
            $data['results'] = $this->Product_model->loaddata($params);
            $this->load->view('product_view', $data);
        } else {

            echo "Please check your json from";
        }
    }

    public function product_fix() {
        $params = json_decode(file_get_contents('php://input'), TRUE);
        if (isset($params)) {
            $a = '1';
            if ($params['id'] == "") {
                $resp = $this->Product_model->querydata2($params);
                json_output($resp['status'], $resp['response']);
                //$this->load->view('product_view',$data);
                //echo $resp;
            } else {
                $resp = $this->Product_model->query_eachdata($params['id']);
                json_output($resp['status'], $resp['response']);
            }
        } else {

            echo "Please check your json from";
        }
    }

    public function product_service() {
        $params = json_decode(file_get_contents('php://input'), TRUE);
        if (isset($params)) {

            $resp = $this->Product_model->querydata_service($params);
            json_output($resp['status'], $resp['response']);
        } else {

            echo "Please check your json from";
        }
    }

    public function product_stay() {
        $params = json_decode(file_get_contents('php://input'), TRUE);
        if (isset($params)) {


            $resp = $this->Product_model->group_by($params);
            json_output($resp['status'], $resp['response']);
            //$this->load->view('product_view',$data);
//					echo $resp;
        } else {

            echo "Please check your json from";
        }
    }

    public function product_stay_from() {

        $params = json_decode(file_get_contents('php://input'), TRUE);


        $resp = $this->Product_model->group_by_stayfrom($params);
        json_output($resp['status'], $resp['response']);
    }

    public function search_prorecoment() {
        $params = json_decode(file_get_contents('php://input'), TRUE);

        $data['response'] = $this->Product_model->prorecoment($params);
        $data['status'] = '202';
//        $data['params'] = $params;
//$data['params'] = $params;
//				json_output($data['status'],$data['response']);
        json_output($data['status'], $data['response']);
        //$data['code'] = $params['code'];
//		$this->load->view('service_view',$data);
    }

    //////////////////////////// End
}

?>