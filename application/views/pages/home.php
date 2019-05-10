<?php
$user_id = $this->session->userdata('user_id'); 
$user_type = $this->session->userdata('user_type'); 
// echo $user_id;die;
$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<style media="screen">
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
    <!-- Sidebar -->
    <!-- <div id="sidebar-wrapper">
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
               $tbl_title1 = $key['display_name'];
            //Check if the table is a foreign table
               $relation_numrows = $this->page_model->get_relations($tbl_id);
               if ($relation_numrows > 0) {

               }else{ ?>

                <li class="home_form">
                    <a href="<?php echo base_url(); ?>pages/get_table_by_id/<?= $tbl_id ?>"><?= $tbl_title1 ?></a>
                </li>

            <?php   }
            ?>

            <?php
               }
            ?>
        </ul>
    </div> -->
    <!-- /#sidebar-wrapper -->


<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">

<?php if($this->session->flashdata('post_created')):
    echo '<p style="text-align: center" class="alert alert-success">'.$this->session->flashdata('post_created').'</p>';
  endif; ?>

<?php if($this->session->flashdata('post_not_created')):
    echo '<p style="text-align: center" class="alert alert-warning">'.$this->session->flashdata('post_not_created').'</p>';
  endif; ?>
<?php if($this->session->flashdata('update_error')):
    echo '<p style="text-align: center" class="alert alert-warning">'.$this->session->flashdata('update_error').'</p>';
  endif; ?>

        <!-- <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="fa" class="fas fa-arrow-alt-circle-left"></i>&nbsp;</a>
        <a href="<?php echo base_url(); ?>admins/index" class="btn btn-success">Admin</a> -->
        <!--Start Form Here-->
        <?php
        if (!empty($table_data))
        { ?>
    <div class="heading_title">  
        <p class="float-left"><a href="<?php echo base_url(); ?>pages/home"><i class="fas fa-arrow-circle-left"></i></a></p>
      <h4 style='text-align: center; color: #337AB7;'><?= $table_data[0]['display_name'] ?></h4>
      <h6 style='text-align: center; color: #337AB7;'><?= $table_data[0]['subtitle'] ?></h6>
  </div>    
  <?php
            $fields = $table_data[0]['fields']; //echo $fields;
            $types = $table_data[0]['types'];
            $nep = $table_data[0]['nepali_title'];
            $tbl_title = $table_data[0]['title'];

            $fields = str_replace('_', ' ', $fields);
            $fields = explode(',', $fields);
            $types = explode(',', $types);
            $nep = explode(',', $nep);
            // echo '<pre>';
            // print_r($nep);die;
            $fields = array_combine($fields, $types);

        ?>

        <form class="form_color" action="<?php echo base_url(); ?>posts/insert" method="post" id="form" enctype="multipart/form-data">
            <?php
$tbname = $table_data[0]['title'];
$foreignn = $this->page_model->get_foreigntable_for($tbname);
$count_for = count($foreignn);

for ($i=0; $i < $count_for; $i++) { 

if (!empty($foreignn[$i])){
            ?>
            <div class="row col-md-12 col-sm-9 first_form" style=""><?php

$sec_table = $foreignn[$i]['sec_table'];
$sec_id = $foreignn[$i]['sec_key'];

$sho = $this->page_model->get_table_by_id($sec_id);
// print_r($sho);
$f = $sho[0]['fields'];
$n = $sho[0]['nepali_title'];
$f = explode(',', $f);
$n = explode(',', $n);
$arr_com = array_combine($f, $n);

// print_r($arr_com);die;
$chunk = $foreignn[$i]['field'];
// print_r($chunk);die;
$t = explode(',', $chunk);
if (!empty($foreignn))
            {
                foreach ($t as $vvv)
                { 
                    $result = $this->page_model->get_data_for_field($vvv, $sec_table);
                    // print_r($result);
                    $t = str_replace('_', ' ', $vvv);
                    ?>
                    <div class="col-md-3">
                    <label class="mr-2"><?php 
                    foreach ($arr_com as $f => $n){

                            if ($vvv == $f){
                                echo $n;
                            }
                        }
                        //echo $t; ?>: </label>
                    <select class="form-control" name="field_data[]">
                    <?php 
                    foreach ($result as $res => $r) {
                        $p = implode(',', $r);
                        //print_r($p); ?>
                        <option><?php echo $p; ?></option><?php } ?>
                    </select></div>
                    <!-- <input type="hidden" name="field_data[]" value="<?= $p ?>"> -->
                    <input type="hidden" name="field_name[]" value="<?= $vvv ?>">
               <?php }  } ?></div><?php } } ?>

            <div class="row mb-5" style="background-color: white;">
            <?php
            $i = 0;
            foreach ($fields as $key => $value)
                // print_r($value);die;
            { ?>
            <!-- Main loop -->
            <?php if($value == 'legend'): ?> 
                <?php echo '</div>' ?>
               <?php //if (ucfirst($key) == "EMJNFDJN"){
               echo '<div class="row col-md-12 main-row second_title" style="">' ?>
           <?php // } ?>
                <div class="col-md-12 legend-border pl-0">
                <div class="col-md-12 fieldset" style="">
                    <label for="" class="control-label"><p style="font-size: 16px;"><?= ucfirst($key) ?></p></label>
                    <!-- <input type="hidden" class="form-control" value="123_legend" name="<?= $key ?>"> -->
                </div></div>
            <?php elseif($value == 'INT'): ?>
                <div class="ml-2 mr-4 input_size">
                    <label class="control-label fsize"><?php echo $nep[$i] ?> :
                    <label for="" style="display:none;" class="control-label"><?= ucfirst($key) ?></label>
                    <input type="number" class="form-control fsize" name="<?= $key ?>">
                </div>
            <?php elseif($value == 'hidden'): ?>
                <div class="col-md-2">
                    <!-- <label for="" class="control-label"><?php echo $nep[$i] ?> : -->
                    <!-- <label for="" style="display:none;" class="control-label"><?= ucfirst($key) ?></label> -->
                    <!-- <input type="text" class="form-control" name="hidden" value="~hidden"> -->
                </div>
            <?php elseif($value == 'VARCHAR'): ?>

                <div class="ml-2 mr-4 input_size">
                    <label for="" class="control-label fsize"><?php echo $nep[$i] ?> :
                    <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label>
                    <input type="text" class="form-control fsize" name="<?= $key ?>" style="width: 265px;">
                </div>
            <?php elseif($value == 'TEXT'): ?>
                <div class="col-md-12">
                    <label for="" class="control-label fsize"><?php echo $nep[$i] ?> :
                    <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label>
                    <textarea name="<?php echo $key; ?>" class="form-control fsize" cols="50" rows="3"></textarea>
                </div>
            <?php elseif(strpos($value,'radio') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="ml-2 mr-4 dotted_border">
                <label for="" class="control-label fsize"><?php echo $nep[$i] ?>:
                <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
            <?php foreach ($table_values as $k): ?>

                <?php if ($value == $k['name'])
                        {
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val)
                            { ?>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-control-label fsize" value="<?= $val ?>"><?= $val ?> <input class="form-check-input" type="radio" name="<?= $key ?>" value="<?= $val ?>">
                                    </label>
                                </div>
                <?php       }
                ?>

                <?php   } ?>

            <?php endforeach ?>
                </div>

            <?php elseif(strpos($value,'checkbox') !== FALSE): ?>

                <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
            <div class="ml-2 mr-4 dotted_border">
                <label for="" class="control-label fsize"><?php echo $nep[$i] ?> :
                <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
            <?php foreach ($table_values as $k): ?>

                <?php if ($value == $k['name'])
                        {
                            $vals = explode('|', $k['vals']);
                            foreach ($vals as $val)
                            { ?>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-control-label fsize" name="<?= $key ?>"><?= $val ?> <input class="form-check-input" type="checkbox"
                                    name="<?php echo $key.'[checkbox]'; ?>[]" value="<?= $val ?>">
                                    </label>
                                </div>
                <?php       }
                ?>

                <?php   } ?>

            <?php endforeach ?>
                </div>

            <?php elseif(strpos($value,'dropdown') !== FALSE): ?>

            <div class="ml-2 mr-4">
                <label for="" class="control-label fsize"><?php echo $nep[$i] ?> :
                <label for="" style="display:none;" class="control-label"><b><?= ucfirst($key) ?>:</b></label><br>
            <?php foreach ($table_values as $k): ?>

                <?php if ($value == $k['name'])
                        {
                            $vals = explode('|', $k['vals']);
                ?>
                <select name="<?= $key ?>" class="form-control" style="width:265px;">
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
            <?php } ?>
            </div>


<!-- Multiple input form part starts here -->
            <?php
            $u = 1;
            $a = 1;
            $tbname = $table_data[0]['title'];
            $foreign = $this->page_model->get_foreigntable_mul($tbname);
            // $for = $foreign[0]['secid_table'];
            // echo '<pre>';
            // print_r($foreign[0]['sec_table']);die;
            if (!empty($foreign))
            {
            $form_type = $foreign[0]['form_type'];
            // echo $form_type;die;
            if ($form_type == "multiple_form"){
            
                foreach ($foreign as $key)
                { ?>
                    <div class="before_multiple">
            <div class="row more<?php echo $u; ?> mt-4 multiple_form">
                <?php    $sectable = $key['sec_table'];

                    $secid = $key['sec_key'];

                    $foreign_table = $this->page_model->get_table_by_id($secid);
                    $foreign_table_values = $this->page_model->get_table_values_by_id($secid);

                    echo "<h4 class='col-md-12 legend-border ' style='margin-top: -21px; font-size: 16px;'>".$foreign_table[0]['display_name']."</h4>";
                    echo "<h6 class='col-md-12' style='font-size: 16px; color: #ee691e'>".$foreign_table[0]['subtitle']."</h6>";

                    $foreign_id = $foreign_table[0]['id'];
                    $foreign_tbl_name = $foreign_table[0]['title'];

                    $fields = $foreign_table[0]['fields'];
                    $types = $foreign_table[0]['types'];
                    $fr = $foreign_table[0]['id'];
                    $nep = $foreign_table[0]['nepali_title'];

                    $fields = str_replace('_', ' ', $fields);
                    $fields = explode(',', $fields);
                    $types = explode(',', $types);

                    $nep = explode(',', $nep);
                    // echo '<pre>';
                    // print_r($nep);die;
                    $fieldss = array_combine($fields, $types);
                    // echo "<pre>";
                    // print_r($table_values);
                    $i = 0;
                    foreach ($fieldss as $keys => $values) { ?>

                        <!-- Main loop -->
                        <?php if($values == 'legend'): ?> 
                <?php  //echo '</div>' ?>
               <?php  //echo '<div class="row col-md-12 main-row second_title" style="">' ?>
                <div class="col-md-12 legend-border pl-0 mt-3">
                <div class="col-md-12 fieldset" style="">
                    <label for="" class="control-label"><p style="font-size: 16px;"><?= ucfirst($keys) ?></p></label>
                    <!-- <input type="hidden" class="form-control" value="123_legend" name="<?= $key ?>"> -->
                </div></div>

                        <?php elseif($values === 'INT'): ?>
                            <div class="ml-2 mr-4 mt-2 input_size">
                                <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> -->
                                <label for="" class="control-label fsize"><?php echo $nep[$i] ?> :
                                <input type="number" class="form-control fsize" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]">
                            </div>

                        <?php elseif($values == 'VARCHAR'): ?>

                            <div class="ml-2 mr-4 mt-2 input_size">
                                <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> -->
                                <label for="" class="control-label"><?php echo $nep[$i] ?> :
                                <input type="text" class="form-control" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]">
                            </div>
                        <?php elseif($values == 'TEXT'): ?>

                            <div class="col-md-12">
                                <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label> -->
                                <label for="" class="control-label"><?php echo $nep[$i] ?> :
                                <textarea rows="4" cols="60" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" class="form-control"></textarea>
                            </div>

                        <?php elseif($values == 'file'): ?>
                            <div class="col-md-3 dotted_border">
                            <label class="control-label fsize"><?php echo $nep[$i] ?> :
                            <input type="file" name="userfile" id="openFile" size="20" class="form-control fsize" required>
                            </div>

                        <?php elseif(strpos($values,'radio') !== FALSE): ?>

                        <div class="ml-2 mr-4 mt-2 dotted_border">
                            <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label><br> -->
                            <label for="" class="control-label"><?php echo $nep[$i] ?> :<br>
                        <?php foreach ($foreign_table_values as $k): ?>

                            <?php if ($values == $k['name'])
                                    {
                                        $vals = explode('|', $k['vals']);
                                        foreach ($vals as $val)
                                        { ?>

                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label form-control-label"><?= $val ?> <input class="form-check-input" type="radio" name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" value="<?= $val ?>">
                                                </label>
                                            </div>
                                <?php   }
                                    } ?>

                        <?php endforeach ?>
                        </div>

                        <?php elseif(strpos($values,'checkbox') !== FALSE): ?>

                            <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
                        <div class="ml-2 mr-4 mt-2 dotted_border">
                            <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label><br> -->
                            <label for="" class="control-label"><?php echo $nep[$i] ?> :<br>
                        <?php foreach ($foreign_table_values as $k): ?>

                            <?php if ($values == $k['name'])
                                    {
                                        $vals = explode('|', $k['vals']);
                                        foreach ($vals as $val)
                                        { ?>

                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label form-control-label"><?= $val ?> <input class="form-check-input" type="checkbox"
                                                name="<?php echo $keys.'['.$foreign_id.'][checkbox]'; ?>[]" value="<?= $val ?>">
                                                </label>
                                            </div>
                            <?php       }
                            ?>

                            <?php   } ?>

                        <?php endforeach ?>
                            </div>

                        <?php elseif(strpos($values,'dropdown') !== FALSE): ?>

                            <!-- <?php echo "<pre>"; print_r($table_values); ?>  -->
                        <div class="ml-2 mr-4 mt-2 input_size">
                            <!-- <label for="" class="control-label"><?= ucfirst($keys) ?>:</label><br> -->
                            <label for="" class="control-label"><?php echo $nep[$i] ?> :<br>
                        <?php foreach ($foreign_table_values as $k): ?>

                            <?php if ($values == $k['name'])
                                    {
                                        $vals = explode('|', $k['vals']);
                            ?>
                            <select name="<?php echo $keys.'['.$foreign_id.']'; ?>[]" class="form-control" style="width: 265px;">
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

                        <?php endif; $i++;
                //end of Main loop

                    } ?>
    <?php
    $query = $this->page_model->get_frn_id();

        foreach ($query as $r) {
           $fid = $r['table_id'];
           //echo $fid;echo $fr;
           if($fr == $fid){

?>
                <!-- <a href="#" style="height: 38px; position:absolute;right:70px;" class='removeempsection<?php echo $a;?> btn btn-danger rt'>-</a> -->
<?php } } ?>
               <input type="hidden" name="foreign_table[]" value="<?= $foreign_id ?>">
               
            </div>
            <div class="append_multiple<?php echo $u; ?>"></div>
 <?php
    $query = $this->page_model->get_frn_id();

        foreach ($query as $r) {
           $fid = $r['table_id'];
           //echo $fid;echo $fr;
           if($fr == $fid){

?>
<p align="right" class="mt-2 mr-3 mul_add" style=""><a href="#" class='addempsection<?php echo $a;?> btn btn-success rt'>+</a></p>
<!-- <p class="mt-2 mr-3 mul_add" style="float: right;"><a href="#" class='addempsection btn btn-success rt'>+</a></p> -->
<?php $a++;$u++; } } ?>
</div>
            <?php } //for every foreign table
                }
            } //check if there is foreign table
            ?>

            <?php $tid = $this->uri->segment(3,1);  ?>
            <input type="hidden" name="tablename" value="<?= $tid ?>">
            <input type="hidden" name="tabletitle" value="<?= $tbl_title ?>">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <input type="hidden" name="str" value="<?= $str ?>">

<?php if ($user_type != 'Guest'){ ?>
    <div class="offset-5 col-md-7 mt-4 mb-5">   
        <button id="check" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
        सेभ गर्नुहोस</button>

            <input class="btn btn-danger btn-sm" type="reset" value="रद गर्नुहोस" id="reset">
        </div>
<?php }else{} ?>

    <!-- Modal starts -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Save Changes ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">फारम सेभ गर्नुहोस |</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">रद गर्नुहोस</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <input class="btn btn-primary" type="submit" value="सेभ गर्नुहोस">
      </div>
    </div>
  </div>
</div> <!-- modal ends here -->

        </form>
        <!--End Form Here-->
<?php   }else{ ?>
    <div class="mt-5" style="margin-left: 46px;">
        <div class="heading_title">  
            <h4 style='text-align: center; color: red;'>रेकर्ड दाखिला गर्नको लागि - मुख्य फारम</h4>
        </div>  
        <div class="col-md-11 ml-3" style="padding: 25px;">
            <ul class="list-items">
        <?php
               foreach ($table_names as $key) {
               $tbl_id = $key['id'];
               $tbl_title = $key['title'];
               $tbl_title1 = $key['display_name'];
            //Check if the table is a foreign table
               $relation_numrows = $this->page_model->get_relations($tbl_id);
               if ($relation_numrows > 0) {

               }else{ ?>
                
                    <li class="home_form1">
                        <a target="_blank" href="<?php echo base_url(); ?>pages/get_table_by_id/<?= $tbl_id ?>"><?= $tbl_title1 ?></a>
                    </li>
                <?php if ($tbl_id == 37){ ?>
                    <li class="home_form1"><a target="_blank" href="<?php echo base_url(); ?>pages/sa18"><?php echo "SA-16 - गाउँपालिकाको सामाजिक-आर्थिक जानकारी"; ?></a></li>
                    <hr>
            <?php  } } }  ?>
            <li class="home_form1"><a target="_blank" href="<?php echo base_url(); ?>pages/sa18"><?php echo "SA-16 - गाउँपालिकाको सामाजिक-आर्थिक जानकारी"; ?></a></li>
            </ul>
        </div>
    </div>

   <?php }  ?>
    </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
