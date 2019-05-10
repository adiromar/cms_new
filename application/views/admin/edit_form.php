<?php
// echo '<pre>';
$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$str = explode("/", $str, 6);
$sec = $str[5];
// echo $sec;die;
$data = $this->admin_model->get_table_by_id($sec);
$fields = $data[0]['fields'];
$display = ucfirst($data[0]['display_name']);
$types = $data[0]['types'];
// print_r($types);die;
$nepali_title = $data[0]['nepali_title'];

$form_type = $data[0]['form_type'];

if ($form_type == 'primary_form'){
  $frm_typ = "Primary";
}elseif ($form_type == 'foreign_form') {
  $frm_typ = "Foreign";
}elseif ($form_type ='multiple_form') {
  $frm_typ = "Multiple Input";
}else{
  
}
$old_title = $data[0]['title'];
// $fields = str_replace('_', ' ', $fields);
$fields = explode(',', $fields);

$types = explode(',', $types);
$nep = explode(',', $nepali_title);

$fields = array_combine($fields, $types);

$tbl = $this->page_model->get_values_tbl($sec);
// $res = $this->page_model->get_values_by_id($tbl[1]['id']);
// $res = $res[0]['vals'];
$vals = $this->page_model->get_table_values_by_id($sec);
if (!empty($vals)){
$val = $vals[0]['vals'];
$val = explode('|', $val);
$cou = count($tbl);

// $res = explode('|', $res);
// print_r($cou);die;
} 
?>
<main class="app-content">
<div class="app-title">
    <div>
      <h1><i class="fa fa-eye"></i> <?= $title ?></h1>
      <!-- <p>Set your Form name and Fields:</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
    </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <h4>Form Edit - <?= $display ?></h4>
            <form method="post" action="<?= base_url() ?>admins/update_form" enctype="multipart/form-data">

              <div class="form-inline" style="background-color: #f2ecec; margin: 20px 0px; padding:12px 0px;">
            <label for="title" class="control-label col-md-1">Form Name:</label>
              
            <input type="text" name="title" class="form-control col-md-3" placeholder="Database form name" value="<?= $data[0]['title'] ?>" required>
            <label for="display_name" class="control-label col-md-1">Display Name:</label>
            <input type="text" name="display_name" class="form-control col-md-3" placeholder="Form Display Name" value="<?= $data[0]['display_name'] ?>" required>
            <label for="display_name" class="control-label col-md-1 ml-2">Form Type:</label>
            <select name="form_type" class="col-md-2 form-control" value="<?= $frm_typ ?>">
              <option value="<?= $form_type ?>"><?= $frm_typ?></option>
              <option value="primary_form">Primary</option>
              <option value="foreign_form">Foreign</option>
              <option value="multiple_form">Multiple Input</option>
            </select>

             <label for="" class="control-label col-md-3 offset-2 mt-4">Sub Title:</label>
            <input type="text" name="subtitle" class="form-control col-md-3 mt-4" value="<?= $data[0]['subtitle'] ?>" >
          </div>

          <?php 
            $i = 0;
            foreach ($fields as $key => $value){ 
// print_r($fields);die;
              if ($value == "legend"):
                echo '</div>';
                echo '<div style="background-color: #f2ecec; margin: 20px 0px; padding:12px 0px;">'; ?>
            <div class="form-inline mb-3">
            <label class="control-label col-md-4 mt-3">Legend:</label>
            <input type="text" name="fields[]" value="<?= $key ?>" class="form-control col-md-5 mt-3" >
            <!-- <input type="hidden" class="form-control col-md-2" name="nepali_title[]" value="legend"> -->
            <input type="hidden" class="form-control col-md-2" name="types[]" value="legend">
            <input type="hidden" name="nepali_title[]" value="<?= $nep[$i] ?>">
          </div>
<?php $i++; ?>

      <?php elseif ($value == "VARCHAR"): ?>
        <div class="form-inline">
      <label class="control-label col-md-1">Field Name:</label>
      <input type="text" class="form-control col-md-2" name="fields[]" value="<?= $key ?>" readonly="readonly">
      <label class="control-label col-md-2">फिल्डको नाम:</label>
      <input type="text" class="form-control col-md-2" name="nepali_title[]" value="<?= $nep[$i]; ?>">
      <label class="control-label col-md-2">Type:</label>
      <select type="text" name="types[]" class="form-control col-md-2" value="<?= $value ?>">
        <option><?= $value; ?></option>
      <option value="VARCHAR">VARCHAR</option><option value="INT">INT</option>
      <option value="TEXT">TEXT</option></select>
    </div>
<?php $i++; ?>

    <?php elseif ($value == "INT"): ?>
        <div class="form-inline">
      <label class="control-label col-md-1">Field Name:</label>
      <input type="text" class="form-control col-md-2" name="fields[]" value="<?= $key ?>" readonly="readonly">
      <label class="control-label col-md-2">फिल्डको नाम:</label>
      <input type="text" class="form-control col-md-2" name="nepali_title[]" value="<?= $nep[$i] ?>">
      <label class="control-label col-md-2">Type:</label>
     
      <select type="text" name="types[]" class="form-control col-md-2" value="<?= $value ?>">
        <option><?= $value; ?></option>
      <option value="VARCHAR">VARCHAR</option><option value="INT">INT</option>
      <option value="TEXT">TEXT</option>
    </select>
    </div>
<?php $i++; ?>

     <?php elseif ($value == "TEXT"): ?>
        <div class="form-inline">
      <label class="control-label col-md-1">Field Name:</label>
      <input type="text" class="form-control col-md-2" name="fields[]" value="<?= $key ?>">
      <label class="control-label col-md-2">फिल्डको नाम:</label>
      <input type="text" class="form-control col-md-2" name="nepali_title[]" value="<?= $nep[$i] ?>">
      <label class="control-label col-md-2">Type:</label>
     
      <select type="text" name="types[]" class="form-control col-md-2" value="<?= $value ?>">
        <option><?= $value; ?></option>
      <option value="VARCHAR">VARCHAR</option><option value="INT">INT</option>
      <option value="TEXT">TEXT</option>
    </select>
    </div>
<?php $i++; ?>

<?php elseif (strpos($value, 'checkbox') !== FALSE): ?>
<div class="form-inline">
<label class='control-label col-md-1'>Field Name:</label>
<input type='text' class='form-control col-md-2' name='fields[]' value="<?= $key ?>" readonly="readonly">
<label class="control-label col-md-2">फिल्डको नाम:</label>
<input type="text" class="form-control col-md-2" name="nepali_title[]" value="<?= $nep[$i] ?>">
<label class='control-label col-md-2'>Checkbox Values:</label>
<input type="hidden" name="types[]" value="<?= $value ?>">
<?php 
  $res = $this->page_model->get_values_by_name($value, $sec);
  $val1 = $res[0]['name'];
$res = $res[0]['vals'];
$res = explode('|', $res); 
foreach ($res as $re => $r) { ?>
    <input type='text' class='form-control col-md-2 offset-9' name="values[<?= $val1 ?>][]" value="<?= $r ?>">
 <?php } ?>
</div>
<?php $i++; ?>

<?php elseif (strpos($value, 'dropdown') !== FALSE): ?>
<div class="form-inline">
<label class='control-label col-md-1'>Field Name:</label>
<input type='text' class='form-control col-md-2' name='fields[]' value="<?= $key ?>" readonly="readonly">
<label class="control-label col-md-2">फिल्डको नाम:</label>
<input type="text" class="form-control col-md-2" name="nepali_title[]" value="<?= $nep[$i] ?>">
<label class='control-label col-md-2'>Dropdown Values:</label>
<input type="hidden" name="types[]" value="<?= $value ?>">
<?php 
  $res = $this->page_model->get_values_by_name($value, $sec);
$val1 = $res[0]['name'];
$res = $res[0]['vals'];
$res = explode('|', $res);
foreach ($res as $rest => $re) { ?>
  <input type='text' class='form-control col-md-2 offset-9' name="values[<?= $val1 ?>][]" value="<?= $re ?>">
<?php } ?>

</div>
<?php $i++; ?>

<?php elseif (strpos($value, 'radio') !== FALSE): ?>
<div class="form-inline">
<label class='control-label col-md-1'>Field Name:</label>
<input type='text' class='form-control col-md-2' name='fields[]' value="<?= $key ?>" readonly="readonly">
<label class="control-label col-md-2">फिल्डको नाम:</label>
<input type="text" class="form-control col-md-2" name="nepali_title[]" value="<?= $nep[$i] ?>">
<label class='control-label col-md-2'>Radio Values:</label>
<input type="hidden" name="types[]" value="<?= $value ?>">
<?php
$res = $this->page_model->get_values_by_name($value, $sec);
$val1 = $res[0]['name']; ?>

<?php
$res = $res[0]['vals'];
$res = explode('|', $res);
foreach ($res as $rest => $re) { ?>
  <input type='text' class='form-control col-md-2 offset-9' name="values[<?= $val1 ?>][]" value="<?= $re ?>">
<?php } ?>

</div>
<?php  $i++; ?>

<?php endif; } ?>

