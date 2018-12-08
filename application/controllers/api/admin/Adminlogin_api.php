<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Adminlogin_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
    }
     //----------fun for login Details------------------------//
    public function adminlogin_post() {
        $data = ($_POST);
        //print_r($data);die();
        $result = $this->Login_model->adminlogin($data);
        return $this->response($result);
    }
 }