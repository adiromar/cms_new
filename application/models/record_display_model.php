<?php class Record_display_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

  public function getRecordByUserID($table_name, $user_id, $user_type)
    {
      
        $district = $this->session->userdata("district");
        $district = $this->session->userdata("user_type");
        // if ($user_type == "user") {
        //     $this->db->where("user_id", $user_id);
        // }
         if ($user_type == "User") {
            // $sql = "SELECT *FROM user_login WHERE district= $district ";
            // $query = $this->db->query($sql);
            // $a = array('-100');
            // foreach ($query->result() as $row) {
            //     array_push($a, $row->user_id);
            // }
            // $this->db->where_in("user_id", $a);

            $query = $this->db->get_where($table_name, array('user_id' => $user_id));        
            // print_r($query);die;
        return $query->result_array();
        }

        // if ($user_type == "verifier") {
        //     $sql = "SELECT *FROM user WHERE district_code= $district_code ";
        //     $query = $this->db->query($sql);
        //     $a = array('-100');
        //     foreach ($query->result() as $row) {
        //         array_push($a, $row->user_id);
        //     }
        //     $this->db->where_in("user_id", $a);
        // }

        // if(!empty($vdc)){
        //     $sql = "SELECT *FROM user WHERE vdc_code ='$vdc' ";
        //     $query = $this->db->query($sql);
        //     $u = array('-100');
        //     foreach ($query->result() as $row) {
        //         array_push($u, $row->user_id);
        //     }
        //     //print_r($u);
        //     $this->db->where_in("user_id", $u);
        // }
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();

        } else {
            return FALSE;
        }
    }

}