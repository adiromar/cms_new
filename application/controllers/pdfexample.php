<?php 
class pdfexample extends CI_Controller{
      function __construct() { 
 parent::__construct();
 } 
     
     function index(){
     	$data['title'] = "Show Records";
		$this->load->library('Pdf');
		$this->load->view('includes/pdf', $data);
      }
}
?>