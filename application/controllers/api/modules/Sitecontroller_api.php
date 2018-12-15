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
        //print_r($_GET);die();
        $result = $this->sitecontroller_model->getAllWitems();
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to get last revison number for project
    public function getlastRevision_get() {
        extract($_GET);
        $result = $this->sitecontroller_model->lastRevision($project_id);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to get associated users
    public function getUserAssoc_get() {
        extract($_GET);
        $result = $this->sitecontroller_model->getUserAssoc($project_id);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to get associated roles
    public function getRolesAssoc_get() {
        extract($_GET);
        $result = $this->sitecontroller_model->getRolesAssoc($project_id);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to get all documents
    public function getAllDocuments_get() {
        extract($_GET);
        $result = $this->sitecontroller_model->getAllDocuments($project_id);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to get document details
    public function getDocumentDetail_get() {
        extract($_GET);
        $document_id=base64_decode($doc_id);
        $result = $this->sitecontroller_model->getDocumentDetail($document_id);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to remove work item
    public function delWitem_post() {
        extract($_POST);
        $result = $this->sitecontroller_model->delWitem($item_id);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to add Work item
    public function addWitem_post() {
        $data=$_POST;
        $result = $this->sitecontroller_model->addWitem($data);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to update Document
    public function updateDocument_post() {
        $data=$_POST;
        $result = $this->sitecontroller_model->updateDocument($data);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to upload file in Document
    public function uploadFile_post() {
        $data=$_POST;
        $result = $this->sitecontroller_model->uploadFile($data);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to remove file in Document
    public function removeFile_post() {
        extract($_POST);
        $result = $this->sitecontroller_model->removeFile($key,$document_id,$author);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
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
