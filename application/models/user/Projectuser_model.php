<?php

class Projectuser_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getProjectRoles($project_id) {
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

    public function createNewUser($data) {
        extract($data);
        //print_r($data);die();
        $username = $userFirstName[0].$userLastName.'@'.;
        //$json = json_encode($features);
        $sql = "INSERT INTO user_tab(project_id,role_name,features_assign,created_date)"
                . "VALUES('$project_id','" . addslashes($role_name) . "','$features',NOW())";
        if ($this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
