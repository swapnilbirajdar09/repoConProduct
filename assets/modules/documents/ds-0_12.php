<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_portfolio extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // load common model
        $this->load->model('admin/portfolio_model');

    }

    // main index function
    public function index() {
        $user_name = $this->session->userdata('userName'); //----session variable
        if ($user_name == '') {
            redirect('admin_login');
        }
        $data['categories']=$this->portfolio_model->getAllCategories();
        $data['all_portfolios']=$this->portfolio_model->getAllPortfolios();
        $this->load->view('includes/header');
        $this->load->view('pages/admin/manage_portfolio',$data); 
        $this->load->view('includes/footer');
    }

    // add new portfolio function
    public function addPortfolio(){
        extract($_POST);
        $data = $_POST;
        $count=0;
        $portImage_Arr = array();    
        $portVid_Arr = array();    
        $portLink_Arr = array();    
        for ($i = 0; $i < count($_FILES['port_image']['name']); $i++) {
            $count=$i+1;
            $imagePath = '';
            $product_image = $_FILES['port_image']['name'][$i];
            if (!empty(($_FILES['port_image']['name'][$i]))) {
                if ($_FILES['port_image']['size'][$i] > 10485760) {  
                //for prod images
                    echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Portfolio Image no.'.$count.' size exceeds 10MB!</div>';
                    die();
                }
                $extension = pathinfo($_FILES['port_image']['name'][$i], PATHINFO_EXTENSION);

                $_FILES['userFile']['name'] = $portfolio_name.'_0'.$portfolio_category.'_'.$i.'.' . $extension;
                $_FILES['userFile']['type'] = $_FILES['port_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['port_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['port_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['port_image']['size'][$i];

                $uploadPath = 'assets/images/portfolio/';  
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|png|jpeg'; 
                //allowed types of images           
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);  
                //load upload file config.
                $this->upload->initialize($config);

                if ($this->upload->do_upload('userFile')) {
                    $fileData = $this->upload->data();
                    $imagePath = 'assets/images/portfolio/'.$fileData['file_name'];
                }
                else{

                    echo  $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>');
                    die();
                }
            }
            $portImage_Arr[] = $imagePath;
        }

        // videos json arr
        if(!empty($port_video)){
            foreach ($port_video as $key) {
                $portVid_Arr[]=$key;
            }
            $data['port_videos']=json_encode($portVid_Arr);
        }else{
            $data['port_videos']='';
        }

        // links josson array
        if(!empty($port_link) && sizeof($port_link)>0){
            foreach ($port_link as $key) {
                $portLink_Arr[]=$key;
            }
            $data['port_links']=json_encode($portLink_Arr);
        }else{
            $data['port_links']='';
        }

        $data['port_images'] = json_encode($portImage_Arr);

        $result = $this->portfolio_model->addPortfolio($data);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Portfolio was successfully added.</div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio was not added.</div>';
        } 
    }

    // edit portfolio function
    public function editPortfolio(){
        extract($_POST);
        $data = $_POST;
        // print_r($_POST);die();
        $count=0;
        $portVid_Arr = array();    
        $portLink_Arr = array();    
        
        // videos json arr
        if(!empty($edit_port_video)){
            foreach ($edit_port_video as $key) {
                $portVid_Arr[]=$key;
            }
            $data['port_videos']=json_encode($portVid_Arr);
        }else{
            $data['port_videos']='';
        }

        // links json array
        if(!empty($edit_port_link) && sizeof($edit_port_link)>0){
            foreach ($edit_port_link as $key) {
                $portLink_Arr[]=$key;
            }
            $data['port_links']=json_encode($portLink_Arr);
        }else{
            $data['port_links']='';
        }
        // print_r($data);die();
        $result = $this->portfolio_model->editPortfolio($data,$portfolio_id);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Portfolio was successfully updated.</div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Perhaps you have not changed anything. Portfolio was not updated. </div>';
        } 
    }

    // upload image in gallery portfolio function
    public function uploadImagePortfolio(){
        extract($_POST);
        $data = $_POST;        
        $filepath = '';

        $file_name = $_FILES['edit_port_image']['name'];
        if (!empty(($_FILES['edit_port_image']['name']))) {
        //file validating---------------------------//
            if ($_FILES['edit_port_image']['size'] > 10485760) {  
            //for portfolio image
                echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Image size exceeds 10MB!</div>';
                die();
            }
            $i=$img_portfolio_count+1;
            $extension = pathinfo($_FILES['edit_port_image']['name'], PATHINFO_EXTENSION);
            $_FILES['userFile']['name'] = $img_portfolio_name.'_0'.$img_portfolio_cat.'_'.time().'.'.$extension;
            $_FILES['userFile']['type'] = $_FILES['edit_port_image']['type'];
            $_FILES['userFile']['tmp_name'] = $_FILES['edit_port_image']['tmp_name'];
            $_FILES['userFile']['error'] = $_FILES['edit_port_image']['error'];
            $_FILES['userFile']['size'] = $_FILES['edit_port_image']['size'];

        $uploadPath = 'assets/images/portfolio/';  //upload images in images/desktop/ folder

        $config['upload_path'] = $uploadPath;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png'; //allowed types of files
        $this->load->library('upload', $config);  //load upload file config.
        $this->upload->initialize($config);
        $image_path = '';

        if ($this->upload->do_upload('userFile')) {
            $fileData = $this->upload->data();
            $filepath = 'assets/images/portfolio/'.$fileData['file_name'];
        }
        else{
           echo  $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>');
           die();
       }
   }

   $data['filepath'] = $filepath;
   $result = $this->portfolio_model->uploadImagePortfolio($data,$img_portfolio_id);

   if($result){
    echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Image uploaded successfully.</div>';
}
else{
    echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Image was not uploaded. </div>';
} 
}

    // function to delete portfolio
