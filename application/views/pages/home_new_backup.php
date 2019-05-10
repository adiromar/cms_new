    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Available Forms
                </a>
            </li>
            <?php 
               foreach ($table_names as $key) {
               $tbl_id = $key['id'];
               $tbl_title1 = $key['title'];
               $tbl_title = str_replace('_', ' ', $tbl_title1);

            //Check if the table is a foreign table
               $relation_numrows = $this->page_model->get_relations($tbl_id);
               if ($relation_numrows > 0) {
                   
               }else{ ?>
                
                <li class="home_form">
                    <a href="<?php echo base_url(); ?>pages/get_table_by_id/<?= $tbl_id ?>"><?= $tbl_title ?></a>
                </li>

            <?php   }
            ?>
                
            <?php
               }
            ?>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
<?php if($this->session->flashdata('post_created')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; 
  endif; ?>

<?php if($this->session->flashdata('post_not_created')): 
    echo '<p class="alert alert-warning">'.$this->session->flashdata('post_not_created').'</p>'; 
  endif; ?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="fa" class="fas fa-arrow-alt-circle-left"></i>&nbsp;</a>
        <a href="<?php echo base_url(); ?>admins/index" class="btn btn-success">Admin</a>
        <!--Start Form Here-->
        <?php         
        if (!empty($table_data)) 
        {
            echo "<h2>".$table_data[0]['display_name']."</h2>";
            $fields = $table_data[0]['fields']; //echo $fields;
            $types = $table_data[0]['types'];

            $fields = explode(',', $fields);
            $types = explode(',', $types);
            
            $fields = array_combine($fields, $types);

        ?>

        <form action="<?php echo base_url(); ?>posts/insert" method="post">
            <div class="row mb-5" style="background-color: #fff; padding: 15px;">
            <?php

            foreach ($fields as $key => $value) 
            { ?>
            <!-- Main loop -->
            <?php if($value == 'legend'): ?>
                <div class="col-md-12">
                <div class="col-md-12 mt-2" style="text-transform: uppercase; color: green;">
                    <label for="" class="control-label"><h4><?= ucfirst($key) ?></h4></label>
                </div></div>
            <?php elseif($value == 'INT'): ?>
                <div class="col-md-2 mt-2">
                    <label for="" class="control-label"><b><?= ucfirst($key) ?></b></label>
                    <input type="number" class="form-control" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'VARCHAR'): ?>  
                
                <div class="col-md-4 mt-2">
                    <label for="" class="control-label"><b><?php $r = ucfirst($key); 
                    $rt = str_replace('_', ' ', $r);
                    echo $rt; ?>:</b></label>
                    <input type="text" class="form-control" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'TEXT'): ?>

                <div class="col-md-10 mt-2">
                    <label for="" class="control-label"><b><?= ucfirst($key) ?>:</b></label>
                    <textarea name="<?php echo $key; ?>" class="form-control" rows="4"></textarea>
                </div>

            <?php elseif(strpos($value,'radio') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-4 mt-2">
                <label for="" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val) 
                            { ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="<?= $key ?>" value="<?= $val ?>">
                                    <label class="form-check-label form-control-label" value="<?= $val ?>"><?= $val ?></label>
                                </div>
                <?php       }
                ?>

                <?php   } ?>
                
            <?php endforeach ?>
                </div>

            <?php elseif(strpos($value,'checkbox') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-4 mt-2">
                <label for="" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val) 
                            { ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" 
                                    name="<?php echo $key.'[checkbox]'; ?>[]" value="<?= $val ?>">
                                    <label class="form-check-label form-control-label" name="<?= $key ?>"><?= $val ?></label>
                                </div>
                <?php       }
                ?>

                <?php   } ?>
                
            <?php endforeach ?>
                </div>

            <?php elseif(strpos($value,'dropdown') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-4 mt-4">
                <label for="" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                ?>
                <select name="<?= $key ?>" class="form-control">
                    <option value="">Select</option>
                
                <?php
                            foreach ($vals as $val) 
                            { ?>
                                <option value="<?= $val ?>"><?= $val ?></option>
                                
                <?php       }
                ?>
                </select>
                <?php   } ?>
                
            <?php endforeach ?>
                </div>

            <?php endif; ?>


            <!-- end of Main loop -->
            <?php } ?>
            </div>

