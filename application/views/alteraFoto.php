<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div  class="panel panel-default">
					<div class="container-fluid" align="center">
						<div class="row">
							<div class="col-md-6 col-md-offset-3" align="center" >
								<?php if (isset($mensagem))
{
								?>
								<br />
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php	echo $mensagem; ?>
								</div>
								<?php } ?>
								<form method="post"  role="form"  enctype="multipart/form-data"  action="<?php echo site_url("produtos/uloadFA")?>" >
									<br />
									<input type="file"  name="fileF" id="FileF">
									<br />
									<input style="display: none;" name="id" id="id" value="<?php echo $id;  ?>" />
									<button type="submit" class="btn btn-primary">
										Enviar
									</button>
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
						<a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>

					</li>
					<li>
						<a href="<?php echo site_url("produtos/novo")?>">Novo Produto</a>
					</li>
					<li>
						<a href="<?php echo site_url("produtos/etiquetas")?>">Etiquetas</a>
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
