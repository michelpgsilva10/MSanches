<?php
class Venda extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			$this -> my_load_view('venda', NULL);
		} else {
			redirect('login');
		}
	}
	public function comum() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			$this -> my_load_view('vendaComum', NULL);
		} else {
			redirect('login');
		}
	}
}
?>