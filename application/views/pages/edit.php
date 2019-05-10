<div id="page-content-wrapper">
    <div class="container-fluid">
        <!-- <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="fa" class="fas fa-arrow-alt-circle-left"></i>&nbsp;</a>
        <a href="<?php echo base_url(); ?>admins/index" class="btn btn-success">Admin</a> -->
        <!--Start Form Here-->
        <?php         
        if (!empty($table_data)) 
        { ?>
            <div class="heading_title">  
      <h4 style='text-align: center; color: #337AB7;'>Update: <?= $table_data[0]['display_name'] ?></h4>
      <h6 style='text-align: center; color: #337AB7;'><?= $table_data[0]['subtitle'] ?></h6>
  </div> 
  <style type="text/css">
  .main-row .col-md-4 , .col-md-7{
    padding: 5px 15px;
  }
  .main-row input select{
    margin-top: 10px;
  }
.input_size input{
    width: 200px;
  }
  .dotted_border{
    border: 1px dotted;
    padding: 4px;
  }
  </style>
  <?php
            // echo "<h2>Update: ".$table_data[0]['display_name']."</h2>";
            $fields = $table_data[0]['fields']; //echo $fields;
            $types = $table_data[0]['types'];
            $form_type = $table_data[0]['form_type'];
            // $fields = str_replace('_', ' ', $fields);
            $p_id = $table_data[0]['id'];
            $fields = explode(',', $fields);
            $types = explode(',', $types);
            $nep = $table_data[0]['nepali_title'];
            $nep = explode(',', $nep);
            $title = $table_data[0]['title'];
            // print_r($form_type);die;
            $fields = array_combine($fields, $types);
            $p_title = $table_data[0]['title'];
        ?>

<form action="<?php echo base_url(); ?>posts/update" method="post" style="background: #fff;">
<?php
$tbname = $table_data[0]['title'];
$foreignn = $this->page_model->get_foreigntable_for($tbname);

$count_for = count($foreignn);

for ($i=0; $i < $count_for; $i++) {
if (!empty($foreignn[$i])){
            ?>
            <div class="row col-md-12 first_form" style="padding: 20px; margin: 20px; width: 97%;"><?php
$skey = $foreignn[0]['sec_key'];
$sho = $this->page_model->get_table_by_id($skey);
$f = $sho[0]['fields'];
$n = $sho[0]['nepali_title'];
$f = explode(',', $f);
$n = explode(',', $n);
$arr_com = array_combine($f, $n);
$sec_table = $foreignn[$i]['sec_table'];

$chunk = $foreignn[$i]['field'];
$t = explode(',', $chunk);
if (!empty($foreignn))
            {
                foreach ($t as $vvv)
                { 
                    $result = $this->page_model->get_data_for_field($vvv, $sec_table);
                    // echo '<pre>';
                    // print_r($result[3][$vvv]);
                    $valres = $this->admin_model->get_table_data_by_id($table_data[0]['title'], $d_id);
                    // print_r($valres[0][$vvv]);
                    foreach ($valres as $valr => $vr) {
                        // print_r($vr);

                    ?>
                    <div class="col-md-3">
                    <label class="mr-2"><?php 
                    foreach ($arr_com as $f => $n){
                            if ($vvv == $f){
                                echo $n;//echo $vr[$f];
                            }
                        }
                        //echo $vvv; ?></label>
                    
                    <select class="form-control" name="field_data[]">
                        <option><?= $valres[0][$vvv] ?></option>
                    <?php 
                    foreach ($result as $res => $r) {
                        $p = implode(',', $r);
                        // print_r($p); 
                        ?>
                        <option><?php echo $p; ?></option><?php } ?>
                    </select></div>
                    <!-- <input type="hidden" name="field_data[]" value="<?= $p ?>"> -->
                    <input type="hidden" name="field_name[]" value="<?= $vvv ?>">
               <?php } } } ?></div><?php } } ?>


    <div class="row after-add-more" style="padding-bottom: 34px; margin: 20px;">

            <?php
            $i = 0;
            foreach ($fields as $key => $value) 
                // print_r($fields);die;
            { ?>
            <!-- Main loop -->
        
<?php 
// print_r($key);die();
$res = $this->admin_model->get_table_data_by_id($table_data[0]['title'], $d_id);

foreach ($res as $ress => $info) {
?>


<!-- <input class="form-control" type="hidden" name="" value="<?= $info[$key]?>"> -->

             <?php if($value == 'legend'): ?>
                <?php echo '</div>' ?>
               <?php echo '<div class="row col-md-12 main-row second_title" style="">' ?>
                <div class="col-md-12 legend-border pl-0">
                <div class="col-md-12 fieldset" style="text-transform: uppercase;">
                    <label for="" class="control-label"><p class="foreign_title"><?php $key1 =  str_replace('_', ' ', $key);
                    echo ucfirst($key1) ?></p></label>
                </div></div>

            <?php elseif($value == 'INT'): ?>

                <div class="ml-2 mr-4 mt-2 input_size">
                    <label for="" class="control-label"><?php echo $nep[$i] ?>:</label>
                    <!-- <label for="" class="control-label"><?= ucfirst($key) ?></label> -->
                    <input type="number" class="form-control" name="<?= $key ?>" value="<?= $info[$key] ?>">
                </div>
            <?php elseif($value == 'hidden'): ?>

                <div class="ml-2 mr-4 mt-2 input_size">
                    <!-- <label for="" class="control-label"><?php echo $nep[$i] ?>:</label> -->
                    <!-- <label for="" class="control-label"><?= ucfirst($key) ?></label> -->
                    <input type="text" class="form-control" name="hidden" value="~hidden">
                </div>
                
            <?php elseif($value == 'VARCHAR'): ?> 
                
                <div class="ml-2 mr-4 mt-2 input_size">
                    <label for="" class="control-label"><?php echo $nep[$i] ?>:</label>
                    <!-- <label for="" class="control-label"><?= ucfirst($key) ?>:</label> -->
                    <input type="text" class="form-control" name="<?= $key ?>" value="<?= $info[$key] ?>">
                </div>
               
            <?php elseif($value == 'TEXT'): ?>

                <div class="col-md-12 col-xs-6">
                    <label for="" class="control-label"><?php echo $nep[$i] ?>:</label>
                    <!-- <label for="" class="control-label"><?= ucfirst($key) ?>:</label> -->
                    <textarea name="<?php echo $key; ?>" value="<?= $info[$key] ?>" class="form-control"><?= $info[$key] ?></textarea>
                </div> 

            <?php elseif(strpos($value,'radio') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="ml-2 mr-4 mt-2 dotted_border">
                <label for="" class="control-label"><?php echo $nep[$i] ?>:</label>
                <!-- <label for="" class="control-label"><?= ucfirst($key) ?>:</label>--><br> 
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val) 
                            { ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="<?= $key ?>" value="<?= $val ?>"<?php if($val == $info[$key]){
            echo ' checked ';}?>>
                                    <label class="form-check-label form-control-label" value="<?= $val ?>"><?= $val ?></label>
                                </div>
                <?php  } } ?>
                
                <?php endforeach ?>

                </div>

            <?php elseif(strpos($value,'checkbox') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="ml-2 mr-4 mt-2 dotted_border">
                <label for="" class="control-label"><?php echo $nep[$i] ?>:</label>
                <!-- <label for="" class="control-label"><?= ucfirst($key) ?>:</label> --><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val) 
                            { 
                                // print_r($info[$key]);
                                $t = explode('|_|',$info[$key]);
                                // print_r($t);die;
                                ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" 
                                    name="<?php echo $key.'[checkbox]'; ?>[]" value="<?= $val ?>"<?php if($val == $info[$key]){
            echo ' checked ';}?>>
                                    <label class="form-check-label form-control-label" name="<?= $key ?>"><?= $val ?></label>
                                </div>
                <?php       }
                ?>

                <?php } ?>
                
            <?php endforeach ?>
                </div>

            <?php elseif(strpos($value,'dropdown') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="ml-2 mr-4 mt-2">
                <label for="" class="control-label"><?php echo $nep[$i] ?>:</label>
               <!--  <label for="" class="control-label"><?= ucfirst($key) ?>:</label> --><br>
            <?php foreach ($table_values as $k): ?>
                
                <?php if ($value == $k['name'])
                        { 
                            $vals = explode('|', $k['vals']);
                ?>
                <select name="<?= $key ?>" class="form-control" value="<?= $key ?>">
                    <option value="">Select</option>
                
                <?php
                            foreach ($vals as $val) 
                            { ?>
                                <option <?php if ($info[$key] == $val){ ?> selected="selected" <?php }?> value="<?= $val ?>"><?= $val ?></option>
                                
                <?php       }
                ?>
                </select>
                <?php } ?>
                
            <?php endforeach ?>
                </div>

            <?php endif; $i++;?>
            <?php } ?>
            <!-- end of Main loop -->
            <?php } ?>
