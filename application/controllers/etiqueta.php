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
			$produto = $this -> usuario_model -> getProduto(0, $code,0,$this->session->userdata('nivel')); 
			$code1 = str_split($code);
			if($code1[0]>=1){
			$data1 = "I8,A,001".PHP_EOL.
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
				$data1 = "I8,A,001".PHP_EOL.
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
			if (file_exists("/home/mmsan532/public_html/sistema/css/arquivo/etiquetas.prn")) {
				unlink("/home/mmsan532/public_html/sistema/css/arquivo/etiquetas.prn");
			}
			$arquivo = fopen("/home/mmsan532/public_html/sistema/css/arquivo/etiquetas.prn", 'w');
			fwrite($arquivo,$data1);
			fclose($arquivo);
			
			$filename = "/home/mmsan532/public_html/sistema/css/arquivo/etiquetas.prn";
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false); 
			header("Content-Type: text");
			header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".filesize($filename));
			readfile("$filename");
			exit;			
		} else {
			redirect('login');
		}
	}

	

}
?>