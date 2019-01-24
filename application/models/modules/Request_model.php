<?php

class Request_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/kolkata');
    }

    public function createNewReq($data) {
        $role_id = '';
        extract($data);

        if ($role_id == '') {
            $role_id = 0;
        }
        $date = date('Y-m-d H:i:s');
        $insert_data = array(
            'project_id' => $project_id,
            'document_name' => $document_name,
            'role_id' => $role_id,
            'requested_by' => $author,
            'requested_from' => $requested_from,
            'estimated_date' => $estimated_date,
            'status' => '0',
            'created_date' => $date,
            'created_by' => $author
        );
        // print_r($insert_data);die();
        $this->db->insert('request_tab', $insert_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getApprovedRequests($project_id) {
        $sql = "SELECT * FROM request_tab WHERE status = '0' AND project_id = '$project_id' ORDER BY request_id DESC";
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

    public function getAllRequests($project_id) {
        $sql = "SELECT * FROM request_tab WHERE project_id = '$project_id' ORDER BY request_id DESC";
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
