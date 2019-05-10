<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

public function insert()
{
		// echo '<pre>'; 
		// print_r($_POST);die;
		// echo '</pre>';
		$tablename = $_POST['tablename'];
		$foreign_table = $_POST['foreign_table'];
		
		unset($_POST['tablename']);
		unset($_POST['foreign_table']);

		$data = $_POST;

		$this->load->model('post_model');

		foreach ($_POST as $key => $value) 
		{	
			
			if (is_array($value)) {
			
				if (!empty($value['checkbox']) && is_array($value['checkbox'])) 
				{
					$v = implode('|_|', $value['checkbox']);
					$field_data[$key] = $v;

					unset($_POST[$key]);
					
				}else{

					foreach($value as $single => $k){

	 //echo $single;
	 //echo $k;
	 //echo $key;		
						if(!empty($foreign_table)){
						foreach ($foreign_table as $fkey) {

							if ($single == $fkey) {
								$foreign_tbl[$fkey][$key]=$k;

								}
							}
						}
					}
					
				}
			}else{

				$field_data[$key]=$value;
				unset($_POST[$key]);	
			}
			// print_r($value);
		}				

		//Get name of table using ID
		$tname = $this->post_model->get_table_name_by_id($tablename);
		$tname = strtolower($tname);
		
		// $this->post_model->insert_form($tname , $field_data);
		if ($this->post_model->insert_form($tname , $field_data) === true) {
			

			//Get the primary data id
			$result = $this->post_model->get_inserted_primary_data_id($tname)->row();
			$primary_data_id = $result->id;
			
			//foreach foreign table
			// print_r($foreign_tbl);

			$items = array();
	foreach ($foreign_tbl as $foreignkey => $value) {

				echo '<pre>';
				foreach ($value as $key => $x) {
				$c = count($x);
				// print_r($c);die;

					$first_names = array_column($foreign_tbl, $key);
					// print_r($first_names);die;
					if (is_array($x)) {
						if (!empty($x['checkbox']) && is_array($x['checkbox'])) {
							$xx = implode('|_|', $x['checkbox']);
							$value[$key]=$xx;
						}else{	
					for ($count = 0; $count < $c; $count++) {
							$res =array_column($value, $count);
						$a = array_keys($value);
						$b = array_combine($a,$res);
						$out = array('primary_id' => $tablename);
					$value1 = array_merge($b, $out);
					$arr2 = array('primary_data_id' => $primary_data_id);
					$value1 = array_merge($value1, $arr2);
					
					$items[] = $value1;
				
							}
							
						}
					}	
					$count++;

				}				
			}
			// print_r($items);

			for ($i=0; $i < $c; $i++) { 
				echo "jasjj<br>";
				$f_tname = $this->post_model->get_table_name_by_id($foreignkey);
				 $this->post_model->insert_form($f_tname,$items[$i]);
			}
			// die();
			

			$this->session->set_flashdata('post_created', 'Record Inserted in <strong>'.$tname.'</strong> table & <strong>'.$f_tname.'</strong> table');
			redirect ('home');

		}else{
			$this->session->set_flashdata('post_not_created', 'There was some relationship error. Please try again.');
			redirect ('home');
		}
}

public function add_relation(){
  //echo "add relation ";

 		if(!empty($_POST['sec_tbl']) && $_POST['primary_tbl'] == 'Select')
            {
              	$this->session->set_flashdata('post_not_created', 'Please Select Proper Field List. No relationship added.');
    			redirect ('news/index');
                
            }
            else
            {
 				$sec_table =$this->input->post('sec_tbl');
			    $primary =$this->input->post('primary_tbl');
			    $sec_key =$this->input->post('foreign_tbl');
			    $primary_key =$this->input->post('pr_key');
			    $data = array(
			        'sec_table'=>$sec_table,
			        'sec_key' => $sec_key,
			        //'primary_key' => $primary_key,
			        'primary_table' =>$primary
			    );

			    $this->load->model('post_model');
			    $d = $this->post_model->check_primary_and_foreign_tables($primary, $sec_key);
			    if(empty($d)){

			    	$dd = $this->admin_model->check_relation($sec_key);
			    	if($dd === 0){
				    	$alter = $this->post_model->alter_foreign_table($sec_table);
				    	if ($alter === true) {
	   					$this->db->insert('relationships',$data);
	   					$this->session->set_flashdata('post_created', 'Relationship added to tables.');
	   					}else{
	   					$this->session->set_flashdata('post_not_created', 'There was some error. No relationship added. Please try again.');
	   					}	
			    	}else{
			    		$this->db->insert('relationships',$data);
	   					$this->session->set_flashdata('post_created', 'Relationship added to tables.');
			    	}
   				
			    }else{
			    	$this->session->set_flashdata('post_not_created', 'This relation already exists.');
			    }
			   
   				
   				


   				
  				redirect ('news/index');
 			} 

	}

