<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div  class="panel panel-danger">
					<div class="panel-heading" style="text-align: center;">
							<h3 class="panel-title">Faturas não Finalizadas</h3>
						</div>
					<br />
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
						<div class="panel-body">
							<div class="row">
					<div class="col-md-9 ">
						<table class="table table-bordered table-hover"  style="margin-left: 18%">
							<thead>
								<tr class="info">
									<th style="text-align: center" >Código do Poroduto</th>
									<th style="text-align: center">Quantidade</th>
									<th style="text-align: center" colspan="2">Unidade  |  Total </th>
									<th style="text-align: center"></th>
								</tr>
							</thead>
							<tbody id="tabelaV">
								<?php if(isset($vendas)){ 
								 for($i=0;$i<count($vendas);$i++){
								 ?>
								  <tr>
								  	<td style="text-align: center;"> <?php echo $produtos[$i]->	cod_barra_produto ?> </td>
								  	<td style="text-align: center;"> <?php echo $produtos[$i]->	estoque_produto ?> </td>
								  	<td style="text-align: center;"> <?php echo $produtos[$i]->	valor_produto ?> </td>
								  	<td style="text-align: center;"> <?php echo $produtos[$i]->valor_produto*$produtos[$i]->estoque_produto ?></td>
								  	<td style="text-align: center;"> <a type="button" class="btn btn-info" href="<?php echo site_url("venda/deletaItem/".$i."/".$total)?>">Deletar</a>
								  </tr> 
								<?php } }?>
							</tbody>
						</table>
					</div>
				</div>
						</div>
					<br />
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="<?php echo site_url("venda/consignado")?>"> Vendas Consignado </a>
					</li>
					<li >
						<a href="#">Nova Venda</a>
					</li>
					<li >
						<a href="<?php echo site_url("home")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>
