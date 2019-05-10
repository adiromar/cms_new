<?php 
/**
* Admin Model
*/
class Admin_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}


	public function check_table_exists($title){

		$query = $this->db->get_where('cms_tables', array('title' => $title));
		if (empty($query->row_array())) {
			return true;
		}else{
			return false;
		}
	}

	public function get_tables(){

		$query = $this->db->query('SELECT * FROM cms_tables ORDER BY id DESC');

		return $query->result_array();

	}

	public function get_table_by_id($id){
		$query = $this->db->get_where('cms_tables', array('id' => $id ));

		return $query->result_array();
	}

	public function get_table_data_by_name($table){
		
		$query = $this->db->get($table);		

		return $query->result_array();
	}

	public function check_relation($id){

		$query = $this->db->get_where('relationships', array('sec_key' => $id));

		return $query->num_rows();
	}

	public function get_foreign_table_of_primary_table($t){

		$query = $this->db->get_where('relationships', array('primary_table' => $t ));

		return $query->result_array();
	}


	public function create_form($title,$fields,$types,$values){

		//Convert fields into string
		$allfields = implode(',', $fields);
		$alltypes = implode(',', $types);
		
		$combine = array_combine($fields,$types);

		foreach ($values as $key => $value) {
			$val[$key] = implode('|', $value); 
		}

		//Create table
		$this->load->dbforge();

		$this->dbforge->add_field('id');

		$combine = array_combine($fields,$types);

		foreach ($combine as $key => $value) {

			if ($value == 'INT') {
				
				$this->dbforge->add_field($key.' '.$value.'(20) NOT NULL');
			}

			elseif ($value == 'TEXT') {
				
				$this->dbforge->add_field($key.' '.$value.' NOT NULL');
			}
			else{
				$this->dbforge->add_field($key.' '. 'VARCHAR(200) NOT NULL');
			}

		}

		if ($this->dbforge->create_table($title, TRUE)){

		// 	//Add title to table cms_tables
			$data = array(
					'title' => $title,
					'fields' => $allfields,
					'types' => $alltypes,
					'display_name' => $this->input->post('display_name')
					);
			$this->db->insert('cms_tables', $data);
			$id = $this->db->insert_id();

			
			foreach ($val as $key => $value) {
				$dat = array(
							'tableid' => $id,
							'name' => $key,
							'vals' => $value,
							);

			$this->db->insert('cms_values', $dat);
			}
			return true;
		}else{
			return false;
		}


	}


	public function insert_table_feature($key){

		$data = array(
						'table_id' => $key,
						'multiple_input' => 1
					);

		return $this->db->insert('table_properties', $data);
	}

	public function get_table_properties($id){

		$query = $this->db->get_where('table_properties', array('table_id' => $id));

		return $query->num_rows();
	}

	public function disable_table_feature($key){

		$data = array(
						'table_id' => $key,
						//'multiple_input' => 0
					);

		return $this->db->delete('table_properties', $data);
	}

	public function get_table_data_by_id($table, $id){
		
		$query = $this->db->query('SELECT * from '.$table.' where id = '.$id.'');		

		return $query->result_array();
	}
	
	public function delete_id($tbl_name, $id){
    	$this->db->where("id",$id);
    	$this->db->delete($tbl_name);
    	return $this->db->affected_rows();
	}
}
 ?>