/*public function insert()
{
		/*echo "<pre>"; 
		print_r($_POST);
		die();
		$tablename = $_POST['tablename'];
		if(!empty($_POST['foreign_table'])){
		$foreign_table = $_POST['foreign_table'];
		}


		unset($_POST['tablename']);
		unset($_POST['foreign_table']);

		
		$data = $_POST;
		//print_r($data);die();
		$this->load->model('post_model');

		foreach ($_POST as $key => $value) 
		{
			 echo '<pre>';
			 print_r($value);die();
			 echo '</pre>';
			if (is_array($value)) {
			
				if (!empty($value['checkbox']) && is_array($value['checkbox'])) 
				{
					$v = implode('|_|', $value['checkbox']);
					$field_data[$key] = $v;
					unset($_POST[$key]);
					
				}else{

					foreach($value as $single => $k){
	// echo $single;
	// echo $k;
	// echo $key;	
					if(!empty($foreign_table)){
							foreach ($foreign_table as $fkey) {
								if ($single == $fkey) {
									$foreign_tbl[$fkey][$key]=$k;

								}
							}
						}
					}
					
				}
			}else{

				$field_data[$key]=$value;
				unset($_POST[$key]);	
			}
			
		}//for each $_POST
		//print_r($field_data);die();
		//Get name of table using ID
		$tname = $this->post_model->get_table_name_by_id($tablename)->title;

		$tname = strtolower($tname);
		// die();
		if ($this->post_model->insert_form($tname , $field_data) === true) {
			

			//Get the primary data id
			$result = $this->post_model->get_inserted_primary_data_id($tname)->row();
			$primary_data_id = $result->id;
			
			//foreach foreign table
			// print_r($foreign_tbl);
			
			foreach ($foreign_tbl as $foreignkey => $value) {


				// print_r($value);
				$count=0;
				foreach ($value as $key => $val) {
					// print_r($val);

					 foreach ($val as $k => $values) {
					 	// echo $k;
					 	// print_r($values);
					
					
					 	if (!empty($val['checkbox']) && is_array($val['checkbox'])) {
					 		$ks[] = implode(',', $values);
					 		// print_r($ks);					 		// unset($k);
					 		// $count--;
					 		$x[$count] = $ks;
					 	}else{
					 		 $x[$count] = array_column($value, $count);
					 	}
					  }
					
					 // echo $foreignkey;
					 $f_tname = $this->post_model->get_table_name_by_id($foreignkey)->title;
					  // echo $f_tname;
					 $f_fields = $this->post_model->get_table_name_by_id($foreignkey)->fields;
					 $f_fields = explode(',', $f_fields);
					 // print_r($f_fields);
					 // print_r($x[$count]);

					
					 $a = array_combine( $f_fields, $x[$count]);
					
					print_r($a);
					$arr = array('primary_id' => $tablename);
					$a = array_merge($a, $arr);
					$arr2 = array('primary_data_id' => $primary_data_id);
					$a = array_merge($a, $arr2);
					// print_r($a);
					$this->post_model->insert_form($f_tname,$a);
					 $count++;



				}

			}
			$this->session->set_flashdata('post_created', 'Your data has been inserted');
			redirect ('home');
		}else{
			$this->session->set_flashdata('post_not_created', 'There was some relationship error. Please try again.');
			redirect ('home');
		}
}
*/
	public function update()
{
		echo '<pre>'; 
		// print_r($_POST);die;
		// echo '</pre>';
		
		$tablename = $_POST['tablename'];
		$foreign_table = $_POST['foreign_table'];
		$table_id = $_POST['tableid'];
		$p_title = $_POST['p_title'];
		$foreign_table_id = $_POST['foreign_table_id'];
		$u = implode(' ', $foreign_table_id);
		$v = explode(' ', $u);
		// print_r($v);die;

		unset($_POST['tablename']);
		unset($_POST['foreign_table']);
		unset($_POST['tableid']);
		unset($_POST['p_title']);
		
		$data = $_POST;
		// print_r($data);
		$this->load->model('post_model');

		foreach ($_POST as $key => $value) 
		{	
			
			if (is_array($value)) {
			
				if (!empty($value['checkbox']) && is_array($value['checkbox'])) 
				{
					$v = implode('|_|', $value['checkbox']);
					$field_data[$key] = $v;

					unset($_POST[$key]);
					
				}else{
					
					foreach($value as $single => $k){

	 //echo $single;
	 //echo $k;
	 //echo $key;		
						if(!empty($foreign_table)){
						foreach ($foreign_table as $fkey) {

							if ($single == $fkey) {
								$foreign_tbl[$fkey][$key]=$k;

								}
							}
						}
					}
				  
				}
			}else{

				$field_data[$key]=$value;
				unset($_POST[$key]);	
			}
			
		}	
		//Get name of table using ID
		$tname = $this->post_model->get_table_name_by_id($tablename);
		$tname = strtolower($tname);
		
		// $this->post_model->insert_form($tname , $field_data);
		if ($this->post_model->update_form($tname , $field_data, $table_id) === true) {
			

			//Get the primary data id
			$result = $this->post_model->get_inserted_primary_data_id($tname)->row();
			$primary_data_id = $result->id;
			
			//foreach foreign table
			// print_r($foreign_tbl);die;

			$items = array();
	foreach ($foreign_tbl as $foreignkey => $value) {

				foreach ($value as $key => $x) {
				$c = count($x);
					
					if (is_array($x)) {
						if (!empty($x['checkbox']) && is_array($x['checkbox'])) {
							$xx = implode('|_|', $x['checkbox']);
							$value[$key]=$xx;
						}else{	
							
					for ($count = 0; $count < $c; $count++) {
							$res =array_column($value, $count);
							
							$a = array_keys($value);
							$b = array_combine($a,$res);
					$items[] = $b;
							}
							
						}
					}	
					$count++;

				}				
				
			}
			// print_r($items);
$vv = current($v);
	// echo $vv;die;
			$no = $vv;	
			for ($i=0; $i < $c; $i++) { 
				// echo "jasjj<br>";
				$f_tname = $this->post_model->get_table_name_by_id($foreignkey);

				 $this->post_model->update_form($f_tname,$items[$i], $no);
				 $no++;
		}
		
			// die();
			

			$this->session->set_flashdata('post_updated', 'Record updated in <strong>'.$tname.'</strong> table with Id '.$table_id.' ');
			redirect ('admins/show_data/'.$p_title.'');

		}else{
			$this->session->set_flashdata('post_not_created', 'There was some relationship error. Please try again.');
			redirect ('home');
		}
}


}