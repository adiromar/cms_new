<?php 

class Page_model extends CI_Model
{
	public function __construct(){

		$this->load->database();
	}

	public function get_table_names(){

		$query = $this->db->query('SELECT id,title,display_name FROM cms_tables where (form_type ="primary_form") ORDER BY form_order Asc');

		return $query->result_array();
	}

	public function get_for_table_names(){

		$query = $this->db->query('SELECT id,title,display_name FROM cms_tables where form_type = "foreign_form" ORDER BY form_order DESC');

		return $query->result_array();
	}

	public function get_mul_table_names(){

		$query = $this->db->query('SELECT id,title,display_name FROM cms_tables where form_type = "multiple_form" ORDER BY id DESC');

		return $query->result_array();
	}

	public function get_tables(){

		$query = $this->db->query('SELECT * FROM cms_tables ORDER BY form_order Asc');

		return $query->result_array();
	}

	public function get_table_values(){

		$query = $this->db->get('cms_values');

		return $query->result_array();
	}

	public function get_table_by_id($tid){

		$query = $this->db->get_where('cms_tables', array('id' => $tid));

		return $query->result_array();
	}

	public function get_for_table_by_id($tid){

		$query = $this->db->get_where('cms_tables', array('id' => $tid, 'form_type' => 'foreign_form'));

		return $query->result_array();
	}

	public function get_mul_table_by_id($tid){

		$query = $this->db->get_where('cms_tables', array('id' => $tid, 'form_type' => 'multiple_form'));

		return $query->result_array();
	}

	public function get_table_values_by_id($tid){

		$query = $this->db->get_where('cms_values', array('tableid' => $tid));

		return $query->result_array();
	}

	public function get_relations($tableid){

		$query = $this->db->get_where('relationships', array('sec_key' => $tableid));

		return $query->num_rows();
	}

	public function get_foreigntable($tbname){

		$query = $this->db->get_where('relationships', array('primary_table' => $tbname));

		return $query->result_array();		
	}

	public function get_foreigntable_mul($tbname){

		$query = $this->db->get_where('relationships', array('primary_table' => $tbname, 'form_type' => 'multiple_form'));
// $query = $this->db->query('SELECT * FROM relationships where primary_table = "'.$tbname.'" AND form_type = "multiple_form" ');
		return $query->result_array();		
	}

	public function get_foreigntable_for($tbname){

		$query = $this->db->get_where('relationships', array('primary_table' => $tbname, 'form_type' => 'foreign_form'));

		return $query->result_array();		
	}

	public function get_multiple($tid){

		$query = $this->db->get_where('table_properties', array('table_id' => $tid));

		return $query->result_array();	
	}

	public function get_frn_id(){

		$query = $this->db->query('SELECT table_id FROM table_properties');

		return $query->result_array();
	}

	public function find_foreign_no_of_tbl_for_edit($table, $id, $pid){
		$array = array('primary_data_id' => $id, 'primary_id' => $pid);
		$query = $this->db->get_where($table, $array);

		return $query->result_array();
	}

	public function edit_foreign_id($f_table, $id, $p_id){

		$query = $this->db->query('SELECT * FROM `'.$f_table.'` where primary_data_id
		 = '.$id.' AND primary_id ='.$p_id.' ');

		return $query->result_array();
	}

	public function get_data_for_field($field, $tbl){
		// $query = $this->db->query('SELECT Distinct '.$field.' FROM '.$tbl.' order by ASC ');
		$this->db->select($field);
		$this->db->from($tbl);
		$this->db->group_by($field);
		$this->db->order_by($field, "asc");
		$query = $this->db->get(); 
		return $query->result_array();
		// return $query->result_array();	
		
	}

	public function get_values_tbl($tbl){
		$query = $this->db->query('SELECT id FROM cms_values where tableid = '.$tbl.' ');

		return $query->result_array();
	}

	public function get_values_by_name($name, $id){

		$query = $this->db->get_where('cms_values', array('name' => $name, 'tableid' => $id));

		return $query->result_array();
	}

	public function record_inserted_by($id){
		$query = $this->db->get_where('user_login', array('user_id' => $id));
		return $query->result_array();
	}
}