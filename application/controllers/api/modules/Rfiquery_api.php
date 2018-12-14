<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Rfiquery_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modules/rfiquery_model');
    }

//-----------fun for save query details
    public function raiseQuery_post() {
        extract($_POST);
        $data = $_POST;
        $result = $this->rfiquery_model->raiseQuery($data);
        return $this->response($result);
    }

//---------------fun for get all queries
    public function getAllQueries_get() {
        $result = $this->rfiquery_model->getAllQueries();
        return $this->response($result);
    }

//-------------fun for remove query
    public function removeQuery_get() {
        extract($_GET);
        $result = $this->rfiquery_model->removeQuery($query_id);
        return $this->response($result);
    }

    //---------fun for get query details
    public function getQueryDetails_get() {
        extract($_GET);
        $result = $this->rfiquery_model->getQueryDetails($query_id);
        return $this->response($result);
    }

    // api to post comment
    public function postComment_post() {
        $data=$_POST;
        $result = $this->rfiquery_model->postComment($data);
        print_r($result);die();
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

}
