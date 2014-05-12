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
	
	public function Deletar($foto,$id) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> usuario_model -> deletarProduto($id);
			unlink("D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/".$foto);
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
				$produto = $this -> usuario_model -> getProduto(trim($id),0);
				if ($tipo == "") {
					$data = array('produto'=>$produto);
					$this -> my_load_view('alterarProduto.php', $data);
				} else {
					if(strcmp($tipo, $produto->	tipo_produto)!=0){
						$code1 = str_split($produto->cod_barra_produto);
						$aux = str_split($tipo);
						$aux2 = $this -> usuario_model -> getQantidade($tipo);
						$code1[0]=$aux[0];
						$code1[1]=$aux[1];
						$novoqt = $aux2->id+1;
						if ($novoqt < 10) {
							$code1[count($code1)-1]=$novoqt;
						} else if ($novoqt < 100) {
							$qt = str_split($novoqt);
							$code1[count($code1)-1]=$qt[0];
							$code1[count($code1)-2]=$qt[1];
						} else if ($novoqt < 1000) {
							$qt = str_split($novoqt);
							$code1[count($code1)-1]=$qt[0];
							$code1[count($code1)-2]=$qt[1];
							$code1[count($code1)-3]=$qt[2];
						}else{
							$qt = str_split($novoqt);
							$code1[count($code1)-1]=$qt[0];
							$code1[count($code1)-2]=$qt[1];
							$code1[count($code1)-3]=$qt[2];
							$code1[count($code1)-4]=$qt[3];
						}
						$code ="";
						for ($i=0; $i <count($code1); $i++) { 
							$code =$code.$code1[$i];
						}
				}else{
						$code = $produto->cod_barra_produto;
					}
					$valor = $this -> input -> post('valor', TRUE);
					$nome = $produto->foto_produto;
					if ($valor < 10) {
							$valor = "000".$valor;
						} else if ($valor < 100) {
							$valor = "00".$valor;
						} else if ($valor < 1000) {
							$valor = "0".$valor;
						}
					$quantidade = $this -> input -> post('quant', TRUE);
					$this -> usuario_model -> updateProduto($id,$tipo,$valor,$quantidade,$nome,$code);
					redirect('produtos/perEtiqueta/'.$code);
				}
			}else{
				$produto = $this -> usuario_model -> getProduto(trim($id),0);
				$data = array('produto'=>$produto);
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
				$produto = $this -> usuario_model -> getProduto(trim($id),0);
				if ($tipo == "") {
					$data = array('produto'=>$produto,'foto'=>TRUE);
					$this -> my_load_view('alterarProduto.php', $data);
				} else {
					if(strcmp($tipo, $produto->	tipo_produto)!=0){
						$code1 = str_split($produto->cod_barra_produto);
						$aux = str_split($tipo);
						$aux2 = $this -> usuario_model -> getQantidade($tipo);
						$code1[0]=$aux[0];
						$code1[1]=$aux[1];
						$novoqt = $aux2->id+1;
						if ($novoqt < 10) {
							$code1[count($code1)-1]=$novoqt;
						} else if ($novoqt < 100) {
							$qt = str_split($novoqt);
							$code1[count($code1)-1]=$qt[0];
							$code1[count($code1)-2]=$qt[1];
						} else if ($novoqt < 1000) {
							$qt = str_split($novoqt);
							$code1[count($code1)-1]=$qt[0];
							$code1[count($code1)-2]=$qt[1];
							$code1[count($code1)-3]=$qt[2];
						}else{
							$qt = str_split($novoqt);
							$code1[count($code1)-1]=$qt[0];
							$code1[count($code1)-2]=$qt[1];
							$code1[count($code1)-3]=$qt[2];
							$code1[count($code1)-4]=$qt[3];
						}
						$code ="";
						for ($i=0; $i <count($code1); $i++) { 
							$code =$code.$code1[$i];
						}
				}else{
						$code = $produto->cod_barra_produto;
					}
					$valor = $this -> input -> post('valor', TRUE);
					$nome = $produto->foto_produto;
					if ($valor < 10) {
							$valor = "000".$valor;
						} else if ($valor < 100) {
							$valor = "00".$valor;
						} else if ($valor < 1000) {
							$valor = "0".$valor;
						}
					$quantidade = $this -> input -> post('quant', TRUE);
					rename("D:\Dropbox\Dropbox\Projetos Trabalho\MSanches\css\img\img_produto\defu.jpg", "D:/Dropbox/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome);
					$this -> usuario_model -> updateProduto($id,$tipo,$valor,$quantidade,$nome,$code);
					redirect('produtos/perEtiqueta/'.$code);
				}
			} else {
				$produto = $this -> usuario_model -> getProduto(trim($id),0);
				$data = array('produto'=>$produto,'foto'=>TRUE);
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
				$produto = $this -> usuario_model -> getProduto(trim($code),0);
				$data = array('produto'=>$produto);
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
			if ($this -> input -> post('codigo', TRUE)!="") {
				$cod = $this -> input -> post('codigo', TRUE);
				$produto = $this -> usuario_model -> getProduto(0,trim($cod));
				$data = array('produto'=>$produto);
				$this -> my_load_view('resultBusca.php', $data);	
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
			}else{
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
			$data = array(
				'brinco'=>$this -> usuario_model -> getQantidade("Br")->id,
				'anel'=>$this -> usuario_model -> getQantidade("An")->id,
				'colar'=>$this -> usuario_model -> getQantidade("Cl")->id,
				'pulceira'=>$this -> usuario_model -> getQantidade("Pl")->id,
				'bracelete'=>$this -> usuario_model -> getQantidade("Bl")->id,
				'conjunto'=>$this -> usuario_model -> getQantidade("Cj")->id,
				'tornozeleira'=>$this -> usuario_model -> getQantidade("Tr")->id,
				);	
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
				redirect('Produtos/alterar2/'.$tipo = $this -> input -> post('id', TRUE));
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
			$data = array('code'=>$code);
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
			$data = array('id'=> $id);
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
					$nome = $tipo.$id.".jpg";
					$id = $this -> usuario_model -> getQantidade($tipo);
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