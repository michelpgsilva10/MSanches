<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="container-fluid">
					<div  class="panel panel-default">
						<div class="row" style="margin-top: 20px; width: 100%; padding-left: 7%;">
							<div class="list-group teste">								
								<?php 
									if($detalhes_compra) {
										echo '<div class="form-separator">';
										echo '	Compra de ' . $detalhes_compra[0]["nome_cliente"];
										echo '</div>';										
								?>											
								
								
								<?php
									if ($detalhes_compra[0]["tipo_venda"] == 0) {
										
								?>								
								
								<div style="display: table; width: 100%; padding-left: 5px;" class="list-group-item">
									<div style="float: left; width: 20%" align="center">
										<h4 class="text-primary">Produto</h4>
									</div>
									<div style="float: left; width: 20%;" align="center">
										<h4 class="text-primary">Quantidade</h4>
									</div>
									<div style="float: left; width: 20%" align="center">
										<h4 class="text-primary">Desconto</h4>
									</div>
									<div style="float: left; width: 20%" align="center">
										<h4 class="text-primary">Valor Unitário</h4>
									</div>									
									<div style="float: left; width: 20%" align="center">
										<h4 class="text-primary">Subtotal</h4>
									</div>
								</div>	
								<div class="scroll-tabela">							
								<?php
									
										for ($i = 0; $i < count($detalhes_compra); $i++) {
																					
									
								?>
								<div style="display: table; width: 100%; padding-left: 5px;" class="list-group-item">
									<div style="float: left; width: 20%" align="center">
										<h5 class="text-center"><?php echo $detalhes_compra[$i]["cod_barra_produto"]; ?></h5>
									</div>
									<div style="float: left; width: 20%" align="center">
										<h5 class="text-center"><?php echo $detalhes_compra[$i]["quantidade_produto"]; ?></h5>
									</div>
									<div style="float: left; width: 20%" align="center">
										<h5 class="text-center"><?php echo $detalhes_compra[$i]["desconto"]."%"; ?></h5>
									</div>
									<div style="float: left; width: 20%" align="center">
										<h5 class="text-center"><?php echo 'R$ ' . number_format($detalhes_compra[$i]["valor_produto"], 2, ',', '.'); ?></h5>
									</div>
									<div style="float: left; width: 20%" align="center">
										<h5 class="text-center">
											<?php 
												$quantidade = $detalhes_compra[$i]["quantidade_produto"];
												$valor_produto = $detalhes_compra[$i]["valor_produto"];
												$desconto = ($detalhes_compra[$i]["valor_produto"]*($detalhes_compra[$i]["desconto"]/100));
												echo 'R$ ' . number_format($quantidade * ($valor_produto-$desconto), 2, ',', '.');
											?>
										</h5>
									</div>
									
								</div>
								
								<?php
										 }
										 echo '</div>';
									} else {									
								?>
																
								<div style="display: table; width: 100%; padding-left: 5px;" class="list-group-item">
									<div style="float: left; width: 16%" align="center">
										<h4 class="text-primary">Produto</h4>
									</div>
									<div style="float: left; width: 16%;" align="center">
										<h4 class="text-primary">Qtde Pegou</h4>
									</div>
									<div style="float: left; width: 16%" align="center">
										<h4 class="text-primary">Qtde Vendida</h4>
									</div>
									<div style="float: left; width: 16%" align="center">
										<h4 class="text-primary">Desconto</h4>
									</div>	
									<div style="float: left; width: 16%" align="center">
										<h4 class="text-primary">Valor Unitário</h4>
									</div>									
									<div style="float: left; width: 16%" align="center">
										<h4 class="text-primary">Subtotal</h4>
									</div>
								</div>
								<div class="scroll-tabela">
								
								<?php
									for ($i = 0; $i < count($detalhes_compra); $i++) {
										
								?>
								
								<div style="display: table; width: 100%; padding-left: 5px;" class="list-group-item">
									<div style="float: left; width: 16%;" align="center">
										<h5 class="text-center"><?php echo $detalhes_compra[$i]["cod_barra_produto"] ?></h>
									</div>
									<div style="float: left; width: 16%;" align="center">
										<h5 class="text-center"><?php echo $detalhes_compra[$i]["quant_pegou"] ?></h5>
									</div>
									<div style="float: left; width: 16%;" align="center">
										<h5 class="text-center">
											<?php
												if($detalhes_compra[$i]["quant_dev"] != NULL) 
													echo $detalhes_compra[$i]["quant_dev"];
												else
													echo '-'; 
											?>
										</h5>
									</div>
									<div style="float: left; width: 16%;" align="center">
										<h5 class="text-center">
											<?php 
													echo $detalhes_compra[$i]["desconto"]."%";
											?>
										</h5>
									</div>
									<div style="float: left; width: 16%;" align="center">
										<h5 class="text-center"><?php echo 'R$ ' . number_format($detalhes_compra[$i]["valor_produto"], 2, ',', '.'); ?></h5>
									</div>
									<div style="float: left; width: 16%" align="center">
										<h5 class="text-center">
											<?php 
												if ($detalhes_compra[$i]["quant_dev"] != NULL ) 
													$quantidade = $detalhes_compra[$i]["quant_dev"];												
												else
													$quantidade = $detalhes_compra[$i]["quant_pegou"];
												$desconto = ($detalhes_compra[$i]["valor_produto"]*($detalhes_compra[$i]["desconto"]/100));
												$valor_produto = $detalhes_compra[$i]["valor_produto"];
												echo 'R$ ' . number_format($quantidade * ($valor_produto-$desconto), 2, ',', '.');
											?>
										</h5>
									</div>
									
								</div>
								<?php
										}
										echo '</div>';
									}
								?>
								
								<div style="display: table; width: 100%; padding-left: 5px;" class="list-group-item">
									<div style="float: left; width: 75%;" align="right">
										<h4><b>Total</b></h4>
									</div>
									<div style="float: left; width: 25%;" align="center">
										<?php
											if ($detalhes_compra[0]["tipo_venda"] == 1) {
												if ($detalhes_compra[0]["valor_venda2"] == NULL)
													echo '<h4 class="text-primary">R$ ' .  number_format($detalhes_compra[0]["valor_venda"], 2, ',', '.') . '</h4>';
												else
													echo '<h4 class="text-primary">R$ ' .  number_format($detalhes_compra[0]["valor_venda2"], 2, ',', '.') . '</h4>';
											} else 
												echo '<h4 class="text-primary">R$ ' .  number_format($detalhes_compra[0]["valor_venda"], 2, ',', '.') . '</h4>';
											
										?>
									</div>									
								</div>
								
								<?php
									}
								?>								
							</div>										
						</div>
						<div style="width: 100%; padding: 10px;" align="center">
							<a href="<?php
										 if ($detalhes_compra[0]["tipo_venda"] == 0) {
										 	echo site_url("cliente/gerarPDF/" . $detalhes_compra[0]["id_venda"]);
										 } else if ($detalhes_compra[0]["tipo_venda"] == 1 && $detalhes_compra[0]["quant_dev"] == NULL) {
										 	echo site_url("cliente/gerarPDFInicio/" . $detalhes_compra[0]["id_venda"]);
										 } else {
										 	echo site_url("cliente/gerarPDFVolta/" . $detalhes_compra[0]["id_venda_consignado"]);
										 }
										  
									 ?>" class="btn btn-primary" target="_blank">Imprimir Registro de Compra</a>
						</div>
					</div>					
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li>
						<a href="<?php echo site_url("cliente/cliente") ?>">Buscar Cliente</a>
					</li>
					<li>
						<a href="<?php echo site_url("cliente/novoCliente") ?>">Novo Cliente</a>
					</li>
					<li >
						<a href="<?php echo site_url("cliente/comprasCliente/" . $detalhes_compra[0]["id_cliente"])?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>