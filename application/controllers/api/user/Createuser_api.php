<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Createuser_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/projectuser_model');
    }

//----------------fun for get all countries details----------------------//
    public function getProjectRoles_get() {
        extract($_GET);
        $result = $this->projectuser_model->getProjectRoles($project_id);
        return $this->response($result);
    }

    public function getProjectUsers_get() {
        extract($_GET);
        $result = $this->projectuser_model->getProjectUsers($project_id);
        return $this->response($result);
    }
    
    public function deleteUser_get() {
        extract($_GET);
        $result = $this->projectuser_model->deleteUser($user_id);
        return $this->response($result);
    }

    public function createNewUser_post() {
        extract($_POST);
        $data = $_POST;
        $result = $this->projectuser_model->createNewUser($data);
        return $this->response($result);
    }

}
