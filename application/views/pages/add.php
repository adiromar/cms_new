<div class="copy-fields" style="display: none;">
    <div class="row minus mb-5" style="border: 2px solid #e2dede; padding-bottom: 34px; margin-top: 12px;">
<?php
            //echo "<h2>".$table_data[0]['display_name']."</h2><br><br>";
            foreach ($fields as $key => $value) 
            { ?>
            <!-- Main loop -->
           <?php if($value == 'INT'): ?>
                <div class="col-md-2 mt-2">
                    <label for="" class="control-label"><b><?= ucfirst($key) ?></b></label>
                    <input type="number" class="form-control" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'VARCHAR'): ?>  
                
                <div class="col-md-4 mt-2">
                    <label for="" class="control-label"><b><?= ucfirst($key) ?>:</b></label>
                    <input type="text" class="form-control" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'TEXT'): ?>

                <div class="col-md-10 mt-2">
                    <label for="" class="control-label"><b><?= ucfirst($key) ?>:</b></label>
                    <textarea name="<?php echo $key; ?>" class="form-control" rows="4"></textarea>
                </div>

            <?php elseif(strpos($value,'radio') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-3 mt-2">
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
                <label for="" class="control-label"><?= ucfirst($key) ?>:</label><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                ?>
                <select name="<?= $key ?>[]" class="form-control">
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

            <div class="input-group-btn" style="float: right; margin-top: 58px;"> 
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
            </div></div> <!-- end of copy fields -->


<div class="copy-fields1" style="display: none;">
    <div class="show1 mt-4" style="border: 1px solid lightgrey;padding-bottom: 20px; clear: left;">
   <?php 
            $tbname = $table_data[0]['title'];
            $foreign = $this->page_model->get_foreigntable($tbname);

            if (!empty($foreign)) 
            {   
                foreach ($foreign as $key) 
                {
                    
                    $sectable = $key['sec_table'];
                
                    $secid = $key['sec_key'];

                    $foreign_table = $this->page_model->get_table_by_id($secid);
                    $foreign_table_values = $this->page_model->get_table_values_by_id($secid);

                    echo "<h2 class='col-md-12 mt-4'>".$foreign_table[0]['display_name']."</h2>";

                    $foreign_id = $foreign_table[0]['id'];
                    $foreign_tbl_name = $foreign_table[0]['title'];

                    $fields = $foreign_table[0]['fields'];
                    $types = $foreign_table[0]['types'];
                    $fields = explode(',', $fields);
                    $types = explode(',', $types);
            
                    $fieldss = array_combine($fields, $types);
                    // echo "<pre>";
                    // print_r($table_values);
                    foreach ($fieldss as $keys => $values) { ?>

                        <!-- Main loop -->
                        <?php if($value == 'INT'): ?>
                        <div class="col-md-2 mt-2">
                         <label for="" class="control-label"><b><?= ucfirst($key) ?></b></label>
                        <input type="number" class="form-control" name="<?= $key ?>[]">
                        </div>
                    <?php elseif($value == 'VARCHAR'): ?>   
                            
                            <div class="col-md-4 mt-4">
                                <label for="" class="control-label"><?= ucfirst($keys) ?>:</label>
                                <input type="text" class="form-control" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]">
                            </div>
                        <?php elseif($values == 'TEXT'): ?>

                            <div class="col-md-4">
                                <label for="" class="control-label"><?= ucfirst($keys) ?>:</label>
                                <textarea name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" class="form-control"></textarea>
                            </div>

                        <?php elseif(strpos($values,'radio') !== FALSE): ?>

                        <div class="col-md-4 mt-4">
                            <label for="" class="control-label"><?= ucfirst($keys) ?>:</label><br>
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
                            <label for="" class="control-label"><?= ucfirst($keys) ?>:</label><br>
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
                            <label for="" class="control-label"><?= ucfirst($keys) ?>:</label><br>
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
                    <div class="input-group-btn" style="float: right; margin-top: 58px;"> 
              <button class="btn btn-danger remove1" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>

               <input type="hidden" name="foreign_table[]" value="<?= $foreign_id ?>">
        
            <?php } //for every foreign table
               
            } //check if there is foreign table  
            ?>

    </div>
</div>