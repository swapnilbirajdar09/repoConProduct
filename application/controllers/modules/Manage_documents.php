<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_documents extends CI_Controller {

// Addproduct controller
    public function __construct() {
        parent::__construct();
// load common model
// $this->load->model('modules/product_model');
        $role = $this->session->userdata('role');
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        if ($role == 'company_admin') {
            $admin_name = $this->session->userdata('usersession_name');
            if ($admin_name == '') {
//     //check session variable set or not, otherwise logout
                redirect('login');
            }
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            //$project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];

            if ($user_name == '') {
//     //check session variable set or not, otherwise logout
                redirect('login');
            }
        }
    }

// main index function
    public function index() {
        $role = $this->session->userdata('role');
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        if ($role == 'company_admin') {
            if ($project_id == '') {
                //check session variable set or not, otherwise logout
                redirect('user/create_project');
            }
            $data['allDocument_types'] = Manage_documents::getDocumentTypes();
            $data['lastRevision_no'] = Manage_documents::getlastRevision();
            $data['allDocuments'] = Manage_documents::getAllDocuments();
            $data['roles'] = Manage_documents::getAllRoles();
            $data['projects'] = Manage_documents::getAllprojects();
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Manage_documents::getAllFeatuesForUser($user_id, $role_id);
            $data['lastRevision_no'] = Manage_documents::getlastRevision();
            $data['allDocuments'] = Manage_documents::getAllDocuments();
            $data['allDocument_types'] = Manage_documents::getDocumentTypes();
            $data['roles'] = Manage_documents::getAllRoles();
        }
        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/manage_documents', $data);
        $this->load->view('includes/footer');
    }

    public function getAllRoles() {
        // $project_id = $this->session->userdata('project_id');
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/user/Role_api/getAllRoles?project_id=' . $project_id;
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

    // fun for upload requested Document
    public function uploadRequestedDocument() {
        extract($_POST);
// print_r($_FILES);
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];

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
// validate fields
        if ($document_type == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Document Type First !</div>',
                'field' => 'document_type'
            );
            echo json_encode($response);
            die();
        }
        if ($shared_with == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Role First !</div>',
                'field' => 'shared_with'
            );
            echo json_encode($response);
            die();
        }

        $imageArr = array();
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $count = $i + 1;
            $imagePath = '';
            $product_image = $_FILES['file']['name'][$i];
            if (!empty(($_FILES['file']['name'][$i]))) {
                $extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
                $_FILES['userFile']['name'] = $document_title . '-' . $document_type . '_' . $project_id . '.' . $extension;
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
                    $imagePath = 'assets/modules/documents/' . $fileData['file_name'];
                } else {
                    $response = array(
                        'status' => 'validation',
                        'message' => $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>'),
                        'field' => 'file_drop'
                    );
                    echo json_encode($response);
                    die();
                }
            }
            $imageArr[] = $imagePath;
        }
        $data['images'] = json_encode($imageArr);
        $data['shared_with'] = json_encode($shared_with);
        //print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/document_api/uploadRequestedDocument';
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
        //print_r($output);die();
        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Documents uploaded successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Documents were not uploaded.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

//  fun for upload document
    public function upload() {
        extract($_POST);
// print_r($_FILES);
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];

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
// validate fields
        if ($document_type == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Document Type First !</div>',
                'field' => 'document_type'
            );
            echo json_encode($response);
            die();
        }
        if ($shared_with == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Role First !</div>',
                'field' => 'shared_with'
            );
            echo json_encode($response);
            die();
        }

        $imageArr = array();
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $count = $i + 1;
            $imagePath = '';
            $product_image = $_FILES['file']['name'][$i];
            if (!empty(($_FILES['file']['name'][$i]))) {

                $extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);

                $_FILES['userFile']['name'] = $document_title . '-' . $document_type . '_' . $project_id . '.' . $extension;
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
                    $imagePath = 'assets/modules/documents/' . $fileData['file_name'];
                } else {
                    $response = array(
                        'status' => 'validation',
                        'message' => $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>'),
                        'field' => 'file_drop'
                    );
                    echo json_encode($response);
                    die();
                }
            }
            $imageArr[] = $imagePath;
        }
        $data['images'] = json_encode($imageArr);
        $data['shared_with'] = json_encode($shared_with);
        //print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/document_api/addDocument';
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
        //print_r($output);die()
        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Documents uploaded successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Documents were not uploaded.</div>'
            );
            echo json_encode($response);
            die();
        }
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

//--fun for large file upload
    public function uploadtoserver() {
        // 5 minutes execution time
        @set_time_limit(5 * 60);
        // Uncomment this one to fake upload time
        // usleep(5000);
        // Settings

        $targetDir = FCPATH . "uploads";
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        $newpath = '';
        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }
        $newpath = 'uploads' . $fileName;
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        //print_r($filePath);die();
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files	
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);
        }
        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : "' . $targetDir . '", "id" : "id"}');
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

    public function uploadFileData() {
        extract($_POST);
        //print_r($_POST);die();
// print_r($_FILES);
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];

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

        $data['shared_with'] = json_encode($shared_with);
        //print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/document_api/addDocument';
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
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Documents uploaded successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Documents were not uploaded.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

// get document types
    public function getDocumentTypes() {
        $path = base_url();
        $url = $path . 'api/modules/document_api/getDocumentTypes';
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

// get last revision number for current project
    public function getlastRevision() {
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
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

// get associated users for project
    public function getUserAssoc() {
        $project_id = $this->session->userdata('project_id');
        $path = base_url();
        $url = $path . 'api/modules/document_api/getUserAssoc?project_id=' . $project_id;
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
            $data['author'] = $session_name;
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

// remove file
    public function removeFile() {
        extract($_GET);
        if (isset($document_id) && $document_id != '') {
            $data['key'] = $key;
            $data['document_id'] = $document_id;
            $session_name = $this->session->userdata('usersession_name');
            $session_role = $this->session->userdata('role');
            if ($session_role == 'company_admin') {
                $data['author'] = 'Administrator';
            } else {
                $user_name = $this->session->userdata('user_name');

                $data['author'] = $user_name;
            }
            $path = base_url();
            $url = $path . 'api/modules/document_api/removeFile';
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

// get associated roles for project
    public function getRolesAssoc() {
        $project_id = $this->session->userdata('project_id');
        $path = base_url();
        $url = $path . 'api/modules/document_api/getRolesAssoc?project_id=' . $project_id;
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

// get all documents for project
    public function getAllDocuments() {
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/modules/document_api/getAllDocuments?project_id=' . $project_id;
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

//---------request for deletion
    public function sendRequestForDeletion() {
        extract($_GET);
        //print_r($_GET);die();
        $data = array(
            'doc_id' => $doc_id,
            'reason_type' => $reason_type,
            'reason_description' => $reason_description
        );
        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/document_api/sendRequestForDeletion';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
//        print_r($response_json);
//        die();
        if ($response == true) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Request Sent successfully.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Request Sending Failed.</div>';
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
        //print_r($output);die();
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

        $role = $this->session->userdata('role');

        if ($role == 'company_admin') {
            $data['allDocument_types'] = Manage_documents::getDocumentTypes();
            $data['documentDetails'] = $response;
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Manage_documents::getAllFeatuesForUser($user_id, $role_id);

            $data['allDocument_types'] = Manage_documents::getDocumentTypes();
            $data['documentDetails'] = $response;
        }


        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/edit_documents', $data);
        $this->load->view('includes/footer');
    }

}
