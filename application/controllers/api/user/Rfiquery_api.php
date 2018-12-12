<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Createuser_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/rfiquery_model');
    }

    public function raiseQuery_post() {
        extract($_POST);
        $data = $_POST;
        $result = $this->rfiquery_model->raiseQuery($data);
        return $this->response($result);
    }

}
