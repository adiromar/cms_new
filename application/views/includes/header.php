<?php
$user_id=$this->session->userdata('user_id');
$user_type=$this->session->userdata('user_type');
$user_name=$this->session->userdata('user_name');
// echo $user_id;die;
if($user_id = true && $user_type == 'SuperAdmin' || $user_type == 'Admin'){

}elseif ($user_id != true){
  redirect('user/index');
}else{
  redirect('pages/home');
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>WUMP Admin</title>
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">WUMP</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"></a>
      <!-- Navbar Right Menu-->

      <ul class="app-nav">
        <li><a class="app-nav__item" href="<?php echo base_url(); ?>" target="_blank">Website</a></li>
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
          
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li> -->
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i><?php echo $user_name;?></a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('user/logout');?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            <li></li>
          </ul>
        </li>
      </ul>
    </header>

<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <!-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"> -->
        <div>
          <!-- <p class="app-sidebar__user-name">Wump Admin</p> -->
          <!-- <p class="app-sidebar__user-designation">Frontend Developer</p> -->
        </div>
      </div>
      <ul class="app-menu">
        <?php if ($user_id == true && $user_type == 'SuperAdmin'){ ?>
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/index"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <?php }else{ ?>
          <li><a class="app-menu__item" href="javascript:AlertIt();"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <?php } ?>

        <?php if ($user_id == true && $user_type == 'SuperAdmin'){ ?>
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>news/info"><i class="app-menu__icon fa fa-paperclip"></i><span class="app-menu__label">Add Field To Form</span></a></li>
        <?php }else{ ?>
          <li><a class="app-menu__item" href="javascript:AlertIt();"><i class="app-menu__icon fa fa-paperclip"></i><span class="app-menu__label">Add Field To Form</span></a></li>
        <?php } ?>
        
         <?php if ($user_id == true && $user_type == 'SuperAdmin'){ ?>
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>news/index"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Add Relation</span></a></li>
         <?php }else{ ?>
          <li><a class="app-menu__item" href="javascript:AlertIt();"><i class="app-menu__icon fa fa-paperclip"></i><span class="app-menu__label">Add Relation</span></a></li>
        <?php } ?>

        <?php if ($user_id == true && $user_type == 'SuperAdmin'){ ?>
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/manage_tables"><i class="app-menu__icon fa fa-plus-square"></i><span class="app-menu__label">Manage Tables</span></a></li>
        <?php }else{ ?>
          <li><a class="app-menu__item" href="javascript:AlertIt();"><i class="app-menu__icon fa fa-paperclip"></i><span class="app-menu__label">Manage Tables</span></a></li>
        <?php } ?>
        
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/view_data"><i class="app-menu__icon fa fa-eye"></i><span class="app-menu__label">View Data</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>user/info"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User Management</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/list_form"><i class="app-menu__icon fa fa-wpforms"></i><span class="app-menu__label">Form Management</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/backup"><i class="app-menu__icon fa fa-download"></i><span class="app-menu__label">Backup Database</span></a></li>
        
      </ul>
    </aside>

     <script type="text/javascript">
      function AlertIt() {
var answer = confirm ("UnAuthorized User Access. For Super Admin Only")
if (answer)
window.location="#";
}
    </script>