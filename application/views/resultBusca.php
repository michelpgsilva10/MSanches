<script language='JavaScript'>
function SomenteNumero(e){
 var tecla=(window.event)?event.keyCode:e.which;
 if((tecla>47 && tecla<58)) return true;
 else{
 if (tecla==8 || tecla==0) return true;
 else  return false;
 }
}
</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default">
							<?php if (isset($mensagem))
{
								?>
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php	echo $mensagem; ?>
								</div>
								<?php } ?>
						<form class="form-horizontal" role="form"  method="post">
							<div class="row" style="margin-top: 40px; margin-left: 3%">
								<div class="col-xs-6">
									<br />
									<br />
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Valor</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="valor" name="valor" value="<?php echo $produto->valor_produto; ?>" style="text-align: center" required maxlength="4" onkeypress="return SomenteNumero(event);" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Tipo</label>
										<div class="col-sm-7">
											<select class="form-control" name="tipo" id="tipo" required  disabled>
												<option value=""></option>
												<option value="Br" <?php if(strcmp ( $produto->tipo_produto,"Br")==0){echo "selected"; } ?>>Brinco</option>
												<option value="An" <?php if(strcmp ( $produto->tipo_produto,"An")==0){echo "selected"; } ?>>Anel</option>
												<option value="Cl" <?php if(strcmp ( $produto->tipo_produto,"Cl")==0){echo "selected"; } ?>>Colar</option>
												<option value="Pl" <?php if(strcmp ( $produto->tipo_produto,"Pl")==0){echo "selected"; } ?>>Pulceira</option>
												<option value="Bl" <?php if(strcmp ( $produto->tipo_produto,"Bl")==0){echo "selected"; } ?>>Bracelete</option>
												<option value="Tr" <?php if(strcmp ( $produto->tipo_produto,"Tr")==0){echo "selected"; } ?>>Tornozeleira</option>
												<option value="Cj" <?php if(strcmp ( $produto->tipo_produto,"Cj")==0){echo "selected"; } ?>>Conjunto</option>
											</select>
										</div> 
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Quantidade</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" id="quant" name="quant" value="<?php echo $produto->estoque_produto; ?>" style="text-align: center" onkeypress="return SomenteNumero(event);" required disabled>
										</div>
									</div>

								</div>
								<div class="col-xs-5">
									<div class="thumbnail">
										<div id="img">
											<img src="<?php echo $this->config->item('base_url')."css/img/img_produto/".$produto->foto_produto."\""?> data-src="holder.js/100%x180" class="img-responsive" alt="Responsive image">
										</div>
										<div id="trocaImg" class="caption" align="center" style=" display: none">
											<ul class="pager" >
												<li>
													<a href="<?php echo site_url("produtos/novaFoto")?>" >Selecionar</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group" align="center">
									<p><a  href="<?php echo site_url("produtos/alterar/".$produto->id_produto)?>" class="btn btn-primary" role="button"> Alterar </a> 
									<a  href="<?php echo site_url("produtos/deletar/".$produto->foto_produto."/".$produto->id_produto);?>" class="btn btn-danger" role="button"> Deletar </a>
									<a href="<?php echo site_url("produtos/busca")?>" class="btn btn-default" role="button"> Voltar </a>  </p>
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