<!-- New form question to add -->
      <div class="another" id="another" style="">
          <div class="form-inline mt-4 mb-4" id="here">
            
          </div>
      </div>
<!-- New form question to add ends-->

<!-- <input type="button" class="btn btn-info btn-sm mb-2" id="showmee" style="float: right;" value="+ Another Question"> -->
<input type="hidden" name="old_table_ttl" value="<?= $old_title ?>">
<input type="hidden" name="table_id" value="<?= $sec ?>">

          <div class="mt-4 offset-5">
              <input class="btn btn-success mt-2" type="submit" name="update" value="Update">
            </div>
            </form>
          </div>
        </div>
      </div>
</div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
$("#reset_btn").click(function(){
/* Single line Reset function executes on click of Reset Button */
$("#form")[0].reset();
});});
$(document).ready(function(){ 

var a = 1;
var x = 1;
var drop = 1;
// var i =1;

  $('#showmee').click(function(){

    // alert(a);
  var delbtn = '#delete_row' + x;
  var row = '.rownew' + x;
// alert(row);
    $('#another').append('<div class="app_div rownew' + x + '" id="another">\
          <div class="form-inline mt-4 mb-4">\
            <div class="col-md-2"></div>\
            <input type="button" class="btn btn-info btn-sm mr-2" id="add'+x+'" value="+ Input">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="addradio'+x+'" value="+ Radio">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="addcheckbox'+x+'" value="+ Checkbox">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="adddrpdwn'+x+'" value="+ Dropdown">\
          </div>\
          <div id="inputt'+x+'">\
          <div class="form-inline mt-1 row">\
      <label for="display_name" class="control-label col-md-4">Legend:</label>\
      <input type="text" name="fields[]" value="" class="form-control col-md-7" placeholder="Legend Name" required>\
      <input type="hidden" name="types[]" value="legend" class="form-control col-md-7">\
      <input type="hidden" name="nepali_title[]" value="legend" class="form-control col-md-7">\
      </div></div>\
          <div id="input'+x+'">\
            <div class="form-inline mt-2">\
            </div>\
          </div>\
          <div id="field'+x+'"></div>\
          <div id="checkbox'+x+'"></div>\
          <div id="drpdwn'+x+'"></div>\
            <b class="btn btn-outline-dark btn-sm ml-3 mt-4" id="delete_row'+x+'">-Remove Section</b></div>');
    
    $(delbtn).click(function(){
      // alert(row);
      $(row).remove();
      x = x-1;
    });
    x= x+1;

var i = "#input" + a;
var aid = "#add" + a;
var aa = 1;
  $(aid).click(function(){
    console.log(aid);console.log(i);
    // alert(i);
  var delbtn = '#delete_row' + aa;
  var row = '.row' + aa;
  var inp = "#input" + i;
  // alert(inp);
    $(i).append('<div class="form-inline mt-1 row' + aa + '">\
      <label class="control-label col-md-1">Field Name:</label>\
      <input type="text" class="form-control col-md-2" name="addfields[]" placeholder="in english" required>\
      <label class="control-label col-md-2">फिल्डको नाम:</label>\
      <input type="text" class="form-control col-md-2" name="nepali_title[]" required>\
      <label class="control-label col-md-2">Type:</label>\
      <select type="text" name="types[]" class="form-control col-md-2">\
      <option value="VARCHAR">VARCHAR</option><option value="INT">INT</option>\
      <option value="TEXT">TEXT</option></select><b class="btn btn-sm btn-danger ml-3" id="delete_row'+aa+'">-</b></div>');
    
    $(delbtn).click(function(){
      $(row).remove();
      aa = aa-1;
    });
    aa++;
  });

    //Add checkbox starts here 
 
  var che = "#addcheckbox" + a;
  var box = "#checkbox" + a;
  var chk = a;
  var z =a;
  // alert(chk);
  $(che).click(function(){
// alert(che);
// alert(box);
 
    var addme = '#checkbox' + chk;
    var delbtn2 = '#delete_checkbox' + z ;
    var delrow2 = '.rowb' + z ;
    var m = chk;
    // chk = chk + 1;

    $(box).append("<div class='form-inline mt-4 checkbox_wrapper"+chk+" rowb"+z+"'>\
      <label class='control-label col-md-1'>Field Name:</label><input type='text' class='form-control col-md-2' name='fields[]' required>\
      <label class='control-label col-md-1'>फिल्डको नाम:</label>\
      <input type='text' class='form-control col-md-2' name='nepali_title[]'' required>\
      <input type='hidden' name='types[]' value='checkbox"+m+"'><label class='control-label col-md-1'>Checkbox Values:</label>\
      <input type='text' class='form-control col-md-2' name='values[checkbox"+m+"][]' placeholder='Add Value'>\
      <input type='button' class='btn btn-outline-warning btn-sm offset-1' id='addcbox"+chk+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_checkbox"+z+"'>-</b></div><div id='checkbox"+chk+ "'>");
    $(delbtn2).click(function(){
      $(delrow2).remove();
      z = z - 1;
    });
    // z = z + 1;
    var ck = chk;
    var addcheckbox = '#addcbox'+ck;
    $(addcheckbox).click(function() {
      // alert(z);
      var addMe = '.checkbox_wrapper'+ck;
      $(addMe).append("<input type='text' class='form-control col-md-2 offset-7' name='values[checkbox"+m+"][]' placeholder='Add Value'><div id='addcheckbox"+ck+"'></div>");
      z++;
      chk++;
    });
// chk++;
  });

  // Add Radio buttons starts here
  
  var rad = "#addradio" + a;
  var fiel = "#field" + a;
  var next = a;
  var y = a; 
  $(rad).click(function(){
// alert(fiel);
// alert(rad);
   
  // alert(next);
    var addto = '#field'+ next;
    var delbtn1 = '#delete_radio' + y ;
    var delrow1 = '.rowa' + y ;
    var p = next;
    // next = next + 1 ;

    $(fiel).append("<div class='form-inline mt-4 field_wrapper"+next+" rowa"+y+"'>\
      <label class='control-label col-md-1'>Field Name:</label>\
      <input type='text' class='form-control col-md-2' name='fields[]' required></input>\
      <label class='control-label col-md-1'>फिल्डको नाम:</label>\
      <input type='text' class='form-control col-md-2' name='nepali_title[]'' required>\
      <input type='hidden' name='types[]' value='radio"+p+"'>\
      <label class='control-label col-md-1'>Radio Values:</label>\
      <input type='text' class='form-control col-md-2' name='values[radio"+p+"][]' placeholder='Add Value'>\
      <input type='button' class='btn btn-outline-info btn-sm offset-1' id='addmore"+next+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_radio"+y+"'>-</b></div><div id='field"+next+ "'>\
      </div>");
    $(delbtn1).click(function(){
      $(delrow1).remove();
      y = y - 1 ;
    });
    // y = y + 1;

    var nxt = next;
    var addmore = '#addmore'+nxt;
    $(addmore).click(function(){
      // alert(nxt);
      var addTo = '.field_wrapper' + nxt;
      $(addTo).append("<input type='text' class='form-control col-md-2 offset-7' name='values[radio"+p+"][]' placeholder='Add Value'><div id='addmore"+nxt+"'></div>");
      next++;
      y++;
    });

  });

  // radio ends here

//Add dropdown

  var adddrpdwn = "#adddrpdwn" + a;
  var dwn = "#drpdwn" + a;
  var dd = a;
  var zz = a;
  // alert(chk);
  $(adddrpdwn).click(function(){
    console.log(adddrpdwn);console.log(dwn);
 
    
    var delbtn2 = '#delete_dropdown' + zz ;
    var delrow2 = '.rowb' + zz ;
    var t = dd;
    // chk = chk + 1;

    $(dwn).append("<div class='form-inline mt-4 dropdown_wrapper"+dd+" rowc"+zz+"'><label class='control-label col-md-1'>Field Name:</label>\
      <input type='text' class='form-control col-md-2' name='fields[]' required>\
      <label class='control-label col-md-1'>फिल्डको नाम:</label>\
      <input type='text' class='form-control col-md-2' name='nepali_title[]'' required>\
      <input type='hidden' name='types[]' value='dropdown"+t+"'>\
      <label class='control-label col-md-1'>Dropdown Values:</label><input type='text' class='form-control col-md-2' name='values[dropdown"+t+"][]' placeholder='Add Value'><input type='button' class='btn btn-outline-info btn-sm offset-1' id='adddropdownn"+dd+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_dropdown"+zz+"'>-</b></div><div id='dropdown"+dd+ "'>");
    $(delbtn2).click(function(){
      $(delrow2).remove();
      zz = zz - 1;
    });
    // z = z + 1;
    var cd = dd;
    var addcheckbox = '#adddropdownn'+cd;
    $(addcheckbox).click(function() {
      var addMe = '.dropdown_wrapper'+cd;
      console.log(addMe);
      $(addMe).append("<input type='text' class='form-control col-md-2 offset-7' name='values[dropdown"+t+"][]' placeholder='Add Value'><div id='addcheckbox"+cd+"'></div>");
      zz++;
      dd++;
    });

// chk++;
  });


var o = "#inputt" + a;
var lid = "#addlegend" + a;
var l = 1;
  $(lid).click(function(){
    // alert(lid);
    // alert(i);
  var delbtn = '#delete_row' + l;
  var row = '.row' + l;
  var inp = "#inputt" + o;
  // alert(inp);
    $(o).append('<div class="form-inline mt-1 row' + l + '">\
      <label for="display_name" class="control-label col-md-4">Legend:</label>\
      <input type="text" name="fields[]" value="" class="form-control col-md-7" placeholder="Legend Name" required>\
      <input type="hidden" name="types[]" value="legend" class="form-control col-md-7">\
      <input type="hidden" name="nepali_title[]" value="legend" class="form-control col-md-7">\
      <b class="btn btn-sm btn-danger ml-3" id="delete_row'+l+'">-</b></div>');
    
    $(delbtn).click(function(){
      $(row).remove();
      l = l-1;
      
    });
    // i++;
  });

//  end here
a = a+1;

  });

$('#delete_first_row').click(function(){

    $('#first_input_row').remove();
  });
});
</script>