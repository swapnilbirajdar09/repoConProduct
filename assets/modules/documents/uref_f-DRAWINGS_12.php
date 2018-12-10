<?php

class Postjob_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
//--------------fun for save job details to db -------------------------------//
    public function saveJob($data) {
        extract($data);
        //print_r($data);die();
        $experience = $experienceRequiredFrom . '-' . $experienceRequiredTo . ' years';
        $sql = "INSERT INTO job_tab(job_name,job_description,vacancies,req_exp, req_list,added_date,status)"
                . "VALUES ('" . addslashes($job_title) . "','" . addslashes($job_description) . "','$noOfVacancies','$experience',"
                . "'".addslashes($skillAdded_field)."',now(),'1')";
        //print_r($sql);die();
        $result = $this->db->query($sql);
        if ($result) {
            return 200;
        } else {
            return 500;
        }
    }
//---------------fun for get all jobs details ---------------------//
    public function getAllJobs() {
        $sql = "SELECT * FROM job_tab";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }
//--------------fun for delete job details--------------------//
    public function deleteJobDetails($job_id) {
        $sql = "DELETE FROM job_tab WHERE job_id = '$job_id'";
        // echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }
//--------------fun for get applied candidate details--------------------//
    public function getAppliedCandidates($job_id) {
        $sql = "SELECT * FROM candidate_tab WHERE applied_job = '$job_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }
//----------------------fun for get candidate resume --------------------------------//
    public function getCandidateResume($candidate_id) {
        $sql = "SELECT * FROM candidate_tab WHERE candidate_id = '$candidate_id'";
        $result = $this->db->query($sql);
        $resume ='';
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            foreach ($result->result_array() as $key){
                $resume = $key['candidate_cv'];
            }
            return $resume;
        }
    }
//---------------------- delete candidate data ---------------------------//
    public function deleteCandidateData($candidate_id){
        //print_r($candidate_id);die();
        $sql = "DELETE FROM candidate_tab WHERE candidate_id = '$candidate_id'";
        // echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }

    //---------------fun for get all jobs details ---------------------//
    public function getAllJobsById($job_id) {
        $sql = "SELECT * FROM job_tab where job_id= '$job_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return 500;
        } else {
            return $result->result_array();
        }
    }
    
}
