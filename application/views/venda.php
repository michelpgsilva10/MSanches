<script>
	$(function() {
		$("#dialog").dialog();
		$("#confirma").click(function() {
			$("#dialog").dialog("close");
		});
	}); 
</script>
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
<?php if(isset($romaneio)){
?>
<div id="dialog" title="Romaneio">
	<label> Deseja imprimir o Romaneio?</label>
	<br />
	<br />
	<a type="button" id="confirma" class="btn btn-success"  href="<?php
		if (isset($consig)) {
			echo site_url("cliente/gerarPDFVolta/" . $romaneio);
		} else {
			if ($tipo == 2) {
				echo site_url("cliente/gerarPDFInicio/" . $romaneio);
			} else {
				echo site_url("cliente/gerarPDF/" . $romaneio);
			}
		}
 ?>" target="_blank"> Confirmar </a>
</div>
<?php } ?>
<div class="row" style=" text-align: center">
	<a href="<?php echo site_url("venda/comum")?>" class="button blue">Venda Comum</a>
	<br/>
	<a href="<?php echo site_url("venda/consignado")?>" class="button green">Venda Consignado</a>
	<br/>
	<a href="<?php echo site_url("home")?>" class="button orange">Voltar</a>
	<br/>
</div>