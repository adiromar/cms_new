<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __Construct()
	{
		parent::__Construct();
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->model('user_model');
		
	}

	public function index()
	{
		$data['title'] = "Admin";

		$this->load->model('admin_model');

		// $data['columns'] = $this->admin_model->get_columns();
		$data['tables'] = $this->admin_model->get_tables();

		$this->load->view('includes/header');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('includes/footer');
	}
	
	public function manage_tables(){
		$data['title'] = "Manage Tables";

		$data['tables'] = $this->admin_model->get_tables_mul();

		$this->load->view('includes/header');
		$this->load->view('admin/manage_tables', $data);
		$this->load->view('includes/footer');
	}

	public function view_data(){
		
		$data['title'] = "View Data";
	
		$this->load->view('includes/header');
		$this->load->view('admin/view_data', $data);
		$this->load->view('includes/footer');

	}

	public function show_data(){       
		$this->load->model('user_model');
		$data['title'] = "Show Table";

		$this->load->view('includes/header');
		$this->load->view('admin/show_data', $data);
		$this->load->view('includes/footer');
	}

	public function setup()
	{
		$this->form_validation->set_rules( 'title', 'Title' , 'required|callback_check_table_exists');
		$this->form_validation->set_rules('display_name', 'Display Name', 'required');
		$this->form_validation->set_rules('form_type', 'Form Type', 'required');

		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('includes/header');
			$this->load->view('admin/dashboard');
			$this->load->view('includes/footer');
		}
		else
		{	
			// echo '<pre>';
			// print_r($_POST);die;
			$this->load->model('admin_model');

			$title1 = $this->input->post('title');
			$title1 = strtolower($title1);
			$title = str_replace(' ', '_', $title1);

			$fields = $this->input->post('fields[]');
			$name = str_replace(' ', '_', $fields);

			$types = $this->input->post('types[]');
			$nep = $this->input->post('nepali_title[]');
			// print_r($nep);die;
			$values = $this->input->post('values[]');
			// print_r($nep);
			$form_type = $this->input->post('form_type');

			$create = $this->admin_model->create_form($title,$name,$types,$values);

			if ($create == true) {
				// Set message
				$this->session->set_flashdata('post_created', 'Successfully Created table/form');
				redirect('admins/index'); 
			}else{
				$this->session->set_flashdata('error', 'Error in Form Submition');
				redirect('admins/index');
			}
		}
	}

	public function check_table_exists($title)
	{

		$this->form_validation->set_message('check_table_exists', 'That form/table is taken. Please choose a different one');
		if ($this->admin_model->check_table_exists($title)) {
			return true;
		}else{
			return false;
		}
	}

	public function add_multiple_input_feature(){

		$tables = $this->input->post('tables');

		foreach ($tables as $key) {

			$this->admin_model->insert_table_feature($key);
		}

		redirect('admins/manage_tables');

	}

	public function disable_multiple_input_feature(){

		$tables = $this->input->post('tables');
		//print_r($tables);die;
		foreach ($tables as $key) {

			$this->admin_model->disable_table_feature($key);
		}

		redirect('admins/manage_tables');

	}

	public function list_form(){
		$data['title'] = "Manage Created Forms";

		$data['alltables'] = $this->admin_model->get_tables();

		$this->load->view('includes/header');
		$this->load->view('admin/formlist', $data);
		$this->load->view('includes/footer');
	}

	public function truncate_table(){
		// print_r($_POST);die;
		$tables = $this->input->post('tables');

		foreach ($tables as $key) {
		$this->db->truncate($key);
		}
		
		redirect('admins/list_form');
		
	}

	public function edit_form(){
		$data['title'] = "Edit Created Forms";

		$this->load->view('includes/header');
		$this->load->view('admin/edit_form', $data);
		$this->load->view('includes/footer');
	}

	public function delete_form(){
		$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$last = explode("/", $str, 6);
		// echo $last[5];
		// echo $str;die;
		
		$del =$this->admin_model->delete_from_values_tbl($last[5]);
		$delete =$this->admin_model->delete_form_by_title($last[4]);
		$del_tbl =$this->admin_model->delete_table_by_title($last[4]);
		if ($del == true && $delete == true && $del_tbl == true){
			$this->session->set_flashdata('post_deleted', 'Form Deleted Successfully.');
			redirect ('admins/list_form/');
		}else{
			$this->session->set_flashdata('error_deletion', 'form deleted.');
			redirect ('admins/list_form/');
		}
	}

	public function form_priority(){
		// print_r($_POST);die;
		$priority = $this->input->post('priority');
		$id = $this->input->post('id');
		$set = $this->admin_model->set_priority($priority, $id);

		if ($set == true){
			$this->session->set_flashdata('post_deleted', 'Form Priority Set.');
			redirect('admins/list_form');
		}else{
			$this->session->set_flashdata('error_deletion', 'Could not set Form Priority.');
			redirect('admins/list_form');
		}
	}

	public function update_form(){

			$this->load->model('admin_model');
			$display = $this->input->post('display_name');
			$table_id = $this->input->post('table_id');
			$title1 = $this->input->post('title');
			$title1 = strtolower($title1);
			$title = str_replace(' ', '_', $title1);

			$fields = $this->input->post('fields[]');
			$name = str_replace(' ', '_', $fields);

			$types = $this->input->post('types[]');
			$nep = $this->input->post('nepali_title[]');
			// print_r($nep);die;
			$values = $this->input->post('values[]');
			// print_r($nep);
			$form_type = $this->input->post('form_type');

			$create = $this->admin_model->update_form($title,$name,$types,$values,$table_id);

			if ($create) {
				// Set message
				$this->session->set_flashdata('form_updated', 'Successfully Updated Form <b>'.$display.'</b> ');
				redirect('admins/list_form'); 
			}
	}

	public function backup(){
		
		$this->load->dbutil();

		$prefs = array(     
    		'format'      => 'zip',             
    		'filename'    => 'wump_backup.sql'
    		);

		$backup =& $this->dbutil->backup($prefs); 
		$db_name = 'wump_backup'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'pathtobkfolder/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 

		$this->load->helper('download');
		force_download($db_name, $backup);
	}

	public function export(){   
		$data['tid'] = $this->uri->segment(3,1);
// $str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $lastn = explode("/", $str, 6);    
		// print_r($lastn[4]);die;
		$data['title'] = "Export Table";

		$this->load->view('includes/header');
		$this->load->view('admin/export_records', $data);
		$this->load->view('includes/footer');

	}

		public function export_records(){
		if ($this->input->post('sec_value') == ''){
			redirect('admins/export');
		}
		// echo '<pre>';
		// print_r($_POST);die;
		$tbl_name = $this->input->post('form_name');
		$tbl_title = $this->input->post('form_title');
		$fields = $this->input->post('sec_value');
		$for_fields = $this->input->post('for_value');
		$no = count($fields);
		// print_r($fields);
		// print_r($tbl_name);die;
// header("Content-type: application/vnd.ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
// header("Content-Disposition: attachment; filename='.$tbl_name.xls");
?>

<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
<div style="margin-left: 100px; margin-top: 20px;">
<table border="1" class="table table-bordered">
	<thead>
	<tr>
		<?php
		// $added_title = $this->admin_model->get_added_title($tbl_name);
		$temp = array();
		echo "<th>S.N.</th>";
		foreach ($fields as $key => $values) {
			// print_r($fields);
			$cap = str_replace('_', ' ', $values);
			$cap = ucfirst($cap);
			echo "<th >".$cap."</th>";
			$temp[] = $values;
		}
		// foreach ($for_fields as $field => $fiel) {
		// 	// print_r($fields);
		// 	echo "<th >".$fiel."</th>";
		// 	$temp[] = $fiel;
		// }

		?>
	       
	     </tr>
	 </thead>
	 <tbody>
	     <tr>
	     	<?php
	     	$f = implode(',', $temp);
	     	// print_r($f);die;
	     	// foreach ($fields as $key => $val) {
			$data = $this->admin_model->get_table_data_by_field($f, $tbl_name);
			// echo '<pre>';
			// print_r($data);
			$i = 1;
			foreach ($data as $key) {
				echo "<td>".$i."</td>";
				foreach ($key as $val) {
					echo "<td>".$val."</td>";
				}
			$i++;
			
		// }   ?>
	     </tr>
	     <?php } ?>
	 </tbody>
</table>
</div>
<?php	}



}//main class loop
