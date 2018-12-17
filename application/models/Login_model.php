
<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function adminlogin($data) {
        extract($data);
        //---get admin details
        // $login_passwordNew = base64_encode($login_password);
        $sql = "SELECT * FROM company_tab where username = '$login_username' OR email= '$login_username' AND password = '$login_password'";
        $result = $this->db->query($sql);
        $username = '';
        $password = '';
        $company_id = '';
        $project_id = '';
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
                //  $user_role = $key['role_id'];
            }
            $sqlSelect = "SELECT * FROM project_tab WHERE company_id = '$company_id' LIMIT 1";
            $resultsel = $this->db->query($sqlSelect);
            foreach ($resultsel->result_array() as $val) {
                $project_id = $val['project_id'];
            }
            $response = array(
                'status' => 200,
                'company_id' => $company_id,
                'admin_name' => $username,
                'project_id' => $project_id
            );
        }

        return $response;
    }

}
