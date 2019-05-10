<?php
$user_id=$this->session->userdata('user_id');
$user_type = $this->user_model->get_user_type($user_id);
$user_type = $user_type[0]['user_type'];
// echo $user_type;die;

$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$lastn = explode("/", $str, 6);
$form_name = $tid;
// $disp_name = $lastn[5];
$list = $this->db->list_fields($form_name);
// print_r($list);die;
unset($list[0]);
// unset($fields['user_id']);
foreach ($list as $key => $f){
  if ($f == 'user_id'){
    unset($list[$key]);
  }
}

$nepali = $this->admin_model->get_nepali_title_id($form_name);
$nepali = $nepali[0]->nepali_title;
$res = explode(',', $nepali);
$dat = array();
foreach ($res as $key => $r) {
  $parts = explode(' ', $r);  
  $pos = in_array('legend', $parts); 
  if ($pos == true){
                    unset($res[$key]);
                    
                  }else{
                    $dat[] = '';
                  }
}

// foreign forms
// echo '<pre>';
$for_title = $this->page_model->get_foreigntable_mul($form_name);
$tot = count($for_title);
$list_for_all = array();
$tbl_lists = array();
for ($k=0; $k < $tot; $k++) { 
$for_tbl = $for_title[$k]['sec_table'];
$tbl_lists[] = $for_tbl;
if (!empty($for_title[$k])){
  $list_for = $this->db->list_fields($for_tbl);
  unset($list_for[0]);
  foreach ($list_for as $key => $f) {
    if ($f == 'user_id' || $f == 'primary_id' || $f == 'primary_data_id'){
    unset($list_for[$key]);
     }
    }
   $list_for_all[] = $list_for;
    // print_r($list_for);
//     $nepali_for = $this->admin_model->get_nepali_title_id($for_title[$k]);
// $nepali_for = $nepali_for[0]->nepali_title;
// $rest = explode(',', $nepali_for);
// $datt = array();
// foreach ($rest as $key => $r) {
//   $parts = explode(' ', $r);
//   $pos = in_array('legend', $parts); 
//   if ($pos == true){
//       unset($rest[$key]);
//         }else{
//       $datt[] = '';
//         }
// }
  }
}
// print_r($list_for_all);die;
// print_r($tbl_lists);die;
// $res = implode(',', $res);
// $res = explode(',', $res);
// print_r($rest);
// print_r($res);die;
// $comb = array_combine($list, $res);
// $comb_for = array_combine($list_for, $rest);
// print_r($comb);die;
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
          <p><h4 style="color: #007bff;">Select Fields:</h4></p>

<form action="<?= base_url() ?>admins/export_records" method="post">
          <div class="col-md-12 float-left">
            <label><input type="checkbox" onClick="toggle(this)" checked/><b> Select All</b></label><br/><br/>
            <?php 
      foreach ($list as $key => $val) { ?>
        
        <label class="col-md-3"><input type="checkbox" name="sec_value[]" id="sec_value" value="<?= $val; ?>" class="" checked> <?= $val; ?></label>
      <?php } 
      for ($i=0; $i < $tot; $i++) { 
      foreach ($list_for_all[$i] as $key => $val) { ?>
        
        <label class="col-md-3"><input type="checkbox" name="for_value[]" id="sec_value" value="<?= $val; ?>" class=""> <?= $val; ?></label>
        <input type="hidden" name="for_form_name" value="<?= $tbl_lists[$i] ?>">
      <?php }  } ?>
      
          </div>

          <div class="col-md-2 float-right">
            <input type="hidden" name="form_name" value="<?= $form_name ?>">
             <!-- <input type="hidden" name="for_form_name" value="<?= $for_title ?>"> -->
            <input type="hidden" name="form_title" value="<?= $tid ?>">
            <input class="btn btn-success" type="submit" name="export" value="Generate Report">
          </div>
          
</form>
        </div>
  </div>
</div>
</div>

</main>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<!-- <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> -->
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

    function toggle(source) {
      console.log('toggle');
  checkboxes = document.getElementsByName('sec_value[]');
  checkboxes1 = document.getElementsByName('for_value[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
  for(var i=0, n=checkboxes1.length;i<n;i++) {
    checkboxes1[i].checked = source.checked;
  }
}
</script>