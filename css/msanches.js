function hideAlertSuccess() {
	$('#cliente_success').delay(7000);
	$('#cliente_success').fadeOut('fast');
}

$(document).ready(function(){
  $('#cpf_cliente').mask('999.999.999-99');
  $('#tel_cliente').mask('(99) 9999-9999');
});
