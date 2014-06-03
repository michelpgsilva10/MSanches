<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default">
						
						<div class="row" style="margin-top: 20px; width: 100%; padding-left: 7%">
							
							<div class="form-separator">
								<h2><?php echo $cliente[0]["nome_cliente"]; ?></h2>
							</div>
							
							<div class="form-line panel panel-default">
								<div style="float: left; margin-right: 30px">
									<label class="control-label">CPF</label>																
								</div>							
							</div>							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="<?php echo site_url("cliente/cliente") ?>">Buscar Cliente</a>
					</li>
					<li>
						<a href="<?php echo site_url("cliente/novoCliente") ?>">Novo Cliente</a>
					</li>
					<li >
						<a href="<?php echo site_url("home")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>