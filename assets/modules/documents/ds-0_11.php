<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class View_services extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();
        // load common model
        $this->load->model('admin/Manageservice_model');
    }

    // main index function
    public function index() {
        // start session		
        $user_name = $this->session->userdata('userName'); //----session variable
        if ($user_name == '') {
            redirect('admin_login');
        }
        $data['services'] = $this->Manageservice_model->getAllServices();
        $this->load->view('includes/header');
        $this->load->view('pages/admin/viewAllServices', $data); //------loading the admin All Services view
        $this->load->view('includes/footer');
    }

//------------------fun for update service details--------------//
    public function updateServiceDetails() {
        extract($_POST);
        extract($_FILES);
        $data = $_POST;

        $allowed_types = ['gif', 'jpg', 'png', 'jpeg', 'JPG', 'GIF', 'JPEG', 'PNG'];
        $imagePath = '';

        //$image_name = $_FILES['profile_image']['name'];
        if (($_FILES['serviceImage']['name']) != '') {
            $imagePath = '';
        } else {
            $imagePath = $serviceImageEdit;
        }

        //$imagePath = '';
        if (!empty(($_FILES['serviceImage']['name']))) {
            $extension_img = pathinfo($_FILES['serviceImage']['name'], PATHINFO_EXTENSION); //get prod image file extension 
            //image validating---------------------------//
            //check whether image size is less than 10 mb or not
            if ($_FILES['serviceImage']['size'] > 10485760) {  //for prod images
                echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-large"></i> Image size exceeds size limit of 10MB. Upload image having size less than 10MB</label>';
                die();
            }
            //check file is an image or not by checking extensions
            if (!in_array($extension_img, $allowed_types)) {  //for prod images
                echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-large"></i> File is not an image file. Upload image having type gif, jpg, jpeg OR png</label>';
                die();
            }
        }

        if (!empty(($_FILES['serviceImage']['name']))) {
            $extension = pathinfo($_FILES['serviceImage']['name'], PATHINFO_EXTENSION);

            $_FILES['userFile']['name'] = $service_name . '.' . $extension;
            $_FILES['userFile']['type'] = $_FILES['serviceImage']['type'];
            $_FILES['userFile']['tmp_name'] = $_FILES['serviceImage']['tmp_name'];
            $_FILES['userFile']['error'] = $_FILES['serviceImage']['error'];
            $_FILES['userFile']['size'] = $_FILES['serviceImage']['size'];

            $uploadPath = 'assets/images/services/';  //upload images in images/desktop/ folder
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; //allowed types of images           
            $config['overwrite'] = TRUE;
            // print_r($fileData = $this->upload->data());die();
            $this->load->library('upload', $config);  //load upload file config.
            $this->upload->initialize($config);

            if ($this->upload->do_upload('userFile')) {
                $fileData = $this->upload->data();
                $imagePath = $uploadPath . $fileData['file_name'];
            }
        }

        $data['imagePath'] = $imagePath;
        //print_r($data);
        $result = $this->Manageservice_model->updateServiceDetails($data);
        //print_r($result);die();
        if ($result == '200') {
            echo '<center><label class="w3-large w3-label w3-text-green"><i class="fa fa-check w3-large"></i>Service Updated SuccessFully.</label></center><script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
                });
                window.location.reload();
                }, 1500);                
                </script>';

//            echo '<div class="alert alert-success">
//        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//        <strong>Success! </strong> Service Updated SuccessFully.
//        </div>
//        <script>
//        window.setTimeout(function() {
//            $(".alert").fadeTo(500, 0).slideUp(500, function(){
//                $(this).remove();
//                });
//                window.location.reload();
//                }, 1500);                
//                </script>';
        } else {
            echo '<center><label class="w3-large w3-label w3-text-red"><i class="fa fa-warning w3-large"></i>Service Not Updated SuccessFully.</label></center><script>
//                window.setTimeout(function() {
//                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
//                        $(this).remove(); 
//                        });
//                        }, 5000);
//                        </script>';
//            echo '<div class="alert alert-danger">
//                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//                <strong>Warning! </strong> Service Not Updated SuccessFully.
//                </div>
//                 <script>
//                window.setTimeout(function() {
//                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
//                        $(this).remove(); 
//                        });
//                        }, 5000);
//                        </script>';
        }
    }

//----------------fun for delete service details----------------------//
    public function deleteServiceDetails() {
        extract($_GET);
        $result = $this->Manageservice_model->deleteServiceDetails($service_id);
        if ($result == '200') {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! </strong> Service Deleted SuccessFully.
        </div>
        <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
                });
                window.location.reload();
                }, 1500);                
                </script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning! </strong> Service Not Deleted SuccessFully.
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

//----------------------fun for featured services---------------------------------//
    public function featuredService() {
        extract($_GET);
        $result = $this->Manageservice_model->featuredService($service_id);
        //print_r($result);die();
        if ($result == '200') {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! </strong> Service Featured SuccessFully.
        </div>
        <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
                });
                window.location.reload();
                }, 1500);                
                </script>';
        } elseif ($result == '700') {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning! </strong> You Can Featured Only 6 Services..
                </div>
                 <script>
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                        });
                        }, 5000);
                        </script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning! </strong> Service Not Featured SuccessFully.
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

//----------------------fun for featured services---------------------------------//
//----------------------fun for unfeatured services---------------------------------//

    public function unFeaturedService() {
        extract($_GET);
        $result = $this->Manageservice_model->unFeaturedService($service_id);
        if ($result == '200') {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! </strong> Service UnFeatured SuccessFully.
        </div>
        <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
                });
                window.location.reload();
                }, 1500);                
                </script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning! </strong> Service Not UnFeatured SuccessFully.
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

    //----------------------fun for unfeatured services---------------------------------//
}
