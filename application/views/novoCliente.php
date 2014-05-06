
<div class="right">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		Action <span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<li>
			<a href="#">Action</a>
		</li>
		<li>
			<a href="#">Another action</a>
		</li>
		<li>
			<a href="#">Something else here</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="#">Separated link</a>
		</li>
	</ul>
</div>
<h1 style="text-align: center;  padding: 25px 0; margin-left: 110px"><a href="<?php echo site_url("home")?>"><span class="glyphicon glyphicon-home"></span> <font color="#000000"> MSanches </font></a></h1>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
				<div  class="panel panel-default">
					<form class="form-horizontal" role="form"  method="post" enctype="multipart/form-data" action="<?php echo site_url("cliente")?>">
						<div class="row" style="margin-top: 40px; margin-left: 10%;">
							<div class="col-xs-6 col-md-7">
								<br />
								<br />
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="nome_cliente" name="Nome">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">CPF</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" id="cpf_cliente" name="CPF">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Referência Comercial</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" id="ref_comercial_cliente" name="Ref. Comercial">
									</div>
								</div>

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
