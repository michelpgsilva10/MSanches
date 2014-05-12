<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default" align="center">
						<?php
							echo validation_errors();
						?>
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
										<input type="text" class="form-control" name="nome_cliente" value="<?php echo set_value('nome_cliente'); ?>" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="cpf_cliente" value="<?php echo set_value('cpf_cliente'); ?>" style="width: 200px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="ref_comercial_cliente" value="<?php echo set_value('ref_comercial_cliente'); ?>" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="tel_cliente" value="<?php echo set_value('tel_cliente'); ?>" style="width: 200px;"/>
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
										<label class="control-label">Complemento</label>
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
										<input type="text" class="form-control" name="rua_cliente" value="<?php echo set_value('rua_cliente'); ?>" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="num_endereco_cliente" value="<?php echo set_value('num_endereco_cliente'); ?>" style="width: 75px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="complemento_cliente" value="<?php echo set_value('complemento_cliente'); ?>" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="bairro_cliente" value="<?php echo set_value('bairro_cliente'); ?>" style="width: 300px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="cidade_cliente" value="<?php echo set_value('cidade_cliente'); ?>" style="width: 200px;"/>
									</div>
									<div class="form-spacing-input">
										<select name="uf_cliente" class="form-control" style="width: 175px;">
											<option value="MT" <?php echo set_select('uf_cliente', 'MT'); ?>>Mato Grosso</option>
											<option value="MS" <?php echo set_select('uf_cliente', 'MS'); ?>>Mato Grosso do Sul</option>
											<option value="RO" <?php echo set_select('uf_cliente', 'RO'); ?>>Rondônia</option>
											<option value="SP" <?php echo set_select('uf_cliente', 'SP'); ?>>São Paulo</option>											
										</select>
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
