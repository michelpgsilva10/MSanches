<script language="JavaScript">$('.dropdown-toggle').dropdown();</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="panel panel-default">
				<div class="container-fluid">
					<br />
					<form class="form-horizontal" method="post" role="form">
						<div class="col-md-6 col-md-offset-3">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Nome do Cliente</label>
								<div class="col-sm-7">
									<input type="email" class="form-control" id="nomeCliente" placeholder="Nome">
								</div>
							</div>
						</div>
						<div class="col-md-6 col-md-offset-3">
						</div>
						<div class="col-md-6 col-md-offset-3">
							<ul class="pager">
								<li>
									<a href="<?php echo site_url("home")?>">Sair</a>
								</li>
								<li>
									<a type="submit" href="#">Finalizar</a>
								</li>
							</ul>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
