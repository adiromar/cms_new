<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __Construct()
	{
		parent::__Construct();
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->model('user_model');	
		$this->load->model('page_model');
		$this->load->model('admin_model');	
	}
	
	public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);
			$data['table_names1'] = $this->page_model->get_for_table_names();
			$data['table_names'] = $this->page_model->get_table_names(); 
			$data['tables'] = $this->page_model->get_tables();

			$data['values'] = $this->page_model->get_table_values();

			// $data['relations'] = $this->page_model->get_relations();

			$this->load->view('templates/header_new');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}

	public function get_table_by_id(){
		
		$tid = $this->uri->segment(3,1);
		$data['table_names'] = $this->page_model->get_table_names();

		$data['table_data'] = $this->page_model->get_table_by_id($tid);
		//get foreign table is exists
		$tbname = $data['table_data'][0]['title'];
		$data['table_values'] = $this->page_model->get_table_values_by_id($tid);
		
		

		$this->load->view('templates/header_new');
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer');
	}

	public function get_for_table_by_id(){
		
		$tid = $this->uri->segment(3,1);
		$data['table_names1'] = $this->page_model->get_for_table_names();

		$data['table_data1'] = $this->page_model->get_for_table_by_id($tid);
		
		//get foreign table is exists
		$tbname = $data['table_data1'][0]['title'];
	
		$data['table_values'] = $this->page_model->get_table_values_by_id($tid);
		
		

		$this->load->view('templates/header_new');
		$this->load->view('pages/foreign', $data);
		$this->load->view('templates/footer');
	}

	public function multiple_form(){
		$tid = $this->uri->segment(3,1);
		// $data['table_namesm'] = $this->page_model->get_mul_table_names();

		// $data['table_datam'] = $this->page_model->get_mul_table_by_id($tid);
		
		//get foreign table is exists
		// $tbname = $data['table_datam'][0]['title'];
		

		// $data['table_values_mul'] = $this->page_model->get_table_values_by_id($tid);
		
		$this->load->view('templates/header_new');
		$this->load->view('pages/multiple', $data);
		$this->load->view('templates/footer');
	}

	public function edit_table_by_id(){
		$this->load->model('admin_model');
		
		$tid = $this->uri->segment(3,1);
		$data['d_id'] = $this->uri->segment(5,1);
		$data['table_names'] = $this->page_model->get_table_names();

		$data['table_data'] = $this->page_model->get_table_by_id($tid);
		//get foreign table is exists
		$tbname = $data['table_data'][0]['title'];	

		$data['table_values'] = $this->page_model->get_table_values_by_id($tid);
		
		$data['multiple'] = $this->page_model->get_multiple($tid);
		$data['frn_tbl'] = $this->page_model->get_frn_id();

		$this->input->post("pages/edit_table_by_id");
		$this->load->view('templates/header_new');
		$this->load->view('pages/edit', $data);
		$this->load->view('templates/footer');
	}

	public function delete($tbl_name , $id, $sec_tbl=false, $pri_id=false, $pri_dat=false ){
		$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    	$last = explode("/", $str, 9);
		// echo $last[5];
 		$tbl_name = $last[4];
 		$id = $last[5];
 		$sec_tbl = $last[6];
 		$pri_id = $last[7];
 		$pri_dat = $last[8];
 		// echo $tbl_name;echo $id.'<br/>';
 		// echo $sec_tbl;echo $pri_id;echo $pri_dat;die;
 		// echo $pri_dat;echo $pri_id;die;

 		$result =$this->admin_model->delete_id($tbl_name, $id);
 		$result1 =$this->admin_model->delete_sec_tbl($sec_tbl, $pri_id, $pri_dat);
 		// print_r($result1);die;
 		if($result==1 || $result1==1){
 			$this->session->set_flashdata('post_deleted', 'Data from <strong>'.$tbl_name.' & '.$sec_tbl.'</strong> table has been deleted successfully.');
 			if ($user_type == 'Normal'){
 				redirect ('pages/show_data_by_user/'.$tbl_name.'');
 			}
			redirect ('pages/show_data_by_user/'.$tbl_name.'');
     		// echo 'success';
  		}else{
     		echo 'Delete failed';
  		}   
  		die;

	}

	public function delete_sin($tbl_name , $id){
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    	$last = explode("/", $str, 6);
		// echo $last[5];
 		$tbl_name = $last[4];
 		$id = $last[5];
 		$result=$this->admin_model->delete_id($tbl_name, $id);
 		if($result==1){
 			$this->session->set_flashdata('post_deleted', 'Data from <strong>'.$tbl_name.'</strong> table with Id <strong>'.$id.'</strong> has been deleted successfully.');
 			if ($user_type == 'Normal'){
 				redirect ('pages/show_data_by_user/'.$tbl_name.'');
 			}else
			redirect ('admins/show_data/'.$tbl_name.'');
     		
  		}else{
     		echo 'failed';
  		}   
	}

	public function delete_foreign($tbl_name , $id){
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    	$last = explode("/", $str, 6);
		// echo $last[5];
 		$tbl_name = $last[4];
 		$id = $last[5];
 		$result=$this->admin_model->delete_id($tbl_name, $id);
 		if($result==1){
 			$this->session->set_flashdata('post_deleted', 'Data from <strong>'.$tbl_name.'</strong> table with Id <strong>'.$id.'</strong> has been deleted successfully.');
 			if ($user_type == 'Normal'){
 				redirect ('pages/show_foreign/'.$tbl_name.'');
 			}else
			redirect ('pages/show_foreign/'.$tbl_name.'');
     		
  		}else{
     		echo 'failed';
  		}   
	}

	public function view_records(){
		
		$data['title'] = "View Records";
	
		$this->load->view('templates/header_new');
		$this->load->view('pages/view_records', $data);
		$this->load->view('templates/footer');

	}

	public function show_data_by_user(){   
		$data['tid'] = $this->uri->segment(3,1);
		$tid = $this->uri->segment(3,1);
// 		$user_id=$this->session->userdata('user_id');
// 		$user_type=$this->session->userdata('user_type');
// 		$dis = $user_type[0]['district'];
// 		$all = $this->user_model->get_all_district_user($dis);
// 		$items = array();
// 		foreach ($all as $key => $value) {
//   		$items[] = $value['user_id'];
// 		}
// $no = count($items);

		$data['title'] = "Show Records";
		$data['tables'] = $this->admin_model->get_tables();
		// if ($user_type == 'User'){
  //                 $dataqs = $this->admin_model->get_table_data_by_user($tid, $user_id);
  //       }
		// if ($user_type == 'District Admin'){
  //                 $dataqs = $this->admin_model->get_table_data_by_distrct_admin($tid, $items);
  //       }
  //       if ($user_type == 'SuperAdmin' || $user_type == 'Admin'){
  //                 $dataqs = $this->admin_model->get_table_data_by_admin($tid);
  //             }

		$this->load->view('templates/header_new');
		$this->load->view('pages/show_data_by_user', $data);
		$this->load->view('templates/footer');

	}

	public function show_foreign(){   
		$data['title'] = "Show Records";

		$this->load->view('templates/header_new');
		$this->load->view('pages/show_foreign_by_user', $data);
		$this->load->view('templates/footer');
	}

	public function sa16(){   
		$data['title'] = "Show Records";

		$this->load->view('templates/header_new');
		$this->load->view('pages/sa18', $data);
		$this->load->view('templates/footer');
	}

	public function sa16_update(){ 
		$this->load->model('post_model');  
		$data['title'] = "Show Records";
		$y = $this->uri->segment(3);
		$data['y'] = $y;
		$table_name="wump_annex_04_sa_18_vdc_social_economic_info";
		$arr="vdc_socio_economic_id";
		$data['district_info'] = $this->post_model->toUpdateRecord($table_name,$y,$arr);
		$table_name="wump_annex_04_sa_18_festivals";
		$arr="vdc_socio_economic_id";
		$data['district_infos'] = $this->post_model->toUpdateRecord($table_name,$y,$arr);	

		$this->load->view('templates/header_new');
		$this->load->view('pages/sa18_update', $data);
		$this->load->view('templates/footer');
	}

	public function delete_sa18($id){
		$this->load->model('post_model');
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$tbl_name = 'wump_annex_04_sa_18_vdc_social_economic_info';
		
 		$result=$this->post_model->delete_sa16($tbl_name, $id);
 		if($result==1){
 			
 			$this->session->set_flashdata('post_deleted', 'रेकर्ड मेटाउन सफल भयो !!');
 			redirect ('displayrecords/socio_economic_info');
 			}else{
     		echo 'failed';
  		}   
	}
	
	public function export_pdf(){ 
		$this->load->helper('pdf_helper');  
		$data['title'] = "Show Records";

		$this->load->view('pages/export_pdf', $data);
	}

	

}