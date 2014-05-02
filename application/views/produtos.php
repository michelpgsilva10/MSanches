<script language="JavaScript">$('.collapse').collapse()</script>

<h1 style="text-align: center;  padding: 30px 0;"><a href="<?php echo site_url("home")?>"><span class="glyphicon glyphicon-home"></span> <font color="#000000"> MSanches </font></a></h1>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				.col-md-9 .col-md-push-3
			</div>
			<div class="col-md-3 col-md-pull-9">
				<ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="#">Estoque</a>
					</li>
					<li>
						<a data-toggle="collapse" data-parent="#accordion" href="#dropP"> Produtos <b class="caret"></b> </a>

						<ul id="dropP" class="panel-collapse collapse nav nav-pills nav-stacked" style="margin-left: 5%" >
							<li>
								<a href="#">Novo Produto</a>
							</li>
							<li >
								<a href="#">Alterar Produto</a>
							</li>
							<li >
								<a href="#">Excluir Produto</a>
							</li>
						</ul>
					</li>
					<li>
						<a data-toggle="collapse" data-parent="#accordion" href="#dropC"> Clientes <b class="caret"></b> </a>

						<ul id="dropC" class="panel-collapse collapse nav nav-pills nav-stacked" style="margin-left: 5%" >
							<li>
								<a href="#">Novo Cliente</a>
							</li>
							<li >
								<a href="#">Alterar Cliente</a>
							</li>
							<li >
								<a href="#">Excluir Cliente</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Vendas</a>
					</li>
					<li>
						<a href="#">Relatório</a>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>
