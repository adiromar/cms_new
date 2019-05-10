<?php
$user_id=$this->session->userdata('user_id');
$user_type=$this->session->userdata('user_type');
$username=$this->session->userdata('user_name');
// echo $username;die;
// if($user_type == 'SuperAdmin' || $user_type == 'Admin'){

// }else{
//   redirect('pages/home');
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets_front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets_front/css/simple-sidebar.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"></script>
</head> 
<style type="text/css">

</style>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar" style="z-index: 1000;">
  <a class="navbar-brand ml-5" href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="overflow: hidden">
    <ul class="navbar-nav mr-auto" id="menu">

      <li style="margin-left: 140px;">
        <a class="dropdown-item" href="<?php echo base_url(); ?>">रेकर्ड दाखिला गर्नुहोस</a>
      </li>

      <li>
        <a class="dropdown-item" href="<?php echo base_url(); ?>pages/foreign">Foreign Form</a>
      </li>
      
      <li>
        <a class="dropdown-item" href="<?php echo base_url(); ?>pages/view_records">रेकोर्ड हेर्नुहोस्<span class="sr-only">(current)</span></a>
      </li>

      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

      <li><a class="dropdown-item" >Welcome, <?= $username ?></a></li>
      <li id="last_item"><a class="dropdown-item" href="<?php echo base_url('user/logout');?>">Logout</a></li>
      
    </ul>
  </div>
</nav>
   
<!-- <div id="wrapper" class="toggled wrapper"> -->
  <script>
// window.onscroll = function() {myFunction()};

// var navbar = document.getElementById("navbar");
// var sticky = navbar.offsetTop;

// function myFunction() {
//   if (window.pageYOffset >= sticky) {
//     navbar.classList.add("sticky")
//   } else {
//     navbar.classList.remove("sticky");
//   }
// }
</script>
    