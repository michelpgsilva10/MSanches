<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default">
						<div class="row" style="margin-top: 20px; width: 100%; padding-left: 7%">
							<div class="list-group teste">
								<div class="form-separator">
									<?php echo 'Compras de ' . $cliente[0]["nome_cliente"]?>
								</div>
  								
								<div style="display: table; width: 100%; padding-left: 5px; background-color: #EEEEEE;" class="list-group-item">
									<div style="float: left; width: 25%" align="center">
										<h4 class="text-primary">Tipo de Venda</h4>
									</div>
									<div style="float: left; width: 25%;" align="center">
										<h4 class="text-primary">Data da Venda</h4>
									</div>
									<div style="float: left; width: 25%" align="center">
										<h4 class="text-primary">Data de Retorno</h4>
									</div>									
									<div style="float: left; width: 25%" align="center">
										<h4 class="text-primary">Valor da Compra</h4>
									</div>
								</div>
								<?php
									if($compras) {	    							
  										for ($i = 0; $i < count($compras); $i++) {
  								?>
  								<a href="<?php echo site_url('cliente/detalhesCompra/' . $compras[$i]["id_venda"] . '/' . $compras[$i]["tipo_venda"]); ?>" class="list-group-item">
  									<div style="display: table; width: 100%; padding-left: 5px;">
  										<div style="float: left; width: 25%;" align="center">
  											<h5 class="list-group-item-text">
  												<?php 
  													if ($compras[$i]["tipo_venda"] == 0)
  														echo 'Venda Comum';
													else
														echo 'Venda Consignada';
  												?>
  											</h5>
  										</div>
										<div style="float: left; width: 25%" align="center">
											<h5 class="list-group-item-text"><?php echo date('d/m/Y', strtotime($compras[$i]["data_venda"])); ?></h5>
										</div>
										<div style="float: left; width: 25%" align="center">
											<h5 class="list-group-item-text">
												<?php
													if ($compras[$i]["data_venda2"] == NULL)
														echo '-';
													else
														echo date('d/m/Y', strtotime($compras[$i]["data_venda2"])); 
												
												?>
											</h5>
										</div>
										<div style="float: left; width: 25%;" align="center">
											<h5 class="list-group-item-text"><?php echo 'R$ ' . number_format($compras[$i]["valor_venda"], 2, ',', '.') ?></h5>
										</div>
  									</div>  									
  								</a>
  								<?php
										
										}
									} else {
											echo '<div class="panel panel-default" style="padding: 10px" align="center">';
											echo '	Nenhuma compra realizada por este cliente!';
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
					<li>
						<a href="<?php echo site_url("cliente/cliente") ?>">Buscar Cliente</a>
					</li>
					<li>
						<a href="<?php echo site_url("cliente/novoCliente") ?>">Novo Cliente</a>
					</li>
					<li >
						<a href="<?php echo site_url("cliente/infoCliente/" . $cliente[0]["id_cliente"] . "/0")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>