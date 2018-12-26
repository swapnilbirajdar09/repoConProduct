<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userrole_login extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();

        // load common model
        $this->load->model('user/userlogin_model');
    }

    // main index function
    public function index() {
        //start session     
        $userrole_name = $this->session->userdata('user_name');
        $user_id = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $project_id = $this->session->userdata('project_id');
        if ($userrole_name != '' && $user_id != '' && $role != '' && $project_id != '') {
            //     //check session variable set or not, otherwise logout
            redirect('user_dashboard');
        }
        //$this->load->view('includes/header');
        $this->load->view('pages/user/userrole_login');
        //$this->load->view('includes/footer');
    }

    // check login authentication-----------------------------------------------------------
    public function user_login() {
        // get data passed through ANGULAR AJAX        
        $data = array(
            'login_username' => $_POST['user_email'],
            'login_password' => $_POST['user_password']
        );

        $path = base_url();
        $url = $path . 'api/user/User_api/userrole_login';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response['status'] == 500) {
            // failure scope
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Login Credentials incorrect.</div>';
        } else {
            // success scope
            //----create session array--------//
            $session_data = array(
                'project_id' => $response['project_id'],
                'user_id' => $response['user_id'],
                'role' => $response['role'],
                'user_name' => $response['userrole_name'],
                'grade_id' => $response['grade_id']
            );
            //start session of user if login success
            $this->session->set_userdata($session_data);
            // redirect('user_dashboard');
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Login Successful.</div>
            <script>
            window.setTimeout(function() {
               $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                  $(this).remove(); 
                  });
                  window.location.href="' . base_url() . 'user_dashboard";
                  }, 1500);
                  </script>
                  ';
        }
    }

    public function logOutUser() {
        //start session		
        $user_name = $this->session->userdata('user_name');

        //if logout success then destroy session and unset session variables
        $this->session->unset_userdata(array('user_name'));
        $this->session->sess_destroy();
        redirect('login');
    }

}
