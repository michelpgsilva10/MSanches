<?php
/**
 *
 */
class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function my_load_view($page, $data) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			$this -> load -> view('head');
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