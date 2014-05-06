<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
				<div  class="panel panel-default">
					<form class="form-horizontal" role="form"  method="post" enctype="multipart/form-data" action="<?php echo site_url("produtos/novo")?>">
						<div class="row" style="margin-top: 40px; margin-left: 3%">
							<div class="col-xs-6">
								<br />
								<br />
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Valor</label>
									<div class="col-sm-7">
										<input type="email" class="form-control" id="valor" name="valor" style="text-align: center">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Tipo</label>
									<div class="col-sm-7">
										<select class="form-control" name="tipo" id="tipo">
											<option value=""></option>
											<option value="Br">Brinco</option>
											<option value="Cl">Colar</option>
											<option value="Pl">Pulceira</option>
											<option value="Bl">Bracelete</option>
											<option value="Tr">Tornozeleira</option>
											<option value="Cj">Conjunto</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Quantidade</label>
									<div class="col-sm-3">
										<input type="email" class="form-control" id="valor" name="valor" style="text-align: center">
									</div>
								</div>

							</div>
							<div class="col-xs-5">
								<div class="thumbnail">
									<div id="img">
										<img src="<?php echo $this->config->item('base_url') ?>css/img/img_sistema/cinza.jpg" data-src="holder.js/100%x180" class="img-responsive" alt="Responsive image">
									</div>
									<div class="caption" align="center">
										<button type="file" class="btn btn-primary btn-xs" name="fotoProduto">
											Selecionar
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group" align="center">
								<button type="submit" class="btn btn-primary " style="width: 100px;">
									Criar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li>
						<a href="<?php echo site_url("produtos")?>"> Produtos </a>
					</li>

					<li>
						<a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>

					</li>
					<li class="active">
						<a href="#">Novo Produto</a>
					</li>
					<li>
						<a href="#">Estoque</a>
					</li>
					<li >
						<a href="<?php echo site_url("home")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>
