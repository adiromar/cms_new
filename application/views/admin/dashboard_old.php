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

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          
          <div class="error" style="color: red; font-weight: bold;">
            <?php echo validation_errors(); ?>  
          </div>

          <?php echo form_open('admins/setup', array('class' => 'mt-4')) ?>
          
        <div class="main_form">
          <div class="form-inline">
            <label for="title" class="control-label col-md-2">Form Name:</label>
            <input type="text" name="title" class="form-control col-md-3" required>
            <label for="display_name" class="control-label col-md-2">Display Name:</label>
            <input type="text" name="display_name" class="form-control col-md-4" required>
          </div>
          <div class="form-inline mt-4 mb-4">
            <div class="col-md-2"></div>
            <input type="button" class="btn btn-info btn-sm mr-2" id="add" value="+ Input">

            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="addradio" value="+ Radio">

            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="addcheckbox" value="+ Checkbox">

            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="adddropdown" value="+ Dropdown">

          </div>
          <div id="input">
            <div class="form-inline mt-2" id="first_input_row">
              <label class="control-label col-md-2">Field Name:</label>
              <input type="text" class="form-control col-md-2" name="fields[]" required>
              <label class="control-label col-md-2">Type:</label>
              <select type="text" name="types[]" class="form-control col-md-3">
                <option value="VARCHAR">VARCHAR</option>
                <option value="INT">INT</option>
                <option value="TEXT">TEXT</option>
              </select>
             <b class="btn btn-sm btn-danger ml-3" id="delete_first_row">-</b>
            </div>
          </div>

          
          <div id="field1"></div>
          <div id="checkbox1"></div>
          <div id="dropdown1"></div>
        </div>

            <a href="" class="btn btn-warning mt-5">Reset</a>
          <input type="submit" class="btn btn-success mt-5" style="width: 150px;" name="submit" value="Proceed">
            
          <?php form_close(); ?>
        </div>
      </div>
    </div>
  

        </div>
      </div>
    </div>
  </div>
  </main>