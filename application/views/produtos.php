<script language="JavaScript">
 
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
									<select class="form-control" name="tipo" id="tipo" style="text-align: center" align="center">
										<option value="Todos">Todos</option>
										<option value="Br">Brinco</option>
										<option value="An">Anel</option>
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
					<div class="row" align="center">
							<div class=".col-xs-3 .col-md-4" align="center">
								<ul class="pager">
									<li>
										<a onclick="">Anterior</a>
									</li>
									<li>
										<a href="#">Proximo</a>
									</li>
								</ul>
							</div>
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
