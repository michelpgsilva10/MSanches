<script language='JavaScript'>
function SomenteNumero(e){
 var tecla=(window.event)?event.keyCode:e.which;
 if((tecla>47 && tecla<58)) return true;
 else{
 if (tecla==8 || tecla==0) return true;
 else  return false;
 }
}
function Finalizar(){
	document.forms['formAl'].submit();
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
						<form id="formAl" class="form-horizontal" role="form" method="post" <?php if(isset($foto)){echo "action=\"".site_url("produtos/alterar2/".$produto->id_produto)."\""; }
							else{echo "action=\"".site_url("produtos/alterar/".$produto->id_produto)."\"";}?>>
							<div class="row" style="margin-left: 3%">
								<div style="margin-left: 30%;" >
									<h3><b> Código: <?php echo $produto->cod_barra_produto?> </b></h3>
								</div>
								<div class="col-xs-6">
									<br />
									<br />
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Valor</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="valor" name="valor" value="<?php echo $produto->valor_produto; ?>" style="text-align: center" required maxlength="4" onkeypress="return SomenteNumero(event);">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Tipo </label>
										<div class="col-sm-7">
											<select class="form-control" name="tipo" id="tipo" required >
												<option value=""></option>
												<option value="3" <?php if($produto->tipo_produto==3){echo "selected"; } ?>>Brinco</option>
												<option value="1" <?php if($produto->tipo_produto==1){echo "selected"; } ?>>Anel</option>
												<option value="4" <?php if($produto->tipo_produto==4){echo "selected"; } ?>>Colar</option>
												<option value="6" <?php if($produto->tipo_produto==6){echo "selected"; } ?>>Pulceira</option>
												<option value="2" <?php if($produto->tipo_produto==2){echo "selected"; } ?>>Bracelete</option>
												<option value="7" <?php if($produto->tipo_produto==7){echo "selected"; } ?>>Tornozeleira</option>
												<option value="5" <?php if($produto->tipo_produto==5){echo "selected"; } ?>>Conjunto</option>
											</select>
										</div> 
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Quantidade</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" id="quant" name="quant" value="<?php echo $produto->estoque_produto; ?>" style="text-align: center" onkeypress="return SomenteNumero(event);" required>
										</div>
									</div>

								</div>
								<div class="col-xs-5">
									<div class="thumbnail">
										<div id="img">
											<img src="<?php if(isset($foto)){ echo $this->config->item('base_url')."css/img/img_produto/defu.jpg\""; }else{echo $this->config->item('base_url')."css/img/img_produto/".$produto->foto_produto."\"";}?> data-src="holder.js/100%x180" class="img-responsive" alt="Responsive image">
										</div>
										<div id="trocaImg" class="caption" align="center">
											<ul class="pager" >
												<li>
													<a href="<?php echo site_url("produtos/alteraFoto/".$produto->id_produto)?>" >Selecionar</a>
												</li>
											</ul>

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group" align="center">
									<p><a onclick="Finalizar()" class="btn btn-primary" role="button"> Finalizar </a> 
									   <a  href="<?php echo site_url("produtos/deletar/".$produto->foto_produto."/".$produto->id_produto."/".$produto->cod_barra_produto)?>" class="btn btn-danger" role="button"> Deletar </a> 
									   <a href="<?php echo site_url("produtos/busca2/".$produto->id_produto)?> " class="btn btn-default" role="button"> Voltar </a></p>
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
