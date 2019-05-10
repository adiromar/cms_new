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


<div class="clearfix" style="margin-bottom: 25px;"></div>

<div class="error" style="color: red; font-weight: bold;">
            <?php echo validation_errors(); ?>  
            <?php if($this->session->flashdata('post_created')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; 
  endif; ?>

<?php if($this->session->flashdata('post_not_created')): 
    echo '<p class="alert alert-warning">'.$this->session->flashdata('post_not_created').'</p>'; 
  endif; ?>

  <?php if($this->session->flashdata('post_updated')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; 
  endif; ?>
          </div>

          

 <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <h4>Set Relation:</h4>
          <form action="<?php echo base_url(); ?>posts/add_relation" method="post" class="row">
          <div class="col-md-3">
            <p>Select Foreign:</p>

            <select name="sec_tbl" id="sec_tbl" class="form-control">
              <option>Select</option>
            <?php 
            foreach($groups1 as $row){ 
              // if($this->admin_model->check_relation($row->id) > 0){
              echo '<option value="'.$row->title.'">'.$row->title.'</option>';
              //echo '<option value="'.$row->id.'">'.$row->id.'</option>';
              // }
            } ?>
            </select>
          </div>

          <div class="col-md-3">
             <p>Select Foreign Key:</p>
            <select name="foreign_tbl" id="foreign_tbl" class="form-control" required>
            <?php 
            foreach($frm_ids as $key){ 
              echo '<option data-group="'.$key->title.'" value="'.$key->id.'">'.$key->id.'</option>';
            }
            ?>
            </select>
          </div>  
          <div class="col-md-3">
             <p>Relationship:</p>
             <input type="text" disabled="" value="Relates To:" class="form-control">
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
                echo '<option value="'.$row->title.'">'.$row->title.'</option>';
              // }else{
                
              // }
              
             
            }  ?>
            </select>
          </div>

           <div class="col-md-3" style="margin-top: 15px;">

             <input type="submit" class="form-control btn btn-success" name="" value="Submit">
           </div>

           <div name="" id="displayText"></div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
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
                  </tr><?php } ?>
                </table>

                
        </div>
      </div>
    </div>
  </div>

</main>

<style type="text/css">
  .str{
    background-color: #f4efef;
    border-bottom: solid red 1px;
    border-right: solid grey 1px;
    padding: 20px 20px;
    margin-left: 15px;
  }

table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 12px;
}

td {
  color: green;
  font-weight: 600;
}
</style>

<script src="jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$('#sec_tbl').on('change', function() { //WHEN USER CHANGES FIRST OPTION
var fromVal = $(this).val(); //MAKE VARIABLE OF SELECTED CHOICE

// var hide = document.getElementById('hid_data');

//$("#displayText").html(fromVal);
//alert($(this).val());

$('#primary_tbl option').each(function(){ //FOR EVERY SECOND OPTION
    if($(this).val() == fromVal) { //CHECK IF IT IS EQUAL TO THE FIRST SELECTED CHOICE
        $(this).attr('disabled', 'disabled'); //IF IT IS, HIDE IT
        //alert($(this).val());
    } else {
        $(this).removeAttr('disabled'); //OTHERWISE SHOW IT, INCASE HIDDEN FROM PREVIOUS CHOICE
    }
});

    
});

$('#primary_tbl').on('change', function() {
  var fromVal1 = $(this).val();
    $('#sec_tbl option').each(function(){ //FOR EVERY SECOND OPTION
        if($(this).val() == fromVal1) { //CHECK IF IT IS EQUAL TO THE FIRST SELECTED CHOICE
        $(this).attr('disabled', 'disabled'); //IF IT IS, HIDE IT
        //alert($(this).val());
         } else {
        $(this).removeAttr('disabled'); //OTHERWISE SHOW IT, INCASE HIDDEN FROM PREVIOUS CHOICE
           }
      });
});

$(function(){
    $('#sec_tbl').on('change', function(){
        var val = $(this).val();
        // alert(val);

        var sub = $('#foreign_tbl');
        $('option', sub).filter(function(){
            if (
                 $(this).attr('data-group') === val 
              || $(this).attr('data-group') === 'SHOW'
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $('#foreign_tbl').trigger('change');
});

$(function() {

    $('#sec_tbl').on('change', function (e) {
    $('#foreign_tbl').val('');
        var endingChar = $(this).val().split('').pop();       
        var selected = $( '#sec_tbl' ).val();
          $('#foreign_tbl option').addClass('show');
 
          $('#foreign_tbl option[value^='+selected+']').toggleClass('show');
    })

})

// $(document).ready(function(){

//     $("#sec_tbl").change(function(){

//         var deptid = $(this).val();
//         alert(deptid);    
//         $.ajax({
//             url: '<?php echo base_url(); ?>news/filter',
//             type: 'post',
//             data: {depart:deptid},
//             dataType: 'json',
//             // console.log(deptid);
//             success:function(response){
//               console.log(data);
//                 var len = response.length;

//                 $("#sel_user").empty();
//                 for( var i = 0; i<len; i++){
                    
//                     var name = response[i]['name'];
                    
//                     $("#sel_user").append("<option value='"+name+"'>"+name+"</option>");

//                 }
//             }
//         });
//     });

// });
</script>