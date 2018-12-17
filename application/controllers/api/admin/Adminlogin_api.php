<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Adminlogin_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('admin/Admin_model');
    }
     //----------fun for company login Details------------------------//
    public function adminlogin_post() {
        $data = ($_POST);
        //print_r($data);die();
        $result = $this->Login_model->adminlogin($data);
        return $this->response($result);
    }

       //----------fun for Super Admin login Details------------------------//
    public function admin_login_post() {
        $data = ($_POST);
        //print_r($data);die();
        $result = $this->Admin_model->adminlogin($data);
        return $this->response($result);
    }
 }