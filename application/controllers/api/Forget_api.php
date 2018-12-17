<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

class Forget_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('forget_model');
    }

    // api to get all document types
    public function getPassword_get() {
        extract($_GET);
        $result = $this->forget_model->getPassword($admin_email);
        return $this->response($result);
    }

    public function getUserPassword_get() {
        extract($_GET);
        $result = $this->forget_model->getUserPassword($user_email);
        return $this->response($result);
    }

}
