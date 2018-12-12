<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Createuser extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        $data['roles'] = Createuser::getProjectRoles();
        $data['users'] = Createuser::getProjectUsers();
        //print_r($data);        die();
        $this->load->view('includes/header');
        $this->load->view('pages/user/createUser', $data);
        $this->load->view('includes/footer');
    }

    public function getProjectUsers() {
        $project_id = 2;
        $path = base_url();
        $url = $path . 'api/user/Createuser_api/getProjectUsers?project_id=' . $project_id;
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

    public function getProjectRoles() {
        // $project_id = $this->session->userdata('project_id');

        $project_id = 2;
        $path = base_url();
        $url = $path . 'api/user/Createuser_api/getProjectRoles?project_id=' . $project_id;
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

    public function createNewUser() {
        extract($_POST);
        $data = $_POST;
        if ($roles == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><b>Error:</b> Please Select Valid Role Name!</strong> 
            </div>');
            echo $response;
            die();
        }
        // $project_id = $this->session->userdata('project_id');
        $data['project_id'] = '2';
        $path = base_url();
        $url = $path . 'api/user/Createuser_api/createNewUser';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response['status'] == 'success') {
            $response = array('status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> User Created successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>');
        } elseif ($response['status'] == 'validation') {
            $response = array('status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Something Went Wrong. Email Id Must be Unique.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>');
        } else {
            $response = array('status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Something Went Wrong. User Not Created Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>');
        }
        echo json_encode($response);
    }

    public function deleteUser() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/user/Createuser_api/deleteUser?user_id=' . $user_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> User Removed successfully.
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
			<strong>Failure!</strong> User Not Removed Successfully.
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
