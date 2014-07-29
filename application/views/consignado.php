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
					<br />
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
							&times;
						</button>
						<?php	echo $mensagem; ?>
					</div>
					<?php } ?>						
						<div class="panel-body">
							<div class="row">
					<div class="col-md-11 ">
						<?php if(isset($vendas)){ ?>
						<table class="table table-bordered table-hover"  style="margin-left: 5%">
							<thead>
								<tr class="info">
									<th style="text-align: center" >Código da Venda</th>
									<th style="text-align: center">Nome do Cliente</th>
									<th style="text-align: center">Valor Total </th>
									<th style="text-align: center">Data de Venda</th>
									<th style="text-align: center">Data de Devolução</th>
									<th style="text-align: center"></th>
								</tr>
							</thead>
							<tbody id="tabelaV">
								<?php for($i=0;$i<count($vendas);$i++){
								 ?>
								  <tr>
								  	<td style="text-align: center;"> <?php echo $vendas[$i]->id_venda ?> </td>
								  	<td style="text-align: center;"> <?php echo $vendas[$i]->cliente_fk?> </td>
								  	<td style="text-align: center;"> R$<?php echo number_format($vendas[$i]->valor_venda, 2, ',', '.'); ?> </td>
								  	<td style="text-align: center;"> <?php echo $vendas[$i]->data_venda ?></td>
								  	<td style="text-align: center;"> <?php echo $vendas[$i]->data_retorno_venda ?></td>
								  	<td style="text-align: center;"> <a type="button" class="btn btn-info btn-sm btn-sm" href="<?php echo site_url("venda/retornoCom/".$vendas[$i]->id_venda)?>">Finalizar Fatura</a>
								  </tr> 
								<?php } ?>
							</tbody>
						</table>
						<?php
						}else{
						echo "<h5>Não possui nem uma Fatura a ser Finalizada</h5>";
						}
						?>
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
						<a href="<?php echo site_url("venda/novoCom")?>">Nova Venda</a>
					</li>
					<li >
						<a href="<?php echo site_url("home")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>
