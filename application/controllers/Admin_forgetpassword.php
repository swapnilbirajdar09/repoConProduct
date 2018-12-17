<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_forgetpassword extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();
        //$this->load->model('user/home_model');
    }

    // main index function
    public function index() {
//        $this->load->view('includes/user/userheader_landing.php'); //------user header page
        $this->load->view('pages/admin_forget.php');
//        $this->load->view('includes/user/userfooter_landing.php');
    }

    public function getPassword() {
        extract($_POST);
        //print_r($_POST);die();
        //Connection establishment, processing of data and response from REST API		
       
        //$result = $this->home_model->getPassword($data);
        $path = base_url();
        $url = $path . 'api/Forget_api/getPassword?admin_email=' . $admin_email;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response_json, true);

        //print_r($response_json);die();
        if ($result['status'] == 200) {
            echo '<div class="alert alert-success">
            <strong>' . $result['status_message'] . '</strong> 
            </div>';
        } elseif ($result['status'] == 412) {
            echo '<div class="alert alert-danger">
            <strong>' . $result['status_message'] . '</strong> 
            </div>';
        } else {
            echo '<div class="alert alert-danger">
            <strong>' . $result['status_message'] . '</strong> 
            </div>';
        }
    }

}
