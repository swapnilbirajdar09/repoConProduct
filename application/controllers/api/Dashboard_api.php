<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Dashboard_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

// fun for get checklist queries
    public function getAllChecklistQueries_get() {
        extract($_GET);
        $result = $this->Dashboard_model->getAllChecklistQueries($project_id);
        return $this->response($result);
    }

    //---------------fun for get all queries
    public function getAllQueriesdashboard_get() {
        extract($_GET);
        $result = $this->Dashboard_model->getAllQueries_dashboard($project_id);
        return $this->response($result);
    }

    //--------------fun for all document
    public function allDocuments_get() {
        extract($_GET);
        $result = $this->Dashboard_model->allDocuments($project_id);
        return $this->response($result);
    }

    //--------------fun for top document
    public function topDocuments_get() {
        extract($_GET);
        $result = $this->Dashboard_model->topDocuments($project_id);
        return $this->response($result);
    }

//----function for count of documents
    public function countoFDocuments_get() {
        extract($_GET);
        $result = $this->Dashboard_model->countoFDocuments($project_id);
        return $this->response($result);
    }

//----function for count of all queries
    public function countoFQuery_get() {
        extract($_GET);
        $result = $this->Dashboard_model->countoFQuery($project_id);
        return $this->response($result);
    }

    //----function for count of pending queries
    public function countoFPendingQuery_get() {
        extract($_GET);
        $result = $this->Dashboard_model->countoFPendingQuery($project_id);
        return $this->response($result);
    }

    //----function for count of total working user
    public function countoFUser_get() {
        extract($_GET);
        $result = $this->Dashboard_model->countoFUser($project_id);
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
