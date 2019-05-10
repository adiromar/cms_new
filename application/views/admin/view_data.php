<?php
$user_id=$this->session->userdata('user_id');
$user_type = $this->user_model->get_user_type($user_id);
$user_type = $user_type[0]['user_type'];

?>
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
<style type="text/css">
  .eye-view{
    color: #cb8888;
    font-size: 22px;
  }

  .eye-view:hover {
    color: #009688;
  }

  .hid{
    opacity: 0;
  }
</style>

<?php if($this->session->flashdata('post_updated')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; 
  endif; ?>
<?php if($this->session->flashdata('post_deleted')): 
    echo '<p class="alert alert-danger">'.$this->session->flashdata('post_deleted').'</p>'; 
  endif; ?>
<div class="row">
  <div class="col-md-12">
  <div class="tile">
        <div class="tile-body">
  <?php 
      $tables = $this->admin_model->get_tables_pri();
      // echo "<pre>";
      // print_r($tables);
?>
<table class="table table-striped table-bordered table-responsive">
            <thead>
              <tr>
                <th>मुख्य फारमहरू</th>
                <th>रेकर्ड संख्या</th>
                <th>Export To Excel</th>
                <!-- <th>Secondary Table</th> -->
                <!-- <th>Multiple Input</th> -->
              </tr>  
            </thead>
            <tbody>
      <?php
      foreach ($tables as $key) 
      {
        

        $qid = $key['id'];
        //echo "Id is " . $qid;
        $fields = explode(',',$key['fields']);
         //print_r($fields);

        $row = $this->admin_model->check_relation($qid);
        // echo "<pre>";
      if($row === 0) //If it is not foreign table
        { ?>
          <tr>
            <td><li class="view_data_link" style="list-style: none;"><a target="_blank" href='show_data/<?php echo $key['title']; ?>' style='color: green; font-size: 18px; font-weight: 500;'><?php echo $key['display_name']; ?><i class="fas fa-link hid"></i></a></li></td>
            <td style="text-align: center;"><?php
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            ?></td>
            <!-- <td><?php
            $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
                    foreach ($fk as $sm) {
                    $pk = $sm['sec_table'];
                   echo $pk . ', ';
                 }
            ?></td> -->
            <!-- <td>-</td> -->
            <td><a href="export/<?php echo $key['title']; ?>" class="btn btn-success">Export</a></td>
          </tr>
          
<?php   } ?>
<?php } ?>
  </tbody>
  </table>

  </div>
</div>
</div>
</div>

<div class="row mt-5">
  <div class="col-md-12">
  <div class="tile">
        <div class="tile-body">
  <?php 
      $tables = $this->admin_model->get_tables_for();
      // echo "<pre>";
      // print_r($tables);
?>
<table class="table table-striped table-bordered table-responsive">
            <thead>
              <tr>
                <th>साझा फारमहरू</th>
                <th>रेकर्ड संख्या</th>
                <!-- <th>Secondary Table</th> -->
                <!-- <th>Multiple Input</th> -->
              </tr>  
            </thead>
            <tbody>
      <?php
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
            <td><li class="view_data_link" style="list-style: none;"><a target="_blank" href='show_data_by_user/<?php echo $key['title']; ?>' style='color: green; font-size: 18px; font-weight: 500;'><?php echo $key['display_name']; ?><i class="fas fa-link hid"></i></a></li></td>
            <td style="text-align: center;"><?php
                // $this->db->where('user_id', $user_id);
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            ?></td>
            <!-- <td><?php
            $fk = $this->admin_model->get_foreign_table_of_primary_table($key['title']);
                    foreach ($fk as $sm) {
                    $pk = $sm['sec_table'];
                   echo $pk . ', ';
                 }
            ?></td> -->
            <!-- <td>-</td> -->
          </tr>
          
<?php   } ?>
<?php  // } ?>
  </tbody>
  </table>

  </div>
</div>
</div>
</div>


</main>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
