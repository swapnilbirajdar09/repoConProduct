<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $admin_name = $this->session->userdata('usersession_name');
        if ($admin_name == '') {
            redirect('Login');
        }
    }

    // main index function
    public function index() {
//        $company_id = $this->session->userdata('company_id');
//        $data['projects'] = Roles::getAllProjects($company_id);
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        if ($project_id == '') {
            //check session variable set or not, otherwise logout
            redirect('user/create_project');
        }
        $data['features'] = Roles::getAllFeatures();
        $data['roles'] = Roles::getAllRoles();
        $data['projects'] = Roles::getAllprojects();
        $data['grades'] = Roles::getAllGrades();

        $this->load->view('includes/header', $data);
        $this->load->view('pages/user/createRoles', $data);
        $this->load->view('includes/footer');
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

    public function getAllProjects() {
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

    public function saveRoles() {
        extract($_POST);
        $data = $_POST;

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

//        print_r($data);
//        die();
        if ($role_name == '0' ) {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Please Select Valid Role Name.
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

        if ($grade == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Please Select Valid Grade.
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

        //$data['features'] = json_encode($features);
        $path = base_url();
        $url = $path . 'api/user/Role_api/saveRoles';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response == 200) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Role Saved successfully.
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
        }elseif($response == 700) {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Selected Role Is Already Exist For This Project.
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
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Role Not Saved Successfully.
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

    public function deleteRole() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/user/Role_api/deleteRole?role_id=' . $role_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response);die();
        if ($response['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Role Removed successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Role Not Removed Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>'
            );
        }
        echo json_encode($response);
    }

}
