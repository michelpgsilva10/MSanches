<?php
class Produtos extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			$this -> my_load_view('produtos', NULL);
		} else {
			redirect('login');

		}
	}
	
	public function busca()
	{
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			if($this -> input -> post('codigo', TRUE)){
				
			}else{
				$this -> my_load_view('buscaProduto', NULL);
			}
		} else {
			redirect('login');

		}
	}
	
	public function novo()
	{
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			if($this -> input -> post('valor', TRUE)){
				 
				 print_r($_POST);
				 
			}else{
				$this -> my_load_view('novoProduto', NULL);
			}
		} else {
			redirect('login');

		}
	}
	

}
