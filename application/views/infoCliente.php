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
							
							<div class="form-line panel panel-default" style="width: 100%; padding:10px">
								<div style="float: left; margin-right: 3%; width: 47%">
									<div class="subtitulo-info-cliente" align="center">
										Dados Pessoais
									</div>	
									<div class="info-cliente-padding">
										<div class="form-spacing-label" style="background-color: #CCCCCC;">
											<label>Contato: </label>
											<span><?php echo $cliente[0]["tel_cliente"]; ?></span>
										</div>
										<div class="form-spacing-label" style="background-color: #EEEEEE;">
											<label>CPF: </label>
											<span><?php echo $cliente[0]["cpf_cliente"]; ?></span>
										</div>	
										<div class="form-spacing-label" style="background-color: #CCCCCC;">
											<label>Referência Comercial: </label>
											<span><?php echo $cliente[0]["ref_comercial"]; ?></span>
										</div>	
									</div>																						
								</div>	
								<div style="float: left; width: 50%">
									<div class="subtitulo-info-cliente" align="center">
										Endereço
									</div>	
									<div class="info-cliente-padding">
										<div class="form-spacing-label" style="background-color: #CCCCCC;"	>
											<label>Rua: </label>
											<span><?php echo $cliente[0]["rua_endereco"]; ?></span>
										</div>
										<div class="form-spacing-label" style="background-color: #EEEEEE;">
											<label>Número: </label>
											<span><?php echo $cliente[0]["numero_endereco"]; ?></span>
										</div>	
										<div class="form-spacing-label" style="background-color: #CCCCCC;">
											<label>Complemento: </label>
											<span><?php echo $cliente[0]["rua_endereco"]; ?></span>
										</div>		
										<div class="form-spacing-label" style="background-color: #EEEEEE;">
											<label>Bairro: </label>
											<span><?php echo $cliente[0]["bairro_endereco"]; ?></span>
										</div>	
										<div class="form-spacing-label" style="background-color: #CCCCCC;">
											<label>Cidade - UF: </label>
											<span><?php echo $cliente[0]["cidade_endereco"] . ' - ' . $cliente[0]["uf_endereco"]; ?></span>
										</div>	
									</div>																				
								</div>							
							</div>	
							<div class="info-cliente-padding" align="center">
								<input type="button" class="btn btn-primary" value="Editar" />
								<input type="button" class="btn btn-default" value="Compras do Cliente" />
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