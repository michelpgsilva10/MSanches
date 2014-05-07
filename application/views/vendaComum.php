<script language="JavaScript">
$('#myModal').modal({
  keyboard: false
})
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
									<input type="email" class="form-control" id="nomeCliente" placeholder="Nome">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<table class="table table-bordered table-hover" style="margin-left: 15%">
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
						<div class="col-xs-6 col-md-4" align="center">
							<button class="btn btn-primary" data-target="#myModal" data-toggle="modal">
								Adicionar Produto
							</button>
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
		<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" aria-hidden="true" data-dismiss="modal" type="button">
							×
						</button>
						<h4 id="mySmallModalLabel" class="modal-title"> Novo Item </h4>
					</div>
				</div>
				<div class="modal-body">
					<input type="text" class="form-control" name="codigo" id="codigo" placeholder="Exemplo: BR00000000">
					<span class="help-block">Digite o Código do Produto</span>
					<br />
				</div>
			</div>
		</div>
	</div>
</div>
</div>
