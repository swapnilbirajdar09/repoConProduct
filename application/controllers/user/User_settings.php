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
        $this->load->view('includes/header');
        $this->load->view('pages/user/user_settings',$data);
        $this->load->view('includes/footer');
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
  
  if ($response['status'] != 200) {
    echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> '.$response['status_message'].'</h4>
    ';
  } else {
    echo '<h4 class="w3-text-green w3-margin"><i class="fa fa-check"></i> '.$response['status_message'].'</h4>
    <script>
    window.setTimeout(function() {
     location.reload();
   }, 1000);
   </script>';
 }
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
  
  if ($response['status'] != 200) {
    echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> '.$response['status_message'].'</h4>
    ';
  } else {
    echo '<h4 class="w3-text-green w3-margin"><i class="fa fa-check"></i> '.$response['status_message'].'</h4>
    <script>
    window.setTimeout(function() {
     location.reload();
   }, 1000);
   </script>';
 }

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
  
  if ($response['status'] != 200) {
    echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> '.$response['status_message'].'</h4>
    ';
  } else {
    echo '<h4 class="w3-text-green w3-margin"><i class="fa fa-check"></i> '.$response['status_message'].'</h4>
    <script>
    window.setTimeout(function() {
     location.reload();
   }, 1000);
   </script>';
 }

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
