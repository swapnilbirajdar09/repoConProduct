<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class User_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/settings_model');
        $this->load->model('user/userlogin_model');
    }

//------- user role login api ----//
	 public function userrole_login_post() {
        $data = ($_POST);
        $result = $this->userlogin_model->userrole_login($data);
        return $this->response($result);
    }
    // -----------------------UPDATE EMAIL API----------------------//
	//-------------------------------------------------------------//
	public function updateEmail_post(){
		extract($_POST);
		$data = $_POST;
		$result = $this->settings_model->updateEmail($data);
		return $this->response($result);			
	}

		// -----------------------UPDATE username API----------------------//
	//-------------------------------------------------------------//
	public function updateUname_post(){
		extract($_POST);
		$data = $_POST;
		$result = $this->settings_model->updateUname($data);
		return $this->response($result);			
	}
	//---------------------UPDATE username END------------------------------//
// -----------------------UPDATE Password API----------------------//
	//-------------------------------------------------------------//
	public function updatePass_post(){
		extract($_POST);
		$data = $_POST;
		$result = $this->settings_model->updatePass($data);
		return $this->response($result);			
	}

	public function getUserDetails_get(){
		extract($_GET);
		
		$result = $this->settings_model->getUserDetails($company_id);
		return $this->response($result);			
	}
        
        public function getAllFeatuesForUser_get(){
            extract($_GET);
            $result = $this->settings_model->getAllFeatuesForUser($user_id,$role_id);
            return $this->response($result);
        }
}