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
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to get last revison number for project
    public function getlastRevision_get() {
        extract($_GET);
        $result = $this->document_model->lastRevision($project_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to get associated users
    public function getUserAssoc_get() {
        extract($_GET);
        $result = $this->document_model->getUserAssoc($project_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to get associated roles
    public function getRolesAssoc_get() {
        extract($_GET);
        $result = $this->document_model->getRolesAssoc($project_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to get all documents
    public function getAllDocuments_get() {
        extract($_GET);
        $result = $this->document_model->getAllDocuments($project_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to get document details
    public function getDocumentDetail_get() {
        extract($_GET);
        $document_id = base64_decode($doc_id);
        $result = $this->document_model->getDocumentDetail($document_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

//---------api for send req for deletion
    public function sendRequestForDeletion_post() {
        extract($_POST);
        //print_r($_POST);die();
        $data = $_POST;
        $result = $this->document_model->sendRequestForDeletion($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to remove document
    public function removeDoc_get() {
        extract($_GET);
        $document_id = base64_decode($doc_id);
        $result = $this->document_model->removeDoc($document_id);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to add Document
    public function addDocument_post() {
        $data = $_POST;
        $result = $this->document_model->addDocument($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api for upload document for request document module

    public function uploadRequestedDocument_post() {
        $data = $_POST;
        $result = $this->document_model->uploadRequestedDocument($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to update Document
    public function updateDocument_post() {
        $data = $_POST;
        $result = $this->document_model->updateDocument($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to upload file in Document
    public function uploadFile_post() {
        $data = $_POST;
        $result = $this->document_model->uploadFile($data);
        if ($result) {
            return $this->response($result, 200);
        } else {
            return $this->response(NULL, 404);
        }
    }

    // api to remove file in Document
    public function removeFile_post() {
        extract($_POST);
        $result = $this->document_model->removeFile($key, $document_id, $author);
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
