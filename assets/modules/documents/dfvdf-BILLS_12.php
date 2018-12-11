    <?php

    class Dashboard_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        //-----------function for add category in db-----------//

        public function AddCategory($catname) {
            $sql = "INSERT INTO category_tab(cat_name) VALUES (UPPER('$catname'))";

            if ($this->db->query($sql)) {
                $response = array(
                    'status' => 200, //---------insert db success code
                    'status_message' => 'Category Added Successfully..'
                );
            } else {
                $response = array(
                    'status' => 500, //---------db error code 
                    'status_message' => 'Something Went Wrong...Category Not Added Successfully.!!!'
                );
            }
            return $response;
        }

    //----------function for show category-------//
        public function getAllCategory() {
            $sql = "SELECT * FROM category_tab";
            //echo $sql; die();
            $result = $this->db->query($sql);
            if ($result->num_rows() <= 0) {
                return 500;
              
            } else {
                return $result->result_array();
           }
        }

    // ----function to delete category
        public function delCat($catid) {
           
            $sql = "DELETE FROM category_tab WHERE cat_id='$catid' ";

            if ($this->db->query($sql)) {
                $response = array(
                    'status' => 200, //---------insert db success code
                    'status_message' => 'Category Deleted Successfully..'
                );
            } else {
                $response = array(
                    'status' => 500, //---------db error code 
                    'status_message' => 'Something Went Wrong... Category is Not Deleted Successfully.!!!'
                );
            }
            return $response;
        }

        // ----function to add technology details in db
          public function add_technology($data) {
            extract($data);
            $result = array(
                'tech_name' => $technology_name,
                'description' => $description,
                'tech_logo' => $imagePath
                
            );
          if($this->db->insert('technology_tab', $result)){
                return true;
            }else{
                return false;
            }
        }
    // ---function to show technology
          public function getTechnologyDetails() {
            $sql = "SELECT * FROM technology_tab";
            $result = $this->db->query($sql);
            if ($result->num_rows() <= 0) {
                return false;
            } else {
                return $result->result_array();
            }
        }

        //-------fun to delete technology --------------//

        public function remove_technology($tech_id) {
           $sql = "DELETE FROM technology_tab WHERE tech_id = '$tech_id'";
            $result = $this->db->query($sql);
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 500;
            }
        }

    // ----function to add testimonial details
         public function add_testimonial($data) {
            extract($data);
            $result = array(
                'client_name' => $client_name,
                'client_designation' => $client_desig,
                'client_image' =>$imagePath,
                'client_comment' =>$client_comment
                
            );
          if($this->db->insert('testimonial_tab', $result)){
                return true;
            }else{
                return false;
            }
        }

    // ------fun to show testimonial details in table format
         public function getTestimonialDetails() {
            $sql = "SELECT * FROM testimonial_tab";
            $result = $this->db->query($sql);
            if ($result->num_rows() <= 0) {
                return false;
            } else {
                return $result->result_array();
            }
        }

    // -------func to delete testimonials
          public function deletClientDetails($testimonial_id) {
            $sql = "DELETE FROM testimonial_tab WHERE testimonial_id = '$testimonial_id'";
            $result = $this->db->query($sql);
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 500;
            }
        }

    }
