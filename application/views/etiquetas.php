<script language="JavaScript">
	var cont = 0;
	function getfocus() {
		document.getElementById("codigoP").value = '';
		document.getElementById('codigoP').focus();
	}
	function Enter(evento) {

		if (evento.keyCode == 13)//event.which para FF
		{
			cont++;

			var cod = document.getElementById("codigoP").value;
			var itemT = "<tr id=\"item" + cont + "\">" +
						 	"<td> <input type=\"text\" name=\"codp"+cont+"\" class=\"form-control\" placeholder=\"Codigo\" value=\"" +cod + "\" disabled> </td>" +
						 	"<td> <input id=\"QItem" + cont + "\" type=\"text\"  value=\"1\" class=\"form-control\" placeholder=\"Quantidade\"></td>"+
							"<td> <input type=\"checkbox\" id=\"inlineCheckbox1\" align=\"center\"  onclick=\"Deletar('"+cont+"')\"></td>" +
						"</tr>";
			$("#tabelaE").append(itemT);
			getfocus();
		}
	}
	function Deletar(id) {
		cont--;
		$('#item'+id).remove();
		
	}
</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div  class="panel panel-default">
					<div class="container-fluid" align="center">
						<div class="row">
							<div class="col-md-6 col-md-offset-3" align="center" >
								<form  class="form-horizontal" method="post" role="form">
									<div class="row" style="margin-top: 10%">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-5 control-label">Posição inicial</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="inicioE" name="inicioE" placeholder="de 1 até 140">
											</div>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-5 control-label">Código do Produto</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="codigoP" placeholder="Código" onkeypress="Enter(event)">
											</div>
										</div>
									</div>
									<div class="row">
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th style="text-align: center" >Código do Poroduto</th>
													<th style="text-align: center">Quantidade</th>
													<th style="text-align: center"> Deletar </th>
												</tr>
											</thead>
											<tbody id="tabelaE">
											</tbody>
										</table>
									</div>
									<div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary">
												Gerar Etiquetas
											</button>
										</div>
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

					<li >
						<a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>
					</li>
					<li >
						<a href="<?php echo site_url("produtos/novo")?>">Novo Produto</a>
					</li>
					<li class="active">
						<a href="#">Etiquetas</a>
					</li>
					<li>
						<a href="#">Estoque</a>
					</li>
					<li >
						<a href="<?php echo site_url("home")?>">Voltar</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>
