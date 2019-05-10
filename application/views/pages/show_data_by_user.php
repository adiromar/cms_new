<?php
$user_id=$this->session->userdata('user_id');
$info = $this->user_model->get_user_type($user_id);
$user_type = $info[0]['user_type'];
$dis = $info[0]['district'];
$all = $this->user_model->get_all_district_user($dis);
$items = array();
foreach ($all as $key => $value) {
  $items[] = $value['user_id'];
}
$no = count($items);
// echo $user_type;die;
?>
<!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">

            </li>
            </ul>
    </div>

<div id="page-content-wrapper" style="padding: 5px; background-color: #fff">
    <div class="container-fluid">
        <!-- <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="fa" class="fas fa-arrow-alt-circle-left"></i>&nbsp;</a> -->

<main class="app-content">
  <div class="app-title mt-4">
    
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

  .modals {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: auto; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    /*width: 80%;*/
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-headerr {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-bodyy {padding: 2px 16px;}

.modal-footerr {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}
</style>
<?php if($this->session->flashdata('post_updated')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; 
  endif; ?>
<?php if($this->session->flashdata('post_deleted')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('post_deleted').'</p>'; 
  endif; ?>
<?php if($this->session->flashdata('update_error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('update_error').'</p>'; 
  endif; ?>

<div class="row">
  <div class="col-md-12">
  <div class="tile_front">
        <div class="tile-body">
       <?php 
$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$last = explode("/", $str, 5);
// print_r($last[4]);

      // $tables = $this->admin_model->get_tables();
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

        if ($key['title'] == $tid){
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
$added_title = $this->admin_model->get_added_title($tid);
$sec_tbl = $this->admin_model->get_sec_tbl($tid);
// print_r($sec_tbl[0]->sec_table);die;
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
                        // echo $a ?></th>
<?php }  } ?>

                 <?php 
                  //Get foreign table using primary table name 
                  $fk = $this->admin_model->get_foreign_table_of_primary_table_mul($tid);
                  // echo '<pre>';  
                  // echo $fk[0]['sec_table'];
                  // print_r($fk);die;
                  if(!empty($fk)){
                      echo "<th class='heading'>More</th>";
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
                  if(!empty($fk)){
                 echo '<th class="heading">Multi Data</th>'; } ?>
                 <th class="heading">Inserted By</th>
                 <th class="heading">View/Edit</th>
              </tr>
              
            </thead>
            <tbody>
              
                <?php 
                $dat = $this->admin_model->get_table_by_title($tid);
                $ff_data_id = $dat[0]['id'];

                  if ($user_type == 'User'){
                  $dataqs = $this->admin_model->get_table_data_by_user($tid, $user_id);
                }
                 if ($user_type == 'District Admin'){
                  $dataqs = $this->admin_model->get_table_data_by_distrct_admin($tid, $items);
                }
                if ($user_type == 'SuperAdmin' || $user_type == 'Admin' || $user_type == 'Guest'){
                  $dataqs = $this->admin_model->get_table_data_by_admin($tid);
                }
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
                      // print_r($keyq);die();
                      
                     $ks = str_replace("|_|", ',', $kq);
                      if ($ks != "123_legend" && $ks != "~hidden"){
                      
                      echo "<td>".$ks."</td>";
                      // echo $keyq['id']; 

                      }
                    }
                    $xx = 1;
                    if (!empty($fk)){   // for multiple
                      echo "<td>";
                      // echo '<pre>';
                    // print_r($fk);die;
                      $stack = array();
                    foreach ($fk as $fkey){
                      $ftbl1 = $fkey['sec_table'];
                      
                      $stack[] = $ftbl1;
                     // print_r($ftbl1);
                      echo '<input type="hidden" id="for_name" value="'.$ftbl1.'">';
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
                            foreach ($key1 as $kkk => $v){
                              if (!empty($v)) {
                              
                              $v = str_replace("|_|", ',', $v);
                              $kkk = ucfirst(str_replace("_", ' ', $kkk));
                              
                              if ($kkk == "Userfile"){ ?>
                                <img id="myImg" style="width: 90px; height: 100px;" src="<?php echo base_url().'uploads/'.$v;?>" alt="View File" />
                                <a href="<?php echo base_url().'uploads/'.$v;?>" download>Download</a><br>
                                <?php
                              }else{
                              // echo "$kkk"." : "."$v"."<br>";
                                
                                }
                              // echo "<th>".$kkk."";
                              // echo "<td>".$v."</td></th>";
                              }
                            }
                            // echo "<hr>";
                          }
                        } // empty
                          // echo $key['tole_name'];
                        }
                      }
                      // echo $tid;
                      // echo $id;
                      // echo $fdata[0]['id'];
                      // print_r($stack);
                    echo "</td>"; ?>
                    <td>
                      <!-- <button type='button' class='btn btn-info btn-sm myBtn' id='myBtn'>View Multiple</button> -->
                      <button class="btn btn-warning btn-sm" name="tid" onclick="launch_comment_modal(<?= $id;?>)">View Multiple</button></td>
                    <?php $xx++; } ?>
                    <!-- <td><button type="button" class="btn btn-info btn-sm myBtn" id="myBtn<?= $xx ?>">View Multiple</button></td> -->
                    <?php $by = $this->page_model->record_inserted_by($user_id_dat);
                    // print_r($by);
                    echo "<td>".$by[0]['user_name']."</td>";
                    echo "<td>";

?>
                  
<?php if ($user_type != 'Guest'){ ?>
                    <a href="<?php echo base_url(); ?>pages/edit_table_by_id/<?= $qid ?>/<?= $tid ?>/<?= $id; ?>" id="here"><i class="fas fa-edit"></i></a>

                    <?php if (empty($ftbl1)) { ?>
                    
                    <a class="eye-view" href="<?php echo base_url(); ?>pages/delete_sin/<?= $tid ?>/<?= $id; ?>" onclick="return confirmDelete_sin();"><i class="fas fa-trash"></i></a>
                    <?php }else{ ?>
                   
                    <a class="eye-view" href="<?php echo base_url(); ?>pages/delete/<?= $tid ?>/<?= $id; ?>/<?= $ftbl1; ?>/<?= $pri_id; ?>/<?= $pri_dat; ?>" onclick="return confirmDelete();"><i class="fas fa-trash"></i></a><?php } ?>
                    <input type="hidden" id="table_name" value="<?= $tid; ?>">
<?php }else{} ?>
                   <?php
                   $xx++; // for dynamic modal and multiple values
                    echo "</td>";
                   echo "</tr>";
                  }
                  //echo "</td>";
                ?>      
            </tbody>
          </table>
<?php } } } ?>

        </div>
  </div>
