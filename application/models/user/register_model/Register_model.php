<?php

class Register_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function registerUser($data) {
        extract($data);
        $sql = "INSERT INTO company_tab(full_name,username,email,mobile_no,company_name,address,city,state,country,postal_code,package_purchased,expiry_date,added_date,)"
                . "VALUES ('$emp_name','$emp_punch_id','$skillAdded_field','1')";
        if ($this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAllCountries() {
        $sql = "SELECT * FROM countries";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500,
                'status_message' => 'No data found.');
        } else {
            $response = array(
                'status' => 200,
                'status_message' => $result->result_array());
        }
        return $response;
    }

}
