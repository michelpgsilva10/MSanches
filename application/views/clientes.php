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

						<div class="row" style="margin-top: 20px; width: 100%; padding-left: 7%">

							<div class="panel panel-default">
								<?php
									if ($clientes) {
								
										for ($i = 0; $i < count($clientes); $i++) {
								?>
								<div class="list-group teste">
	  								<a href="#" class="list-group-item">
		    							<h4 class="list-group-item-heading"><?php echo $clientes[$i]["nome_cliente"]; ?></h4>
		    							<h5 class="list-group-item-text"><span class="glyphicon glyphicon-phone"></span> <?php echo $clientes[$i]["tel_cliente"]; ?></h5>
		    							<h5 class="list-group-item-text"><span class="glyphicon glyphicon-home"></span>  <?php echo $clientes[$i]["cidade_endereco"] . '-' . $clientes[$i]["uf_endereco"]; ?></h5>
	  								</a>
								</div>			
								<?php
									}
								
								} else {
									echo '<div>';
									echo '	Nenhum cliente cadastrado!';
									echo '</div>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="#">Buscar Cliente</a>
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