<div class="panel panel-default">
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="container-fluid">
				<?php if (isset($mensagem))
{
				?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						&times;
					</button>
					<?php	echo $mensagem; ?>
				</div>
				<?php } ?>
				<br />
				<div class="row">
					<div style="margin-left: 34%;" >
						<h3><b> Código do Produto: <?php echo $produto->cod_barra_produto?>
						</b></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3" align="center">
						<a href="#" class="thumbnail"> <img data-src="holder.js/400%x680" src="<?php echo $this -> config -> item('base_url') . "css/img/img_produto/" . $produto -> foto_produto; ?>"> </a>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-md-6 col-md-offset-3" align="center">
						<ul class="pager">
							<li>
								<a type="button" href="<?php echo site_url("venda/visualizaI/-1/" . $total . "/" . $tipo . "/" . $idCliente . "/" . $id); ?>">Voltar</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