</div>
<div class="clearfix left"></div>
<?php 
            $tbname = $table_data[0]['title'];
            // echo $tbname;
            $foreign_table = $this->page_model->get_foreigntable_mul($tbname);

             
            if (!empty($foreign_table)) 
            {   
                foreach ($foreign_table as $key) 
                    
                { ?>
                <!-- <div class="row morew mt-4" style="border: 1px solid #9e9191;padding-bottom: 20px; clear: left; "> -->
                <?php
                    $sectable = $key['sec_table'];
                    
                    $secid = $key['sec_key'];

                    $foreign_table = $this->page_model->get_table_by_id($secid);
                    // echo "foreign id is :" . $foreign_table[0]['id'];   

                    $foreign_table_values = $this->page_model->get_table_values_by_id($secid);
                    // print_r($foreign_table_values);
                    // echo "<h2 class='col-md-12 mt-4'>".$foreign_table[0]['display_name']."</h2>";

                    $foreign_id = $foreign_table[0]['id'];
                    // echo $foreign_id;
                    $foreign_tbl_name = $foreign_table[0]['title'];
                    // echo $foreign_tbl_name;
                    $fields = $foreign_table[0]['fields'];
                    $types = $foreign_table[0]['types'];
                    $fr = $foreign_table[0]['id'];
                    // echo $fr;
                    $fields = explode(',', $fields);
                    $types = explode(',', $types);
                    $nep = $foreign_table[0]['nepali_title'];
                    $nep = explode(',', $nep);
                    $fieldss = array_combine($fields, $types);
                    // echo "<pre>";
                    // print_r($table_values);
                    // echo "uid ".$uid;
                    $dat = $this->admin_model->get_table_by_title($foreign_tbl_name);
                // print_r($dat[0]['id']);

                    $count_table = $this->page_model->find_foreign_no_of_tbl_for_edit($foreign_tbl_name, $d_id, $p_id);
                    // print_r($count_table);
                    if (!empty($count_table)) {
                        $cou = count($count_table);
                        $y = $count_table[0]['id'];
                    }else{
                        $cou = 0;
                    }
                    
                    // print_r($p_id);
                    $single_for = $this->page_model->edit_foreign_id($foreign_tbl_name, $d_id, $p_id);
               ?>
               
    <div class="second_title"> 
<?php for ($j=0; $j < $cou; $j++) { ?>
     <div class="row morew mt-4 second_title" style="padding-bottom: 20px;">
                <?php
                    echo "<p class='col-md-12 mt-4 foreign_title'>".$foreign_table[0]['display_name']."</p>";
                    // print_r($y);
                    // print_r($foreign_table_values);
                    $i = 0;
                    foreach ($fieldss as $keys => $values) { ?>
<?php
// echo $secid;
$res = $this->admin_model->get_table_data_by_id($foreign_table[0]['title'], $y);
// print_r($res);die;
foreach ($res as $ress => $info) {
    // echo '<pre>';
    // print_r($info);

?>
                        <!-- Main loop -->
                <?php if($values == 'legend'): ?> 
                <?php //echo '</div>' ?>
                <?php //echo '<div class="row col-md-12 main-row" style="">' ?>
                <div class="col-md-12 legend-border pl-0 mt-3">
                <div class="col-md-12 fieldset" style="">
                    <label for="" class="control-label"><p style="font-size: 16px;"><?= ucfirst($keys) ?></p></label>
                </div></div>

                        <?php elseif($values == 'INT'): ?>  
                            
                            <div class="ml-2 mr-4 mt-2 input_size">
                                <label for="" class="control-label"><p><?php echo $nep[$i] ?> :</p></label>
                                <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> -->
                                <input type="number" class="form-control" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" value="<?= $info[$keys] ?>">
                            </div>
                        <?php elseif($values == 'FLOAT'): ?>  
                            
                            <div class="ml-2 mr-4 mt-2 input_size">
                                <label for="" class="control-label"><p><?php echo $nep[$i] ?> :</p></label>
                                <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> -->
                                <input type="number" class="form-control" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" value="<?= $info[$keys] ?>">
                            </div>

                        <?php elseif($values == 'VARCHAR'): ?>  
                            
                            <div class="ml-2 mr-4 mt-2 input_size">
                                <label for="" class="control-label"><p><?php echo $nep[$i] ?> :</p></label>
                                <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> -->
                                <input type="text" class="form-control" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" value="<?= $info[$keys] ?>">
                            </div>
                        <?php elseif($values == "file"): ?>
                            <div class="ml-2 mr-5">
                            
                            <img id="myImg" style="width: 150px; height: 150px;" src="<?php echo base_url().'uploads/'.$info[$keys];?>" alt="View File" />
                            <div>
                            <a href="<?php echo base_url().'uploads/'.$info[$keys];?>" class="btn btn-secondary" download><i class="fas fa-download"></i> Download File</a>
                            </div>
                            </div>
                            
                            <div class="mt-3">
                                <label>नयाँ नक्शा:</label>
                                <input type="file" name="userfile" class="form-control fsize mt-2" >
                            </div>
                        <?php elseif($values == 'TEXT'): ?>

                            <div class="col-md-12">
                                <label for="" class="control-label"><p><?php echo $nep[$i] ?></p></label>
                                <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> -->
                                <textarea name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" value="<?= $info[$keys] ?>" class="form-control"></textarea>
                            </div>

                        <?php elseif(strpos($values,'radio') !== FALSE): ?>

                        <div class="ml-2 mr-4 mt-2 dotted_border">
                            <label for="" class="control-label"><p><?php echo $nep[$i] ?></p></label>
                            <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> --><br>
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
                        <div class="ml-2 mr-4 mt-2 dotted_border">
                            <label for="" class="control-label"><p><?php echo $nep[$i] ?></p></label>
                            <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> --><br>
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
                        <div class="ml-2 mr-4 mt-2 input_size">
                            <label for="" class="control-label"><p><?php echo $nep[$i] ?></p></label>
                            <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> --><br>
                        <?php foreach ($foreign_table_values as $k): ?>
                            
                            <?php if ($values == $k['name'])
                                    { 
                                        $vals = explode('|', $k['vals']);
                            ?>
                            <select name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" class="form-control">
                                <option value="<?= $info[$keys] ?>">Select</option>
                            
                            <?php
                                        foreach ($vals as $val) 
                                        { ?>
                                            <!-- <option value="<?= $val ?>"><?= $val ?></option> -->

                                            <option <?php if ($info[$keys] == $val){ ?> selected="selected" <?php }?> value="<?= $val ?>"><?= $val ?></option>
                                            
                            <?php } ?>
                            </select>
                            <?php } ?>
                            
                        <?php endforeach ?>
                            </div>

                        <?php endif; 
                //end of Main loop
                        $i++;
                    } } ?>

               <input type="hidden" name="foreign_table[]" value="<?= $foreign_id ?>">
               <input type="hidden" name="tbl_data_id[]" value="<?= $info['id'] ?>">
               <input type="hidden" name="foreign_table_id[]" value="<?= $y ?>">
        </div>

    <?php $y++;
 }  ?>
 </div>
       <!-- </div> -->
            <?php } //for every foreign table?>
               
 </div>

        <?php } //check if there is foreign table   ?>

      <?php $tid = $this->uri->segment(3,1);  ?>
            <input type="hidden" name="tablename" value="<?= $tid ?>">
            <input type="hidden" name="form_type" value="<?= $form_type ?>">
            <input type="hidden" name="tableid" value="<?= $d_id ?>">
            <input type="hidden" name="p_title" value="<?= $p_title ?>">
            <!-- <input class="btn btn-info col-md-2 offset-6 mt-4 mb-4" style="float: right;" type="submit" value="Update"> -->
            <button type="button" class="btn btn-primary btn-sm offset-5 mt-4 mb-4" data-toggle="modal" data-target="#exampleModalCenter">अपडेट गर्नुहोस</button>

             <!-- Modal starts -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Changes ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">फारम अपडेट गर्नुहोस |</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">रद गर्नुहोस</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <input class="btn btn-primary" type="submit" value="अपडेट गर्नुहोस">
      </div>
    </div>
  </div>
</div> <!-- modal ends here -->

        </form>
  </div>
</div>


<!-- The Modal -->
<div id="myModal" class="modall">
  <span class="closeit">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<?php } ?>

<style>
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modall {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.closeit {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.closeit:hover,
.closeit:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>

<script type="text/javascript">
    // for image modal
    // Get the modal 
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeit")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>
