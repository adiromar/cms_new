<!DOCTYPE html>
<html>
<head>
	<title>CMS SYSTEM</title>

	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>

	
</head>
<body>
<div class="container-fluid">
	<div class="row">
	 	<div class="col-md-2 sidebar" style="background-color: transparent;">
			<h2 style="color: black" class="mt-4 text-center"></h2>
		</div>
		<div class="col-md-10 text-center mt-4">

		<?php if($this->session->flashdata('post_created')): 
        		echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; 
      	      endif; ?>

      	<?php if($this->session->flashdata('post_not_created')): 
        		echo '<p class="alert alert-warning">'.$this->session->flashdata('post_not_created').'</p>'; 
      	      endif; ?>