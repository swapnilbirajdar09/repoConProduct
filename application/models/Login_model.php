
<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function adminlogin($data) {
    	extract($data);
        //---get admin details
       // $login_passwordNew = base64_encode($login_password);
        $sql = "SELECT * FROM company_tab";
        $result = $this->db->query($sql);
        $username = '';
        $password = '';
        $company_id = '';
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
                $company_id = $key['company_id'];
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
                'company_id' => $company_id,
                'Admin_name'=> $username
                //'role' => $user_role
            );
        } else {
            $response = array(
                'status' => 500
            );
        }
        return $response;
    }

}
