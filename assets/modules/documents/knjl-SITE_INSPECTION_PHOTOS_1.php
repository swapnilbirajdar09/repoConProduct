<?php

class Manageservice_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//--------fun for add service details to db----------------//
    public function addServices($data) {
        extract($data);

        $sql = "INSERT INTO service_tab(service_name,service_description,service_image,is_featured)"
                . "VALUES ('" . addslashes($service_name) . "','" . addslashes($serviceDescription) . "',"
                . "'$imagePath','0')";
        //print_r($sql);die();
        $result = $this->db->query($sql);
        if ($result) {
            return 200;
        } else {
            return 500;
        }
    }

//------------------fun for get all services---------------------------//
    public function getAllServices() {
        $sql = "SELECT * FROM service_tab";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }

//----------------fun for get all featured services ----------------------------//
    public function getAllFeaturedServices() {
        $sql = "SELECT * FROM service_tab ORDER BY is_featured DESC LIMIT 6";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

//------------------fun for update service details--------------------------//
    public function updateServiceDetails($data) {
        extract($data);
        //print_r($data);die();
        $sql = "UPDATE service_tab SET service_image='$imagePath',service_name = '$service_name',service_description = '$serviceDescription' WHERE service_id = '$service_id'";
        // echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }

//---------------fun for delete service details-------------------------------//
    public function deleteServiceDetails($service_id) {

        $sql = "DELETE FROM service_tab WHERE service_id = '$service_id'";
        // echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }

//--------------fun for featured service -----------------------------------//
    public function featuredService($service_id) {
        $count = Manageservice_model::getFeatiredServiceCount();
        //print_r($count);die();
        if($count < 6){
        $sql = "UPDATE service_tab SET is_featured = '1' WHERE service_id = '$service_id'";
        // echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
        }else{
            return 700;
        }
    }
//----------------fun for get the service count-----------------------//
    public function getFeatiredServiceCount(){
        $sql = "SELECT count(*) as count FROM service_tab WHERE is_featured = '1'";
        $result = $this->db->query($sql);
        $count ='';
        if ($result->num_rows() <= 0) {
            return 0;
        } else {
            foreach ($result->result_array() as $key){
                $count = $key['count'];
            }
            return $count;
        }        
    }
//------------fun for unfeatured service --------------------------------------//
    public function unFeaturedService($service_id) {
        $sql = "UPDATE service_tab SET is_featured = '0' WHERE service_id = '$service_id'";
        // echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }

//-------------fun for all services--------------------------//
    public function allServices() {
        $sql = "SELECT * FROM service_tab ORDER BY is_featured DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return FALSE;
        } else {
            return $result->result_array();
        }
    }

}
