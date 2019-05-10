<!DOCTYPE html>
<html>
<head>
	<title>CMS SYSTEM</title>

	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/solar/bootstrap.min.css">
</head>
<body>

	<?php if($this->session->flashdata('post_created')): 
        		echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; 
      	      endif; ?>

      	<?php if($this->session->flashdata('post_not_created')): 
        		echo '<p class="alert alert-warning">'.$this->session->flashdata('post_not_created').'</p>'; 
      	      endif; ?>