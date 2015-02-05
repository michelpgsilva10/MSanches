<?php
class Home extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			$user = $this -> usuario_model -> getLojaUser($this->session->userdata('id'));
			$this -> session -> set_userdata('nivel', $user->NIVEL_USER);
			$this -> my_load_view('principal', NULL);
		} else {
			redirect('login');

		}
	}

}
