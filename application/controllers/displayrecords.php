<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class displayrecords extends CI_Controller {

public function __Construct()
	{
		// $this->ci =& get_instance();
		parent::__Construct();
		$this->load->helper("url");
		$this->load->model("record_display_model");
		$this->load->library('pagination');
		$this->load->model('user_model');
		//$this->load->library('myclass');
		
	}
public function show(){
	echo "sf";die;
}

public function socio_economic_info()
	{
		$user_id = $this->session->userdata("user_id");
		$user_type = $this->session->userdata("user_type");
		
		$data['display_reocrds'] = $this->record_display_model->getRecordByUserID("wump_annex_04_sa_18_vdc_social_economic_info", $user_id, $user_type);
		$data['festivals'] = $this->record_display_model->getRecordByUserID("wump_annex_04_sa_18_festivals", $user_id, $user_type);
		$data['site_title'] = "गा.बि.स.को भौगोलिक तथा प्राकृतिक जानकारी विवरण";
		if($user_type=='verifier'){
		$this->load->view("includes/verifier_header", $data);
		}else{
		$this->load->view("templates/header_new");	}
		// $this->load->view("includes/vdc_filter_form", $this->data);
		$this->load->view("pages/show_SA_18", $data);
		$this->load->view("includes/footer");
	
	}

}



?>