<?php
class Produtos extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
	}

	public function index() {
		$this->load->library('pagination');
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$todos = $this -> usuario_model -> getProdutos(0,0);
			$QItens = $this -> usuario_model -> getQantidade(0)->id;
			$ultima = $QItens%12;
			if($ultima==0){
				$ultima = $QItens/12;
			}else{
				$ultima = (int)(($QItens/12));
			}
			$data = array('todos' => $todos,
						  'pagina'=> 0,
						  'tipo'=>0,
						  'QItens'=>$QItens,
						  'proximo'=>1,
						  'caminho'=>"produtos/pagina/0",
						  'anterior'=>-1,
						  'ultima'=> $ultima
						  );
			$this -> my_load_view('produtos', $data);
		} else {
			redirect('login');

		}
	}
	public function pagina($inicio=0,$tipo=0) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$QItens = $this -> usuario_model -> getQantidade($tipo)->id;
			$todos = $this -> usuario_model -> getProdutos($inicio*12,$tipo);
			$ultima = $QItens%12;
			if($ultima==0){
				$ultima = $QItens/12;
			}else{
				$ultima = (int)(($QItens/12));
			}
			if($inicio>0){
				$data = array('todos' => $todos,
						      'anterior'=>1,
						      'proximo'=>$inicio+1,
						      'QItens'=>$QItens,
						      'tipo'=>$tipo,
						      'caminho'=>"produtos/pagina/0",
						      'anterior'=>$inicio-1,
						  	  'ultima'=> $ultima
							 );
			}else{
				$data = array('todos' => $todos,
							  'tipo'=>$tipo,
							  'proximo'=>$inicio+1,
							  'QItens'=>$QItens,
							  'caminho'=>"produtos/pagina/0",
							  'anterior'=>$inicio-1,
						 	  'ultima'=> $ultima
						     );
			}
			$this -> my_load_view('produtos', $data);
		} else {
			redirect('login');
		}
	}
	
	public function Deletar($foto, $id,$code) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$todos = $this -> usuario_model -> logs($this->session->userdata('id'),4,$code);
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
					if ($tipo != $produto -> tipo_produto) {
						$model = $this -> usuario_model -> getQantidade($tipo) -> id + 1;
						if ($model < 10) {
							$model = "000" . $model;
						} else if ($model < 100) {
							$model = "00" . $model;
						} else if ($id < 1000) {
							$model = "0" . $model;
						} else if ($model > 10000) {
							$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
							$this -> my_load_view('alterarProduto', $data);
						}
					} else {
						$model = $produto -> modelo_produto;
						if ($model < 10) {
							$model = "000" . $model;
						} else if ($model < 100) {
							$model = "00" . $model;
						} else if ($id < 1000) {
							$model = "0" . $model;
						} else if ($model > 10000) {
							$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
							$this -> my_load_view('alterarProduto', $data);
						}
					}
					$valor = $this -> input -> post('valor', TRUE);
					if ($valor < 10) {
						$valor = "000" . $valor;
					} else if ($valor < 100) {
						$valor = "00" . $valor;
					} else if ($valor < 1000) {
						$valor = "0" . $valor;
					} else if ($valor > 10000) {
						$data = array('foto' => TRUE, '$mensagem' => "Valor Superior que 10.000");
						$this -> my_load_view('novoProduto', $data);
					}
					$code = $tipo . $model . $valor;
					$nome = $produto -> foto_produto;
					$quantidade = $this -> input -> post('quant', TRUE);
					$todos = $this -> usuario_model -> logs($this->session->userdata('id'),3,$code);
					$this -> usuario_model -> updateProduto($id, $tipo, $valor, $quantidade, $model, $nome, $code);
					redirect('produtos/perEtiqueta/' . $code);
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
					if ($tipo != $produto -> tipo_produto) {
						$model = $this -> usuario_model -> getQantidade($tipo) -> id + 1;
						if ($model < 10) {
							$model = "000" . $model;
						} else if ($model < 100) {
							$model = "00" . $model;
						} else if ($id < 1000) {
							$model = "0" . $model;
						} else if ($model > 10000) {
							$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
							$this -> my_load_view('alterarProduto', $data);
						}
					} else {
						$model = $produto -> modelo_produto;
						if ($model < 10) {
							$model = "000" . $model;
						} else if ($model < 100) {
							$model = "00" . $model;
						} else if ($id < 1000) {
							$model = "0" . $model;
						} else if ($model > 10000) {
							$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
							$this -> my_load_view('alterarProduto', $data);
						}
					}
					$valor = $this -> input -> post('valor', TRUE);
					if ($valor < 10) {
						$valor = "000" . $valor;
					} else if ($valor < 100) {
						$valor = "00" . $valor;
					} else if ($valor < 1000) {
						$valor = "0" . $valor;
					} else if ($valor > 10000) {
						$data = array('foto' => TRUE, '$mensagem' => "Valor Superior que 10.000");
						$this -> my_load_view('novoProduto', $data);
					}
					$code = $tipo . $model . $valor;
					$nome = $produto -> foto_produto;
					$quantidade = $this -> input -> post('quant', TRUE);
					$todos = $this -> usuario_model -> logs($this->session->userdata('id'),3,$code);
					rename("D:/Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg", "D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome);
					$this -> usuario_model -> updateProduto($id, $tipo, $valor, $quantidade, $model, $nome, $code);
					redirect('produtos/perEtiqueta/' . $code);
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
			if (file_exists("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg")) {
				unlink("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg");
			}
			if (!$this -> upload -> do_upload("fileF")) {
				$data = array('mensagem' => $this -> upload -> display_errors());
				$this -> my_load_view('selFoto', $data);
			} else {
				$this -> usuario_model -> logs($this->session->userdata('id'),2);
				redirect('produtos/alterar2/' . $tipo = $this -> input -> post('id', TRUE));
			}
		} else {
			redirect('login');
		}
	}

	public function perEtiqueta($code) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$data = array('code' => $code);
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
						$id = "000" . $id;
					} else if ($id < 100) {
						$id = "00" . $id;
					} else if ($id < 1000) {
						$id = "0" . $id;
					} else if ($id > 10000) {
						$data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
						$this -> my_load_view('novoProduto', $data);
					}
					if ($valor < 10) {
						$valor = "000" . $valor;
					} else if ($valor < 100) {
						$valor = "00" . $valor;
					} else if ($valor < 1000) {
						$valor = "0" . $valor;
					} else if ($valor > 10000) {
						$data = array('foto' => TRUE, '$mensagem' => "Valor Superior que 10.000");
						$this -> my_load_view('novoProduto', $data);
					}

					$code = $tipo . $id . $valor;
					$todos = $this -> usuario_model -> logs($this->session->userdata('id'),1,$code);
					rename("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg", "D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome);
					$this -> usuario_model -> setProduto($tipo, $valor, $quantidade, $id, $nome, $code);
					redirect('produtos/perEtiqueta/' . $code);
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
			if (file_exists("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg")) {
				unlink("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg");
			}
			if (!$this -> upload -> do_upload("fileF")) {
				$data = array('mensagem' => $this -> upload -> display_errors());
				$this -> my_load_view('selFoto', $data);
			} else {
				if(chmod ("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg", 777)){
					$todos = $this -> usuario_model -> logs($this->session->userdata('id'),2);
					redirect('produtos/novo2');
				}else{
					$data = array('mensagem' => "Erro ao modifivcar Permissao do Arquivo");
					$this -> my_load_view('selFoto', $data);
				}
				
			}
		} else {
			redirect('login');
		}
	}

}
?>