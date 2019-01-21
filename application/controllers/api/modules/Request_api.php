<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Request_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modules/request_model');
    }


    public function createNewReq_post() {
        extract($_POST);
        $data = $_POST;
        $result = $this->request_model->createNewReq($data);
        return $this->response($result);
    }

}