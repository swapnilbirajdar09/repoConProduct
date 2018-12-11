<?php

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //-------fun for get all links-----------//
    public function getSocials() {
        $sql = "SELECT * FROM social_class_tab";
        //echo $sql; die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }

//-------------------fun for delete social link------------------//
    public function deleteSocialLink($social_id) {
        $sql = "DELETE FROM social_tab WHERE social_id = '$social_id'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }

//-----------fun for get all social links -----------------------------//
    public function getAllSocialLinks() {
        $sql = "SELECT * FROM social_tab";
        //echo $sql; die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }

    //------------fun for add social links to social tab--------------//

    public function addSocialLinks($data) {
        extract($data);
        $sql = "SELECT * FROM social_class_tab WHERE social_classes = '$social_link_type'";
        $result = $this->db->query($sql);
        if ($result) {
            $social_name = '';
            foreach ($result->result_array() as $key) {
                $social_name = $key['social_name'];
            }
        }
        $sqlInsert = "INSERT INTO social_tab(social_symbole,social_link_name,social_url)values('$social_link_type','$social_name','$social_url')";
        $resultNew = $this->db->query($sqlInsert);
        if ($resultNew) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //-------UPDATE ADMIN EMAIL FUNCTION--------------//
    public function updateEmail($email) {

        $sql = "UPDATE user_tab SET user_email='$email' WHERE user_id='1'";

        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
        return $response;
    }

    //-------UPDATE ADMIN username FUNCTION--------------//
    public function updateUname($uname) {

        $sql = "UPDATE user_tab SET user_name='$uname' WHERE user_id='1'";

        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
        return $response;
    }

    //-------UPDATE ADMIN PASSWORD FUNCTION--------------//
    public function updatePass($upass) {
        $password = base64_encode($upass);
        $sql = "UPDATE user_tab SET user_passwd='$password' WHERE user_id='1'";

        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
        return $response;
    }

    //----------function to get all admin details-------//
    public function getAlladmin_details() {
        $sql = "SELECT * FROM user_tab";
        //echo $sql; die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }

//-------INSERT COMPANY DETAILS FUNCTION--------------//
    public function add_companyProfile($c_profile = array()) {
        $company_name = $c_profile['company_name'];
        $company_logo = $c_profile['company_logo'];
        $company_email = $c_profile['company_email'];
        $hqAddress = $c_profile['hqAddress'];
        $sql = " UPDATE company_tab SET company_name='$company_name',"
                . "company_logo='$company_logo',company_email='$company_email',hq_address='$hqAddress' WHERE company_id='1'";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
        return $response;
    }

    //----------function to get all Company details-------//
    public function getAllcompany_details() {
        $sql = "SELECT * FROM company_tab";
        //echo $sql; die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }

    //-------update COMPANY address FUNCTION--------------//
    public function add_officeaddress($office_details) {
        $sqlselect = "SELECT * FROM company_tab WHERE company_id='1'";
        $resultnew = $this->db->query($sqlselect);
        if ($resultnew) {
            // return true;
            $office_newdetails = '';
            foreach ($resultnew->result_array() as $key) {

                $office_newdetails = json_decode($key['office_details']);
            }
            if ($office_newdetails != '' && $office_newdetails != '[]') {
                array_push($office_newdetails, $office_details);
            } else {
                $office_newdetails[] = $office_details;
            }
        }

        $jsonVal = json_encode($office_newdetails);
        //print_r($office_newdetails);die();
        $sql = " UPDATE company_tab SET office_details='$jsonVal' WHERE company_id='1'";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
        //return $response;
    }

    public function remove_officedetails($key) {
        //echo $key;die();
        $sqlselect = "SELECT * FROM company_tab WHERE company_id='1'";
        $resultnew = $this->db->query($sqlselect);
        if ($resultnew) {
            // return true;
            $office_newdetails = '';
            foreach ($resultnew->result_array() as $row) {

                $office_newdetails = json_decode($row['office_details']);
            }
            unset($office_newdetails[$key]);
            $office_newdetails = array_values($office_newdetails);
            $json = json_encode($office_newdetails);
            $sql = " UPDATE company_tab SET office_details='$json' WHERE company_id='1'";
            if ($this->db->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }

}
