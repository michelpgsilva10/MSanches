<?php
class Fpdf extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('session');	
		$this->load->library('fpdf'); // Load library
    	//$this->fpdf->fontpath = 'libraries/font/';
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			
		} else {
			redirect('login');
		}
	}
}

?>
	