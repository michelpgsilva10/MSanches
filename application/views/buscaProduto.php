<script language="JavaScript">
	$('.collapse').collapse();
	$('.dropdown-toggle').dropdown(); 
</script>
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
				<div  class="panel panel-default">
					<div class="container-fluid" align="center">
						<div class="row">
							<div class="col-md-6 col-md-offset-3" align="center" >
								<form >
									<div class="col-xs-5" style="margin-top: 50px; margin-left: 35%" align="center">
										<input type="text" class="form-control" name="codigo" id="codigo" placeholder="Exemplo: BR00000000">
										<span class="help-block">Digite o Código do Produto</span>
										<br />
										<button type="submit" class="btn btn-primary">
											Buscar
										</button>
										
									</div>
								</form>
							</div>
						</div>
					</div>
					<br />
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li>
						<a href="<?php echo site_url("produtos")?>"> Produtos </a>
					</li>

					<li class="active">
						<a href="#">Buscar Produto</a>

					</li>
					<li >
						<a href="<?php echo site_url("produtos/novo")?>">Novo Produto</a>
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
