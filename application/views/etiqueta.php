<script language="JavaScript">
	var cont=1;
function Sim(){
if(cont==1){
$( "#pergunta" ).fadeOut(10);
$( "#seSim" ).fadeIn( "slow" );
cont=0;
}else{
$( "#seSim" ).fadeOut( "slow" );
$( "#pergunta" ).fadeIn( "slow" );
cont=1;
}
}
function nao(){
location.href="<?php echo site_url("produtos")?>
	";
	}
</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div  class="panel panel-default">
					<div class="container-fluid" align="center">
						<div class="row">
							<div class="col-md-6 col-md-offset-3" align="center"  >
								<div id="pergunta" >
									<div class="col-xs-8" style="margin-top: 50px; margin-left: 25%" align="center">
										<label> Deseja imprimir as etiquetas?</label>
										<br />
										<br />
										<button type="submit" class="btn btn-primary" onclick="Sim();">
											Sim
										</button>
										<button type="submit" class="btn btn-primary" onclick="nao()">
											Não
										</button>
									</div>
								</div>
								<form  role="form"  method="post" action="<?php echo site_url("etiqueta")?>" >
									<div id="seSim" style="margin-top: 50px; margin-left: 15%; display: none;">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label">Quantidade</label>
											<div class="col-sm-7">
												<input type="text" maxlength="3" value="1" class="form-control" id="quantidade" name="quantidade">
											</div>
										</div>
										<?php 
										 $aux = str_split($code);
										 if($aux[0]<1){
										?>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label">Inicio</label>
											<div class="col-sm-7">
												<input type="text" maxlength="3" value="1" class="form-control" id="inicioE" name="inicioE">
											</div>
										</div>
										<?php } ?>
										<div class="form-group">
											<div>
												<input type="text" style="display: none;" value="<?php echo $code ?>" class="form-control" id="code" name="code"  >
											</div>
										</div>
										<button type="button" style="margin-top: 5%;"  class="btn btn-primary" onclick="Sim();">
											Voltar
										</button>
										<button type="submit" style="margin-top: 5%;" class="btn btn-primary" onclick="nao()">
											Criar
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

					<li>
						<a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>

					</li>
					<li >
						<a href="<?php echo site_url("produtos/novo")?>">Novo Produto</a>
					</li>
					<li class="active">
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
