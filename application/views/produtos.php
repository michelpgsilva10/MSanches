<script>
	function troca(){
		d = document.getElementById("tipo").value;
		location.href="<?php echo site_url($caminho)?>"+"/"+d;
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
							<div class=".col-xs-3 .col-md-4" align="center">
								<div class="col-sm-4" align="center" style="margin-left: 34%;">
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
							</div>
						</div>
						<br />
						<?php 
						if($todos!=FALSE){
						 	for($i=0;$i<count($todos);$i++){
						?>
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img data-src="holder.js/300x200" src="<?php echo $this->config->item('base_url')."css/img/img_produto/".$todos[$i]["foto_produto"]; ?>">
								<div class="caption">
									<h3><?php echo $todos[$i]["cod_barra_produto"]; ?></h3>
									<p>
										<a href="<?php echo site_url("produtos/busca2/".$todos[$i]["id_produto"])?>" class="btn btn-primary" role="button">Detalhes do Profuto</a>
									</p>
								</div>
							</div>
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
										<a href="<?php echo site_url("produtos/pagina/".$anterior."/".$tipo)?>">Anterior</a>
									</li>
								<?php } 
								if($proximo*12<$QItens){
									?>
									<li>										
										<a href="<?php echo site_url("produtos/pagina/".$proximo."/".$tipo)?>">Proximo</a>
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