<!-- Foreign starts here-->

            <?php 
            $tbname = $table_data[0]['title'];
            $foreign = $this->page_model->get_foreigntable($tbname);

            if (!empty($foreign)) 
            {   
                foreach ($foreign as $key) 
                { ?>
            <div class="row more mt-2" style="border: 1px solid lightgrey;padding-bottom: 20px; background-color: #fff;">
                <?php    $sectable = $key['sec_table'];
                
                    $secid = $key['sec_key'];

                    $foreign_table = $this->page_model->get_table_by_id($secid);
                    $foreign_table_values = $this->page_model->get_table_values_by_id($secid);

                    echo "<h4 class='col-md-12 mt-4'>".$foreign_table[0]['display_name']."</h4>";

                    $foreign_id = $foreign_table[0]['id'];
                    $foreign_tbl_name = $foreign_table[0]['title'];

                    $fields = $foreign_table[0]['fields'];
                    $types = $foreign_table[0]['types'];
                    $fr = $foreign_table[0]['id'];
                    
                    $fields = explode(',', $fields);
                    $types = explode(',', $types);
            
                    $fieldss = array_combine($fields, $types);
                    // echo "<pre>";
                    // print_r($table_values);
                    foreach ($fieldss as $keys => $values) { ?>

                        <!-- Main loop -->
                        <?php if($values === 'INT'): ?>
                            <div class="col-md-2 mt-4">
                                <label for="" class="control-label"><b><?= ucfirst($keys) ?>:</b></label>
                                <input type="number" class="form-control" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]">
                            </div>
                        <?php elseif($values == 'VARCHAR'): ?>  
                            
                            <div class="col-md-4 mt-4">
                                <label for="" class="control-label"><b><?= ucfirst($keys) ?>:</b></label>
                                <input type="text" class="form-control" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]">
                            </div>
                        <?php elseif($values == 'TEXT'): ?>

                            <div class="col-md-12">
                                <label for="" class="control-label"><b><?= ucfirst($keys) ?>:</b></label>
                                <textarea name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" class="form-control"></textarea>
                            </div>

                        <?php elseif(strpos($values,'radio') !== FALSE): ?>

                        <div class="col-md-4 mt-4">
                            <label for="" class="control-label"><b><?= ucfirst($keys) ?>:</b></label><br>
                        <?php foreach ($foreign_table_values as $k): ?>
                            
                            <?php if ($values == $k['name'])
                                    { 
                                        $vals = explode('|', $k['vals']);
                                        foreach ($vals as $val) 
                                        { ?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" value="<?= $val ?>">
                                                <label class="form-check-label form-control-label"><?= $val ?></label>
                                            </div>
                                <?php   }                
                                    } ?>
                            
                        <?php endforeach ?>
                        </div>

                        <?php elseif(strpos($values,'checkbox') !== FALSE): ?>

                            <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
                        <div class="col-md-4 mt-4">
                            <label for="" class="control-label"><b><?= ucfirst($keys) ?>:</b></label><br>
                        <?php foreach ($foreign_table_values as $k): ?>
                            
                            <?php if ($values == $k['name'])
                                    { 
                                        $vals = explode('|', $k['vals']);
                                        foreach ($vals as $val) 
                                        { ?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" 
                                                name="<?php echo $keys.'['.$foreign_id.'][checkbox]'; ?>[]" value="<?= $val ?>">
                                                <label class="form-check-label form-control-label"><?= $val ?></label>
                                            </div>
                            <?php       }
                            ?>

                            <?php   } ?>
                            
                        <?php endforeach ?>
                            </div>

                        <?php elseif(strpos($values,'dropdown') !== FALSE): ?>

                            <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
                        <div class="col-md-4 mt-4">
                            <label for="" class="control-label"><b><?= ucfirst($keys) ?>:</b></label><br>
                        <?php foreach ($foreign_table_values as $k): ?>
                            
                            <?php if ($values == $k['name'])
                                    { 
                                        $vals = explode('|', $k['vals']);
                            ?>
                            <select name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" class="form-control">
                                <option value="">Select</option>
                            
                            <?php
                                        foreach ($vals as $val) 
                                        { ?>
                                            <option value="<?= $val ?>"><?= $val ?></option>
                                            
                            <?php       }
                            ?>
                            </select>
                            <?php   } ?>
                            
                        <?php endforeach ?>
                            </div>

                        <?php endif; 
                //end of Main loop

                    } ?>
               <input type="hidden" name="foreign_table[]" value="<?= $foreign_id ?>">
               <p style="float: right;"><a href="#" class='removeempsection btn btn-danger rt'>Remove</a>
            </div>
 <?php 
    $query = $this->page_model->get_frn_id();

        foreach ($query as $r) {
           $fid = $r['table_id'];
           //echo $fid;echo $fr;
           if($fr == $fid){

?>
<p class="mt-4" style="float: right;"><a href="#" class='addempsection btn btn-success rt'>Add</a></p>
<?php } } ?>
            <?php } //for every foreign table
                    
            } //check if there is foreign table  
            ?>
            
            <?php $tid = $this->uri->segment(3,1);  ?>
            <input type="hidden" name="tablename" value="<?= $tid ?>">
            <input class="btn btn-info col-md-4 offset-6 mt-4" type="submit" value="SUBMIT">
        </form>
        <!--End Form Here-->
