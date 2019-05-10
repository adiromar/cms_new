<?php
$user_id=$this->session->userdata('user_id');
$info = $this->user_model->get_user_type($user_id);
// $user_type = $user_type[0]['user_type'];
$user_type = $info[0]['user_type'];
$dis = $info[0]['district'];
$all = $this->user_model->get_all_district_user($dis);
// print_r($all);
$items = array();
foreach ($all as $key => $value) {
  $items[] = $value['user_id'];
}
// print_r($items);
$no = count($items);
?>
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">

            </li>
            </ul>
    </div>
    <!-- Page Content -->
<div id="page-content-wrapper" style="padding: 5px; background-color: #fff;">
    <div class="container-fluid">
        <!-- <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="fa" class="fas fa-arrow-alt-circle-left"></i>&nbsp;</a> -->


<main class="app-content mt-3">
  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admins/index"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item">View Records</li>
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
<div class="row" style="margin-left: 50px;">
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
            <td><li class="view_data_link" style="list-style: none;"><a target="_blank" href='show_data_by_user/<?php echo $key['title']; ?>' style='color: green; font-size: 18px; font-weight: 500;'><?php echo $key['display_name']; ?><i class="fas fa-link hid"></i></a></li>
            
            <?php
            if ($key['id'] > 34 && $key['id'] < 36){ ?>
              <hr><li class="view_data_link" style="list-style: none;"><a target="_blank" href='<?= base_url()?>displayrecords/socio_economic_info' style='color: green; font-size: 18px; font-weight: 500;'>SA-16 - गाउँपालिकाको सामाजिक-आर्थिक जानकारी<i class="fas fa-link hid"></i></a></li>
            <?php } ?></td>
            
            <td style="text-align: center;">
              <?php 
              if ($user_type == "SuperAdmin" || $user_type == "Admin" || $user_type=="Guest"){
                // $this->db->where('user_id', $user_id);
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            } 
              if ($user_type == "District Admin"){
                // for ($i=0; $i < $no; $i++) { 
                  $this->db->where_in('user_id', $items);
                // }
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            } 
              if ($user_type == "User"){
                $this->db->where('user_id', $user_id);
                $this->db->from($key['title']);
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo $rowcount;
            } ?>
            <?php
            if ($key['id'] > 34 && $key['id'] < 36){ 
              $this->db->from('wump_annex_04_sa_18_vdc_social_economic_info');
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo '<hr>'.$rowcount;
                ?>
            <?php } ?>
            </td>
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
<?php } ?>

  </tbody>
  </table>

  </div>
</div>
</div>
</div>


<div class="row mt-5" style="margin-left: 50px;">
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
            <td><li class="view_data_link" style="list-style: none;"><a target="_blank" href='show_foreign/<?php echo $key['title']; ?>' style='color: green; font-size: 18px; font-weight: 500;'><?php echo $key['display_name']; ?><i class="fas fa-link hid"></i></a></li></td>
            <td style="text-align: center;"><?php
                $this->db->where('user_id', $user_id);
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

</div>
</div>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
