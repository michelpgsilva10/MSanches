<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default" align="center">
						<?php
							echo validation_errors();
						?>
						<form class="form-horizontal form-padding" role="form"  method="post" enctype="multipart/form-data" action="<?php echo site_url("cliente/editar")?>">
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
								<div class="form-input-position" align="left">
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="nome_cliente" value="<?php echo $cliente[0]['nome_cliente']; ?>" style="width: 475px;" autofocus/>
									</div>
									<div class="form-spacing-input">
										<input id="cpf_cliente" type="text" class="form-control" name="cpf_cliente" value="<?php echo $cliente[0]['cpf_cliente']; ?>" style="width: 200px;" />
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="ref_comercial_cliente" value="<?php echo $cliente[0]['ref_comercial']; ?>" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input id="tel_cliente" type="text" class="form-control" name="tel_cliente" value="<?php echo $cliente[0]['tel_cliente']; ?>" style="width: 200px;"/>
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
								<div class="form-input-position" align="left">
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="rua_cliente" value="<?php echo $cliente[0]['rua_endereco']; ?>" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="num_endereco_cliente" value="<?php echo $cliente[0]['numero_endereco']; ?>" style="width: 75px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="complemento_cliente" value="<?php echo $cliente[0]['complemento_endereco']; ?>" style="width: 475px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="bairro_cliente" value="<?php echo $cliente[0]['bairro_endereco']; ?>" style="width: 300px;"/>
									</div>
									<div class="form-spacing-input">
										<input type="text" class="form-control" name="cidade_cliente" value="<?php echo $cliente[0]['cidade_endereco']; ?>" style="width: 200px;"/>
									</div>
									<div class="form-spacing-input">
										<select name="uf_cliente" class="form-control" style="width: 175px;">
											<option value="MT" <?php if ($cliente[0]['uf_endereco'] == 'MT') echo 'selected="selected"'; ?>>Mato Grosso</option>
											<option value="MS" <?php if ($cliente[0]['uf_endereco'] == 'MS') echo 'selected="selected"'; ?>>Mato Grosso do Sul</option>
											<option value="RO" <?php if ($cliente[0]['uf_endereco'] == 'RO') echo 'selected="selected"'; ?>>Rondônia</option>
											<option value="SP" <?php if ($cliente[0]['uf_endereco'] == 'SP') echo 'selected="selected"'; ?>>São Paulo</option>											
										</select>
									</div>
								</div>
								
							</div>
							
							<div>
								<input type="submit" name="editar_cliente" value="Concluído"  class="btn btn-primary" />
								<a class="btn btn-default" href="<?php echo site_url('cliente/infoCliente/' . $cliente[0]['id_cliente'] . '/0') ?>">Voltar</a>
							</div>
							<input type="hidden" name="id_cliente" value="<?php echo $cliente[0]["id_cliente"]; ?>" />
							<input type="hidden" name="id_endereco" value="<?php echo $cliente[0]["id_endereco"]; ?>" />
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li>
						<a href="<?php echo site_url('cliente') ?>">Buscar Cliente</a>
					</li>
					<li >
						<a href="<?php echo site_url('cliente/novoCliente') ?>">Novo Cliente</a>
					</li>
					
					<li>
						<a href="<?php echo site_url('cliente/infoCliente/' . $cliente[0]["id_cliente"] . "/0")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>
