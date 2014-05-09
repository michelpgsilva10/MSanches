<script language="JavaScript">
		var cont = 0;
	
	function atualizaT(){
		var total=0;
		var valor;
		for(var i=1;i<=cont;i++){
			if(parseInt(document.getElementById("QItem"+i).value)==1){
				valor = document.getElementById("vItem"+i).value;
				total+=parseInt(valor);
			}else{
				valor1 = parseInt(document.getElementById("vItem"+i).value)*parseInt(document.getElementById("QItem"+i).value);
				total+=valor1;
			}
			
		}
		document.getElementById("total").value= ""+total;
		document.getElementById("total").value= ""+total;
	}
	
	function getfocus() {
		document.getElementById("codigoP").value = '';
		document.getElementById('codigoP').focus();
	}
	
	function atualizaQ(evento,id){
			var total=0, valor,valor1;
		for(var i=1;i<=cont;i++){
			if(parseInt(document.getElementById("QItem"+i).value)==1){
				valor = document.getElementById("vItem"+i).value;
				total+=parseInt(valor);
				
			}else{
				valor1 = parseInt(document.getElementById("vItem"+i).value)*parseInt(document.getElementById("QItem"+i).value);
				total+=valor1;
			}
			
		}
		document.getElementById("total").value= ""+total;
	}
	
	function Enter(evento) {

	if (evento.keyCode == 13)//event.which para FF
	{
	cont++;

	var cod = document.getElementById("codigoP").value;
	var itemT = "<tr id=\"item" + cont + "\">" +
					 "<td> <input type=\"text\" class=\"form-control\" placeholder=\"Codigo\" value=\"" +cod + "\" disabled> </td>" +
					 "<td> <input id=\"QItem" + cont + "\" type=\"text\"  value=\"1\" class=\"form-control\" placeholder=\"Quantidade\" onkeypress=\"atualizaQ("+"event,'"+cont+"')\"></td>"+
					 "<td> <input id=\"vItem" + cont + "\" type=\"text\" class=\"form-control\" placeholder=\"Valor\" value="+ "10"+" disabled ></td>" +
					 "<td> <input id=\"vItemT" + cont + "\" type=\"text\" class=\"form-control\" placeholder=\"Valor\" value="+ "10"+" disabled ></td>" +
					 "<td> <input type=\"checkbox\" id=\"inlineCheckbox1\" align=\"center\"  onclick=\"Deletar('"+cont+"')\"></td>" +
				"</tr>";
	$("#tabelaV").append(itemT);
	atualizaT();
	getfocus();

	}
	}

	function Deletar(id) {
		var total;
		if(parseInt(document.getElementById("QItem"+id).value)==1){
			total = parseInt(document.getElementById("total").value)-parseInt(document.getElementById("vItem"+id).value);
		}else{
			total = parseInt(document.getElementById("total").value)-(parseInt(document.getElementById("vItem"+id).value)*parseInt(document.getElementById("QItem"+id).value));
		}
		document.getElementById("total").value= ""+total;
		cont--;
		$('#item'+id).remove();
		
	}

</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="container-fluid">
				<br />
				<form class="form-horizontal" method="post" role="form">
					<div class="row">
						<div class="col-md-6 col-md-offset-3" align="center">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Nome do Cliente</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nomeCliente" name="nomeCliente" placeholder="Nome">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Código do Produto</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="codigoP" placeholder="Código" onkeypress="Enter(event)">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 ">
							<table class="table table-bordered table-hover"  style="margin-left: 18%">
								<thead>
									<tr>
										<th style="text-align: center" >Código do Poroduto</th>
										<th style="text-align: center">Quantidade</th>
										<th style="text-align: center" colspan="2">Unidade  |  Total </th>
										<th style="text-align: center"> Deletar </th>
									</tr>
								</thead>
								<tbody id="tabelaV">
									
								</tbody>
								<tfoot>
									<td > <strong> Total  </strong></td>
									<td colspan = 4><input type="text" align="center" class="form-control" id="total" name="total" value="0" style="text-align: center" disabled></td>
								</tfoot>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3" align="center">
							<ul class="pager">
								<li>
									<a href="<?php echo site_url("home")?>">Sair</a>
								</li>
								<li>
									<a type="submit" href="#">Finalizar</a>
								</li>
							</ul>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
