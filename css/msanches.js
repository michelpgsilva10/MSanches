function hideAlertSuccess() {
	$('#cliente_success').delay(7000);
	$('#cliente_success').fadeOut('fast');
}


$(document).ready(function() {
	var estoqueLoja = '0';
	
	$('#cpf_cliente').mask('999.999.999-99');
	$('#tel_cliente').mask('(99) 99999-9999');

	if ($('#tipo').val() == 1)
		$("#nome").mask('999.999.999-99');
		
	if ($('#opcao_pesquisa_cliente').val() == 1)
		$("#pesquisa_cliente").mask('999.999.999-99');		

	$("#tipo").change(function() {//Quando houver uma mudança no select

		var opt = $("#tipo").val();
		//Recupera o valor do option selecionado
		if (opt == 1) {
			$("#nome").mask('999.999.999-99');
		} else {
			$("#nome").unmask();
		}

	});
	
	$('#opcao_pesquisa_cliente').change(function() {				
		if ($('#opcao_pesquisa_cliente').val() == 2) {			
			$('#pesquisa_cliente').unmask();
		} else {			
			$('#pesquisa_cliente').mask('999.999.999-99');	 
		}
		$('#pesquisa_cliente').focus();	
	});
	
	$('#opcao_loja').change(function() {	
		
		$('#div' + estoqueLoja).hide();			
		$('#div' + $('#opcao_loja').val()).show();
		
		estoqueLoja = $('#opcao_loja').val();	
	});
});
