<script language="JavaScript"></script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div  class="panel panel-default">
					<div class="container-fluid" align="center">
						<div class="row">
							<div class="col-md-6 col-md-offset-3" align="center" >
								<table class="table table-striped table-hover">
									<thead>
										<th style="text-align: center">Tipo</th>
										<th style="text-align: center">Quantidade</th>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center">Anel</td>
											<td style="text-align: center"><?php echo $anel; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">Bracelete</td>
											<td style="text-align: center"><?php echo $bracelete; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">Brinco</td>
											<td style="text-align: center"><?php echo $brinco; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">Conjunto</td>
											<td style="text-align: center"><?php echo $conjunto; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">Colar</td>
											<td style="text-align: center"><?php echo $colar; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">Pulceira</td>
											<td style="text-align: center"><?php echo $pulceira; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">Tornozeleira</td>
											<td style="text-align: center"><?php echo $tornozeleira; ?></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td style="text-align: center"><b> Total </b></td>
											<td style="text-align: center"><?php echo $tornozeleira+$brinco+$anel+$colar+$pulceira+$bracelete+$conjunto+$tornozeleira; ?></td>
										</tr>
									</tfoot>
								</table>
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

					<li >
						<a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>
					</li>
					<li >
						<a href="<?php echo site_url("produtos/novo")?>">Novo Produto</a>
					</li>
					<li>
						<a href="<?php echo site_url("produtos/etiquetas")?>">Etiquetas</a>
					</li>
					<li class="active">
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
