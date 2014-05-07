<script language="JavaScript">
function getfocus()
{
document.getElementById('codigoP').focus()
}
function Enter(evento)
{
tecla = evento.keyCode;
if(tecla == 13)//event.which para FF
{
 alert('Você apertou o ENTER');
}
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
									<input type="email" class="form-control" id="nomeCliente" name="nomeCliente" placeholder="Nome">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Código do Produto</label>
								<div class="col-sm-7">
									<input type="email" class="form-control" id="codigoP" name="codigoP" placeholder="Nome" onkeypress="Enter(event)">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 ">
							<table class="table table-bordered table-hover" style="margin-left: 18%">
								<thead>
									<th>Código do Poroduto</th>
									<th>Quantidade</th>
									<th>Valor</th>
									<th> Deletar </th>
								</thead>
								<tbody>

								</tbody>
								<tfoot>
									<td > Total </td>
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
