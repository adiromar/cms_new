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
               $tbl_title = $key['title'];

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
            <div class="row">
            <?php

            foreach ($fields as $key => $value) 
            { ?>
            <!-- Main loop -->
            <?php if($value == 'VARCHAR'): ?>  
                
                <div class="col-md-6 mt-4">
                    <label for="" class="control-label"><?= ucfirst($key) ?>:</label>
                    <input type="text" class="form-control" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'TEXT'): ?>

                <div class="col-md-6 mt-4">
                    <label for="" class="control-label"><?= ucfirst($key) ?>:</label>
                    <textarea name="<?= $key ?>" class="form-control"></textarea>
                </div>

            <?php elseif(strpos($value,'radio') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-6 mt-4">
                <label for="" class="control-label"><?= ucfirst($key) ?>:</label><br>
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
            <div class="col-md-6 mt-4">
                <label for="" class="control-label"><?= ucfirst($key) ?>:</label><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val) 
                            { ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="<?= $key ?>[]" value="<?= $val ?>">
                                    <label class="form-check-label form-control-label" name="<?= $key ?>"><?= $val ?></label>
                                </div>
                <?php       }
                ?>

                <?php   } ?>
                
            <?php endforeach ?>
                </div>

            <?php elseif(strpos($value,'dropdown') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-6 mt-4">
                <label for="" class="control-label"><?= ucfirst($key) ?>:</label><br>
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
            <div class="row">
            <?php 
            $tbname = $table_data[0]['title'];
            $foreign = $this->page_model->get_foreigntable($tbname);

            if (!empty($foreign)) 
            {
                foreach ($foreign as $key) 
                {
                    
                    $sectable = $key['sec_table'];
                echo "<h2 class='col-md-12 mt-4'>".$sectable."</h2>";
                    $secid = $key['sec_key'];

                    $foreign_table = $this->page_model->get_table_by_id($secid);

                    $fields = $foreign_table[0]['fields'];
                    $types = $foreign_table[0]['types'];
                    $fields = explode(',', $fields);
                    $types = explode(',', $types);
            
                    $fields = array_combine($fields, $types);

                    foreach ($fields as $key => $value) { ?>

                            <!-- Main loop -->
            <?php if($value == 'VARCHAR'): ?>  
                
                <div class="col-md-6 mt-4">
                    <label for="" class="control-label"><?= ucfirst($key) ?>:</label>
                    <input type="text" class="form-control" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'TEXT'): ?>

                <div class="col-md-6">
                    <label for="" class="control-label"><?= ucfirst($key) ?>:</label>
                    <textarea name="<?= $key ?>" class="form-control"></textarea>
                </div>

            <?php elseif(strpos($value,'radio') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-6 mt-4">
                <label for="" class="control-label"><?= ucfirst($key) ?>:</label><br>
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
                    <?php   }                
                        } ?>
                
            <?php endforeach ?>
            </div>

            <?php elseif(strpos($value,'checkbox') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-6 mt-4">
                <label for="" class="control-label"><?= ucfirst($key) ?>:</label><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val) 
                            { ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="<?= $key ?>[]" value="<?= $val ?>">
                                    <label class="form-check-label form-control-label" name="<?= $key ?>"><?= $val ?></label>
                                </div>
                <?php       }
                ?>

                <?php   } ?>
                
            <?php endforeach ?>
                </div>

            <?php elseif(strpos($value,'dropdown') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-6 mt-4">
                <label for="" class="control-label"><?= ucfirst($key) ?>:</label><br>
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

                <?php    }
                }//for every forign table
                    
            }//check if there is foreign table  
            ?>
            </div>
            <?php $tid = $this->uri->segment(3,1);  ?>
            <input type="hidden" name="tablename" value="<?= $tid ?>">
            <input class="btn btn-info col-md-4 offset-6 mt-4" type="submit" value="submit">
        </form>
        <!--End Form Here-->
<?php   }  ?>
    </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->