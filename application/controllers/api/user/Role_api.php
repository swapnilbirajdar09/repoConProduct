<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Role_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/Roles_model');
    }

//----------------fun for get all countries details----------------------//
    public function getAllProjects_get() {
        //print_r($_GET);die();
        extract($_GET);
        $result = $this->Roles_model->getAllProjects($company_id);
        return $this->response($result);
    }

    public function getAllFeatures_get() {
        //print_r($_GET);die();
        extract($_GET);
        $result = $this->Roles_model->getAllFeatures();
        return $this->response($result);
    }

    public function saveRoles_post() {
        $data = ($_POST);
        //print_r($data);die();
        $result = $this->Roles_model->saveRoles($data);
        return $this->response($result);
    }

    public function getAllRoles_get() {
        //print_r($_GET);die();
        extract($_GET);
        $result = $this->Roles_model->getAllRoles($project_id);
        return $this->response($result);
    }

    public function deleteRole_get() {
        //print_r($_GET);die();
        extract($_GET);
        $result = $this->Roles_model->deleteRole($role_id);
        return $this->response($result);
    }

}
