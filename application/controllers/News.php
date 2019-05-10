<?php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->model('page_model');
                $this->load->model('admin_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
        $data['title'] = 'Add Relation Page';

        $data['groups'] = $this->news_model->get_form_title();
        $data['groups1'] = $this->news_model->get_form_title_mul();
        $data['frm_ids'] = $this->news_model->get_table_id();
        $data['results'] = $this->news_model->show_relation();
        $this->load->view('includes/header');
        $this->load->view('news/index', $data);
        $this->load->view('includes/footer');
        }

      public function info(){
      $data['title'] = 'New Relation Page - Step 1';
      
      $data['groups'] = $this->news_model->get_form_title();
      $data['test'] = $this->news_model->get_for_table_names();
      $data['results'] = $this->news_model->show_relation();

      $this->load->view('includes/header');
      $this->load->view('news/relation', $data);
      }

      public function get(){
      $data['title'] = 'New Relation Page - Step 2';
      $data['groups'] = $this->news_model->get_form_title();
      $data['results'] = $this->news_model->show_relation();

      $this->load->view('includes/header');
      $this->load->view('news/get', $data);
      }

      public function test(){
  //echo "add relation ";
// print_r($_POST);die;
                $hid_title = $this->input->post('hid_title');
                // print_r($hid_title);die;
                $sec_table =$this->input->post('sec_tbl');
                // echo $sec_table;
                $form_type = $this->input->post('form_type');
                $val =$this->input->post('sec_value');
                $val = implode(',', $val);

                $primary =$this->input->post('primary_tbl');
                // echo $primary;
                $key = $this->admin_model->get_id_by_title($sec_table);
                $key1 = $key[0]->id;
                // echo $key1;
                $primary_key =$this->input->post('pr_key');
                $data = array(
                    'sec_table'=>$sec_table,
                    'sec_key' => $key1,
                    'form_type' => $form_type,
                    'primary_table' =>$primary,
                    'field' => $val
                );

                $this->load->model('post_model');
                $d = $this->post_model->check_primary_and_foreign_tables($primary, $key1);
                $upd_id = $d[0]['id'];
                // print_r($d);
                 if(empty($d)){

                    $dd = $this->admin_model->check_relation($key1);
                    // echo "rel is : " ;print_r($dd);die;
                    if($dd === 0 || $dd === 1){
                      
                        $alter = $this->post_model->alter_primary_table($primary, $val );
                        if ($alter === true) {
                        $this->db->insert('relationships',$data);
                        $this->session->set_flashdata('post_created', 'Relationship added to tables.');
                        }else{
                          redirect('news/info');
                        $this->session->set_flashdata('post_not_created', 'There was some error. No relationship added. Please try again.');
                        }   
                    }else{

                        $this->db->insert('relationships',$data);
                        $this->session->set_flashdata('post_created', 'Relationship added to tables.');
                    }
                
                }else{
                  // echo "Hello";die;

                  $alter1 = $this->post_model->alter_primary_table($primary, $val);
                  if ($alter1 === true) {
                        // $this->db->set('field', "CONCAT(field,', ','".$val."')", FALSE);
                        $this->db->where('id', $upd_id);
                        $this->db->set('field', 'CONCAT(field,\',\',\''.$val.'\')', FALSE);
                        $this->db->update('relationships');

                        $this->session->set_flashdata('post_updated', 'Relationship updated to tables '.$primary.'. ');
                        redirect('news/info');
                        
                        }
                  
                    
                }
               $this->session->set_flashdata('post_not_created', 'This relation already exists.');
                redirect ('news/info');
             

    }

      public function filter(){
        $t = $this->input->post('depart');
        $lists = $this->db->list_fields($t);
        $data[] = $this->$lists;
        // header("Content-Type: application/json");
        $value = json_encode($lists, JSON_FORCE_OBJECT);

        $this->load->view('news/test', $value);
       redirect('news/test', $data);
      }

      public function multiple_fetch(){
        $data['tid'] = $_POST['id'];
        $data['t_name'] = $_POST['name'];
        $t_name = $_POST['name'];
        
        $data['fk'] = $this->admin_model->get_foreign_table_of_primary_table_mul($t_name);
        // echo '<pre>';
        
        if(!empty($data['fk'])){
          $this->load->view('pages/list_multiple', $data);
        }
      }

      public function tests(){
        print_r($_POST['id']);

        print_r($theId);
        echo "data";die;
      }
        
}

