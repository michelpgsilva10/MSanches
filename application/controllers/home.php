<?php
class Home extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	public function index() {
		if ($this -> session -> userdata('load')) {
			$this -> my_load_view('home', NULL);
		} else {
			redirect('login');

		}
	}
}