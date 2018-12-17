<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();
        
        // load common model
        $this->load->model('Login_model');
    }

    // main index function
    public function index() {
        //start session     
        $admin_name = $this->session->userdata('usersession_name');
        if ($admin_name != '') {
            //     //check session variable set or not, otherwise logout
            redirect('user_dashboard');
        }
        //$this->load->view('includes/header');
        $this->load->view('pages/login_new');
        //$this->load->view('includes/footer');
    }

    // check login authentication-----------------------------------------------------------
    public function adminlogin() {
        
        $data = array(
            'login_username' => $_POST['admin_email'],
            'login_password' => $_POST['admin_password']
        );

        $path = base_url();
        $url = $path . 'api/admin/Adminlogin_api/adminlogin';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response['status']);die();
        if ($response['status'] == 500) {
            // failure scope
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Login Credentials incorrect.</div>';
        } else {
            // success scope
            //----create session array--------//
            $session_data = array(
                'project_id' => $response['project_id'],
                'role'  =>  'company_admin',
                'usersession_name' => $response['admin_name'],
                'company_id' => $response['company_id']
            );
            //start session of user if login success
            $this->session->set_userdata($session_data);
            //redirect('admin/dashboard');
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
            //echo '<p class="w3-green w3-padding-small">Login successfull! Welcome Admin.</p>';
              }
        //print_r($result);
          }

          public function logoutAdmin() {
        //start session		
            $admin_name = $this->session->userdata('usersession_name');

        //if logout success then destroy session and unset session variables
            $this->session->unset_userdata(array('usersession_name'));
            $this->session->sess_destroy();
            redirect('login');
        }

    }
