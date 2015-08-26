<style>
	a.button {
		display: inline-block;
		width: 200px;
		padding: 15px 35px;
		text-decoration: none;
		color: white;
		text-transform: uppercase;
		font-weight: 700;
		margin: 0 auto 20px;
		-webkit-transition: all 0.2s ease-in-out;
		-moz-transition: all 0.2s ease-in-out;
	}
	.blue {
		background: #6D9BCA;
	}
	.red {
		background: #CA3721;
	}
	.green {
		background: #5ED64B;
	}
	.orange {
		background: orange;
	}
	a.button:hover {
		margin-top: -5px;
		margin-bottom: 25px;
	}

</style>
<div id="dialog" title="Loja">
	<?php
if (isset($mensagem)) {
	?>
	<br />
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
			&times;
		</button>
		<?php echo $mensagem; ?>
	</div>
	<?php
	} else if (isset($mensagemC)) {
	?>
	<br />
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
			&times;
		</button>
		<?php echo $mensagemC; ?>
	</div>
	<?php } ?>
	<div class="col-md-6 col-md-offset-3">
		<h4><strong> Qual loja você deseja Vender? </strong></h4>
		<br />
		<form name="formL" class="form-horizontal" role="form"  method="post" action="<?php if(isset($tipo)){ echo site_url("empresa/seleloja"); }else{ echo site_url("venda/seleloja"); } ?>">
			<div class="form-group">
				<div class="col-sm-7">
				<select class="form-control" name="loja" id="loja" style="text-align: center;" required>
					<option></option>
					<?php for($i=0;$i<count($lojas);$i++){ ?>
					<option value="<?php echo $lojas[$i]['id_loja']; ?>"> <?php echo $lojas[$i]['nome_loja']; ?> </option>
					<?php } ?>
				</select>
				</div>
				<br />
			</div>
			<button type="submit" id="confirma" class="btn btn-success"  >
				Confirmar
			</button>
			<a type="button" id="confirma" class="btn btn-success" href=" <?php echo site_url("validador"); ?> " > Voltar </a>
		</form>
	</div>
</div>
</div>
