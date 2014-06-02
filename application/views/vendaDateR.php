<script>
	function submit(){
		document.forms['formD'].submit();
	}
	 $(function() {
		$( "#data" ).datepicker();
		 $( "#data" ).datepicker( "option", "dateFormat",'dd-mm-yy');
	 });F
</script>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="container-fluid">
				<div class="row">
					<br />
					<form class="form-horizontal" method="post" role="form" name="formD" action="<?php echo site_url("venda/finalizarCompraC/" . $total . "/" . $cliente)?>">
						<div class="col-md-6 col-md-offset-3">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Data de Retorno:</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="data" name="data" placeholder="99/99/9999" required>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3" align="center">
						<ul class="pager">
							<li>
								<a type="button" href="<?php echo site_url("venda/sair/1")?>">Sair</a>
							</li>
							<li>
								<a type="button" href="#" onclick="submit();">Finalizar</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>