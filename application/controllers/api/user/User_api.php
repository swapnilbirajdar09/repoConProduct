<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class User_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user/settings_model');
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
}