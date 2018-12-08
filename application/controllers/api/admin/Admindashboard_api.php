<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Admindashboard_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Admin_model');
    }
     //----------fun all company Details------------------------//
    public function getAllCompanies_get() {
        $result = $this->Admin_model->getAllCompanies();
        return $this->response($result);
    }
 }