// var cloneId = 0;
 var a = 1;             
var o = '.more1';
var lid = '.addempsection1';

  $(lid).click(function(){
    
  var delbtn = '.removeempsection1';
  var row = '.row' + l;
  var inp = "#inputt" + o;
  // alert(inp);
  var temp = $('.more1:first').clone().find('input[type=text], input[type=number], input[type=dropdown],input[type=checkbox]').val("").end();
  // var del = $('.more1:lastchild');
    $(temp).appendTo('.append_multiple1');
    console.log(temp);
    $(delbtn).click(function(){
      $(del).remove();
      temp.removeChild(temp.lastChild);
      l = l-1;
      
    });
    a = a +1;
    $("body, more1").animate({ scrollTop: $(document).height() }, "slow");
  return false;
  });

  var o = '.more2';
var lid = '.addempsection2';
var l = 1;
  $(lid).click(function(){
    
  var delbtn = '.removeempsection2';
  var row = temp;
  var inp = "#inputt" + o;
  // alert(inp);
  var temp = $('.more2:first').clone().find('input[type=text], input[type=number], input[type=dropdown],input[type=checkbox]').val("").end();
    $(temp).appendTo('.append_multiple2');
    console.log(temp);
    $(delbtn).click(function(){
      $(row).remove();
      l = l-1;
      
    });
    a = a +1;
    $("body, more2").animate({ scrollTop: $(document).height() }, "slow");
  return false;
  });

  var o = '.more3';
