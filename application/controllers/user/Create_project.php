<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Create_project extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
       // $data['roles'] = Createuser::getProjectRoles();
       // $data['users'] = Createuser::getProjectUsers();
        //print_r($data);        die();
        $this->load->view('includes/header');
        $this->load->view('pages/user/create_project');
        $this->load->view('includes/footer');
    }

     public function create_Newproject() {
         
  		extract($_POST);
		  $data=$_POST;
		  $company_id = $this->session->userdata('company_id');
		  $data['company_id'] = $company_id;
		  $path = base_url();
		  $url = $path.'api/user/Createuser_api/create_Newproject';
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
    

 }