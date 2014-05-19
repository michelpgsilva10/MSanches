<?php
class Etiqueta extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('download');
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			$quantidade = $this -> input -> post('quantidade', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$code1 = str_split($code);
			if($code1[0]==1){
			$data = "I8,A,001".PHP_EOL.
			PHP_EOL.
			PHP_EOL.
			"Q128,023".PHP_EOL.
			"q863".PHP_EOL.
			"rN".PHP_EOL.
			"S3".PHP_EOL.
			"D14".PHP_EOL.
			"ZT".PHP_EOL.
			"JF".PHP_EOL.
			"OD".PHP_EOL.
			"R60,0".PHP_EOL.
			"f100".PHP_EOL.
			"N".PHP_EOL.
			"B651,69,2,9,1,3,55,N,\"".$code."\"".PHP_EOL.
			"A460,51,2,2,1,1,N,\"".$code."\"".PHP_EOL.
			"P".$quantidade.PHP_EOL;
			}else{
				$data = "I8,A,001".PHP_EOL.
			PHP_EOL.
			PHP_EOL.
			"Q160,024".PHP_EOL.
			"q863".PHP_EOL.
			"rN".PHP_EOL.
			"S3".PHP_EOL.
			"D15".PHP_EOL.
			"ZT".PHP_EOL.
			"JF".PHP_EOL.
			"O".PHP_EOL.
			"R24,0".PHP_EOL.
			"f100".PHP_EOL.
			"N".PHP_EOL.
			"B181,59,2,9,1,3,80,N,\"".$code."\"".PHP_EOL.
			"B462,65,2,9,1,3,80,N,\"".$code."\"".PHP_EOL.
			"A185,83,2,3,1,1,N,\"".$code."\"".PHP_EOL.
			"B740,62,2,9,1,3,80,N,\"".$code."\"".PHP_EOL.
			"A466,89,2,3,1,1,N,\"".$code."\"".PHP_EOL.
			"A745,86,2,3,1,1,N,\"".$code."\"".PHP_EOL.
			"P".$quantidade.PHP_EOL; 
			}
			
			force_download("etiquetas.prn", $data); 
			redirect('produtos');
			
		} else {
			redirect('login');
		}
	}
}
?>