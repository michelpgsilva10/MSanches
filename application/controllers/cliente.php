<?php
class Produtos extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {
		$this -> my_load_view('novoCliente', NULL);
	}
}
?>