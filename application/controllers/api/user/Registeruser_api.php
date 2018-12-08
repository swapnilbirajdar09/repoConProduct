<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Registeruser_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/register_model/Register_model');
    }

//----------------fun for get all countries details----------------------//
    public function getAllCountries_get() {
        //print_r($_GET);die();
        $result = $this->Register_model->getAllCountries();
        return $this->response($result);
    }

    //----------------fun for get all countries details----------------------//
    public function getCountryState_get() {
        //print_r($_GET);die();
        extract($_GET);
        $result = $this->Register_model->getCountryState($country);
        return $this->response($result);
    }
    
    //----------------fun for get all countries details----------------------//
    public function getStateCity_get() {
        //print_r($_GET);die();
        extract($_GET);
        $result = $this->Register_model->getStateCity($state);
        return $this->response($result);
    }
    //----------fun for register user Details------------------------//
    public function registerUser_post() {
        $data = ($_POST);
        //print_r($data);die();
        $result = $this->Register_model->registerUser($data);
        return $this->response($result);
    }

}