<?php   }  ?>
    </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
        //define template
    var template = $('.container-fluid .more:last').clone();
                    
        var sectionsCount = 1;
            //add new section
            $('body').on('click', '.addempsection', function() {

                //increment
                sectionsCount++;

                //loop through each input
                var section = template.clone().find('.j_year').each(function(){

                //set id to store the updated section number
                    var newId = this.id + sectionsCount;

                //update for label
                $(this).prev().attr('for', newId);

                //update id
                this.id = newId;

            }).end()

            //inject new section
                .appendTo('.more');
                section.show();
                section.removeClass('defaultsection');
                return false;
            });
         //remove section
                    $('.container-fluid').on('click', '.removeempsection', function() {
                        //fade out section
                        $(this).parent().fadeOut(300, function(){
                            //remove parent element (main section)

                            $(this).parent().empty();
          
                            return false;
                        });
                        return false;
                    });
</script>



//  posts.php backup

public function insert()
{
        
        $tablename = $_POST['tablename'];
        $foreign_table = $_POST['foreign_table'];
        
        unset($_POST['tablename']);
        unset($_POST['foreign_table']);

        $data = $_POST;
        // echo "<pre>";
        // print_r($data);die;
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
            //      echo '<pre>';
            // print_r($value);
                    foreach($value as $single => $k){
     // echo $single;die;
     // echo $k;
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
        // print_r($key);die();
        //Get name of table using ID
        $tname = $this->post_model->get_table_name_by_id($tablename);
        $tname = strtolower($tname);
        
        // $this->post_model->insert_form($tname , $field_data);
        if ($this->post_model->insert_form($tname , $field_data) === true) {
            

            //Get the primary data id
            $result = $this->post_model->get_inserted_primary_data_id($tname)->row();
            // print_r($result);die();
            $primary_data_id = $result->id;
            
            //foreach foreign table
            // echo '<pre>';
            // print_r($foreign_tbl);
            // echo '</pre>';

            foreach ($foreign_tbl as $foreignkey => $value) {
                // echo '<pre>';
                // print_r($value);die();
                // echo '</pre>';
                
                foreach ($value as $key => $x) {
                    if (is_array($x)) {
                        if (!empty($x['checkbox']) && is_array($x['checkbox'])) {
                            $xx = implode('|_|', $x['checkbox']);
                            $value[$key]=$xx;
                        }
                    }
                }
                // echo '<pre>';
                // print_r($value);die();
                $arr = array('primary_id' => $tablename);
                $value = array_merge($value, $arr);

                $arr2 = array('primary_data_id' => $primary_data_id);
                $value = array_merge($value, $arr2);
                // echo '<pre>';
                // print_r($value);die();
                
                $f_tname = $this->post_model->get_table_name_by_id($foreignkey);
                // echo '<pre>';
                // print_r($value);die();
                // print_r($f_tname);die();
                $this->post_model->insert_form($f_tname,$value);

            }
            // die();
            

            $this->session->set_flashdata('post_created', 'Record Inserted in <strong>'.$tname.'</strong> table');
            redirect ('home');

        }else{
            $this->session->set_flashdata('post_not_created', 'There was some relationship error. Please try again.');
            redirect ('home');
        }
}