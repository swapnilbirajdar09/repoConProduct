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

    // get all query responses
    public function getQueryComments_get() {
        extract($_GET);
        $result = $this->rfiquery_model->getQueryComments($query_id);
        return $this->response($result);
    }

    // api to post comment
    public function postComment_post() {
        $data = $_POST;
        $result = $this->rfiquery_model->postComment($data);
        print_r($result);
        die();
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    public function updateQueryDetails_post() {
        $data = $_POST;
        $result = $this->rfiquery_model->updateQueryDetails($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to remove file in Document
    public function removeImage_post() {
        extract($_POST);
        $result = $this->rfiquery_model->removeImage($key, $query_id, $author);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to upload file in Document
    public function uploadImage_post() {
        $data = $_POST;
        $result = $this->rfiquery_model->uploadImage($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    public function commentReply_post() {
        extract($_POST);
        print_r($_POST);
        die();
        $result = $this->rfiquery_model->postComment($replyfor, $comment_posted, $author);
        print_r($result);
        die();
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
            
        }
    }

}