public function removePortfolio(){
    extract($_GET);
    if(isset($portfolio_id) && $portfolio_id!=''){
        $result = $this->portfolio_model->removePortfolio($portfolio_id);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Portfolio was successfully deleted.</div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio was not deleted.</div>';
        } 
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio not found.</div>';
    } 
}

    // function to delete portfolio image frim gallery
public function removeImage(){
    extract($_GET);
    if(isset($portfolio_id) && $portfolio_id!=''){
        $result = $this->portfolio_model->removeImage($key,$portfolio_id);

        if($result['status']=='warning'){
            echo $result['message'];
            die();
        }
        if($result['status']=='success'){
            echo $result['message'];
        }
        else{
            echo $result['message'];
        } 
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio Image not found.</div>';
    } 
}

    // function to mark portfolios as featured
public function markPortfolio(){
    extract($_GET);
    if(isset($portfolio_id) && $portfolio_id!=''){
        $result = $this->portfolio_model->markPortfolio($portfolio_id);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Portfolio marked as <b>Featured</b>.</div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio was not marked as <b>Featured</b>.</div>';
        } 
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio not found.</div>';
    } 
}

    // function to unmark portfolio as featured
public function unmarkPortfolio(){
    extract($_GET);
    if(isset($portfolio_id) && $portfolio_id!=''){
        $result = $this->portfolio_model->unmarkPortfolio($portfolio_id);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Portfolio unmarked as <b>Featured</b>.</div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio was not unmarked as <b>Featured</b>.</div>';
        } 
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio not found.</div>';
    } 
}

    // function to redirect page to selected portfolio
public function portfolio($url=''){
    $portfolio_id=base64_decode($url);
    $data['categories']=$this->portfolio_model->getAllCategories();
    $data['portfolioDetail']=$this->portfolio_model->getPortfolioDetail($portfolio_id);
    $this->load->view('includes/header');
    $this->load->view('pages/admin/portfolio',$data); 
    $this->load->view('includes/footer');
}
}