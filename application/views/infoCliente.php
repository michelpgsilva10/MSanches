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
							
							<div class="form-line" style="width: 100%;">
								<div style="float: left; margin-right: 1%; width: 49%">																	
									<div class="info-cliente">
										<div class="subtitulo-info-cliente" align="center">
											Dados Pessoais
										</div>	
										<div class="form-spacing-label" style="background-color: #EEEEEE;">
											<label>Contato: </label>
											<span><?php echo $cliente[0]["tel_cliente"]; ?></span>
										</div>
										<div class="form-spacing-label">
											<label>CPF: </label>
											<span><?php echo $cliente[0]["cpf_cliente"]; ?></span>
										</div>	
										<div class="form-spacing-label" style="background-color: #EEEEEE;">
											<label>Referência Comercial: </label>
											<span><?php echo $cliente[0]["ref_comercial"]; ?></span>
										</div>	
									</div>																						
								</div>	
								<div style="float: left; width: 50%">
									
									<div class="info-cliente">
										<div class="subtitulo-info-cliente" align="center">
											Endereço
										</div>	
										<div class="form-spacing-label" style="background-color: #EEEEEE;"	>
											<label>Rua: </label>
											<span><?php echo $cliente[0]["rua_endereco"]; ?></span>
										</div>
										<div class="form-spacing-label">
											<label>Número: </label>
											<span><?php echo $cliente[0]["numero_endereco"]; ?></span>
										</div>	
										<div class="form-spacing-label" style="background-color: #EEEEEE;">
											<label>Complemento: </label>
											<span><?php echo $cliente[0]["rua_endereco"]; ?></span>
										</div>		
										<div class="form-spacing-label">
											<label>Bairro: </label>
											<span><?php echo $cliente[0]["bairro_endereco"]; ?></span>
										</div>	
										<div class="form-spacing-label" style="background-color: #EEEEEE;">
											<label>Cidade - UF: </label>
											<span><?php echo $cliente[0]["cidade_endereco"] . ' - ' . $cliente[0]["uf_endereco"]; ?></span>
										</div>	
									</div>																				
								</div>							
							</div>	
							<div style="padding: 10px;" align="center">
								<input type="button" class="btn btn-primary" value="Editar" />
								<input type="button" class="btn btn-default" value="Compras do Cliente" />
								<input type="button" class="btn btn-default" value="Excluir Cliente" />
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
					<li>
						<a href="<?php echo site_url("cliente/cliente")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>