<?php
$user_id=$this->session->userdata('user_id');
$user_type = $this->user_model->get_user_type($user_id);
$user_type = $user_type[0]['user_type'];
// echo $user_type;die;
?><main class="app-content">
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
  .heading{
  	color: #fff;
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
$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$last = explode("/", $str, 5);
// print_r($last[4]);

      $tables = $this->admin_model->get_tables();
      // echo "<pre>";
      // print_r($tables);
      foreach ($tables as $key) 
      {
        $qid = $key['id'];
        //echo "Id is " . $qid;
        $fields = explode(',',$key['fields']);
        $titles = explode(',',$key['nepali_title']);
         //print_r($fields);

        $row = $this->admin_model->check_relation($qid);
        // echo "<pre>";

        if ($key['title'] == $last[4]){
          // echo "matched";
        

      if($row === 0) //If it is not foreign table
        {
          
          echo "<h4 style='color: green; text-transform: capitalize;'>".$key['display_name']."</h4>"; ?>
          <table class="table table-bordered">
            <thead>
              <tr style="background: #3c8fe2;">
                
                <th class="heading">क्र.स.</th>
                 <?php foreach($titles as $k => $v){
                  // print_r($v);
                  $leg = array("legend");
                  $parts = explode(' ', $v);  
                  $pos = in_array('legend', $parts);   
                  $hid = in_array('hidden', $parts);            
                       ?>
                  <?php 
                 if ($pos != true && $hid != true){
                    unset($titles[$k]);
                    
                    ?><th class="heading"><?php
                  echo $v; ?></th>
                <?php } } ?> 
                <?php
$added_title = $this->admin_model->get_added_title($key['title']);
$sec_tbl = $this->admin_model->get_sec_tbl($key['title']);
if (!empty($added_title)){
  $add_title = $added_title[0]->field;
// print_r($add_title);die;
    $res = explode(',', $add_title);
$sho = $this->admin_model->get_table_by_title($sec_tbl[0]->sec_table);
$f = $sho[0]['fields'];
$n = $sho[0]['nepali_title'];
$f = explode(',', $f);
$n = explode(',', $n);
$arr_com = array_combine($f, $n);
      foreach ($res as $a) { ?>
      	<th class="heading"><?php
      	foreach ($arr_com as $f => $n){
      	if ($a == $f){
                                echo $n;
                            }
                           }
                             ?>
        
<?php }  } ?>

                 <?php 
                  //Get foreign table using primary table name 
                  $fk = $this->admin_model->get_foreign_table_of_primary_table_mul($key['title']);
                  if(!empty($fk)){
                      echo "<th>Multi Data</th>";
                    }
                  foreach ($fk as $sm) {
                    $pk = $sm['sec_key'];
                    // print_r($pk);
                    $foreign_tables = $this->admin_model->get_table_by_id($pk);

                    //foreach ($foreign_tables as $keyssss) {
                     
                    //$f_fields = explode(',',$keyssss['fields']);
                    //foreach($f_fields as $ssk){ ?>
                  <!-- <th><?php echo $ssk; ?></th> -->
                <?php //} 
                    //}
                  }
                 ?> 
                 <th class="heading">Inserted By</th>
                 <th class="heading">View/Edit</th>

              </tr>
              
            </thead>
            <tbody>
              
                <?php 
                $dat = $this->admin_model->get_table_by_title($key['title']);
                // print_r($dat[0]['id']);
                  $dataqs = $this->admin_model->get_table_data_by_name($key['title']);
                
                  foreach ($dataqs as $keyq) {
                    echo "<tr>";
                    $id = $keyq['id'];
                    
                       if(!empty($keyq['primary_id'])){
                      unset($keyq['primary_id']);
                                                  
                      }
                      if (!empty($keyq['user_id'])){
                        $user_id_dat = $keyq['user_id'];
                        unset($keyq['user_id']);
                      }
                    foreach ($keyq as $kq) {
                      //print_r($kq);die();
                      
                     $ks = str_replace("|_|", ',', $kq);
                      if ($ks != "123_legend" && $ks != "hidden"){
                      
                      echo "<td>".$ks."</td>";
                     }
                    }

                    if (!empty($fk)){
                      echo "<td>";
                      // echo $last;
                    foreach ($fk as $fkey){
                      $ftbl1 = $fkey['sec_table'];
                     print_r($ftbl1);
                      $fdata = $this->admin_model->get_for_table_data_by_name($ftbl1);
                    
                        foreach ($fdata as $key1) 
                        {

                          unset($key1['id']);
                          // unset($key1['primary_id']);
                          // print_r($key);
                          $pri_id = $key1['primary_id'];
                          $pri_dat = $key1['primary_data_id'];

                          if (!empty($key1['primary_data_id'])){
                          if ($key1['primary_data_id'] === $id && $key1['primary_id'] === $dat[0]['id']) 
                          {
                            unset($key1['primary_data_id']);
                            unset($key1['primary_id']);
                            // print_r($key);
                            foreach ($key1 as $kkk => $v) 
                            {
                              if (!empty($v)) {
                              
                              $v = str_replace("|_|", ',', $v);
                              $kkk = ucfirst(str_replace("_", ' ', $kkk));
                              
                              echo "$kkk"." : "."$v"."<br>";

                              }
                            }
                            echo "<hr>";
                          }
                        } // empty
                          // echo $key['tole_name'];
                        }
                      }
                    echo "</td>"; }
                    $by = $this->page_model->record_inserted_by($user_id_dat);
                    // print_r($by);
                    echo "<td>".$by[0]['user_name']."</td>";
                    echo "<td>";
?>
                   
                    <a href="<?php echo base_url(); ?>pages/edit_table_by_id/<?= $qid ?>/<?= $key['title'] ?>/<?= $id; ?>"><i class="fas fa-edit"></i></a>
                    
                    
                    <?php if (empty($ftbl)) { ?>
                    
                    <a class="eye-view" href="<?php echo base_url(); ?>pages/delete_sin/<?= $key['title'] ?>/<?= $id; ?>" onclick="return confirmDelete_sin();"><i class="fas fa-trash"></i></a>
                    <?php }else{ ?>
                   
                    <a class="eye-view" href="<?php echo base_url(); ?>pages/delete/<?= $key['title'] ?>/<?= $id; ?>/<?= $ftbl; ?>/<?= $pri_id; ?>/<?= $pri_dat; ?>" onclick="return confirmDelete();"><i class="fas fa-trash"></i></a><?php } ?>
              
                   <?php

                    echo "</td>";
                   echo "</tr>";
                  }
                  
                  
                  //echo "</td>";
                 
                ?>  
                         
            </tbody>
          </table>
<?php   } 
      } } ?>
       
      <?php
       ?>
        </div>
  </div>
</div>
</div>

</main>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script type="text/javascript">
   
    function confirmDelete(){
       // alert(title);
        var r=confirm("Confirm Delete this Data?")
        if (r==true)
          window.location = url+"pages/delete/"+title+id;
        else
          return false;
        } 

    function confirmDelete_sin(){
       // alert(title);
        var r=confirm("Confirm Delete this Data?")
        if (r==true)
          window.location = url+"pages/delete_sin/"+title+id;
        else
          return false;
        } 
</script>