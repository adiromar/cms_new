<?php
// echo $t_name.'<br/>';
// echo $tid;
$pri_id = $this->admin_model->get_table_by_title($t_name);
$pp_id = $pri_id[0]['id'];

echo '<h4 class="ml-4">Multiple Form Records</h4>';
echo '<table class="table table-bordered table-checked mr-4" style="background-color: #fff;">';
// echo '<pre>';
foreach ($fk as $sm) {
                    $pk = $sm['sec_key'];
                    // echo $pk;
                    $foreign_tables = $this->admin_model->get_table_by_id($pk);
                    
                    $titles =array();
                    foreach ($foreign_tables as $for_tbl) {
                    	$table =$for_tbl['title'];
                         $idd =$for_tbl['id'];
                         $for_tbl_title = $for_tbl['display_name'];
                         // print_r($foreign_tables);
                         $titles[] = $for_tbl_title;

                    	$fields =$for_tbl['fields'];
                    	$fields = explode(',', $fields);
                    	$nepali =$for_tbl['nepali_title'];
                    	$nepali = explode(',', $nepali);
                    	foreach ($nepali as $nep => $np) {
                    		if( strpos( $np, 'legend' ) === 0 ) {
        					unset( $nepali[ $nep ] );
    							}
                    	}

                    	if ($pk == $for_tbl['id']){
                    		echo '<tr>';
                    		$fdata = $this->admin_model->get_for_table_data_by_id($table,$pp_id,$tid);
                    		
                              $data =array();$cc=0;
                    		foreach ($fdata as $key => $val) {
                                   $cc = $key;
                                   
                    			// print_r($key);
                    			
                    			// unset($val['id']);unset($val['user_id']);unset($val['primary_id']);unset($val['primary_data_id']);
                                   unset($fdata[$key]['id']);unset($fdata[$key]['user_id']);unset($fdata[$key]['primary_id']);unset($fdata[$key]['primary_data_id']);
                    			// print_r($key);
                    			// print_r($fdata);
                    			// foreach ($val as $vvv => $vv) {
                    			// 	$dat = explode(',', $vv);
                    			// 	$data[] = $vv;
                    			// 	// $data[$key][] = $dat;
                    			// }
                    			
                    			// print_r($val);
                    		}
                              // print_r($fdata);
                    	    // print_r($nepali);die;
                         // print_r($data);die;
                         // $mix = array_combine($data, $nepali);
                              // $mix = array_combine($nepali, $data);
                              // print_r($mix);
                         
                         foreach ($nepali as $dat => $head) {

                              echo '<th style="background: #3c8fe2;color: #fff;" class="mt-5">'.$head.'</th>';   
                              // echo '<td>'.$data[$key].'</td>';     
                              
                              // echo '<br/>';
                         }
                         echo '</tr>';
                         // data fetch
                         
                         // print_r($data); 
                                   foreach ($fdata as $keyy => $vals) {
                                        // print_r($fdata);
                                        echo '<tr>';
                                       foreach ($vals as $k_key => $d_val){
                                       // print_r($d_val);
                                       // echo '<td>'.$d_val.'</td>';
                                        echo '<td>'.$d_val.'</td>';
                                        }
                                        echo '</tr>';
                                   }
                              // echo $all;
                              // echo '<td>'.$lval.'</td>';
                         
                         // echo '<br/>';
                    	} // if condition
                    }
                  }
echo '</table>';

?>