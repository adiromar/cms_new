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
<script src="<?php echo base_url(); ?>/assets/js/dashboard.js"></script>
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
$('#delete_first_row').click(function(){

    $('#first_input_row').remove();
  });
});
</script>
