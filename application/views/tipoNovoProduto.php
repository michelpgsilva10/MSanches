<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default">
						<?php if (isset($mensagem))
{
						?>
						<br />
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
								&times;
							</button>
							<?php	echo $mensagem; ?>
						</div>
						<?php } ?>
						<div class="row" style="margin-top: 40px; margin-bottom: 20px; ">
							<div class="col-xs-8 col-md-offset-2" align="center">
								<label> Deseja informa o Codigo de Barras?</label>
								<br />
								<br />
								<a href="<?php echo site_url("produtos/tipoNovo/1")?>" type="button" class="btn btn-primary">
									Sim
								</a>
								<a href="<?php echo site_url("produtos/tipoNovo/0")?>" type="button" class="btn btn-primary">
									Não
								</a>
							</div>
						</div>
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
						<a href="<?php echo site_url("produtos/etiquetas")?>">Etiquetas</a>
					</li>
					<li>
						<a href="<?php echo site_url("produtos/estoque")?>">Estoque</a>
					</li>
					<li >
						<a href="<?php echo site_url("home")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>
