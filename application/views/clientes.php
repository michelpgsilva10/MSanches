<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
				<div  class="panel panel-default">
					<?php 
						if ($cadastro_cliente) {
							echo '<div id="cliente_success" class="alert alert-success" onload="hideAlertSuccess()">';
							echo '	Cadastro realizado com sucesso!';
							echo '</div>';
						}
					?>
					<div>
						
					</div>
					<form class="form-horizontal" role="form"  method="post" enctype="multipart/form-data" action="<?php echo site_url("cliente")?>">
						<div class="row" style="margin-top: 20px; margin-left: 10%;">
							<div class="panel panel-default ale" style="width: 90%">
								<div class="panel-body">
									teste
								</div>								
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="<?php echo site_url("cliente") ?>">Novo Cliente</a>
					</li>
					<li>
						<a href="#">Buscar Cliente</a>
					</li>
					<li >
						<a href="<?php echo site_url("home")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>