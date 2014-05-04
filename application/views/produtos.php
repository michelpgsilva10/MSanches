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
				<div class="panel panel-default">
					<br />
					<div class="container-fluid" align="center">
						<div class="row" align="center">
							<div class=".col-xs-3 .col-md-4" align="center">
								<div class="col-sm-4" align="center" style="margin-left: 34%;">
									<select class="form-control" name="tipo" id="tipo" style="text-align: center" align="center">
										<option value="">Todos</option>
										<option value="Br">Brinco</option>
										<option value="Cl">Colar</option>
										<option value="Pl">Pulceira</option>
										<option value="Bl">Bracelete</option>
										<option value="Tr">Tornozeleira</option>
										<option value="Cj">Conjunto</option>
									</select>
								</div>
							</div>
						</div>
						<br />
						<?php for($i=0;$i<9;$i++){
						?>
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img data-src="holder.js/300x200" alt="...">
								<div class="caption">
									<h3>Thumbnail label</h3>
									<p>
										...
									</p>
									<p>
										<a href="#" class="btn btn-primary" role="button">Button</a><a href="#" class="btn btn-default" role="button">Button</a>
									</p>
								</div>
							</div>
						</div>
						<?php  } ?>
						<br />
						<div>
							<ul class="pager">
								<li>
									<a href="#">Anterior</a>
								</li>
								<li>
									<a href="#">Proximo</a>
								</li>
							</ul>
						</div>
						<br />
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="#">Produtos</a>
					</li>

					<li>
						<a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>

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
