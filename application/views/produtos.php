<script>
	function troca(){
	 	d = document.getElementById("tipo").value;
	 	k = document.getElementById("detalhe").value;
	 	maior = document.getElementById("maior").value;
	 	menor = document.getElementById("menor").value;
		if(!maior){
			maior = 0;
		}
		if(!menor){
			menor = 0;
		}
		location.href="<?php echo site_url($caminho)?>"+"/"+d+"/"+maior+"/"+menor+"/"+k;
	}
	function Enter(evento) {

		if (evento.keyCode == 13)
		{
			d = document.getElementById("tipo").value;
			k = document.getElementById("detalhe").value;
	 		maior = document.getElementById("maior").value;
	 		menor = document.getElementById("menor").value;
			
			if(!maior){
				maior = 0;
			}
			if(!menor){
				menor = 0;
			}
			location.href="<?php echo site_url($caminho)?>"+"/"+d+"/"+maior+"/"+menor+"/"+k;
		}
	}
		
</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="panel panel-default">
					<br />
					<div class="container-fluid" align="center">
						<div class="row" align="center">
								<div class="row " align="center">
									<div class="col-md-1" style="margin-left: 13%;">
										<h5><strong>Tipos</strong></h5>
									</div>
									<div class="col-md-1" style="margin-left: 16%;">
										<h5><strong>Qualidade</strong></h5>
									</div>
									<div class="col-md-1" style="margin-left: 26%;">
										<h5><strong>Valores</strong></h5>
									</div>
								</div>
								<div class="container-fluid">
									<div class="row" align="center">
										<div class="col-xs-6 col-sm-3" align="center" style=" margin-left: 4%">
											<select class="form-control" name="tipo" id="tipo" style="text-align: center;" onchange="troca();" align="center">
												<option value="0" <?php if($tipo==0){echo "selected"; } ?>>Todos</option>
												<option value="3" <?php if($tipo==3){echo "selected"; } ?>>Brinco</option>
												<option value="1" <?php if($tipo==1){echo "selected"; } ?>>Anel</option>
												<option value="4" <?php if($tipo==4){echo "selected"; } ?>>Colar</option>
												<option value="6" <?php if($tipo==6){echo "selected"; } ?>>Pulceira</option>
												<option value="2" <?php if($tipo==2){echo "selected"; } ?>>Bracelete</option>
												<option value="7" <?php if($tipo==7){echo "selected"; } ?>>Tornozeleira</option>
												<option value="5" <?php if($tipo==5){echo "selected"; } ?>>Conjunto</option>
											</select>
										</div>
										<div class="col-xs-6 col-sm-4"  align="center" style="margin-left: -2%;">
											<select class="form-control" name="detalhe" id="detalhe" style="text-align: center;" onchange="troca();" >
												<option value="0" <?php if($detalhe==0){echo "selected"; } ?>>Todos</option>
												<option value="1" <?php if($detalhe==1){echo "selected"; } ?>>Só Dourado</option>
												<option value="2" <?php if($detalhe==2){echo "selected"; } ?>>Dourado c/ Pedra Natural</option>
												<option value="3" <?php if($detalhe==3){echo "selected"; } ?>>Dourado c/ Pedra Sintético</option>
												<option value="4" <?php if($detalhe==4){echo "selected"; } ?>>Dourado c/ Zirconia G</option>
												<option value="5" <?php if($detalhe==5){echo "selected"; } ?>>Dourado c/ Zirconia Cravejado</option>
												<option value="6" <?php if($detalhe==6){echo "selected"; } ?>>Só Proata</option>
												<option value="7" <?php if($detalhe==7){echo "selected"; } ?>>Prata c/ Pedra</option>
											</select>
										</div>	
										<div class="input-group col-xs-6 col-sm-4" align="center" style="margin-right: 6%;"  >
												<input class="form-control" value="<?php if($vmenor>0){ echo $vmenor;} ?>" name="menor" id="menor" type="text" onkeypress="Enter(event)" placeholder="Maior Valor">
     											 <div class="input-group-addon">Entre</div>
      											<input class="form-control" name="maior" value="<?php if($vmaior>0){echo $vmaior;} ?>" type="text" id="maior" onkeypress="Enter(event)" placeholder="Menor Valor">
    									</div>
									</div>
								</div>
						</div>
						<br />
						<?php 
						if($todos!=FALSE){
						 	for($i=0;$i<count($todos);$i++){
						?>
						<div class="col-xs-6 col-md-2">
							 <a href="<?php echo site_url("produtos/busca2/".$todos[$i]["id_produto"])?>" class="thumbnail">
								<img data-src="holder.js/100%x180" title="<?php echo $todos[$i]["cod_barra_produto"]; ?>" src="<?php echo $this->config->item('base_url')."css/img/img_produto/".$todos[$i]["foto_produto"]; ?>">
							 </a>
							
						</div>
						<?php  }
							 }else{
							echo "<p> Não Possui Produtos Cadastrados </p>";
						} ?>
					</div>
					<?php if($todos!=FALSE){ ?>
					<div class="row" align="center">
							<div class=".col-xs-3 .col-md-4" align="center">
								<ul class="pager">
								<?php if($anterior>=0){ ?>
									<li>
										<a href="<?php echo site_url("produtos/pagina/0/".$tipo."/".$vmaior."/".$vmenor."/".$detalhe)?>">Primeira</a>
									</li>
									<li>
										<a href="<?php echo site_url("produtos/pagina/".$anterior."/".$tipo."/".$vmaior."/".$vmenor."/".$detalhe)?>">Anterior</a>
									</li>
								<?php } 
								if($proximo*42<$QItens){
									?>
									<li>										
										<a href="<?php echo site_url("produtos/pagina/".$proximo."/".$tipo."/".$vmaior."/".$vmenor."/".$detalhe)?>">Proximo</a>
									</li>
									<li>
										<a href="<?php echo site_url("produtos/pagina/".$ultima."/".$tipo."/".$vmaior."/".$vmenor."/".$detalhe)?>">Ultima</a>
									</li>
								<?php }?>
								</ul>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="<?php echo site_url("produtos")?>">Produtos</a>
					</li>

					<li>
						<a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>

					</li>
					<li >
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
