<script language="JavaScript">
	function Enter(evento) {

		if ((evento.keyCode == 13) && (document.getElementById("codigoP").value != ""))//event.which para FF
		{
			document.forms['formV'].submit();
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
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						&times;
					</button>
					<?php	echo $mensagem; ?>
				</div>
				<?php } ?>
				<br />
				<form class="form-inline" name="formV" method="post" role="form" action="<?php echo site_url("venda/buscaCliente/".$total)?>">
					<div class="row">
						<div class="col-md-6 col-md-offset-3" align="center">
							<div class="form-group">
    							<div class="col-sm-5">
    								  <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome ou CPF do Cliente" autofocus onkeypress="Enter(event)" >
							    </div>
  							</div>
  							<div class="form-group">
  								 <select class="form-control" style="text-align: center;" name="tipo">
    								  	<option  value="1" style="text-align: center;" selected>CPF</option>
    								  	<option  value="2" style="text-align: center;"> Nome </option>
    							</select>
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
									<th style="text-align: center" >Nome</th>
									<th style="text-align: center">Telefone</th>
									<th style="text-align: center"></th>
								</tr>
							</thead>
							<tbody id="tabelaV">
								<?php if(isset($cliente)){
									for($i=0;$i<count($cliente);$i++){?>
										<tr>
											<td style="text-align: center;"> <?php echo $cliente[$i]['nome_cliente']; ?></td>
											<td style="text-align: center;"> <?php echo $cliente[$i]['tel_cliente']; ?></td>
											<td style="text-align: center;"> <a type="button" class="btn btn-info" href="<?php echo site_url("venda/selCliente/".$cliente[$i]['id_cliente']."/".$total)?>">Selecionar</a>
										</tr>
								<?php } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