var lid = '.addempsection3';
var l = 1;
  $(lid).click(function(){
    
  var delbtn = '.removeempsection3';
  var row = temp;
  var inp = "#inputt" + o;
  // alert(inp);
$('.more3:first').find("input[type=radio]").each(function(index) {
        // cloneRadios.eq(index).prop("checked", this.checked);
         $(this).prop('checked',true);
});
  var temp = $('.more3:first').clone().find('input[type=text], input[type=number], input[type=dropdown],input[type=checkbox],input[type=radio]').val("").end();
  // temp.find("input[type=radio]").prop("name", "structure status[120][]" + cloneId);
  // cloneId++;
//   var cloneRadios = temp.find("input[type=radio]");
//     temp.find("input[type=radio]").each(function(index) {
//         cloneRadios.eq(index).prop("checked", this.checked);
// });
    $(temp).appendTo('.append_multiple3');
    console.log(temp);
    $(delbtn).click(function(){
      $(row).remove();
      l = l-1;
      
    });
    a = a +1;
    $("body, more3").animate({ scrollTop: $(document).height() }, "slow");
  return false;
  });

    var o = '.more4';
var lid = '.addempsection4';
var l = 1;
  $(lid).click(function(){
    
  var delbtn = '.removeempsection4';
  var row = temp;
  var inp = "#inputt" + o;
  // alert(inp);
  var temp = $('.more4:first').clone().find('input[type=text], input[type=number], input[type=dropdown],input[type=checkbox]').val("").end();
    $(temp).appendTo('.append_multiple4');
    console.log(temp);
    $(delbtn).click(function(){
      $(row).remove();
      l = l-1;
      
    });
    a = a +1;
    $("body, more4").animate({ scrollTop: $(document).height() }, "slow");
  return false;
  });

  var o = '.more5';
