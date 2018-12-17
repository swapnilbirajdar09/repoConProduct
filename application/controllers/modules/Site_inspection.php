<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_inspection extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $role = $this->session->userdata('role');

        if ($role == 'company_admin') {
            $admin_name = $this->session->userdata('usersession_name');
            if ($admin_name == '') {
//     //check session variable set or not, otherwise logout
                redirect('login');
            }
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];

            if ($user_name == '') {
//     //check session variable set or not, otherwise logout
                redirect('user/userrole_login');
            }
        }
    }

    // main index function
    public function index() {
        // $data['allDocument_types'] = Site_inspection::getDocumentTypes();
        // $data['lastRevision_no'] = Site_inspection::getlastRevision();
        $role = $this->session->userdata('role');

        if ($role == 'company_admin') {
            $data['allWitems'] = Site_inspection::getAllWitems();
            $data['allActivities'] = Site_inspection::getAllActivity();
            // // print_r($data);
            $data['projects'] = Site_inspection::getAllprojects();
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Site_inspection::getAllFeatuesForUser($user_id, $role_id);
            $data['allWitems'] = Site_inspection::getAllWitems();
            $data['allActivities'] = Site_inspection::getAllActivity();
        }
        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/site_inspection', $data);
        $this->load->view('includes/footer');
    }

    public function getAllFeatuesForUser($user_id, $role_id) {
        $path = base_url();
        $url = $path . 'api/user/User_api/getAllFeatuesForUser?user_id=' . $user_id . '&role_id=' . $role_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    public function getAllprojects() {
        $company_id = $this->session->userdata('company_id');
        $path = base_url();
        $url = $path . 'api/user/Role_api/getAllProjects?company_id=' . $company_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    // add new work item function
    public function addWitem() {
        extract($_POST);
        // print_r($_FILES);
        $project_id = $this->session->userdata('project_id');
        $data = $_POST;
        $data['project_id'] = $project_id;

        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/addWitem';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        if ($response) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Work Item added.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Work Item was not added successfully.</div>';
        }
    }

    // get all work items
    public function getAllWitems() {
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getAllWitems';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    // get all work items
    public function getAllActivity() {
        $project_id = $this->session->userdata('project_id');
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getAllActivity?project_id='.base64_encode($project_id);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    // add new activity in checklist function
    public function addActivity() {
        extract($_POST);
        // print_r($_FILES);
        $project_id = $this->session->userdata('project_id');
        $data = $_POST;
        $data['project_id'] = $project_id;

        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/addActivity';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        if ($response) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Activity added.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Activity was not added successfully.</div>';
        }
    }

    // get last revision number for current project
    public function getlastRevision() {
        $project_id = $this->session->userdata('project_id');
        $path = base_url();
        $url = $path . 'api/modules/document_api/getlastRevision?project_id=' . $project_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    
    // edit document fucntion
    public function updateDocument() {
        extract($_POST);
        // print_r($_FILES);
        $data = $_POST;
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        // validate fields
        if ($document_type == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Document Type first !</div>',
                'field' => 'document_type'
            );
            echo json_encode($response);
            die();
        }

        $path = base_url();
        $url = $path . 'api/modules/document_api/updateDocument';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);

        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Details updated successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Perhaps you have not changed any value.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

    // upload more files in document edit page
    public function uploadFile() {
        extract($_POST);
        $data = $_POST;
        $data['document_id'] = $doc_id;
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        $filepath = '';

        $file_name = $_FILES['doc_file']['name'];
        if (!empty(($_FILES['doc_file']['name']))) {
            $extension = pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION);
            $_FILES['userFile']['name'] = $doc_title . '-' . $doc_type . '_' . time() . '.' . $extension;
            $_FILES['userFile']['type'] = $_FILES['doc_file']['type'];
            $_FILES['userFile']['tmp_name'] = $_FILES['doc_file']['tmp_name'];
            $_FILES['userFile']['error'] = $_FILES['doc_file']['error'];
            $_FILES['userFile']['size'] = $_FILES['doc_file']['size'];

            $uploadPath = 'assets/modules/documents/';  //upload images in images/desktop/ folder

            $config['upload_path'] = $uploadPath;
            $config['overwrite'] = FALSE;
            $config['allowed_types'] = '*'; //allowed types of files
            $this->load->library('upload', $config);  //load upload file config.
            $this->upload->initialize($config);
            $image_path = '';

            if ($this->upload->do_upload('userFile')) {
                $fileData = $this->upload->data();
                $filepath = 'assets/modules/documents/' . $fileData['file_name'];
            } else {
                $response = array(
                    'status' => 'validation',
                    'message' => $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>'),
                    'field' => 'doc_file'
                );
                echo json_encode($response);
                die();
            }
        }
        $data['filepath'] = $filepath;
        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/document_api/uploadFile';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $result = json_decode($output, true);

        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> File uploaded successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> File was not uploaded.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

// remove work item
    public function delWitem() {
        extract($_GET);
        if (isset($item_id) && $item_id != '') {
            $data['item_id'] = $item_id;

            $path = base_url();
            $url = $path . 'api/modules/sitecontroller_api/delWitem';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);

            // authenticate API
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
            curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $output = curl_exec($ch);
            //close cURL resource
            curl_close($ch);
            $result = json_decode($output, true);
// print_r($result);die();
            if ($result['status'] == 'warning') {
                echo $result['message'];
                die();
            }
            if ($result['status'] == 'success') {
                echo $result['message'];
            } else {
                echo $result['message'];
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> File not found.</div>';
        }
    }

    
    // remove document
    public function removeDoc() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/modules/document_api/removeDoc?doc_id=' . $doc_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        if ($response == true) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Document removed successfully.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Document deletion failed.</div>';
        }
    }

    // fucntion to display edit document page
    public function edit_document($param = '') {
        $path = base_url();
        $url = $path . 'api/modules/document_api/getDocumentDetail?doc_id=' . $param;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);

        $data['allDocument_types'] = Site_inspection::getDocumentTypes();
        $data['documentDetails'] = $response;
        $this->load->view('includes/header');
        $this->load->view('pages/modules/edit_documents', $data);
        $this->load->view('includes/footer');
    }

}
