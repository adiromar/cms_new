<?php
// $user_id=$this->session->userdata('user_id');
// $user_type=$this->session->userdata('user_type');

// if($user_type == 'SuperAdmin' || $user_type == 'Admin'){

// }else{
//   redirect('pages/index');
// }
?>
  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      <p>Set your Form name and Fields:</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>

<style type="text/css">
  .hr{
    border-top: 2px solid #d9cdcd;
    padding-top: 10px;
  }

  .app_div{
    border: 2px solid #b9b3b3;
    padding: 12px;
    margin-top: 15px;
    border-radius: 36px;
  }
</style>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
    <?php if($this->session->flashdata('post_created')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; 
  endif; ?>
  <?php if($this->session->flashdata('error')): 
    echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; 
  endif; ?>
          <div class="error" style="color: red; font-weight: bold;">
          <?php echo validation_errors(); ?>  
          </div>

          <?php echo form_open('admins/setup', array('class' => 'mt-4', 'id' => 'form')) ?>

        <div class="main_form">
          <div class="form-inline">
            <label for="title" class="control-label col-md-1">Form Name:</label>
            <input type="text" name="title" class="form-control col-md-3" pattern="[A-Za-z]{1}.{4,}" title="First letter can't be number" placeholder="Database form name" required>
            <label for="display_name" class="control-label col-md-1">Display Name:</label>
            <input type="text" name="display_name" class="form-control col-md-3" placeholder="Form Display Name" required>
            <label for="display_name" class="control-label col-md-1 ml-2">Form Type:</label>
            <select name="form_type" class="col-md-2 form-control">
              <option value="primary_form">Primary</option>
              <option value="foreign_form">Foreign</option>
              <option value="multiple_form">Multiple Input</option>
              <option value="table">Table Input</option>
            </select>

            <label for="display_name" class="control-label col-md-3 offset-2 mt-4">Sub Title:</label>
            <input type="text" name="subtitle" class="form-control col-md-3 mt-4" placeholder="Form Sub-Title">
            
          </div>
        
        <div class="another" id="another" style="">
          <div class="form-inline mt-4 mb-4" id="here">
            
          </div>
            </div>
        </div>
        <!-- <div id="new1"></div> -->
        <div id="new1">
          <p></p>
          <div id="fieldsds1"></div>
        </div>

<!-- <input type="button" class="btn btn-info" id="radioo" style="" value="+"> -->

<input type="button" class="btn btn-info btn-sm" id="showmee" style="float: right;" value="+ Another Question">

            <a id="reset_btn" class="btn btn-warning btn-sm mt-5">Reset</a>
          <input type="submit" class="btn btn-success btn-sm mt-5 submit-name" id="submit-name" style="width: 150px;" name="submit" value="Proceed">

          <?php form_close(); ?>

        </div>
      </div>
    </div>
</div>

      </div>
    </div>
  </div>

  </main>

  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".submit-name").attr("disabled", "true");
    $(".legend-name").blur(function(){
        if ( $(this).val() != "") {
            $(".submit-name").removeAttr("disabled");
        } else {
            $(".submit-name").attr("disabled", "true");        
        }
    });    
});


  $(document).ready(function(){
$("#reset_btn").click(function(){
/* Single line Reset function executes on click of Reset Button */
$("#form")[0].reset();
});});
$(document).ready(function(){ 

var a = 1;
var x = 1;
// var i =1;

  $('#showmee').click(function(){
  //    $(".submit-name").attr("disabled", "true");
  //   $(".legend-name").blur(function(){
  //       if ( $(this).val() != "") {
  //           $(".submit-name").removeAttr("disabled");
  //       } else {
  //           $(".submit-name").attr("disabled", "true");        
  //       }
  //   });  

    $(function() {
  var button = $("#add1"),
  submitButt = $("#submit-name");
  button.on("click",function(e) {
     submitButt.prop("disabled",false); // NOT a toggle
  });
});
  $(function() {
  var rdobutton = $("#addradio1"),
  submitButt = $("#submit-name");
  rdobutton.on("click",function(e) {
     submitButt.prop("disabled",false); // NOT a toggle
  });
});
    $(function() {
  var chkbutton = $("#addcheckbox1"),
  submitButt = $("#submit-name");
  chkbutton.on("click",function(e) {
     submitButt.prop("disabled",false); // NOT a toggle
  });
});
    $(function() {
  var drpbutton = $("#adddrpdwn1"),
  submitButt = $("#submit-name");
  drpbutton.on("click",function(e) {
     submitButt.prop("disabled",false); // NOT a toggle
  });
});
    $(function() {
  var chkbutton = $("#upload"),
  submitButt = $("#submit-name");
  chkbutton.on("click",function(e) {
     submitButt.prop("disabled",false); // NOT a toggle
  });
});

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
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="upload" value="+ Upload File">\
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
          <div id="inputt'+x+'"></div>\
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
    // alert(aid);
    // alert(i);
  var delbtn = '#delete_row' + aa;
  var row = '.row' + aa;
  var inp = "#input" + i;
  // alert(inp);
    $(i).append('<div class="form-inline mt-1 row' + aa + '">\
      <label class="control-label col-md-1">Field Name:</label>\
      <input type="text" class="form-control col-md-2" name="fields[]" placeholder="in english" required>\
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
  var zz =a;
  // alert(chk);
  $(adddrpdwn).click(function(){
// alert(che);
// alert(box);
 
    
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
      // alert(z);
      var addMe = '.dropdown_wrapper'+cd;
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

  var i = "#inputt" + a;
var aid = "#upload";
var aa = 1;
  $(aid).click(function(){
    // alert(aid);
    // alert(i);
  var delbtn = '#delete_row' + aa;
  var row = '.row' + aa;
  var inp = "#input" + i;
  // alert(inp);
    $(i).append('<div class="form-inline mt-1 row' + aa + '">\
      <label class="control-label col-md-1">File Name:</label>\
      <input type="text" class="form-control col-md-2" name="fields[]" value="userfile" required>\
      <label class="control-label col-md-2">फिल्डको नाम:</label>\
      <input type="text" class="form-control col-md-2" name="nepali_title[]" required>\
      <label class="control-label col-md-2">Type:</label>\
      <select type="text" name="types[]" class="form-control col-md-2">\
      <option value="file">File</option>\
      </select><b class="btn btn-sm btn-danger ml-3" id="delete_row'+aa+'">-</b></div>');
    
    $(delbtn).click(function(){
      $(row).remove();
      aa = aa-1;
    });
    aa++;
  });

//  end here
a = a+1;

  });

$('#delete_first_row').click(function(){

    $('#first_input_row').remove();
  });
});
</script>
