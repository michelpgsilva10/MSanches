<script language="JavaScript"></script>
<div class="panel panel-default">
	<div class="panel-body">		
		<div class="row">			
			<div class="col-md-9 col-md-push-3">				
				<div  class="panel panel-default">
					
					<div class="container-fluid" align="center">
						<div width="100%" align="center" style="padding-top: 10px; padding-bottom: 10px;">
							<div class="btn-group" align="left">
								<select id="opcao_loja" class="form-control">
									<option value="0">Todas as Lojas</option>	
									<?php
										for ($i = 0; $i < count($lojas); $i++)
											echo '<option value="' . $lojas[$i]['id_loja'] . '">' . $lojas[$i]['nome_loja'] . '</option>'; 
									?>								
								</select>						
							</div>
						</div>	
						<div class="row">
							<div class="col-md-8 col-md-offset-2" align="center" >
								<table class="table table-striped table-hover">
									<thead>
										<th></th>
										<th style="text-align: center">Tipo</th>
										<th style="text-align: center">Quntidade de Modelos</th>
										<th style="text-align: center">Quantidade em Estoque</th>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center">1</td>
											<td style="text-align: center">Anel</td>
											<td style="text-align: center"><?php echo $anel; ?></td>
											<td style="text-align: center"><?php echo $anel2; ?></td>
										</tr>
										<tr>
											<td style="text-align: center"> 2 </td>
											<td style="text-align: center">Bracelete</td>
											<td style="text-align: center"><?php echo $bracelete; ?></td>
											<td style="text-align: center"><?php echo $bracelete2; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">3</td>
											<td style="text-align: center">Brinco</td>
											<td style="text-align: center"><?php echo $brinco; ?></td>
											<td style="text-align: center"><?php echo $brinco2; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">4</td>
											<td style="text-align: center">Colar</td>
											<td style="text-align: center"><?php echo $colar; ?></td>
											<td style="text-align: center"><?php echo $colar2; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">5</td>
											<td style="text-align: center">Conjunto</td>
											<td style="text-align: center"><?php echo $conjunto; ?></td>
											<td style="text-align: center"><?php echo $conjunto2; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">6</td>
											<td style="text-align: center">Pulceira</td>
											<td style="text-align: center"><?php echo $pulceira; ?></td>
											<td style="text-align: center"><?php echo $pulceira2; ?></td>
										</tr>
										<tr>
											<td style="text-align: center">7</td>
											<td style="text-align: center">Tornozeleira</td>
											<td style="text-align: center"><?php echo $tornozeleira; ?></td>
											<td style="text-align: center"><?php echo $tornozeleira2; ?></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td style="text-align: center" colspan="2"><b> Total </b></td>
											<td style="text-align: center"><?php echo $tornozeleira+$brinco+$anel+$colar+$pulceira+$bracelete+$conjunto+$tornozeleira; ?></td>
											<td style="text-align: center"><?php echo $tornozeleira2+$brinco2+$anel2+$colar2+$pulceira2+$bracelete2+$conjunto2+$tornozeleira2; ?></td>
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
