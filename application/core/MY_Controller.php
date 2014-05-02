<?php
/**
 *
 */
class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function my_load_view($page, $data) {
		if ($this -> session -> userdata('load')) {
			$this -> load -> view('head');
			$this -> load -> view('menu');
			$this -> load -> view($page, $data);
			$this -> load -> view('footer');
		} else {
			$this -> load -> view('head');
			$this -> load -> view($page, $data);
			$this -> load -> view('footer');

		}
	}

}
?>