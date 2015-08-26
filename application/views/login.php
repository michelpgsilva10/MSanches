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
	<body >
		<div class="container">
			<div>
				<img  src="<?php echo $this->config->item('base_url') ?>css/img/img_sistema/MSanches-logo.png" class="img-responsive" alt="Responsive image">
			</div>
			<br />

<div class="row">
	<?php
	if (isset($mensagem)) {?>
			<div class="alert alert-danger alert-dismissable">
			 <?php	echo $mensagem; ?>
			</div>
	<?php } ?>
	<div class="col-md-6 col-md-offset-3">
	</div>	
	<div class="col-md-6 col-md-offset-3">
		<form method="post" class="form-horizontal" role="form" action="<?php echo site_url("login")?>">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Login</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="login" name="login" placeholder="Login" maxlength="100" required autofocus>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="password" name="password" placeholder="Senha" maxlength="100" required>
				</div>
			</div>
			<br />
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-8">
					<button type="submit" class="btn btn-success">
						Fazer Login
					</button>
				</div>
			</div>
		</form>
	</div>
</div>