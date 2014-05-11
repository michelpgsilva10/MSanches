<div class="panel panel-default">
	<?php
		echo validation_errors();
	?>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default" align="center">
						<form class="form-horizontal form-padding" role="form"  method="post" enctype="multipart/form-data" action="<?php echo site_url("cliente/adicionar")?>">
							<div class="form-separator" align="left">
								<span>Cliente</span>
							</div>
							<div class="form-line">
								<div class="form-label-position" align="right">
									<div class="form-spacing-label">
										<label class="control-label">Nome</label>
									</div>
									<div class="form-spacing-label">
										<label class="control-label">CPF</label>
									</div>
									<div class="form-spacing-label">
										<label class="control-label">Ref. Comercial</label>
									</div>
									<div class="form-spacing-label">
										<label class="control-label">Telefone</label>
									</div>
								</div>
								<div class="form-input-position">
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="nome_cliente" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="cpf_cliente" style="width: 200px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="ref_comercial_cliente" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="tel_cliente" style="width: 200px;"/>
									</div>
								</div>
							</div>
							
							<div class="form-separator" align="left">
								<span>Endereço</span>
							</div>
							
							<div class="form-line">
								<div class="form-label-position" align="right">
									<div class="form-spacing-label">
										<label class="control-label">Rua</label>
									</div>
									<div class="form-spacing-label">
										<label class="control-label">Número</label>
									</div>
									<div class="form-spacing-label">
										<label class="control-label">Bairro</label>
									</div>
									<div class="form-spacing-label">
										<label class="control-label">Cidade</label>
									</div>
									<div class="form-spacing-label">
										<label class="control-label">Estado</label>
									</div>
								</div>
								<div class="form-input-position">
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="rua_cliente" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="num_endereco_cliente" style="width: 75px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="bairro_cliente" style="width: 300px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="cidade_cliente" style="width: 200px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="uf_cliente" style="width: 100px;"/>
									</div>
								</div>
								
							</div>
							
							<div>
								<input type="submit" name="cadastrar_cliente" value="Cadastrar"  class="btn btn-primary" />
							</div>

						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="#">Novo Cliente</a>
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
