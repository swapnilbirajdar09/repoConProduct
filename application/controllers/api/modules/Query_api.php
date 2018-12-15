<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Query_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modules/query_model');
    }

    public function uploadImage_post() {
        $data = $_POST;
        $result = $this->query_model->uploadImage($data);
        return $this->response($result);
    }

    public function addComment_post() {
        $data = $_POST;
        //print_r($data);die();
        $result = $this->query_model->add_comments($data);
        return $this->response($result);
    }

    public function saveComments_post() {
        $data = ($_POST);
        //print_r($data);die();
        $result = $this->query_model->saveComments($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

}
