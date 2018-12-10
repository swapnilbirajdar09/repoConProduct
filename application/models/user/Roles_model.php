
<?php

class Roles_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllProjects($company_id) {
        $sql = "SELECT * FROM project_tab WHERE company_id = '$company_id'";
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

    public function getAllFeatures() {
        $sql = "SELECT * FROM features_tab";
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

    public function saveRoles($data) {
        extract($data);
        //print_r($data);die();
        $role_name = strtoupper($role_name);
        //$json = json_encode($features);
        $sql = "INSERT INTO role_tab(project_id,role_name,features_assign,created_date)"
                . "VALUES('$project_id','" . addslashes($role_name) . "','$features',NOW())";
        if ($this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAllRoles($project_id) {
        $sql = "SELECT * FROM role_tab WHERE project_id = '$project_id'";
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

    public function deleteRole($role_id) {
        $sql = "DELETE FROM role_tab WHERE role_id = '$role_id'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 'success',
                'status_message' => 'Role Deleted Successfully.');
        } else {
            $response = array(
                'status' => 'error',
                'status_message' => 'Role Not Deleted Successfully.');
        }
        return $response;
    }

}