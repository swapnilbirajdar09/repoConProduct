<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Update_profile extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
     //   $data['user'] = User_settings::getUserDetails();
        $this->load->view('includes/header');
        $this->load->view('pages/user/update_profile');
        $this->load->view('includes/footer');
    }
}