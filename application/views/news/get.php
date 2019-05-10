<?php

$input = $this->input->post('sec_tbl');
// echo $input;die;

if ($input == 'Select'){
	redirect('news/info');
}
$fields = $this->db->list_fields($input);
unset($fields[0]);
// unset($fields['user_id']);
foreach ($fields as $key => $f) {
  if ($f == 'user_id'){
    unset($fields[$key]);
  }
}
// print_r($fields);
$title1= $this->input->post('tbl_title');
$form_type = $this->news_model->get_form_type($input);
$type = $form_type[0]['form_type'];
// print_r($type);die;
$nepali = $this->admin_model->get_nepali_title_id($input);
$nepali = $nepali[0]->nepali_title;
$res = explode(',', $nepali);

foreach ($res as $key => $r) {
 $parts = explode(' ', $r);  
  $pos = in_array('legend', $parts); 
  if ($pos == true){
                    unset($res[$key]);
                    
                  }else{
                    // print_r($r);
                  }
}
$comb = array_combine($fields, $res);
 // print_r($comb);die;
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fas fa-arrow-circle-left"></i><?= $title ?></h1>
      <!-- <p>Set your Form name and Fields:</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
    </ul>
  </div>
<?php if($this->session->flashdata('post_not_created1')):
    echo '<p class="alert alert-danger">'.$this->session->flashdata('post_not_created1').'</p>';
  endif; ?>
  
<div class="clearfix" style="margin-bottom: 25px;"></div>

<div class="row">
	<a class="ml-4 admin_back" href="info"><i class="fa fa-eye"></i>Back</a>
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <h4 class="relat">Set Relations:</h4>
          <form action="<?php echo base_url(); ?>news/test" method="post" onsubmit="return validateForm()" name="myForm" class="row">
          <div class="col-md-3">
            <p>Select Foreign:</p>
            <select name="sec_tbl" id="sec_tbl" class="form-control" value="">
              <option><?php echo $input; ?></option>
            </select>
            <!-- <input class="form-control" type="text" name="sec_tbl" value="<?= $input?>" disabled> -->
          </div>
            
		<div class="col-md-4">
			<p>Select Fields:</p>
			<?php 

			foreach ($comb as $key => $nepali) { ?>
				<input type="checkbox" name="sec_value[]" id="sec_value" value="<?= $key; ?>" class="col-md-2"><b><?= $nepali; ?></b>
			<?php }  ?>
		</div>

		<div class="col-md-3">
            <p>Primary Table</p>
            <select name="primary_tbl" id="primary_tbl" class="form-control">
              <option>Select</option>
            <?php 
            foreach($groups as $row)
            { 
              //check if foreign table
              $tblid = $row->title;
              // if (!empty($this->admin_model->get_foreign_table_of_primary_table($tblid)))
              // {
                echo '<option value="'.$row->title.'">'.$row->display_name.'</option>';
              // }else{
                
              // }
            }  ?>
            </select>
          </div>
          

           <div class="col-md-2" style="margin-top: 15px;">
             <input type="hidden" name="form_type" value="<?= $type ?>">
             <input type="submit" class="form-control btn btn-success mt-4" name="" value="Submit">
           </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<!-- <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
            <h4>Added Relationship:</h4>
            <table>
                  <tr style="">
                    <th>Id</th>
                    <th>Primary table</th>
                    <th>key</th>
                    <th>Secondary table</th>
                    <th>Fields</th>
                  </tr>
                <?php 
                      
                foreach($results as $row)
                { 

                      
                
                ?>

                
                  <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->primary_table; ?></td>
                    <td><?php echo $row->sec_key; ?></td>
                    <td id="sec_table"><?php echo $row->sec_table; ?></td>
                    <td><?php echo $row->field; ?></td>
                  </tr><?php } ?>
                </table>

                
        </div>
      </div>
    </div>
  </div> -->

</main>
<script type="text/javascript">
  function validateForm() {
    var x = document.forms["myForm"]["primary_tbl"].value;
    var y = document.forms["myForm"]["sec_value"].value;
    if (x == "Select") {
        alert("Please Select Primary Table");
        return false;
    }
    if (y == null) {
        alert("Checkbox Value is empty");
        return false;
    }
    
}
</script>

<style type="text/css">
	a.admin_back{
  display: block !important;
  padding: 4px !important;
  background-color: #032525 !important;
  border-radius: 8px !important;
  color: #eeeef2 !important;
  margin-bottom: 11px !important;
}
</style>