<script language="JavaScript">
	function Enter(evento) {

		if ((evento.keyCode == 13) && (document.getElementById("codigoP").value != ""))//event.which para FF
		{
		document.forms['formV'].submit();
		}
	}
 	$(function() {
 		 $( "#retornoData" ).datepicker();
		 $( "#retornoData" ).datepicker( "option", "dateFormat", "dd/mm/yy");
	});
</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="container-fluid">
				<?php if (isset($mensagem))
					{
								?>
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php	echo $mensagem; ?>
								</div>
					<?php } ?>
				<br />
				<form class="form-horizontal" name="formV" method="post" role="form" action="<?php echo site_url("venda/novoitem/".$total)?>">
					<div class="row">
						<div class="col-md-6 col-md-offset-3" align="center">
							<div class="form-group" style="margin-right: 15%;">
								<label for="inputEmail3" class="col-sm-5 control-label">Cliente:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nomeCliente" name="nomeCliente" placeholder="Nome">
								</div>
							</div>
							<div class="form-group" style="margin-right: 15%;">
								<label for="inputEmail3" class="col-sm-5 control-label">Data de Retorno:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="retornoData" name="retornoData" placeholder="Ex: 31/12/9999">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3" align="center" >
							<div class="form-inline" align="center">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Quantidade:</label>
									<div class="col-sm-7">
										<input type="number" class="form-control" name="quantP"  id="quantP" value="1" style="text-align: center;" required>
									</div>
								</div>
								<div class="form-group" style="margin-left: 10px;">
									<div class="col-sm-7">
										<input type="text" class="form-control" name="codigoP" id="codigoP" placeholder="Código do Produto" onkeypress="Enter(event)" autofocus required>
									</div>
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
									<th style="text-align: center">Quantidade</th>
									<th style="text-align: center" colspan="2">Unidade  |  Total </th>
									<th style="text-align: center"></th>
								</tr>
							</thead>
							<tbody id="tabelaV">
								<?php if($total!=0){ 
								 for($i=0;$i<count($produtos);$i++){
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
							<tfoot>
								<tr class="info">
									<td style="text-align: center;" ><strong> Total </strong></td>
									<td colspan = 4 style="text-align: center;"><label> <b> <?php echo $total; ?>
										</b></label></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3" align="center">
						<ul class="pager">
							<li>
								<a type="button" href="<?php echo site_url("venda/sair/1")?>">Sair</a>
							</li>
							<li>
								<a type="button" href="<?php echo site_url("venda/finalizarCompraC/".$total)?>">Finalizar</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
