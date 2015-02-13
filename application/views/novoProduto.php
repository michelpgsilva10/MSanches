<script language='JavaScript'>
function SomenteNumero(e){
 var tecla=(window.event)?event.keyCode:e.which;
 if((tecla>47 && tecla<58)) return true;
 else{
 if (tecla==8 || tecla==0) return true;
 else  return false;
 }
}
function Desabilitar(){
	document.getElementById('enviar').disabled = disabled;
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
								<br />
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php	echo $mensagem; ?>
								</div>
								<?php } ?>
						<form class="form-horizontal" role="form"  method="post" <?php if(isset($foto)){ ?> action="<?php echo site_url("produtos/novo2/".$nome)?>" <?php }else{ ?>action="<?php echo site_url("produtos/novo")?>"<?php }?> >
							<div class="row" style="margin-top: 40px; margin-left: 3%">
								<div class="col-xs-6">
									<br />
									<br />
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Valor:</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="valor" name="valor" style="text-align: center" required maxlength="4" onkeypress="return SomenteNumero(event);">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Tipo:</label>
										<div class="col-sm-8">
											<select class="form-control" name="tipo" id="tipo" style="text-align: center;" required >
												<option value=""></option>
												<option value="3">Brinco</option>
												<option value="1">Anel</option>
												<option value="4">Colar</option>
												<option value="6">Pulceira</option>
												<option value="2">Bracelete</option>
												<option value="7">Tornozeleira</option>
												<option value="5">Conjunto</option>
											</select>
										</div> 
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Qualidade:</label>
										<div class="col-sm-8">
											<select class="form-control" name="detalhe" id="detalhe" style="text-align: center;" required>
												<option value=""></option>
												<option value="1">Só Dourado</option>
												<option value="2">Dourado c/ Pedra Natural</option>
												<option value="3">Dourado c/ Pedra Sintético</option>
												<option value="4">Dourado c/ Zirconia G</option>
												<option value="5">Dourado c/ Zirconia Cravejado</option>
												<option value="6">Só Proata</option>
												<option value="7">Prata c/ Pedra</option>
											</select>
										</div> 
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Quantidade</label>
										<div class="col-sm-8">
	                                        <div class=" scroll-tabela" style=" height: 100px;">
	                                            <table style="width: 100%;">
	                                                <?php for($i=0;$i<count($lojas);$i++){ ?>
	                                                <tr>
	                                                    <td style="width: 60%; padding-left: 10px; padding-top: 5px;">
	                                                      <h6><?php echo $lojas[$i]['nome_loja']; ?>:</h6>
	                                                    </td> 
	                                                    <td style="width: 20%; padding-right: 10px; padding-top: 5px;">
	                                                          <input type="text" class="form-control" id="quant" <?php echo "name=\"quant".$lojas[$i]['id_loja']."\""; ?>
	                                                             value="<?php echo '0'; ?>" style="text-align: center" onkeypress="return SomenteNumero(event);" 
                                                                		<?php if($loja!=0){
                                                                			if($loja != $lojas[$i]['id_loja'] ){   
                                                                				echo "required disabled"; }}?>
                                                                	 
                                                                		>
	                                                            </td>
	                                                    </tr>
	                                                <?php } ?>
	                                            </table>
	                                        </div>
	                                    </div>
									</div>

								</div>
								<div class="col-xs-5">
									<div class="thumbnail">
										<div id="img">
											<img src="<?php echo $this->config->item('base_url') ?>css/img/<?php if(isset($foto)){ echo "img_produto/".$nome."\""; ?>
												<?php }else { ?>img_sistema/cinza.jpg" <?php } ?>data-src="holder.js/100%x180" class="img-responsive" alt="Responsive image">
										</div>
										<div class="caption" align="center">
											<ul class="pager">
												<li>
													<a href="<?php echo site_url("produtos/novaFoto")?>">Selecionar</a>
												</li>
											</ul>

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group" align="center">
									<button type="submit" name="enviar" onclick="Desabilitar();" class="btn btn-primary " style="width: 100px;" >
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
