<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Raisequery_rfi extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $admin_name = $this->session->userdata('usersession_name');
        if ($admin_name == '') {
            redirect('Login');
        }
    }

    // main index function
    public function index() {
//        $company_id = $this->session->userdata('company_id');
//        $data['projects'] = Roles::getAllProjects($company_id);
//        $data['features'] = Roles::getAllFeatures();
//        $data['roles'] = Roles::getAllRoles();
        $this->load->view('includes/header');
        $this->load->view('pages/user/requestForInfo');
        $this->load->view('includes/footer');
    }

    public function raiseQuery() {
        extract($_POST);
        $data = $_POST;

        $prod_Arr = array();
        $imageArr = array();
        //print_r($_POST);
        //print_r($_FILES);
        $allowed_types = ['gif', 'jpg', 'png', 'jpeg', 'JPG', 'GIF', 'JPEG', 'PNG'];
        for ($i = 0; $i < count($_FILES['prod_image']['name']); $i++) {
            $imagePath = '';
            $product_image = $_FILES['prod_image']['name'][$i];
            if (!empty(($_FILES['prod_image']['name'][$i]))) {
                $extension = pathinfo($_FILES['prod_image']['name'][$i], PATHINFO_EXTENSION);

                $_FILES['userFile']['name'] = $queryTitle . '_' . $i . '.' . $extension;
                $_FILES['userFile']['type'] = $_FILES['prod_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['prod_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['prod_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['prod_image']['size'][$i];

                $uploadPath = 'assets/modules/query_images/';  //upload images in images/desktop/ folder
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg'; //allowed types of images           
                $config['overwrite'] = FALSE;
                $this->load->library('upload', $config);
                //load upload file config.
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userFile')) {
                    $fileData = $this->upload->data();
                    $imagePath = 'assets/modules/query_images/' . $fileData['file_name'];
                } else {
                    $response = array(
                        'status' => 'validation',
                        'message' => $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>'),
                    );
                    echo json_encode($response);
                    die();
                }
            }
            $imageArr[] = $imagePath;
        }
        $data['project_id'] = '2';
        $data['images'] = json_encode($imageArr);
        $data['created_by'] = $this->session->userdata('usersession_name');
        //print_r($data);die();
        //$header = array('user_id' =>  $user_id);
        $path = base_url();
        $url = $path . 'api/user/Rfiquery_api/raiseQuery';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
//        print_r($response_json);
//        die();
        if ($response['status'] == 'success') {
            $response = array('status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Query Raised Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>');
        } elseif ($response['status'] == 'validation') {
            $response = array('status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Something Went Wrong. Email Id Must be Unique.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>');
        } else {
            $response = array('status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Something Went Wrong. Query Not Raised Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>');
        }
        echo json_encode($response);
    }

}