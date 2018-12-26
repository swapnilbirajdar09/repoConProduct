
<?php

class Userlogin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function userrole_login($data) {
        extract($data);
        //---get user details
        // $login_passwordNew = base64_encode($login_password);
        $sql = "SELECT * FROM user_tab, role_tab WHERE role_tab.role_id = user_tab.role_id "
        . "AND user_tab.user_email = '$login_username' AND user_tab.password = '$login_password'";
        $result = $this->db->query($sql);

        $project_id = '';
        $project_name = '';
        $user_id = '';
        $username = '';
        $user_role = '';
        $grade_id = '';
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500
            );
            return $response;
            die();
        } else {
            foreach ($result->result_array() as $key) {
                $project_id = $key['project_id'];
                $user_id = $key['user_id'];
                $username = $key['user_name'];
                $user_role = $key['role_id'] . '/' . $key['role_name'];
                $grade_id = $key['grade_id'];
            }

            // get project name
            $project_sql = "SELECT * FROM project_tab WHERE project_id='$project_id'";
            $project_result = $this->db->query($project_sql);

            foreach ($project_result->result_array() as $key) {
                $project_name = $key['project_name'];
            }
            $response = array(
                'status' => 200,
                'project_id' => base64_encode($project_id.'|'.$project_name),
                'user_id' => $user_id,
                'userrole_name' => $username,
                'role' => $user_role,
                'grade_id' => $grade_id
            );
        }

        return $response;
    }

}
