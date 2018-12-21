<?php

class Permission_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllGrades() {
        $sql = "SELECT * FROM grade_tab";
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

//------------fun for grant permission
    public function grantPrivilege($data) {
        extract($data);
        //print_r($data);die();
        $sql = "UPDATE features_tab SET grades_assigned = '$gradeData' WHERE feature_id = '$feature'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {            //return TRUE;
            $response = array('status' => 'success',
                'status_message' => 'Privilege Set Successfully.');
        } else {
            //return FALSE;
            $response = array('status' => 'error',
                'status_message' => 'Privilege Not Set Successfully.');
        }

        return $response;
    }

}
