<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Grantpermission_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/permission_model');
    }

    //----------------fun for get all grades ----------------------//
    public function getAllGrades_get() {
        //print_r($_GET);die();
        $result = $this->permission_model->getAllGrades();
        return $this->response($result);
    }

}
