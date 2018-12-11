<?php

class Portfolio_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //----------------function to get all categories
    public function getAllCategories() {
        $sql = "SELECT * FROM category_tab";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    //----------------function to get all portfolios
    public function getAllPortfolios() {
        $sql = "SELECT * FROM portfolio_tab,category_tab WHERE portfolio_tab.portfolio_category=category_tab.cat_id ORDER BY is_featured DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    //----------------function to get fetaured portfolios
    public function getFeaturedPortfolios() {
        $sql = "SELECT * FROM portfolio_tab,category_tab WHERE portfolio_tab.portfolio_category=category_tab.cat_id AND is_featured='1'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    //----------------function to get selected portfolio details
    public function getPortfolioDetail($portfolio_id) {
        $sql = "SELECT * FROM portfolio_tab,category_tab WHERE portfolio_tab.portfolio_category=category_tab.cat_id AND portfolio_id='$portfolio_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // add new portfolio function
    public function addPortfolio($data){
        extract($data);
        $insert_data = array(
            'portfolio_name' => $portfolio_name,
            'portfolio_category' => $portfolio_category,
            'client_name' => $client_name,
            'portfolio_description' => $portfolio_description,
            'portfolio_images' => $port_images,
            'portfolio_videos' => $port_videos,
            'portfolio_link' => $port_links
        );
        // print_r($insert_data);die();
        $this->db->insert('portfolio_tab',$insert_data);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // update portfolio function
    public function editPortfolio($data,$portfolio_id){
        extract($data);
        $result = array(
            'portfolio_name' => $edit_portfolio_name,
            'portfolio_category' => $edit_portfolio_category,
            'client_name' => $edit_client_name,
            'portfolio_description' => $edit_portfolio_description,
            'portfolio_videos' => $port_videos,
            'portfolio_link' => $port_links
        );

        $this->db->where('portfolio_id', $portfolio_id);
        $this->db->update('portfolio_tab', $result);
        if($this->db->affected_rows()==1){
            return true;
        }
        else{
            return false;
        }
    }

    // upload portfolio image
    public function uploadImagePortfolio($data,$portfolio_id){
        extract($data);
        $currentImages='';
        $sql = "SELECT portfolio_images FROM portfolio_tab WHERE portfolio_id='$portfolio_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $key) {
            $currentImages = $key['portfolio_images'];
        }

        $imgArr=json_decode($currentImages);
        array_push($imgArr,$filepath);

        $result = array(
            'portfolio_images' => json_encode($imgArr)
        );

        $this->db->where('portfolio_id', $portfolio_id);
        $this->db->update('portfolio_tab', $result);
        if($this->db->affected_rows()==1){
            return true;
        }
        else{
            return false;
        }
    }

    // delete the selected portfolio
    public function removePortfolio($portfolio_id){
        $sql = "DELETE FROM portfolio_tab WHERE portfolio_id='$portfolio_id'";
        $result = $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // delete the selected portfolio image from gallery
    public function removeImage($key,$portfolio_id){
        $sql = "SELECT portfolio_images FROM portfolio_tab WHERE portfolio_id='$portfolio_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $row) {
            $currentImages = $row['portfolio_images'];
        }

        $imgArr=json_decode($currentImages);
        if(count($imgArr)==1){
            $response=array(
                'status'    =>  'false',
                'message'   =>  '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Cannot remove Image. Atleast one image should be uploaded.</div>'
            );
            return $response;
            die();
        }
        // unset key value
        unset($imgArr[$key]);
        $imgArr = array_values($imgArr);
        $result = array(
            'portfolio_images' => json_encode($imgArr)
        );

        $this->db->where('portfolio_id', $portfolio_id);
        $this->db->update('portfolio_tab', $result);
        if($this->db->affected_rows()==1){
            $response=array(
                'status'    =>  'success',
                'message'   =>  '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Portfolio Image was successfully deleted.</div>'
            );
            return $response;
        }
        else{
            $response=array(
                'status'    =>  'failure',
                'message'   =>  '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Portfolio Image was not deleted.</div>'
            );
            return $response;
        }
    }

    // function to mark portfolio as featured
    public function markPortfolio($portfolio_id) {
        $sql = "UPDATE portfolio_tab SET is_featured='1' WHERE portfolio_id='$portfolio_id'";
        $result = $this->db->query($sql);
        if ($this->db->affected_rows()>0) {
            return true;
        } else {
            return false;
        }
    }

    // function to unmark portfolio as featured
    public function unmarkPortfolio($portfolio_id) {
        $sql = "UPDATE portfolio_tab SET is_featured='0' WHERE portfolio_id='$portfolio_id'";
        $result = $this->db->query($sql);
        if ($this->db->affected_rows()>0) {
            return true;
        } else {
            return false;
        }
    }

}
