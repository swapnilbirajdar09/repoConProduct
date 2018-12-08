
<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function adminlogin($data) {
    	extract($data);
        //---get admin details
       // $login_passwordNew = base64_encode($login_password);
        $sql = "SELECT * FROM company_tab where username = '$login_username' AND password = '$login_password'";
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
              //  $user_role = $key['role_id'];
            }
            	$response = array(
                'status' => 200,
                'company_id' => $company_id,
                'admin_name'=> $username
                //'role' => $user_role
            );
        }

        return $response;
    }

}
