<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Registeruser_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/register_model/Register_model');
    }

//----------------fun for get machine details----------------------//
    public function getAllCountries_get() {
        print_r($_GET);die();
        $result = $this->Register_model->getAllCountries();
        return $this->response($result);
    }

    //----------fun for update Employee Details------------------------//
    public function registerUser_post() {
        $data = ($_POST);
        //extract($data);
        $result = $this->Register_model->registerUser($data);
        return $this->response($result);
    }

}
