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
						
						echo validation_errors();
						?>
						<div>

						</div>

						<div class="row" style="margin-top: 20px; width: 100%; padding-left: 7%">
							
							<div class="form-separator">
								Lista de Clientes
							</div>
							
							<form class="form-horizontal form-padding" role="form"  method="post" enctype="multipart/form-data" action="<?php echo site_url("cliente/buscarCliente")?>">
																					
								<div class="form-line" align="center">
									<div style="float: left; width: 25%; margin-right: 5px;" align="right">
										<select id="opcao_pesquisa_cliente" name="opcao_pesquisa_cliente" class="form-control" style="width: 150px">
											<option value="2" <?php echo set_select('opcao_pesquisa_cliente', 2); ?>>Nome</option>
											<option value="1" <?php echo set_select('opcao_pesquisa_cliente', 1); ?>>CPF</option>
										</select>
									</div>
									<div style="float: left; width: 55%; margin-right: 5px;">
										<input class="form-control"	 type="text" name="pesquisa_cliente" value="" id="pesquisa_cliente" autofocus/>
									</div>	
									<div style="float: left; width: 15%;">
										<input class="btn btn-primary form-control" type="submit" name="btn_pesquisa_cliente" value="Pesquisar" id="btn_pesquisa_cliente"/>
									</div>	
									<a href="<?php echo site_url("cliente/teste") ?>" target="_blank">
										Teste
									</a>					
								</div>	
							
							</form>					

							<div class="panel panel-default">
								<?php
									if ($clientes) {
								
										for ($i = 0; $i < count($clientes); $i++) {
								?>
								<div class="list-group teste">
	  								<a href="#" class="list-group-item">
	  									<div style="display: table; width: 100%; padding-left: 5px;">
	  										<div style="float: left; width: 45%;">
	  											<h5 class="list-group-item-text"><span class="glyphicon glyphicon-user"></span> <?php echo $clientes[$i]["nome_cliente"]; ?></h5>
	  										</div>
	  										<div style="float: left; width: 25%">
	  											<h5 class="list-group-item-text"><span class="glyphicon glyphicon-phone"></span> <?php echo $clientes[$i]["tel_cliente"]; ?></h5>
	  										</div>
	  										<div style="float: left; width: 30%">
	  											<h5 class="list-group-item-text"><span class="glyphicon glyphicon-home"></span>  <?php echo $clientes[$i]["cidade_endereco"] . '-' . $clientes[$i]["uf_endereco"]; ?></h5>
	  										</div>
	  									</div>	    							
	  								</a>
								</div>			
								<?php
								}

								} else {
								echo '<div style="padding: 10px; width: 100%" align="center">';
								echo '	Nenhum cliente encontrado!';
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