<?php
class Venda extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> my_load_view('venda', NULL);
		} else {
			redirect('login');
		}
	}

	public function comum() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> session -> userdata('produtos')) {
				$produtos = $this -> session -> userdata('produtos');
				$total = 0;
				for ($i = 0; $i < count($produtos); $i++) {
					$total += $produtos[$i] -> valor_produto * $produtos[$i] -> estoque_produto;
				}
				$data = array('total' => $total, 'produtos' => $produtos);
			} else {
				$data = array('total' => 0);
			}
			$this -> my_load_view('vendaComum', $data);
		} else {
			redirect('login');
		}
	}

	public function consignado() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> my_load_view('consignado', NULL);
		} else {
			redirect('login');
		}
	}

	public function novoitem($total, $tipo = 0, $id = -1) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($id != -1) {
				$cliente = $this -> usuario_model -> getCliente($id, 0);
			}
			if ($this -> session -> userdata('produtos')) {
				$produtos = $this -> session -> userdata('produtos');
				$produto = $this -> usuario_model -> getProduto(0, trim($this -> input -> post('codigoP', TRUE)));
				if (($produto != FALSE) && (trim($this -> input -> post('quantP', TRUE)) != "")) {
					$testeE = 0;
					for ($i = 0; $i < count($produtos); $i++) {
						if (strcmp($produtos[$i] -> cod_barra_produto, trim($this -> input -> post('codigoP', TRUE))) == 0) {
							$testeE = 1;
							break;
						}
					}
					if ($testeE == 0) {
						if ($this -> input -> post('quantP', TRUE) <= $produto -> estoque_produto) {
							$produto -> estoque_produto = $this -> input -> post('quantP', TRUE);
							$produtos[] = $produto;
							$total += $produto -> valor_produto * trim($this -> input -> post('quantP', TRUE));
							$this -> session -> set_userdata('produtos', $produtos);
							if ($tipo == 0) {
								if ($id != -1) {
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente);
									$this -> my_load_view('vendaComum', $data);
								} else {
									$data = array('total' => $total, 'produtos' => $produtos);
									$this -> my_load_view('vendaComum', $data);
								}
							} else {
								if ($id != -1) {
									$data = array('total' => $total, 'produtos' => $produtos,  'cliente' => $cliente);
									$this -> my_load_view('vendaConsig', $data);
								} else {
									$data = array('total' => $total, 'produtos' => $produtos);
									$this -> my_load_view('vendaConsig', $data);
								}
							}
						} else {
							if ($tipo == 0) {
								if ($id != -1) {
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaComum', $data);
								} else {
									$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaComum', $data);
								}
							} else {
								if ($id != -1) {
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaConsig', $data);
								} else {
									$data = array('total' => $total, 'produtos' => $produtos,'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaConsig', $data);
								}
							}
						}
					} else {
						if ($tipo == 0) {
							if ($id != -1) {
								$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Produto Já Inserido, Delete e Insira Novamente, Alterando a Quantidade");
								$this -> my_load_view('vendaComum', $data);
							} else {
								$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Produto Já Inserido, Delete e Insira Novamente, Alterando a Quantidade");
								$this -> my_load_view('vendaComum', $data);
							}
						} else {
							if ($id != -1) {
								$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Produto Já Inserido, Delete e Insira Novamente, Alterando a Quantidade");
								$this -> my_load_view('vendaConsig', $data);
							} else {
								$data = array('total' => $total, 'produtos' => $produtos,'mensagem' => "Produto Já Inserido, Delete e Insira Novamente, Alterando a Quantidade");
								$this -> my_load_view('vendaConsig', $data);
							}
						}
					}
				} else {
					if ($tipo == 0) {
						if ($id != -1) {
							$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaComum', $data);
						} else {
							$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaComum', $data);
						}
					} else {
						if ($id != -1) {
							$data = array('total' => $total, 'produtos' => $produtos,'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaConsig', $data);
						} else {
							$data = array('total' => $total, 'produtos' => $produtos,'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaConsig', $data);
						}
					}
				}
			} else {
				$produto = $this -> usuario_model -> getProduto(0, $this -> input -> post('codigoP', TRUE));
				if (($produto != FALSE) && (trim($this -> input -> post('quantP', TRUE)) != "")) {
					if ($this -> input -> post('quantP', TRUE) <= $produto -> estoque_produto) {
						$produtos[0] = $produto;
						$total += $produto -> valor_produto * trim($this -> input -> post('quantP', TRUE));
						$this -> session -> set_userdata('produtos', $produtos);
						if ($tipo == 0) {
							if ($id != -1) {
								$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente);
								$this -> my_load_view('vendaComum', $data);
							} else {
								$data = array('total' => $total, 'produtos' => $produtos);
								$this -> my_load_view('vendaComum', $data);
							}
						} else {
							if ($id != -1) {
								$data = array('total' => $total,'produtos' => $produtos, 'cliente' => $cliente);
								$this -> my_load_view('vendaConsig', $data);
							} else {
								$data = array('total' => $total,'produtos' => $produtos);
								$this -> my_load_view('vendaConsig', $data);
							}
						}
					} else {
						if ($tipo == 0) {
							if ($id != -1) {
								$data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
								$this -> my_load_view('vendaComum', $data);
							} else {
								$data = array('total' => $total, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
								$this -> my_load_view('vendaComum', $data);
							}
						} else {
							if ($id != -1) {
								$data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
								$this -> my_load_view('vendaConsig', $data);
							} else {
								$data = array('total' => $total,'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
								$this -> my_load_view('vendaConsig', $data);
							}
						}
					}
				} else {
					if ($tipo == 0) {
						if ($id != -1) {
							$data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaComum', $data);
						} else {
							$data = array('total' => $total, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaComum', $data);
						}
					} else {
						if ($id != -1) {
							$data = array('total' => $total,'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaConsig', $data);
						} else {
							$data = array('total' => $total,'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaConsig', $data);
						}
					}
				}
			}
		} else {
			redirect('login');
		}
	}

	public function selCliente($id, $total, $tipo = 0) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$produtos = $this -> session -> userdata('produtos');
			if ($id < 0) {
				$data = array('total' => $total, 'tipo' => $tipo);
				$this -> my_load_view('vendaCliente', $data);
			} else {
				$cliente = $this -> usuario_model -> getCliente($id, 0);
				$data = array('total' => $total, 'cliente' => $cliente, 'produtos' => $produtos);
				if ($tipo == 0) {
					$this -> my_load_view('vendaComum', $data);
				} else {
					$this -> my_load_view('vendaConsig', $data);
				}
			}
		} else {
			redirect('login');
		}
	}

	public function buscaCliente($total, $tipo) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> input -> post('tipo', TRUE) == 1) {
				$aux = str_split(trim($this -> input -> post('nome', TRUE)));
				if ((count($aux) > 14) || ((count($aux) < 14))) {
					$data = array('total' => $total, 'mensagem' => "CPF Invalido", 'tipo' => $tipo);
					$this -> my_load_view('vendaCliente', $data);
				} else {
					$dado = $this -> input -> post('nome');
					
					$cliente = $this -> usuario_model -> getCliente(trim($dado), $this -> input -> post('tipo', TRUE));
					if ($cliente == FALSE) {
						$data = array('total' => $total, 'mensagem' => "Cliente não Cadastrado", 'tipo' => $tipo);
						$this -> my_load_view('vendaCliente', $data);
					} else {
						$data = array('total' => $total, 'cliente' => $cliente, 'tipo' => $tipo);
						$this -> my_load_view('vendaCliente', $data);
					}
				}
			} else {
				$dado = trim($this -> input -> post('nome', TRUE));
				$dado = $this -> usuario_model -> getCliente($dado, $this -> input -> post('tipo', TRUE));
				if ($dado == FALSE) {
					$data = array('total' => $total, 'mensagem' => "Cliente não Cadastrado", 'tipo' => $tipo);
					$this -> my_load_view('vendaCliente', $data);
				} else {
					$data = array('total' => $total, 'cliente' => $dado, 'tipo' => $tipo);
					$this -> my_load_view('vendaCliente', $data);
				}
			}
		} else {
			redirect('login');
		}
	}

	public function finalizarCompra($total, $cliente = -1) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if($cliente!=-1){
				$this -> session -> unset_userdata('produtos');
				redirect('venda');
			}else{
				$data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Cliente não Selecionado");
				$this -> my_load_view('vendaComum', $data);
			}	
		} else {
			redirect('login');
		}
	}

	public function finalizarCompraC($total, $cliente = -1) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if($this -> input -> post('data', TRUE)){
				print_r($_POST);
				$this -> session -> unset_userdata('produtos');
				#redirect('venda');		
			}else{
				$data = array('total'=>$total,'cliente'=>$cliente);
				$this -> my_load_view('vendaDateR', $data);
			}
			
		} else {
			redirect('login');
		}
	}

	public function sair($tipo = 0) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> session -> unset_userdata('produtos');
			if ($tipo == 0) {
				redirect('venda');
			} else {
				redirect('venda/consignado');
			}
		} else {
			redirect('login');
		}
	}

	public function deletaItem($i, $total, $tipo = 0, $id = -1) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($id != -1) {
				$cliente = $this -> usuario_model -> getCliente($id, 0);
			}
			$produtos = $this -> session -> userdata('produtos');
			$total -= $produtos[$i] -> valor_produto * $produtos[$i] -> estoque_produto;
			unset($produtos[$i]);
			$produtos = array_values($produtos);
			$this -> session -> set_userdata('produtos', $produtos);
			if ($tipo == 0) {
				if ($id != -1) {
					$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente);
					$this -> my_load_view('vendaComum', $data);
				} else {
					$data = array('total' => $total, 'produtos' => $produtos);
					$this -> my_load_view('vendaComum', $data);
				}
			} else {
				if ($id != -1) {
					$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente);
					$this -> my_load_view('vendaConsig', $data);
				} else {
					$data = array('total' => $total, 'produtos' => $produtos);
					$this -> my_load_view('vendaConsig', $data);
				}
			}
		} else {
			redirect('login');
		}
	}

	public function novoCom() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> session -> userdata('produtos')) {
				$produtos = $this -> session -> userdata('produtos');
				$total = 0;
				for ($i = 0; $i < count($produtos); $i++) {
					$total += $produtos[$i] -> valor_produto * $produtos[$i] -> estoque_produto;
				}
				$data = array('total' => $total, 'produtos' => $produtos);
			} else {
				$data = array('total' => 0);
			}
			$this -> my_load_view('vendaConsig', $data);
		} else {
			redirect('login');
		}
	}

	public function retornoCom($id) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> session -> userdata('produtos')) {
				$this -> session -> unset_userdata('produtos');
			}
			
			echo "RETORNO DA FATURA";
		} else {
			redirect('login');
		}
	}

}
?>