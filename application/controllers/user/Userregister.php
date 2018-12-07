<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userregister extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $this->load->model('product_model/product_model');
    }

    // main index function
    public function index() {
        $this->load->view('includes/header');
        $this->load->view('pages/user/user_register');
        $this->load->view('includes/footer');
    }

}
