<!DOCTYPE html>
<html lang="en" >
	<meta content="text/html" http-equiv="content-type" charset="utf-8">
	<link href="<?php echo $this->config->item('base_url') ?>css/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('base_url') ?>css/msanches.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="<?php echo $this->config->item('base_url') ?>css/js/jquery-2.1.0.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>css/js/bootstrap.js"></script>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>css/js/transition.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>css/js/modal.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>css/msanches.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>css/js/jquery.maskedinput.js"></script>
	<head>
		<title>MSanches</title>

	</head>
	<body onload="hideAlertSuccess()">
		<div class="container">
			<div>
				<a href="<?php $datestring = "%m%d";
							   $time = time();
						       $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		                      if ($this -> session -> userdata('load') == $load) {
		                      	 echo site_url("validador");
							  }else {
							  	echo '#';
							  }?>"><img  src="<?php echo $this->config->item('base_url') ?>css/img/img_sistema/MSanches-logo.png" class="img-responsive" alt="Responsive image"></a>
			</div>
			<br />
