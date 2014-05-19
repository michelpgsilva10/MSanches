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
			$todos = $this -> usuario_model -> getProdutos(0);
			$data = array('todos' => $todos);
			$this -> my_load_view('produtos', $data);
		} else {
			redirect('login');

		}
	}

	public function Deletar($foto, $id) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> usuario_model -> deletarProduto($id);
			unlink("D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $foto);
			redirect('produtos');
		} else {
			redirect('login');

		}
	}

	public function alterar($id) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> input -> post('valor', TRUE)) {
				$tipo = $this -> input -> post('tipo', TRUE);
				$produto = $this -> usuario_model -> getProduto(trim($id), 0);
				if ($tipo == "") {
					$data = array('produto' => $produto);
					$this -> my_load_view('alterarProduto.php', $data);
				} else {
					$code1 = str_split($produto -> cod_barra_produto);
					$code1[0] = $tipo;
					$modelo = "";
					for ($i = count($code1) - 1; ($code1[$i] != 0) && ($i != 0); $i--) {
						if ($i == count($code1)) {
							$modelo = $code1[$i];
						} else {
							$modelo = $code1[$i] . $modelo;
						}
					}
					$valor = $this -> input -> post('valor', TRUE);
					$code = "";
					if ($tipo != $produto -> tipo_produto) {
						$aux = 	$this -> usuario_model -> getQantidade($tipo) -> id + 1;
						if ($aux < 10) {
							$aux = "0000000" . $aux;
						} else if ($aux < 100) {
							$aux = "000000" . $aux;
						} else if ($aux < 1000) {
							$aux = "00000" . $aux;
						} else if ($aux < 10000) {
							$aux = "0000" . $aux;
						} else if ($aux < 100000) {
							$aux = "000" . $aux;
						} else if ($id < 1000000) {
							$aux = "00" . $aux;
						} else if ($aux < 10000000) {
							$aux = "0" . $aux;
						} else if ($aux < 100000000) {
							$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
							$this -> my_load_view('novoProduto', $data);
						}
						$code = $tipo . $aux;
					} else {
						for ($i = 0; $i < count($code1); $i++) {
							$code = $code . $code1[$i];
						}
					}
					$nome = $produto -> foto_produto;
					$quantidade = $this -> input -> post('quant', TRUE);
					$this -> usuario_model -> updateProduto($id, $tipo, $valor, $quantidade, $nome, $code);
					redirect('produtos/perEtiqueta/' . $code . '/' . $modelo . '/' . $valor);
				}
			} else {
				$produto = $this -> usuario_model -> getProduto(trim($id), 0);
				$data = array('produto' => $produto);
				$this -> my_load_view('alterarProduto.php', $data);
			}

		} else {
			redirect('login');

		}

	}

	public function alterar2($id) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> input -> post('valor', TRUE)) {
				$tipo = $this -> input -> post('tipo', TRUE);
				$produto = $this -> usuario_model -> getProduto(trim($id), 0);
				if ($tipo == "") {
					$data = array('produto' => $produto, 'foto' => TRUE);
					$this -> my_load_view('alterarProduto.php', $data);
				} else {
					$code1 = str_split($produto -> cod_barra_produto);
					$code1[0] = $tipo;
					$modelo = "";
					for ($i = count($code1) - 1; ($code1[$i] != 0) && $i != 0; $i--) {
						if ($i == count($code1)) {
							$modelo = $code1[$i];
						} else {
							$modelo = $code1[$i] . $modelo;
						}
					}
					$valor = $this -> input -> post('valor', TRUE);
					if ($tipo != $produto -> tipo_produto) {
						$aux = 	$this -> usuario_model -> getQantidade($tipo) -> id + 1;
						if ($aux < 10) {
							$aux = "0000000" . $aux;
						} else if ($aux < 100) {
							$aux = "000000" . $aux;
						} else if ($aux < 1000) {
							$aux = "00000" . $aux;
						} else if ($aux < 10000) {
							$aux = "0000" . $aux;
						} else if ($aux < 100000) {
							$aux = "000" . $aux;
						} else if ($id < 1000000) {
							$aux = "00" . $aux;
						} else if ($aux < 10000000) {
							$aux = "0" . $aux;
						} else if ($aux < 100000000) {
							$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
							$this -> my_load_view('novoProduto', $data);
						}
						$code = $tipo . $aux;
					} else {
						for ($i = 0; $i < count($code1); $i++) {
							$code = $code . $code1[$i];
						}
					}
					$nome = $produto -> foto_produto;
					$quantidade = $this -> input -> post('quant', TRUE);
					rename("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg", "D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome);
					$this -> usuario_model -> updateProduto($id, $tipo, $valor, $quantidade, $nome, $code);
					redirect('produtos/perEtiqueta/' . $code . '/' . $modelo . '/' . $valor);
				}
			} else {
				$produto = $this -> usuario_model -> getProduto(trim($id), 0);
				$data = array('produto' => $produto, 'foto' => TRUE);
				$this -> my_load_view('alterarProduto.php', $data);
			}
		} else {
			redirect('login');

		}
	}

	public function busca2($code) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$produto = $this -> usuario_model -> getProduto(trim($code), 0);
			$data = array('produto' => $produto);
			$this -> my_load_view('resultBusca.php', $data);

		} else {
			redirect('login');

		}
	}

	public function busca() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> input -> post('codigo', TRUE) != "") {
				$cod = $this -> input -> post('codigo', TRUE);
				$produto = $this -> usuario_model -> getProduto(0, trim($cod));
				if ($produto != FALSE) {
					$data = array('produto' => $produto);
					$this -> my_load_view('resultBusca.php', $data);
				} else {
					$data = array('mensagem' => "Produto não encontrado");
					$this -> my_load_view('buscaProduto.php', $data);
				}
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
			if ($this -> input -> post('valor', TRUE)) {
				$data = array('mensagem' => " A Foto não Foi Selecionada");
				$this -> my_load_view('novoProduto', $data);
			} else {
				$this -> my_load_view('novoProduto', null);
			}
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

	public function estoque() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$data = array('brinco' => $this -> usuario_model -> getQantidade(3) -> id, 'anel' => $this -> usuario_model -> getQantidade(1) -> id, 'colar' => $this -> usuario_model -> getQantidade(4) -> id, 'pulceira' => $this -> usuario_model -> getQantidade(6) -> id, 'bracelete' => $this -> usuario_model -> getQantidade(2) -> id, 'conjunto' => $this -> usuario_model -> getQantidade(5) -> id, 'tornozeleira' => $this -> usuario_model -> getQantidade(7) -> id, 'brinco2' => $this -> usuario_model -> getQantidadeItem(3) -> total, 'anel2' => $this -> usuario_model -> getQantidadeItem(1) -> total, 'colar2' => $this -> usuario_model -> getQantidadeItem(4) -> total, 'pulceira2' => $this -> usuario_model -> getQantidadeItem(6) -> total, 'bracelete2' => $this -> usuario_model -> getQantidadeItem(2) -> total, 'conjunto2' => $this -> usuario_model -> getQantidadeItem(5) -> total, 'tornozeleira2' => $this -> usuario_model -> getQantidadeItem(7) -> total);
			$this -> my_load_view('estoque', $data);
		} else {
			redirect('login');
		}
	}

	public function uloadFA() {
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
				redirect('Produtos/alterar2/' . $tipo = $this -> input -> post('id', TRUE));
			}
		} else {
			redirect('login');
		}
	}

	public function perEtiqueta($code, $modelo, $valor) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$data = array('code' => $code, 'modelo' => $modelo, 'valor' => $valor);
			$this -> my_load_view('etiqueta', $data);
		} else {
			redirect('login');
		}
	}

	public function alteraFoto($id) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$data = array('id' => $id);
			$this -> my_load_view('alteraFoto', $data);
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
					if ($code == FALSE) {
						$id = 1;
					} else {
						$id = $code -> id_produto + 1;
					}
					if ($id < 10) {
						$id = "000" . $id;
					} else if ($id < 100) {
						$id = "00" . $id;
					} else if ($id < 1000) {
						$id = "0" . $id;
					}
					$nome = $tipo . $id . ".jpg";
					$id = $this -> usuario_model -> getQantidade($tipo) -> id + 1;
					$valor = $this -> input -> post('valor', TRUE);
					$quantidade = $this -> input -> post('quant', TRUE);
					if ($id < 10) {
						$id = "0000000" . $id;
					} else if ($id < 100) {
						$id = "000000" . $id;
					} else if ($id < 1000) {
						$id = "00000" . $id;
					} else if ($id < 10000) {
						$id = "0000" . $id;
					} else if ($id < 100000) {
						$id = "000" . $id;
					} else if ($id < 1000000) {
						$id = "00" . $id;
					} else if ($id < 10000000) {
						$id = "0" . $id;
					} else if ($id < 100000000) {
						$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
						$this -> my_load_view('novoProduto', $data);
					}
					$code = $tipo . $id;
					$id = $this -> usuario_model -> getQantidade($tipo) -> id + 1;
					rename("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg", "D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome);
					$this -> usuario_model -> setProduto($tipo, $valor, $quantidade, $nome, $code);
					redirect('produtos/perEtiqueta/' . $code . '/' . $id . '/' . $valor);
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