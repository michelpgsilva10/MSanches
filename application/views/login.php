<div class="row" style="margin-top: 20%">
	<?php
	if (isset($mensagem)) {?>
			<div class="alert alert-danger alert-dismissable">
			 <?php	echo $mensagem; ?>
			</div>
	<?php } ?>
	<div class="col-md-6 col-md-offset-3">
		<form method="post" class="form-horizontal" role="form" action="<?php echo site_url("Login")?>">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Login</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="login" name="login" placeholder="Login" maxlength="100" required>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="password" name="password" placeholder="Senha" maxlength="100" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-success">
						Fazer Login
					</button>
				</div>
			</div>
		</form>
	</div>
</div>