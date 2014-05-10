<?php
class Produtos extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$todos = $this -> usuario_model -> getProdutos("0");
			print_r($todos);
			#$data = array('todos' => $todos);
			#$this -> my_load_view('produtos', $data);
		} else {
			redirect('login');

		}
	}

	public function busca() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> input -> post('codigo', TRUE)) {

			} else {
				$this -> my_load_view('buscaProduto', NULL);
			}
		} else {
			redirect('login');

		}
	}

	public function novo() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {

			$this -> my_load_view('novoProduto', NULL);
		} else {
			redirect('login');
		}
	}

	public function etiquetas() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> my_load_view('etiquetas', NULL);
		} else {
			redirect('login');
		}
	}
	
	public function perEtiqueta($code) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$data = array('code'=>$code);
			$this -> my_load_view('etiqueta', $data);
		} else {
			redirect('login');
		}
	}
	
	public function novaFoto() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> my_load_view('selFoto', NULL);
		} else {
			redirect('login');
		}
	}

	public function novo2() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> input -> post('valor', TRUE)) {
				$tipo = $this -> input -> post('tipo', TRUE);
				if ($tipo == "") {
					$data = array('foto' => TRUE, '$mensagem' => "Tipo não Selecionado");
					$this -> my_load_view('novoProduto', $data);
				} else {
					$code = $this -> usuario_model -> getID();
					if($code==FALSE){
						$id = 1;
					}else{
						$id = $code -> id_produto + 1;
					}
					if ($id < 10) {
						$id = "000" . $id;
					} else if ($id < 100) {
						$id = "00" . $id;
					} else if ($id < 1000) {
						$id = "0" . $id;
					}
					echo " id= ".$id;
					$nome = $tipo.$id.".jpg";
					echo " ";
					echo "nome=".$nome;
					$id = $this -> usuario_model -> getQantidade($tipo);
					echo " ";
					echo $id->id;
					if ($id == FALSE) {
						$id = 0001;
					} else {
						$id = $id->id + 1;
						if ($id < 10) {
							$id = "000".$id;
						} else if ($id < 100) {
							$id = "00".$id;
						} else if ($id < 1000) {
							$id = "0".$id;
						}
					}
					echo " ";
					echo "id= ".$id;
					$valor = $this -> input -> post('valor', TRUE);
					if ($valor < 10) {
							$valor = "000".$valor;
						} else if ($valor < 100) {
							$valor = "00".$valor;
						} else if ($valor < 1000) {
							$valor = "0".$valor;
						}
					$quantidade = $this -> input -> post('quant', TRUE);
					$code = $tipo . $valor . $id;
					echo " ";
					echo "code= ".$code;
					rename("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg", "D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome);
					$this -> usuario_model -> setProduto($tipo,$valor,$quantidade,$nome,$code);
					redirect('produtos/perEtiqueta/'.$code);
				}
			} else {

				$data = array('foto' => TRUE);
				$this -> my_load_view('novoProduto', $data);
			}
		} else {
			redirect('login');
		}
	}

	public function uloadF() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$config['upload_path'] = "D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto";
			$config['file_name'] = 'defu.jpg';
			$config['allowed_types'] = 'jpg';
			$config['max_size'] = '2048';

			$this -> load -> library('upload', $config);
			unlink("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg");

			if (!$this -> upload -> do_upload("fileF")) {
				$data = array('mensagem' => $this -> upload -> display_errors());

				$this -> my_load_view('selFoto', $data);
			} else {
				redirect('Produtos/novo2');
			}
		} else {
			redirect('login');
		}
	}

}
?>