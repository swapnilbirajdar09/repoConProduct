<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_settings extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        $data['user'] = User_settings::getUserDetails();
      //  print_r($data);die();
        $data['projects'] = User_settings::getAllprojects();

        $this->load->view('includes/header', $data);
        $this->load->view('pages/user/user_settings',$data);
        $this->load->view('includes/footer');
    }

public function getAllProjects() {
       $company_id = $this->session->userdata('company_id');
       $path = base_url();
       $url = $path . 'api/user/Role_api/getAllProjects?company_id='.$company_id;
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

       //----------this function to update admin email-----------------------------//
 public function updateEmail() { 
  extract($_POST);
  $data=$_POST;
   $company_id = $this->session->userdata('company_id');
   $data['company_id'] = $company_id;
  $path = base_url();
  $url = $path.'api/user/user_api/updateEmail';
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

public function updateUname()
{
    extract($_POST);
     $data=$_POST;
    // print_r($_POST);die();
  $company_id = $this->session->userdata('company_id');
  $data['company_id'] = $company_id;
 
  $path = base_url();
  $url = $path.'api/user/user_api/updateUname';
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

public function updatePass()
{
  extract($_POST);
    $data=$_POST;
  $company_id = $this->session->userdata('company_id');
  $data['company_id'] = $company_id;

  $path = base_url();
  $url = $path.'api/user/user_api/updatePass';
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
 
 public function getUserDetails() {
  $company_id = $this->session->userdata('company_id');
   //$data['company_id'] = $company_id;
  $path = base_url();
  $url = $path . 'api/user/user_api/getUserDetails?company_id='.$company_id;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  return $response;
}

}
