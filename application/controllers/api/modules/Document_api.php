<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');
class Document_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modules/document_model');
    }

    // api to get all document types
    public function getDocumentTypes_get() {
        //print_r($_GET);die();
        $result = $this->document_model->getDocumentTypes();
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
        $result = $this->document_model->lastRevision($project_id);
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
        $result = $this->document_model->getUserAssoc($project_id);
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
        $result = $this->document_model->getRolesAssoc($project_id);
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
        $result = $this->document_model->getAllDocuments($project_id);
        if($result)
        {
            return $this->response($result, 200);
        } 
        else
        {
            return $this->response(NULL, 404);
        }
    }

    // api to add Document
    public function addDocument_post() {
        $data=$_POST;
        $result = $this->document_model->addDocument($data);
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
