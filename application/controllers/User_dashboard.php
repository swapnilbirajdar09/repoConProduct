<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        $this->load->view('includes/header');
        $this->load->view('pages/dashboard');
        $this->load->view('includes/footer');
    }

}