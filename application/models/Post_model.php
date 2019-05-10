<?php 

class Post_model extends CI_Model
{


	public function insert_form($tablename , $data){

		if ($this->db->insert($tablename, $data)) {
			return true;
		}else{
			return false;
		}
		
	}

	public function update_form($tablename , $data, $id){

		$this->db->where('id', $id);
		$this->db->update($tablename ,$data);
		return true;
	}

	public function update_sa16($tablename , $data, $id){

		$this->db->where('vdc_socio_economic_id', $id);
		$this->db->update($tablename ,$data);
		return true;
	}

	public function get_inserted_primary_data_id($table){

		$this->db->select('id');
		$this->db->order_by('id', 'DESC');
		return $this->db->get($table);

	}

	public function delete_sa16($tbl_name, $id){
    	$this->db->where("vdc_socio_economic_id",$id);
    	$this->db->delete($tbl_name);
    	return $this->db->affected_rows();
	}

	public function get_table_name_by_id($tid){

		// $query = $this->db->select('title');
		// $query = $this->db->from('cms_tables');
		// $query = $this->db->where('id', $tid);

		// return $this->db->get('asset_types');

		return $this->db->get_where('cms_tables', array('id' => $tid))->row()->title;

	}

	public function alter_foreign_table($sec_table){

		$this->load->dbforge();

		$fields = array(
        					'primary_id' => array('type' => 'INT'),
        					'primary_data_id' => array('type' => 'INT')
						);

		
		if($this->dbforge->add_column($sec_table, $fields)){
			return true;
		}else{
			return false;
		}
	}

	public function alter_primary_table($primary, $val){

		$this->load->dbforge();
		$break = explode(',', $val);
		// print_r($break);die;

		foreach ($break as $bre) {
			
		$fields = array(
        					$bre => array('type' => 'VARCHAR(200)')
						);
		$rel = $this->dbforge->add_column($primary, $fields);
		}

		if($rel){
			return true;
		}else{
			return false;
		}
	}

	public function alter_for_table($sec_table, $fields){

		$this->load->dbforge();

		$fields = array(
        					'primary_data_id' => array('type' => 'VARCHAR')
						);

		
		if($this->dbforge->add_column($sec_table, $fields)){
			return true;
		}else{
			return false;
		}
	}

	public function check_primary_and_foreign_tables($a, $b){

		// $this->db->get_where('relationships', array('primary_table' => $a, 'sec_key' => $b))->row()->id;
		// return true;

		$query = $this->db->get_where('relationships', array('primary_table' => $a, 'sec_key' => $b));

		return $query->result_array();
	}

	public function toUpdateRecord($table_name,$y,$arr) //here--------------------------------------------------------------------------------------------
	{
		
		$query = $this->db->get_where($table_name,array($arr=>$y));
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}	
		else
		{
			return FALSE;
		}
	}
}