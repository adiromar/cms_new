<?php
$user_id=$this->session->userdata('user_id');
$user_type=$this->session->userdata('user_type');
$username=$this->session->userdata('user_name');
// echo $username;die;
if($user_id != true ){
	$this->session->set_flashdata('session_error', '<b>Session Ended. Re-Login </b>to continue');
	redirect('user/index');
}else{
  // redirect('pages/home');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Amaryllis 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140131

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?php echo base_url();?>assets_front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets_front/css/simple-sidebar.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets_front/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets_front/css/fonts.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div class="float-left mt-3"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets_front/logo.png"></a></div>
		<div id="logo">
			<h1><a href="#">Water Use Master Plan (WUMP)</a></h1>
		</div>
		<div id="menu">
			<ul class="nav">
				<?php if ($user_type != 'Guest'){ ?>
				<li class="btn"><a href="<?php echo base_url(); ?>pages/home" accesskey="1" title="">रेकर्ड दाखिला गर्नुहोस</a></li>
				<li class="btn"><a href="<?php echo base_url(); ?>pages/foreign" accesskey="2" title="">साझा फारम</a></li>
				<li class="btn"><a href="<?php echo base_url(); ?>pages/view_records" accesskey="3" title="">रेकर्ड हेर्नुहोस्</a></li>
			<?php }else{ ?>
				<li class="btn"><a href="<?php echo base_url(); ?>pages/view_records" accesskey="3" title="">रेकर्ड हेर्नुहोस्</a></li>

				<?php }
				if ($user_type == "SuperAdmin"){ ?>
				<li class="btn"><a href="<?php echo base_url(); ?>pages/multiple" accesskey="3" title="">Multiple Form</a></li>
				<?php } ?>
				<!-- <li class="ml-5"><a>Welcome, <?= $username ?></a></li> -->
				<!-- <li class="btn"><a href="<?php echo base_url('user/logout');?>" accesskey="5" title="">Log Out</a></li> -->

				
			</ul>
		</div>
	</div>
</div>

<div class="dropdown float-right mr-4" style="margin-top: -35px;">
  <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #3c8fe2;color: #fff;border: none;">
    Welcome, <?= $username ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <?php if ($user_type == 'SuperAdmin') { ?>
    <li class="dropdown-item"><a href="<?php echo base_url('admins/index');?>" accesskey="5" title="">Admin Section</a></li>
<?php } ?>

    <li class="dropdown-item"><a href="<?php echo base_url('user/logout');?>" accesskey="5" title="">Log Out</a></li>
  </div>
</div>

<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("menu");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

$("li").click(
    function(event) {
      $('li').removeClass('active');
      $(this).addClass('active');
      event.preventDefault()
    }
);
</script>