var lid = '.addempsection5';
var l = 1;
  $(lid).click(function(){
    
  var delbtn = '.removeempsection5';
  var row = temp;
  var inp = "#inputt" + o;
  // alert(inp);
  var temp = $('.more5:first').clone().find('input[type=text], input[type=number], input[type=dropdown],input[type=checkbox]').val("").end();
    $(temp).appendTo('.append_multiple5');
    console.log(temp);
    $(delbtn).click(function(){
      $(row).remove();
      l = l-1;
      
    });
    a = a +1;
    $("body, more5").animate({ scrollTop: $(document).height() }, "slow");
  return false;
  });

  var o = '.more6';
var lid = '.addempsection6';
var l = 1;
  $(lid).click(function(){
    
  var delbtn = '.removeempsection6';
  var row = temp;
  var inp = "#inputt" + o;
  // alert(inp);
  var temp = $('.more6:first').clone().find("input:text").val("").end();
    $(temp).appendTo('.append_multiple6');
    console.log(temp);
    $(delbtn).click(function(){
      $(row).remove();
      l = l-1;
      
    });
    a = a +1;
    $("body, more6").animate({ scrollTop: $(document).height() }, "slow");
  return false;
  });



 $(document).ready(function(){
$("#reset").click(function(){
/* Single line Reset function executes on click of Reset Button */
$("#form")[0].reset();
});});

 $(document).ready(function() {
  $('#openFile').on('change', function(evt) {
    var rt = this.files[0].size;
    console.log(this.files[0].size);
    if (rt >= 6048000){
        alert("Files size Exceeded. Upload smaller image.");
        $("#check").hide("fast");
    }
    if (rt <= 6048000){
        $("#check").show("slidedown");
    }
  });
});
</script>
 