<div class="panel panel-default">
	<div class="panel-body">
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
		<div class="row">
			<br />
			<div class="container-fluid" align="center">
				<div class="col-md-6 col-md-offset-3">
					<div>
						<h2>Qual item Deve manter a Foto?</h2>
					</div>
					<br />
					<?php
					if(isset($produtos)){
					for($i=0;$i<count($produtos);$i++){
					?>
					<div class="col-xs-6 col-md-4">
					<div class="thumbnail">
					<img data-src="holder.js/300x200" src="<?php echo $this -> config -> item('base_url') . "css/img/img_produto/" . $produtos[$i] -> foto_produto; ?>">
					<div class="caption">
					<h3><?php echo $produtos[$i] -> cod_barra_produto; ?></h3>
					<p>
						<a href="<?php echo site_url("bugs/corrigir/".$posicao."/".$i."/".$QItens)?>" class="btn btn-primary" role="button">Selecionar</a>
					</p>
				</div>
			</div>
		</div>
		<?php  }
			}else{
			echo "<p> Não Possui Produtos Errados </p>";
			}
		?>
	</div>
</div>
</div>
</div>
</div>

