<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $admin_name = $this->session->userdata('usersession_name');
        if ($admin_name == '') {
            //     //check session variable set or not, otherwise logout
            redirect('login');
        }
        
    }

    // main index function
    public function index() {
        $this->load->view('includes/header');
        $this->load->view('pages/dashboard');
        $this->load->view('includes/footer');
    }

}
