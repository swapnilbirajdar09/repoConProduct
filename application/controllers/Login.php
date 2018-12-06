<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();

        // load common model
        $this->load->model('login_model');
    }

    // main index function
    public function index() {
        //start session		
        // $admin_name = $this->session->userdata('admin_name');
        // if ($admin_name != '') {
        //     $sessionArr = explode('|', $admin_name);
        //     //check session variable set or not, otherwise logout
        //     if (($sessionArr[0] == 'SWANROCKSPlates')) {
        //         redirect('admin/dashboard');
        //     }
        // }
        //$this->load->view('includes/header');
        $this->load->view('pages/login');
        //$this->load->view('includes/footer');
    }
}
