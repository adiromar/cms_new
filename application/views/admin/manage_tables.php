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
        <h4>Add Multiple Input Feature</h4>
        <?php echo form_open('admins/add_multiple_input_feature', array('class' => 'mt-4')) ?>
          <label>Select Table:</label>
          <div class="row mt-1">
            <?php foreach ($tables as $key) {   ?>
              <?php 
              $check = $this->admin_model->get_table_properties($key['id']); 

              if($check == 0 ) :
              ?>
                <input type="checkbox" name="tables[]" value="<?= $key['id'] ?>" class="col-md-1"><b class="col-md-3"><?= $key['display_name'] ?></b>
              <?php endif; ?>

            <?php } ?>
            
          </div>
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Add Tables" class="btn btn-sm btn-info mt-4">
        </form>
      </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <d  iv class="tile-body">
          <h4>List of tables:</h4>
          <table class="table table-bordered table-responsive">
            <thead>
              <tr>
                <th>Display Name</th>
                <th>Title</th>
                <th>Multiple Input</th>
              </tr>  
            </thead>
            <tbody>
            <?php foreach ($tables as $key) {   ?>
              <tr>
                <td><?= $key['display_name'] ?></td>
                <td><?= $key['title'] ?></td>
                <?php 
                    $check = $this->admin_model->get_table_properties($key['id']); 

                    if($check > 0 ) : 
                ?>
                <td>Yes</td>
                <?php else: ?>
                <td>-</td>

                <?php endif; ?>
              </tr>
            <?php } ?>
            </tbody>
          </table>  
        </div>
      </div>

      <div class="col-md-6">
        <div class="tile">
          <div class="tile-body">
            <h5>Disable Multiple Input Feature</h5>
             <?php echo form_open('admins/disable_multiple_input_feature', array('class' => 'mt-4')) ?>
          <label>Select Table:</label>
          <div class="row mt-1">
            <?php foreach ($tables as $key) {   ?>
              <?php 
              $check = $this->admin_model->get_table_properties($key['id']); 

              if($check == 1 ) :
              ?>
                <input type="checkbox" name="tables[]" value="<?= $key['id'] ?>" class="col-md-1"><b class="col-md-3"><?= $key['display_name'] ?></b>
              <?php endif; ?>

            <?php } ?>
            
          </div>
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Disable Tables" class="btn btn-sm btn-danger mt-4">
        </form>

          </div>
        </div>
      </div>

    </div>
  </div>
</main>