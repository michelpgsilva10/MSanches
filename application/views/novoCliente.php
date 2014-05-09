<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default">
						<form class="form-horizontal" role="form"  method="post" enctype="multipart/form-data" action="<?php echo site_url("cliente/adicionar")?>">
							<div class="row" style="margin-top: 20px; margin-left: 10%;">
								<div style="width: 80%">
									<div class="form-group" style="border-bottom: 1px solid #CCCCCC; font-family: Arial, Helvetica, sans-serif; font-size: 22px; color: #428BCA">
										Cliente
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Nome</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nome_cliente" name="nome_cliente">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">CPF</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="cpf_cliente" name="cpf_cliente">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Referência Comercial</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="ref_comercial_cliente" name="ref_comercial_cliente">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Telefone</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="ref_comercial_cliente" name="ref_comercial_cliente">
										</div>
									</div>
									<div class="form-group" style="border-bottom: 1px solid #CCCCCC; font-family: Arial, Helvetica, sans-serif; font-size: 22px; color: #428BCA">
										Endereço
									</div>
									<div class="form-group" style="display: table; margin-left: 15%">
										<div class="form-group" style="float: left">
											<label for="inputEmail3" class="col-sm-3 control-label">Rua</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="rua_endereco" name="rua_endereco">
											</div>
										</div>
										<div class="form-group" style="float: left">
											<label for="inputEmail3" class="col-sm-3 control-label">Número</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="rua_endereco" name="rua_endereco">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Bairro</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="rua_endereco" name="rua_endereco">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Cidade</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="rua_endereco" name="rua_endereco">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">U.F.</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="rua_endereco" name="rua_endereco">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Complemento</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="rua_endereco" name="rua_endereco">
										</div>
									</div>

									<div style="width: 100%; margin-left: 20px; padding-bottom: 20px" align="center">
										<button type="submit" class="btn btn-primary " style="width: 100px;">
											Criar
										</button>
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