</div>
</div>

</main>

<!-- <div class="sss"></div> -->

<div class="modal fade bd-example-modal-lg" id="compose-modals" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content pt-1 pl-2 pr-2 pb-5" style="background-color: lightgrey;">
      
    </div>
  </div>
</div>

</div>
</div>

<!-- The Modal -->
<!-- <div id="myModal" class="modall">
  <span class="closeit">&times;</span>
  <img class="modal-contents" id="img01">
  <div id="caption"></div>
</div> -->
<style>
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modall {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-contents {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-contents, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.closeit {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.closeit:hover,
.closeit:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-contents {
        width: 100%;
    }
}
</style>
<style type="text/css">
@media (min-width: 768px) {
  .modal-xl {
    width: 100%;
   max-width: 1350px;
  }
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> -->
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
// $.(document).ready(function(){

  // Get the modal
// var no = 1;
// var modal = "#myModal" + no;
// var myBtn = "#myBtn" + no;

// var btn = "#myBtn" + no;
//   $(btn).click(function(){
//     alert(myBtn);
    
//     var modals = document.getElementById("myModal");

// // Get the button that opens the modal
// var btn = document.getElementById("myBtn");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks the button, open the modal 
// btn.onclick = function() {
//     modals.style.display = "block";
// }
// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//     modals.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modals) {
//         modals.style.display = "none";
//     }
// }


// no++;
// });
</script>
<script>
  // $("#send_id").submit(function (event) {
    $('#compose-modals').modal({ show: false});
    function launch_comment_modal(id){
      // alert(tid);
      var values = {
        'id' : id,
        'name': document.getElementById('table_name').value,
        'for_name': document.getElementById('for_name').value,
      };
       $.ajax({
          type: "POST",
          url: "<?= base_url(); ?>news/multiple_fetch",
          // dataType: 'JSON',
          data: values,
          success: function(resp){

          //"data" contains a json with your info in it, representing the array you created in PHP. Use $(".modal-content").html() or something like that to put the content into the modal dynamically using jquery.

        $('#compose-modals').modal("show");// this triggers your modal to display
        // alert(theId);
        $(".modal-content").html(resp);
        $(".sss").html(resp);
           },
    });
 }
 // });

  $(document).ready(function(){
$('#post_form').submit(function() { 
  // alert("hello");
    $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: $(this).attr('POST'), // GET or POST
        url: $(this).attr('<?= base_url(); ?>news/tests'), // the file to call
        success: function(response) { // on success..
            $('.sss').html(response); // update the DIV
        }
    });
    return false; // cancel original event to prevent form submitting
});
  });
</script>
<script type="text/javascript">
    // for image modal
    // Get the modal 
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeit")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>