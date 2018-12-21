<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Grant_permission extends CI_Controller {

// Addproduct controller
    public function __construct() {
        parent::__construct();
// load common model
// $this->load->model('modules/product_model');
        //$project_id = '';
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
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];

        if ($role == 'company_admin') {
            //$project_id = $this->session->userdata('project_id');
            if ($project_id == '') {
                //check session variable set or not, otherwise logout
                redirect('user/create_project');
            }
            $data['features'] = Grant_permission::getAllFeatures();
            $data['grades'] = Grant_permission::getAllGrades();
            $data['projects'] = Grant_permission::getAllprojects();
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            //$project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
        }
        $this->load->view('includes/header', $data);
        $this->load->view('pages/user/grantPermissions', $data);
        $this->load->view('includes/footer');
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

    public function getAllFeatures() {
        $path = base_url();
        $url = $path . 'api/user/Role_api/getAllFeatures';
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

    public function getAllGrades() {
        $path = base_url();
        $url = $path . 'api/user/Grantpermission_api/getAllGrades';
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

    public function grantPrivilege() {
        extract($_POST);
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $data['project_id'] = $project_id;
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

       
        if ($feature == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Please Select valid Feature.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>'
                    //'<b>Success:</b> You Have Successfully Registered.!'
            );
            echo json_encode($response);
            die();
        }
        if (!isset($grades)) {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Please Select Atleast one Grade.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>'
                    //'<b>Success:</b> You Have Successfully Registered.!'
            );
            echo json_encode($response);
            die();
        }

        $data['gradeData'] = json_encode($grades);
        $data['feature'] = $feature;
//         print_r($data);
//        die();
        $path = base_url();
        $url = $path . 'api/user/Grantpermission_api/grantPrivilege';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Privilege Set Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>'
                    //'<b>Success:</b> You Have Successfully Registered.!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Previlege Not Set Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>'
                    //'<b>Error:</b> You Have Not Registered Successfully!'
            );
        }
        echo json_encode($response);
    }

}
