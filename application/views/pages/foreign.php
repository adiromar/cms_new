<?php
$user_id = $this->session->userdata('user_id'); 
// echo $user_id;die;
$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<?php if($this->session->flashdata('post_created')):
    echo '<p style="text-align: center" class="alert alert-success">'.$this->session->flashdata('post_created').'</p>';
  endif; ?>

<?php if($this->session->flashdata('post_not_created')):
    echo '<p style="text-align: center" class="alert alert-warning">'.$this->session->flashdata('post_not_created').'</p>';
  endif; ?>
  
<div id="page-content-wrapper" style="padding: 5px;">
    <div class="container-fluid">
        <!-- <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="fa" class="fas fa-arrow-alt-circle-left"></i>&nbsp;</a> -->

      <?php
        if (!empty($table_data1))
        { ?>
<div class="heading_title">  
      <h4 style='text-align: center; color: #337AB7;'><?= $table_data1[0]['display_name'] ?></h4>
  </div>  
            <?php
            // echo "<h2 style='text-align: center; color: #337AB7;'>".$table_data1[0]['display_name']."</h2>";
            $fields = $table_data1[0]['fields']; //echo $fields;
            $types = $table_data1[0]['types'];
            $nep = $table_data1[0]['nepali_title'];
            $foreign_id = $table_data1[0]['id'];
            $fields = str_replace('_', ' ', $fields);
            $fields = explode(',', $fields);
            $types = explode(',', $types);
            $nep = explode(',', $nep);

            $fields = array_combine($fields, $types);

        ?>

        <form action="<?php echo base_url(); ?>posts/insert_foreign" method="post" class="form_color">
            <div class="row mb-5">
            <?php
            $i = 0;
            foreach ($fields as $key => $value)
            { ?>
            <!-- Main loop -->
            <?php if($value == 'legend'): ?>
                <?php echo '</div>' ?>
               <?php echo '<div class="row col-md-12 main-row first_form">' ?>
                <div class="col-md-12 legend-border pl-0" style="margin-top: -32px;">
                <div class="col-md-12" style="">
                    <label for="" class="control-label"><p><?= ucfirst($key) ?></p></label>
                    <!-- <input type="hidden" class="form-control" value="123_legend" name="<?= $key ?>"> -->
                </div></div>
            <?php elseif($value == 'INT'): ?>
                <div class="col-md-2 mt-2">
                    <label for="" class="control-label"><?php echo $nep[$i] ?> :
                    <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?></b></label>
                    <input type="number" class="form-control" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'VARCHAR'): ?>

                <div class="col-md-4 mt-2">
                    <label for="" class="control-label"><?php echo $nep[$i] ?> :
                    <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label>
                    <input type="text" class="form-control" name="<?= $key ?>" style="width: 295px;">
                </div>
            <?php elseif($value == 'TEXT'): ?>

                <div class="col-md-6 mt-2">
                    <label for="" class="control-label"><?php echo $nep[$i] ?> :
                    <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label>
                    <textarea name="<?php echo $key; ?>" class="form-control" cols="50" rows="3"></textarea>
                </div>

            <?php elseif(strpos($value,'radio') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="col-md-2 mt-2">
                <label for="" class="control-label"><?php echo $nep[$i] ?>:
                <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
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
                <label for="" class="control-label"><?php echo $nep[$i] ?> :
                <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
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

            <div class="col-md-4 mt-2">
                <label for="" class="control-label"><?php echo $nep[$i] ?> :
                <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
            <?php foreach ($table_values as $k): ?>

                <?php if ($value == $k['name'])
                        {
                            $vals = explode('|', $k['vals']);
                ?>
                <select name="<?= $key ?>" class="form-control" style="width:295px;">
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

            <?php endif; $i++; ?>


            <!-- end of Main loop -->
            <?php }  ?>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
  			<input type="hidden" name="tablename" value="<?= $foreign_id ?>">
            <input type="hidden" name="str" value="<?= $str ?>">
            <input class="btn btn-info col-md-3 offset-9 mt-4" type="submit" value="SUBMIT">
 			</form>
		<?php }else{ ?>
 <div class="mt-5">
        <div class="heading_title">  
            <h4 style='text-align: center; color: red;'>रेकर्ड दाखिला गर्नको लागि - साझा फारम</h4>
        </div>  
        <div class="col-md-11 ml-3" style="padding: 25px;">
            <ul class="list-items">
        <?php
               $data['table_names1'] = $this->page_model->get_for_table_names();

               foreach ($table_names1 as $key) {
                // print_r($table_names1);
               $tbl_id = $key['id'];
               $tbl_title = $key['title'];
               $tbl_title1 = $key['display_name'];               
                ?>
                <li class="home_form1">
                    <a href="<?php echo base_url(); ?>pages/get_for_table_by_id/<?= $tbl_id ?>"><?= $tbl_title1 ?></a>
                </li>

            <?php }  ?>
            </ul>
        </div>
    </div>

   <?php }  ?>
	</div>
</div>


