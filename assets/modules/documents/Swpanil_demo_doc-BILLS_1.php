<?php

// error_reporting('E_ALL');

defined('BASEPATH') OR exit('No direct script access allowed');

class Viewportfolio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load common model
        $this->load->model('admin/portfolio_model');
        $this->load->model('admin/Setting_model');
    }

    // main index function
    public function index() {
        $data['social_logos'] = $this->Setting_model->getAllSocialLinks();
        $data['allCategories'] = $this->portfolio_model->getAllCategories();
        $data['allPortfolios'] = $this->portfolio_model->getAllPortfolios();
        $data['company_details'] = $this->Setting_model->getAllcompany_details();

        $this->load->view('includes/user/header', $data);
        $this->load->view('pages/user/portfolios', $data);
        $this->load->view('includes/user/footer', $data);
    }

    // get portfolo detail on single page
    public function info($url = '') {
        $str = base64_decode($url);
        $arr = explode('|', $str);
        $portfolio_id = $arr[1];
        $data['company_details'] = $this->Setting_model->getAllcompany_details();

        $data['social_logos'] = $this->Setting_model->getAllSocialLinks();
        $data['featuredPortfolio'] = $this->portfolio_model->getFeaturedPortfolios();
        $data['portfolioDetail'] = $this->portfolio_model->getPortfolioDetail($portfolio_id);
        $this->load->view('includes/user/header', $data);
        $this->load->view('pages/user/portfolio_info', $data);
        $this->load->view('includes/user/footer', $data);
    }

}
