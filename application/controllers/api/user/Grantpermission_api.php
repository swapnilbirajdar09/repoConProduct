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

    //-------fun for grantPrivilege
    public function grantPrivilege_post() {
        extract($_POST);
        $data = $_POST;
        //print_r($_POST);die();
        $result = $this->permission_model->grantPrivilege($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

}
