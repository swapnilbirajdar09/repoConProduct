<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Login extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();

        // load common model
       // $this->load->model('Login_model');
    }

    // main index function
    public function index() {
        //start session		
         $admin_name = $this->session->userdata('admin_name');
         if ($admin_name != '') {         
            redirect('admin/admin_dashboard');
        }
        //$this->load->view('includes/header');
        $this->load->view('pages/admin/admin_login');
        //$this->load->view('includes/footer');
    }

        // check login authentication-----------------------------------------------------------
    public function adminlogin() {
        // get data passed through ANGULAR AJAX
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        $data=array(
        	'login_username' => $request['username'],
        	'login_password' => $request['password']
        );

        //print_r($request['username']);
         $path = base_url();
        $url = $path . 'api/admin/Adminlogin_api/admin_login';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
       // print_r($response_json);die();
        // call to model function to authenticate user
       // $result = $this->Login_model->adminlogin($request['username'], $request['password']);
        // print valid message
        if (!$response) {
            // failure scope
            echo '<p class="w3-red w3-padding-small">Sorry, your credentials are incorrect!</p>';
        } else {
            // success scope
            //----create session array--------//

            $session_data = array(
                'admin_name' => $request['username']
            );
            //start session of user if login success
            $this->session->set_userdata($session_data);
            //redirect('admin/dashboard');
            echo '200';
            //echo '<p class="w3-green w3-padding-small">Login successfull! Welcome Admin.</p>';
        }
        //print_r($result);
    }

      public function logoutAdmin() {
        //start session		
        $admin_name = $this->session->userdata('admin_name');

        //if logout success then destroy session and unset session variables
        $this->session->unset_userdata(array('admin_name'));
        $this->session->sess_destroy();
        redirect('admin/admin_login');
    }
}