<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

class Sitecontroller_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modules/sitecontroller_model');
    }

    // api to get all work item types
    public function getAllWitems_get() {
        extract($_GET);
        $result = $this->sitecontroller_model->getAllWitems($project_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

      public function addComment_post() {
        $data = $_POST;
        //print_r($data);die();
        $result = $this->sitecontroller_model->add_comments($data);
        return $this->response($result);
    }


    // api to get all activities
    public function getAllActivity_get() {
        extract($_GET);
        $proj_id = base64_decode($project_id);
        $result = $this->sitecontroller_model->getAllActivity($proj_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

   // get all query responses
    public function getQueryComments_get() {
        extract($_GET);
        $result = $this->sitecontroller_model->getQueryComments($activity_id);
        return $this->response($result);
    }

    // api to get activity details
    public function getActivityDetail_get() {
        extract($_GET);
        $act_id = base64_decode($activity_id);
        $result = $this->sitecontroller_model->getActivityDetail($act_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to remove work item
    public function delWitem_post() {
        extract($_POST);
        $result = $this->sitecontroller_model->delWitem($item_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to add Work item
    public function addWitem_post() {
        $data = $_POST;
        $result = $this->sitecontroller_model->addWitem($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to add Activity
    public function addActivity_post() {
        $data = $_POST;
        $result = $this->sitecontroller_model->addActivity($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to update Document
    public function updateChecklist_post() {
        $data = $_POST;
        $result = $this->sitecontroller_model->updateChecklist($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to upload file in Document
    public function uploadImageInfo_post() {
        $data = $_POST;
        $result = $this->sitecontroller_model->uploadImageInfo($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to remove activity
    public function removeActivity_get() {
        extract($_GET);
        $activity_id = base64_decode($act_id);
        $result = $this->sitecontroller_model->removeActivity($activity_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to remove file in Document
    public function removeImageInfo_post() {
        extract($_POST);
        $result = $this->sitecontroller_model->removeImageInfo($key, $activity_id, $author);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    public function getAllActivities_get() {
        extract($_GET);
        $result = $this->sitecontroller_model->getAllActivity($project_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }


    // get slab cycle details details
    public function getSlabCycleDetails_get(){
        extract($_GET);

        $result = $this->sitecontroller_model->getSlabCycleDetails($project_id,$witemid);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // mark checklist as done
    public function markChecklistDone_get(){
        extract($_GET);
        $act_id=base64_decode($activity_id);
        $result = $this->sitecontroller_model->markChecklistDone($act_id,$author);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // mark checklist as undone
    public function markChecklistUndone_get(){
        extract($_GET);
        $act_id=base64_decode($activity_id);
        $result = $this->sitecontroller_model->markChecklistUndone($act_id,$author);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // //----------------fun for get all countries details----------------------//
    // public function getCountryState_get() {
    //     //print_r($_GET);die();
    //     extract($_GET);
    //     $result = $this->Register_model->getCountryState($country);
    //     return $this->response($result);
    // }
    // //----------------fun for get all countries details----------------------//
    // public function getStateCity_get() {
    //     //print_r($_GET);die();
    //     extract($_GET);
    //     $result = $this->Register_model->getStateCity($state);
    //     return $this->response($result);
    // }
    // //----------fun for register user Details------------------------//
    // public function registerUser_post() {
    //     $data = ($_POST);
    //     //print_r($data);die();
    //     $result = $this->Register_model->registerUser($data);
    //     return $this->response($result);
    // }
}
