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
								?>
								<table class="table" style="width: 100%;">
									<thead class="table-header">
										<th style="width: 40%"> Nome </th>
										<th style="width: 20%"> Telefone </th>
										<th style="width: 25%"> Cidade </th>
										<th style="width: 12%"> Info </th>
									</thead>
									<tbody>
										<?php
											for ($i = 0; $i < count($clientes); $i++) {
										?>
										<tr>
											<td>
												<?php echo $clientes[$i]["nome_cliente"]; ?>
											</td>
											<td>
												<?php echo $clientes[$i]["tel_cliente"]; ?>
											</td>
											<td>
												<?php echo $clientes[$i]["cidade_endereco"] . '-' . $clientes[$i]["uf_endereco"]; ?>
											</td>
											<td>
												<div class="btn-group">
													<button class="btn btn-default btn-xs">
														<span class="glyphicon glyphicon-pencil"></span>
													</button>
													<button class="btn btn-default btn-xs">
														<span class="glyphicon glyphicon-remove"></span>														
													</button>
													<button class="btn btn-default btn-xs">
														<span class="glyphicon glyphicon-plus"></span>														
													</button>
												</div>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
								<?php
									} else {
										echo '<div>';
										echo '	Nenhum cliente cadastrado!';
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