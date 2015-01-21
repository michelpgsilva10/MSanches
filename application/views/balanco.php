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
				<?php }else if (isset($mensagemC))
					{
				?>
				<br />
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						&times;
					</button>
					<?php	echo $mensagemC; ?>
				</div>
				<?php } ?>
				<br />
				<form class="form-inline" name="formV" method="post" role="form" action="<?php
				echo site_url("empresa/novoItem/".$idlista);
				?>">
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
					<div class="col-md-11">
						<table class="table table-bordered table-hover"  style="margin-left: 5%">
							<thead>
								<tr class="info">
									<th style="text-align: center">#</th>
									<th style="text-align: center" >Código do Barra</th>
									<th style="text-align: center">Código Produto</th>
									<th style="text-align: center">Quantidade</th>
									<th style="text-align: center" colspan="2">Unidade  |  Total </th>
									<th style="text-align: center"></th>
								</tr>
							</thead>
							<tbody id="tabelaV">
								<?php 
							if($total!=0){
							for($i=0;$i<count($produtos);$i++){?>
                            <tr <?php if($produtos[$i]['quantidade_D']!=0){?> class="success" <?php } ?>>
	                            <td style="text-align: center;"> <?php echo $i+1; ?> </td>
								<td style="text-align: center;"> <?php echo $produtos[$i]['codbarras'];?></td>
								<td style="text-align: center;"> <?php echo $produtos[$i]['id_produto']; ?>	</td>
								<td style="text-align: center;"> <?php echo $produtos[$i]['quantidade']; ?> </td>
								<td style="text-align: center;"> <?php echo $produtos[$i]['valor_uni']; ?>  </td>
								<td style="text-align: center;"> <?php echo $produtos[$i]['valor_pago']; ?> </td>
								<td style="text-align: center;"> 
								<a style="margin-left: 3%;" type="button" class="btn btn-info btn-sm" href="<?php
										if(isset($idlista)){
											echo site_url("empresa/visualizaI/" . $produtos[$i]['id_produto'] ."/".$idlista);
										}else{
											echo site_url("empresa/visualizaI/" . $produtos[$i]['id_produto'] );
										}
									?>" > Ver Produto </a>									
									<a type="button" class="btn btn-info btn-sm" href="<?php
											echo site_url("empresa/deletaItem/" . $produtos[$i]['id_produto'] . "/".$idlista);
										?>">Deletar</a> 
								</tr>
								<?php }}?>
								
							</tbody>
							<tfoot>
								<tr class="info">
									<td colspan = 3 style="text-align: center;" ><strong> Total </strong></td>
									<td colspan = 5 style="text-align: center;"><label> <b> <?php echo "R$: ".number_format($total, 2, ',', '.'); ?> </b></label></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3" align="center">
						<ul class="pager">
							<li>
								<a type="button" href="<?php echo site_url("empresa/sair/")?>">Sair</a>
							</li>
							<li>
								<a type="button" href="#<?php
								//echo site_url("empresa/finalizarRetorno/".$idlista);?>">Finalizar</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
