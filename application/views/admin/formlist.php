<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admins/index"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><?= $title?></li>
    </ul>
  </div>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

<?php if($this->session->flashdata('post_deleted')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; 
  endif; ?>
<?php if($this->session->flashdata('error_deletion')): 
    echo '<p class="alert alert-danger">'.$this->session->flashdata('error_deletion').'</p>'; 
  endif; ?>
<?php if($this->session->flashdata('form_updated')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('form_updated').'</p>'; 
  endif; ?>

  <div class="row">
  <div class="col-md-12">
  <div class="tile">
        <div class="tile-body">
          <table class="table table-striped table-bordered table-responsive">
            <thead>
              <tr>
                <th>No</th>
                <th>Main/Primary Form</th>
                <th>No of Records</th>
                <th>Secondary Table</th>
                <th>Edit/Delete</th>
                <th>Form Priority No.</th>
              </tr>  
            </thead>
            <tbody>
      <?php
      $tables = $this->admin_model->get_tables_pri();
      foreach ($tables as $key) 
      {
        

        $qid = $key['id'];
        //echo "Id is " . $qid;
        $fields = explode(',',$key['fields']);
         //print_r($fields);

        // $row = $this->admin_model->check_relation($qid);
        // echo "<pre>";
      // if($row === 0) //If it is not foreign table
        // { 
          ?>
          <tr>
            <td><?= $key['id'] ?></td>
            <td><li class="view_data_link" style="list-style: none;"><a href='show_data/<?php echo $key['title']; ?>' style='color: green; font-size: 18px; font-weight: 500;'><?php echo $key['display_name']; ?></a></li></td>
            <td style="text-align: center;"><?php
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            ?></td>
            <td><?php
            $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
                    foreach ($fk as $sm) {
                    $pt = $sm['sec_table'];
                    $pk = $sm['sec_key'];
                   echo $pt .'('. $pk . ')' . ', ';
                 }
            ?></td>
          
            <td class="eddel">
          <?php $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
          // if (empty($fk)){ ?>
            <a class="eye-view" href="<?php echo base_url(); ?>admins/edit_form/<?= $key['title'];?>/<?= $key['id'];?>" ><i style="color: grey;" class="fa fa-edit"></i></a>
            <?php // } ?>

            <a class="eye-view" href="<?php echo base_url(); ?>admins/delete_form/<?= $key['title'];?>/<?= $key['id'];?>" onclick="return confirmDelete();"><i style="color: red;" class="fas fa-trash-alt"></i></a>

          </td>
          <td style="width: 230px;">
            <form method="post" action="form_priority" enctype="multipart/form-data">
            <div class="numbers-row float-left">
              <input type="text" class="col-md-3" name="priority" value="<?= $key['form_order'] ?>">
            </div>
            <div class="float-right" style="margin-top: -30px;">
            <input type="hidden" name="id" value="<?= $key['id'] ?>">
            <input class="btn btn-info btn-sm" type="submit" name="submit" value="Set"> </div>
            </form>
          </td>
          </tr>
          
<?php   } ?>
<?php  // } ?>
  </tbody>
  </table>
        </div>
   </div>
  </div>
 </div>

<!-- Foreign form -->

 <div class="row">
  <div class="col-md-12">
  <div class="tile">
        <div class="tile-body">
          <table class="table table-striped table-bordered table-responsive">
            <thead>
              <tr>
                <th>Foreign Form</th>
                <th>No of Records</th>
                <th>Secondary Table</th>
                <th>Edit/Delete</th>
                <th>Form Priority No.</th>
              </tr>  
            </thead>
            <tbody>
      <?php
      $tables = $this->admin_model->get_tables_for();
      foreach ($tables as $key) 
      {
        

        $qid = $key['id'];
        //echo "Id is " . $qid;
        $fields = explode(',',$key['fields']);
         //print_r($fields);

        // $row = $this->admin_model->check_relation($qid);
        // echo "<pre>";
      // if($row === 0) //If it is not foreign table
        // { 
          ?>
          <tr>
            <td><li class="view_data_link" style="list-style: none;"><a href='show_data/<?php echo $key['title']; ?>' style='color: green; font-size: 18px; font-weight: 500;'><?php echo $key['display_name']; ?></a></li></td>
            <td style="text-align: center;"><?php
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            ?></td>
            <td><?php
            $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
                    foreach ($fk as $sm) {
                    $pk = $sm['sec_table'];
                   echo $pk . ', ';
                 }
            ?></td>
            
            <td class="eddel">
          <?php $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
          if (empty($fk)){ ?>
            <a class="eye-view" href="<?php echo base_url(); ?>admins/edit_form/<?= $key['title'];?>/<?= $key['id'];?>" ><i style="color: grey;" class="fa fa-edit"></i></a>
            <?php } ?>
            <a class="eye-view" href="<?php echo base_url(); ?>admins/delete_form/<?= $key['title'];?>/<?= $key['id'];?>" onclick="return confirmDelete();"><i style="color: red;" class="fas fa-trash-alt"></i></a>
          </td>
          <td style="width: 230px;">
            <form method="post" action="form_priority" enctype="multipart/form-data">
            <div class="numbers-row float-left">
              <input type="text" class="col-md-3" name="priority" value="<?= $key['form_order'] ?>">
            </div>
            <div class="float-right" style="margin-top: -30px;">
            <input type="hidden" name="id" value="<?= $key['id'] ?>">
            <input class="btn btn-info btn-sm" type="submit" name="submit" value="Set"> </div>
            </form>
          </td>
          </tr>
          
<?php   } ?>
<?php  // } ?>
  </tbody>
  </table>
        </div>
   </div>
  </div>
 </div>

 <!-- Multiple form -->

 <div class="row">
  <div class="col-md-12">
  <div class="tile">
        <div class="tile-body">
          <table class="table table-striped table-bordered table-responsive">
            <thead>
              <tr>
                <th>No</th>
                <th>Multiple Form</th>
                <th>No of Records</th>
                <th>Secondary Table</th>
                <th>Edit/Delete</th>
                <th>Form Priority No.</th>
              </tr>  
            </thead>
            <tbody>
      <?php
      $tables = $this->admin_model->get_tables_mul();
      foreach ($tables as $key) 
      {
        

        $qid = $key['id'];
        //echo "Id is " . $qid;
        $fields = explode(',',$key['fields']);
         //print_r($fields);

        // $row = $this->admin_model->check_relation($qid);
        // echo "<pre>";
      // if($row === 0) //If it is not foreign table
        // { 
          ?>
          <tr>
            <td><?= $key['id'] ?></td>
            <td><li class="view_data_link" style="list-style: none;"><a href='show_data/<?php echo $key['title']; ?>' style='color: green; font-size: 18px; font-weight: 500;'><?php echo $key['display_name']; ?></a></li></td>
            <td style="text-align: center;"><?php
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            ?></td>
            <td><?php
            $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
                    foreach ($fk as $sm) {
                    $pk = $sm['sec_table'];
                   echo $pk . ', ';
                 }
            ?></td>
            
            <td class="eddel">
        <?php $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
          if (empty($fk)){ ?>
            <a class="eye-view" href="<?php echo base_url(); ?>admins/edit_form/<?= $key['title'];?>/<?= $key['id'];?>" ><i style="color: grey;" class="fa fa-edit"></i></a>
            <?php } ?>
            <a class="eye-view" href="<?php echo base_url(); ?>admins/delete_form/<?= $key['title'];?>/<?= $key['id'];?>" onclick="return confirmDelete();"><i style="color: red;" class="fas fa-trash-alt"></i></a>
          </td>

          <td style="width: 230px;">
            <form method="post" action="form_priority" enctype="multipart/form-data">
            <div class="numbers-row float-left">
              <input type="text" class="col-md-3" name="priority" value="<?= $key['form_order'] ?>">
            </div>
            <div class="float-right" style="margin-top: -30px;">
            <input type="hidden" name="id" value="<?= $key['id'] ?>">
            <input class="btn btn-info btn-sm" type="submit" name="submit" value="Set"> </div>
            </form>
          </td>
          </tr>
          
<?php   } ?>
<?php  // } ?>
  </tbody>
  </table>
        </div>
   </div>
  </div>
 </div>

 <div class="row"> 
  <div class="col-md-12">
    <div class="tile">
      <?php echo form_open('admins/truncate_table', array('class' => 'mt-4')) ?>
      <p>Truncate table</p>
      <div class="row">
      <?php
      foreach ($alltables as $key) { ?>
        
       <input type="checkbox" name="tables[]" value="<?= $key['title'] ?>" class="col-md-1"><p class="col-md-3"><?= $key['display_name'] ?></p>
       
      <?php } ?>
       </div>

       <input type="submit" class="btn btn-info btn-sm" name="truncate" value="Empty DB">
       <?php form_close(); ?>
    </div>
  </div>
</div>

</main>

<style type="text/css">
  .eddel{
    text-align: center;
  }
</style>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  <script src="js/incrementing.js"></script>

<script type="text/javascript">
   function confirmDelete(){
       // alert(title);
        var r=confirm("Confirm Delete this Form ?")
        if (r==true)
          window.location = url+"admins/delete_form/"+title+id;
        else
          return false;
        } 

  $(function() {

  $(".numbers-row").append('<div class="inc ibutton">+</div><div class="dec ibutton">-</div>');

  $(".ibutton").on("click", function() {

    var $button = $(this);
    var oldValue = $button.parent().find("input").val();

    if ($button.text() == "+") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
     // Don't allow decrementing below zero
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 0;
      }
    }

    $button.parent().find("input").val(newVal);

  });

});
</script>
<style type="text/css">
  .ibutton {
  margin: 0 0 0 5px;
  text-indent: -9999px;
  cursor: pointer;
  width: 29px;
  height: 29px;
  float: left;
  text-align: center;
  background: url('http://localhost/ci/assets_front/buttons.png') no-repeat;
}
.dec {
  background-position: 0 -29px;
}
</style>