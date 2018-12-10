<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        //print_r($data);        die();
        $this->load->view('includes/user/homepage_header');
        $this->load->view('pages/home');
        $this->load->view('includes/user/homepage_footer');
    }

}
