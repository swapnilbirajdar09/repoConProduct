<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post_job extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();

        // load common model
        $this->load->model('admin/Postjob_model');
    }

    // main index function
    public function index() {
        // start session		
        $user_name = $this->session->userdata('userName'); //----session variable
        if ($user_name == '') {
            redirect('admin_login');
        }
        $this->load->view('includes/header');
        $this->load->view('pages/admin/postJob'); //------loading the admin Add Service view
        $this->load->view('includes/footer');
    }

//--------------------------fun for save job------------------------------//
    public function saveJob() {
        extract($_POST);
        $data = $_POST;
        if ($experienceRequiredFrom > $experienceRequiredTo) {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning! </strong> Required Experience From Is Less Than Experience To.
                </div>
                 <script>
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                        });
                        }, 5000);
                        </script>';
            die();
        }
      
        $result = $this->Postjob_model->saveJob($data);
        //print_r($result);die();
        if ($result == '200') {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! </strong> Job Posted SuccessFully.
        </div>
        <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
                });
                window.location.reload();
                }, 2000);                
                </script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning! </strong> Job Not Posted SuccessFully.
                </div>
                 <script>
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                        });
                        }, 5000);
                        </script>';
        }
    }

}
