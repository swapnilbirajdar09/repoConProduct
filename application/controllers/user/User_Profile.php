<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_Profile extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
    	 $role = $this->session->userdata('role');
        if ($role == 'company_admin') {
            $data['projects'] = User_dashboard::getAllprojects();
        } else {
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];


            $data['features'] = User_Profile::getAllFeatuesForUser($user_id,$role_id);
        }
        $data['userrole_details'] = User_Profile::getUserRoleDetails();
           $data['projects'] = User_Profile::getAllprojects();
         
       

        $this->load->view('includes/header', $data);
        $this->load->view('pages/user/user_profile',$data);
        $this->load->view('includes/footer');
    }

     public function updateUserRoleEmail() { 
  extract($_POST);
  $data=$_POST;
  $user_id = $this->session->userdata('user_id');
   $data['user_id'] = $user_id;
  $path = base_url();
  $url = $path.'api/user/user_api/updateUserRoleEmail';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
 // print_r($response_json);die();
  
  if ($response['status'] == 200) {
            $response = array('status' => '200',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Email Id Updated successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>');
        } else {
            $response = array('status' => 500,
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong>  Email Id Updation Failed.
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

//----------------this fun to update admin email end---------------//

public function updateUserRoleUname()
{
    extract($_POST);
     $data=$_POST;
    // print_r($_POST);die();
   $user_id = $this->session->userdata('user_id');
   $data['user_id'] = $user_id;
 
  $path = base_url();
  $url = $path.'api/user/user_api/updateUserRoleUname';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
 // print_r($response_json);die();
  
 if ($response['status'] == 200) {
            $response = array('status' => '200',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Username Updated successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>');
        } else {
            $response = array('status' => 500,
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong>  Username Updation Failed.
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

public function updateUserRolePass()
{
  extract($_POST);
    $data=$_POST;
  $user_id = $this->session->userdata('user_id');
   $data['user_id'] = $user_id;

  $path = base_url();
  $url = $path.'api/user/user_api/updateUserRolePass';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  //print_r($response_json);die();
  
   if ($response['status'] == 200) {
            $response = array('status' => '200',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Password Updated successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>');
        } else {
            $response = array('status' => 500,
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong>  Password Updation Failed.
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
 
 public function getUserRoleDetails() {
 $user_id = $this->session->userdata('user_id');
   //$data['company_id'] = $company_id;
  $path = base_url();
  $url = $path . 'api/user/user_api/getUserRoleDetails?user_id='.$user_id;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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

    public function getAllFeatuesForUser($user_id,$role_id) {
        $path = base_url();
        $url = $path . 'api/user/User_api/getAllFeatuesForUser?user_id=' . $user_id.'&role_id='.$role_id;
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

 }