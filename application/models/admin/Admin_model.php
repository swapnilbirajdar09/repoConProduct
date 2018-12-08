<?php

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function adminlogin($data) {
        extract($data);
        //---get admin details
        // $login_passwordNew = base64_encode($login_password);
        $sql = "SELECT * FROM admin_tab";
        $result = $this->db->query($sql);
        $username = '';
        $password = '';
        $admin_id = '';
        // $user_role = '';
        // $role_name = '';
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500
            );
            return $response;
            die();
        } else {
            foreach ($result->result_array() as $key) {
                $admin_id = $key['admin_id'];
                $username = $key['username'];
                $password = $key['password'];
                //  $user_role = $key['role_id'];
            }
        }

        if ($login_username != $username) {
            echo '<p class="w3-red w3-padding-small">Invalid Key passed for username!</p>';
        }
        if ($login_password != $password) {
            echo '<p class="w3-red w3-padding-small">Invalid Key passed for password!</p>';
        }

        // check post values with db values
        if ($login_username == $username && $login_password == $password) {
            $response = array(
                'status' => 200,
                'admin_id' => $admin_id,
                'Admin_name' => $username
                    //'role' => $user_role
            );
        } else {
            $response = array(
                'status' => 500
            );
        }
        return $response;
    }

    public function getAllCompanies() {
        $sql = "SELECT * FROM company_tab";
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
