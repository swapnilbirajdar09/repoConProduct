<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Dashboard_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    //---------------fun for get all queries
    public function getAllQueriesdashboard_get() {
        $result = $this->Dashboard_model->getAllQueries_dashboard();
        return $this->response($result);
    }

//-----------fun for update query status
     public function updateQueryStatus_get() {
        extract($_GET);
        $result = $this->Dashboard_model->updateQueryStatus($query_id);
        return $this->response($result);
    }
//-----------fun for Reject query 
     public function RejectQueryStatus_get() {
        extract($_GET);
        $result = $this->Dashboard_model->RejectQueryStatus($query_id);
        return $this->response($result);
    }
  }