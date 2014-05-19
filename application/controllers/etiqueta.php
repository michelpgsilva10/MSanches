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
			$modelo = $this -> input -> post('modelo', TRUE);
			$valor = $this -> input -> post('valor', TRUE);
			$data = "I8,A,001
			
			
Q128,023
q863
rN
S3
D7
ZT
JF
OD
R60,0
f100
N
A475,69,2,2,1,1,N,\"Modelo: ".$modelo."\"
A471,43,2,2,1,1,N,\"Valor: " .$valor."\"
B651,72,2,9,1,3,55,N,".$code."\"
P".$quantidade;
			force_download("etiquetas.txt", $data); 
			redirect('produtos');
			
		} else {
			redirect('login');
		}
	}
}
?>