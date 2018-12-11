<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_documents extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        // $this->load->model('modules/product_model');
    }

    // main index function
    public function index() {
        $data['allDocument_types']=Manage_documents::getDocumentTypes();
        $data['lastRevision_no']=Manage_documents::getlastRevision();
        $data['assocUsers']=Manage_documents::getUserAssoc();
        $data['assocRoles']=Manage_documents::getRolesAssoc();
        $data['allDocuments']=Manage_documents::getAllDocuments();
        // print_r($data);

        $this->load->view('includes/header');
        $this->load->view('pages/modules/manage_documents',$data);
        $this->load->view('includes/footer');
    }

    public function upload(){
        extract($_POST);
        // print_r($_FILES);
        $project_id='1';
        $data=$_POST;
        $data['project_id']=$project_id;
        
        $data['author']='samrat';
        // validate fields
        if($document_type=='0'){
            $response=array(
                'status'    =>  'validation',
                'message'   =>  '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Document Type first !</div>',
                'field'   =>  'document_type'
            );
            echo json_encode($response);
            die();
        }
        if(!isset($roleAssoc)){
            $response=array(
                'status'    =>  'validation',
                'message'   =>  '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Please share the document with at least one <b>Role</b> !</div>',
                'field'   =>  'roleAssoc'
            );
            echo json_encode($response);
            die();
        }
        $data['roleAssoc']=json_encode($roleAssoc);
        $imageArr = array();    
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $count=$i+1;
            $imagePath = '';
            $product_image = $_FILES['file']['name'][$i];
            if (!empty(($_FILES['file']['name'][$i]))) {

                $extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);

                $_FILES['userFile']['name'] = $document_title.'-'.$document_type.'_'.$project_id.'.'.$extension;
                $_FILES['userFile']['type'] = $_FILES['file']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['file']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['file']['size'][$i];

                $uploadPath = 'assets/modules/documents/';  
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*'; 
                //allowed types of images           
                $config['overwrite'] = FALSE;
                $this->load->library('upload', $config);  
                //load upload file config.
                $this->upload->initialize($config);

                if ($this->upload->do_upload('userFile')) {
                    $fileData = $this->upload->data();
                    $imagePath = 'assets/modules/documents/'.$fileData['file_name'];
                }
                else{
                    $response=array(
                        'status'    =>  'validation',
                        'message'   =>  $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>'),
                        'field'   =>  'file_drop'
                    );
                    echo json_encode($response);
                    die();
                }
            }
            $imageArr[] = $imagePath;
        }
        $data['images'] = json_encode($imageArr);

        $path = base_url();
        $url = $path . 'api/modules/document_api/addDocument';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER.":".API_PASSWD);  
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);

        if($response){
            $response=array(
                'status'    =>  'success',
                'message'   =>  '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Documents uploaded successfully.</div>'
            );
            echo json_encode($response);
            die();
        }
        else{
            $response=array(
                'status'    =>  'error',
                'message'   =>  '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Documents were not uploaded.</div>'
            );
            echo json_encode($response);
            die();
        } 
    }

    // get document types
    public function getDocumentTypes(){
        $path = base_url();
        $url = $path . 'api/modules/document_api/getDocumentTypes';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER.":".API_PASSWD);  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    // get last revision number for current project
    public function getlastRevision(){
        $project_id='1';
        $path = base_url();
        $url = $path . 'api/modules/document_api/getlastRevision?project_id='.$project_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER.":".API_PASSWD);  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    // get associated users for project
    public function getUserAssoc(){
        $project_id='1';
        $path = base_url();
        $url = $path . 'api/modules/document_api/getUserAssoc?project_id='.$project_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER.":".API_PASSWD);  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    // get associated roles for project
    public function getRolesAssoc(){
        $project_id='1';
        $path = base_url();
        $url = $path . 'api/modules/document_api/getRolesAssoc?project_id='.$project_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER.":".API_PASSWD);  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    // get all documents for project
    public function getAllDocuments(){
        $project_id='1';
        $path = base_url();
        $url = $path . 'api/modules/document_api/getAllDocuments?project_id='.$project_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER.":".API_PASSWD);  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

}
