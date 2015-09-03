<script language="JavaScript">

function Enter(evento) {

	if ((evento.keyCode == 13)&&(document.getElementById("codigoP").value!=""))//event.which para FF
		{
			document.forms['formB'].submit();
		}
	}

</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div  class="panel panel-default">
					<?php if (isset($mensagem))
					{
								?>
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php	echo $mensagem; ?>
								</div>
					<?php } ?>
					<div class="container-fluid" align="center">
						<div class="row">
							<div class="col-md-6 col-md-offset-3" align="center" >
								<form  name="formB" id="formB" class="form-horizontal" role="form"  method="post" action="<?php echo site_url("produtos/busca")?>">
									<div class="col-xs-5" style="margin-top: 50px; margin-left: 35%" align="center">
										<input type="text" class="form-control" name="codigo" id="codigo" placeholder="199999999" required onkeypress=" Enter(event) " autofocus>
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
						<a href="<?php echo site_url("produtos/tipoNovo")?>">Novo Produto</a>
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
