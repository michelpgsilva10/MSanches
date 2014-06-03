<script language="JavaScript">
	function Enter(evento) {

		if ((evento.keyCode == 13) && (document.getElementById("codigoP").value != ""))//event.which para FF
		{
			document.forms['formV'].submit();
		}
	}

	function SomenteNumero(e) {
		var tecla = (window.event) ? event.keyCode : e.which;
		if ((tecla > 47 && tecla < 58))
			return true;
		else {
			if (tecla == 8 || tecla == 0)
				return true;
			else
				return false;
		}
	}

</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="container-fluid">
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
				<br />
				<form class="form-inline" name="formV" method="post" role="form" action="<?php
				echo site_url("venda/verificaItem/" . $total . "/" . $cliente[0]['id_cliente']."/".$id);
				?>">
					<div class="row">
						<div class="col-md-7 col-md-offset-3" align="center">
							<div class="form-group">
								<label for="inputEmail3" control-label" >Cliente: <?php
								if (isset($cliente)) { echo $cliente[0]['nome_cliente'];
								} else { echo "Não Selecionado";
								}
 ?></label>									
							</div>
						</div>
					</div>
					<br />
					<div class="row">
								<div class="form-group" style="margin-left: 23%">
									<label  for="inputEmail3" class = "col-sm-4 control-label">Quantidade Devolvida:</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="quantP"  id="quantP" value="1" style="text-align: center;" onkeypress="return SomenteNumero(event);" maxlength="4" required>
									</div>
									<div class="col-sm-2">
										<input type="text" class="form-control" name="codigoP" id="codigoP" placeholder="Código do Produto" onkeypress="Enter(event)" autofocus required>
									</div>
								</div>
						</div>
					</div>
				</form>
				<br />
				<div class="row">
					<div class="col-md-9 ">
						<table class="table table-bordered table-hover"  style="margin-left: 18%">
							<thead>
								<tr class="info">
									<th style="text-align: center" >Código do Poroduto</th>
									<th style="text-align: center">Quantidade Levada</th>
									<th style="text-align: center">Quantidade Devolvida</th>
									<th style="text-align: center" colspan="2">Unidade  |  Total </th>
									<th style="text-align: center"></th>
								</tr>
							</thead>
							<tbody id="tabelaV">
								<?php 
for($i=0;$i<count($produtos);$i++){
?>
<tr <?php if($produtos[$i]->tipo_produto==1){?> class="success" <?php } ?>>
								<td style="text-align: center;"> <?php echo $produtos[$i]->	cod_barra_produto ?>
								 <?php if($produtos[$i]->tipo_produto==1){ ?>
								 	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
								 <?php } ?>
								</td>
								<td style="text-align: center;"> <?php echo $produtos[$i]->	estoque_produto ?>
								</td>
								</td>
								<td style="text-align: center;"> <?php echo $produtos[$i]->	modelo_produto ?>
								</td>
								<td style="text-align: center;"> <?php echo $produtos[$i]->	valor_produto ?>
								</td>
								<td style="text-align: center;"> <?php echo $produtos[$i]->valor_produto*($produtos[$i]->estoque_produto-$produtos[$i]->modelo_produto) ?></td>
								<td style="text-align: center;"> <a type="button" class="btn btn-info btn-sm" href="<?php
								echo site_url("venda/visualizaI/" . $produtos[$i]->id_produto . "/" . $total . "/0/" . $cliente[0]['id_cliente']."/".$id);
								?>">Ver Produto</a><?php if($produtos[$i]->tipo_produto==1){ ?> <a type="button" class="btn btn-info btn-sm" href="<?php
								echo site_url("venda/voltarCom/" .$i. "/" . $total . "/" . $cliente[0]['id_cliente']."/".$id);
								?>">Desfazer Ação</a><?php } ?>
								
								<?php }  ?>
								
							</tbody>
							<tfoot>
								<tr class="info">
									<td style="text-align: center;" ><strong> Total </strong></td>
									<td colspan = 5 style="text-align: center;"><label> <b> <?php echo $total; ?> </b></label></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3" align="center">
						<ul class="pager">
							<li>
								<a type="button" href="<?php echo site_url("venda/sair")?>">Sair</a>
							</li>
							<li>
								<a type="button" href="<?php
								echo site_url("venda/finalizarRetorno/" . $total . "/" . $cliente[0]['id_cliente']."/".$id);?>">Finalizar</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
