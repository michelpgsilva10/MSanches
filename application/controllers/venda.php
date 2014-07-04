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

	public function criaRomaneio($idvenda, $tipo = 0) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($tipo == 1) {
				$data = array('romaneio' => $idvenda, 'consig' => TRUE);
			} else {
				$data = array('romaneio' => $idvenda, 'tipo' => $tipo);
			}
			$this -> my_load_view('venda', $data);
		} else {
			redirect('login');
		}
	}

	public function comum() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			session_start();
			if (isset($_SESSION['produtos'])) {
				$produtos = $_SESSION['produtos'];
				$total = 0;
				for ($i = 0; $i < count($produtos); $i++) {
					$total += $produtos[$i] -> valor_produto * $produtos[$i] -> estoque_produto;
				}
				session_write_close();
				$data = array('total' => $total, 'produtos' => $produtos);
			} else {
				session_write_close();
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
			$vendas1 = $this -> usuario_model -> getVendaC();
			if ($vendas1 != FALSE) {
				for ($i = 0; $i < count($vendas1); $i++) {
					$venda = $this -> usuario_model -> getVenda($vendas1[$i]['id_venda_inicio']);
					$cliente = $this -> usuario_model -> getCliente($venda -> cliente_fk, 0);
					$data1 = explode(" ", $venda -> data_venda);
					$data1 = explode("-", $data1[0]);
					$data = "" . $data1[2];
					$data = $data . "-" . $data1[1];
					$data = $data . "-" . $data1[0];
					$venda -> data_venda = $data;
					$venda -> cliente_fk = $cliente[0]['nome_cliente'];
					$vendas[$i] = $venda;
				}
				$data = array('vendas' => $vendas);
				$this -> my_load_view('consignado', $data);
			} else {
				$this -> my_load_view('consignado', NULL);
			}
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
			session_start();
			if (isset($_SESSION['produtos'])) {
				$produtos = $_SESSION['produtos'];
				$produto = $this -> usuario_model -> getProduto(0, trim($this -> input -> post('codigoP', TRUE)));
				if (($produto != FALSE) && (trim($this -> input -> post('quantP', TRUE)) != "")) {
					$testeE = 0;
					for ($i = 0; $i < count($produtos); $i++) {
						if (strcmp($produtos[$i] -> cod_barra_produto, trim($this -> input -> post('codigoP', TRUE))) == 0) {
							if (($this -> input -> post('quantP', TRUE)+$produtos[$i] -> estoque_produto) <= $produto -> estoque_produto) {
								$produtos[$i] -> estoque_produto += $this -> input -> post('quantP', TRUE);
								if($this -> input -> post('desconto', TRUE)!=0){
									$produto -> modelo_produto = $this -> input -> post('desconto', TRUE);
									$desconto = $produto -> valor_produto*($this -> input -> post('desconto', TRUE)/100);
									$total += ($produto -> valor_produto-$desconto) * (int)trim($this -> input -> post('quantP', TRUE));
								}else{
									$desconto = $produto -> valor_produto*($produto -> modelo_produto/100);
									$total += ($produto -> valor_produto-$desconto) * (int)trim($this -> input -> post('quantP', TRUE));
								}
								$testeE = 1;
								break;
							}else{
								$testeE=2;
								break;
							}
						}
					}
					if ($testeE == 0) {
						if ($this -> input -> post('quantP', TRUE) <= $produto -> estoque_produto) {
							$produto -> estoque_produto = $this -> input -> post('quantP', TRUE);
							$produto -> modelo_produto = $this -> input -> post('desconto', TRUE);
							$desconto = $produto -> valor_produto*($this -> input -> post('desconto', TRUE)/100);
							$produtos[] = $produto;
							$total += ($produto -> valor_produto-$desconto) * (int)trim($this -> input -> post('quantP', TRUE));
							$_SESSION['produtos'][] = $produto;
							session_write_close();
							if ($tipo == 0) {
								if ($id != -1) {
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
									$this -> my_load_view('vendaComum', $data);
								} else {
									$data = array('total' => $total, 'produtos' => $produtos ,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
									$this -> my_load_view('vendaComum', $data);
								}
							} else {
								if ($id != -1) {
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
									$this -> my_load_view('vendaConsig', $data);
								} else {
									$data = array('total' => $total, 'produtos' => $produtos,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
									$this -> my_load_view('vendaConsig', $data);
								}
							}
						} else {
							if ($tipo == 0) {
								if ($id != -1) {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaComum', $data);
								} else {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaComum', $data);
								}
							} else {
								if ($id != -1) {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaConsig', $data);
								} else {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaConsig', $data);
								}
							}
						}
					}else if($testeE==2){
						if ($tipo == 0) {
								if ($id != -1) {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaComum', $data);
								} else {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaComum', $data);
								}
							} else {
								if ($id != -1) {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaConsig', $data);
								} else {
									session_write_close();
									$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
									$this -> my_load_view('vendaConsig', $data);
								}
							}
					}else {
						if ($tipo == 0) {
							if ($id != -1) {
								session_write_close();
								$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagemC' =>"Foi Adicionado mais um na Quantidade do item: ".$produto -> cod_barra_produto );
								$this -> my_load_view('vendaComum', $data);
							} else {
								session_write_close();
								$data = array('total' => $total, 'produtos' => $produtos, 'mensagemC' =>"Foi Adicionado mais um na Quantidade do item: ".$produto -> cod_barra_produto );
								$this -> my_load_view('vendaComum', $data);
							}
						} else {
							if ($id != -1) {
								session_write_close();
								$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagemC' =>"Foi Adicionado mais um na Quantidade do item: ".$produto -> cod_barra_produto );
								$this -> my_load_view('vendaConsig', $data);
							} else {
								session_write_close();
								$data = array('total' => $total, 'produtos' => $produtos, 'mensagemC' =>"Foi Adicionado mais um na Quantidade do item: ".$produto -> cod_barra_produto );
								$this -> my_load_view('vendaConsig', $data);
							}
						}
					}
				} else {
					if ($tipo == 0) {
						if ($id != -1) {
							session_write_close();
							$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaComum', $data);
						} else {
							session_write_close();
							$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaComum', $data);
						}
					} else {
						if ($id != -1) {
							session_write_close();
							$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaConsig', $data);
						} else {
							session_write_close();
							$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaConsig', $data);
						}
					}
				}
			} else {
				$produto = $this -> usuario_model -> getProduto(0, $this -> input -> post('codigoP', TRUE));
				if (($produto != FALSE) && (trim($this -> input -> post('quantP', TRUE)) != "")) {
					if ($this -> input -> post('quantP', TRUE) <= $produto -> estoque_produto) {
						$produto -> estoque_produto = $this -> input -> post('quantP', TRUE);
						$produto -> modelo_produto = $this -> input -> post('desconto', TRUE);
						$desconto = $produto -> valor_produto*($this -> input -> post('desconto', TRUE)/100);
						$produtos[0] = $produto;
						$total += ($produto -> valor_produto-$desconto) * (int)trim($this -> input -> post('quantP', TRUE));
						$_SESSION['produtos'] = $produtos;
						session_write_close();
						if ($tipo == 0) {
							if ($id != -1) {
								$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
								$this -> my_load_view('vendaComum', $data);
							} else {
								$data = array('total' => $total, 'produtos' => $produtos,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
								$this -> my_load_view('vendaComum', $data);
							}
						} else {
							if ($id != -1) {
								$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
								$this -> my_load_view('vendaConsig', $data);
							} else {
								$data = array('total' => $total, 'produtos' => $produtos,'mensagemC' =>"Foi Adicionado o item: ".$produto -> cod_barra_produto);
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
								$data = array('total' => $total, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto -> estoque_produto . " itens em  estoque");
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
							$data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
							$this -> my_load_view('vendaConsig', $data);
						} else {
							$data = array('total' => $total, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
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
			if ($id < 0) {
				$data = array('total' => $total, 'tipo' => $tipo);
				$this -> my_load_view('vendaCliente', $data);
			} else {
				$cliente = $this -> usuario_model -> getCliente($id, 0);
				session_start();
				if (isset($_SESSION['produtos'])) {
					$produtos = $_SESSION['produtos'];
					$data = array('total' => $total, 'cliente' => $cliente, 'produtos' => $produtos);
				} else {
					$data = array('total' => $total, 'cliente' => $cliente);
				}
				session_write_close();
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
			session_start();
			if (isset($_SESSION['produtos'])) {
				$produtos = $_SESSION['produtos'];
			} else {
				$total = 0;
			}
			if ($cliente != -1) {
				$cliente = $this -> usuario_model -> getCliente($cliente, 0);
				if ($total != 0) {
					$idVenda = $this -> usuario_model -> setVenda($cliente[0]['id_cliente'], $total);
					$sProduto = -1;
					for ($i = 0; $i < count($produtos); $i++) {
						$produto = $this -> usuario_model -> getProduto($produtos[$i] -> id_produto, 0);
						if ($produtos[$i] -> estoque_produto <= $produto -> estoque_produto) {
							if ($produtos[$i] -> estoque_produto == $produto -> estoque_produto) {
								$this -> usuario_model -> updateVendaProduto($produtos[$i] -> id_produto, 0);
							} else {
								$this -> usuario_model -> updateVendaProduto($produtos[$i] -> id_produto, $produto -> estoque_produto - $produtos[$i] -> estoque_produto);
							}
							$this -> usuario_model -> setCompra($cliente[0]['id_cliente'], $produtos[$i] -> estoque_produto, $produtos[$i] -> id_produto, $idVenda);
						} else {
							$sProduto = $produtos[$i] -> cod_barra_produto;
							break;
						}
					}
					if ($sProduto != -1) {
						$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "O produto " . $sProduto . " não possui essa quantidade mias ou Já foi vendido todos os itens");
						$this -> my_load_view('vendaComum', $data);
					} else {
						session_destroy();
						session_write_close();
						$this -> usuario_model -> logs($this -> session -> userdata('id'), 7, $cliente[0]['id_cliente'], $total);
						redirect('venda/criaRomaneio/' . $idVenda);
					}
				} else {
					session_write_close();
					$data = array('total' => $total, 'mensagem' => "Nem um produto Selecionado ou erro no Sistema(Se for erro no Sistema ligue para o tecnico)", 'cliente' => $cliente);
					$this -> my_load_view('vendaComum', $data);
				}
			} else {
				if (isset($_SESSION['produtos'])) {
					$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Cliente não Selecionado");
					$this -> my_load_view('vendaComum', $data);
				} else {
					$data = array('total' => $total, 'mensagem' => "Cliente não Selecionado");
					$this -> my_load_view('vendaComum', $data);
				}
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
			session_start();
			if (isset($_SESSION['produtos'])) {
				$produtos = $_SESSION['produtos'];
			} else {
				$total = 0;
			}
			if ($this -> input -> post('data', TRUE)) {
				if ($cliente != -1) {
					$cliente = $this -> usuario_model -> getCliente($cliente, 0);
					if ($total != 0) {
						$idVenda = $this -> usuario_model -> setVenda($cliente[0]['id_cliente'], $total, $this -> input -> post('data', TRUE));
						$this -> usuario_model -> setVendaC($idVenda);
						$sProduto = -1;
						for ($i = 0; $i < count($produtos); $i++) {
							$produto = $this -> usuario_model -> getProduto($produtos[$i] -> id_produto, 0);	
							if ($produtos[$i] -> estoque_produto > $produto -> estoque_produto) {
								$sProduto = $produtos[$i] -> cod_barra_produto;
								break;
							}
						}	
						if ($sProduto != -1) {
							$data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "O produto " . $sProduto . " não possui essa quantidade mias ou Já foi vendido todos os itens");
							$this -> my_load_view('vendaComum', $data);
						} else {
							for ($i = 0; $i < count($produtos); $i++) {
							$produto = $this -> usuario_model -> getProduto($produtos[$i] -> id_produto, 0);	
								if ($produtos[$i] -> estoque_produto == $produto -> estoque_produto) {
									$this -> usuario_model -> updateVendaProduto($produtos[$i] -> id_produto, 0);
								} else {
									$this -> usuario_model -> updateVendaProduto($produtos[$i] -> id_produto, $produto -> estoque_produto - $produtos[$i] -> estoque_produto);
								}
								$this -> usuario_model -> setCompra($cliente[0]['id_cliente'], $produtos[$i] -> estoque_produto, $produtos[$i] -> id_produto, $idVenda);
							
						}
							session_destroy();
							session_write_close();
							$this -> usuario_model -> logs($this -> session -> userdata('id'), 8, $cliente[0]['id_cliente'], $total, $idVenda);
							redirect('venda/criaRomaneio/' . $idVenda . '/2');
						}
					} else {
						session_write_close();
						$data = array('total' => $total, 'mensagem' => "Nem um produto Selecionado ou erro no Sistema(Se for erro no Sistema ligue para o tecnico)", 'cliente' => $cliente);
						$this -> my_load_view('vendaComum', $data);
					}
				} else {
					if (isset($_SESSION['produtos'])) {
						$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Cliente não Selecionado");
						$this -> my_load_view('vendaComum', $data);
					} else {
						$data = array('total' => $total, 'mensagem' => "Cliente não Selecionado");
						$this -> my_load_view('vendaComum', $data);
					}
				}
			} else {
				if ($cliente != -1) {
					if ($total != 0) {
						session_write_close();
						$data = array('total' => $total, 'cliente' => $cliente);
						$this -> my_load_view('vendaDateR', $data);
					} else {
						session_write_close();
						$cliente = $this -> usuario_model -> getCliente($cliente, 0);
						$data = array('total' => $total, 'mensagem' => "Nem um produto Selecionado ou erro no Sistema(Se for erro no Sistema ligue para o tecnico)", 'cliente' => $cliente);
						$this -> my_load_view('vendaConsig', $data);
					}
				} else {
					if (isset($_SESSION['produtos'])) {
						session_write_close();
						$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Cliente não Selecionado");
						$this -> my_load_view('vendaConsig', $data);
					} else {
						session_write_close();
						$data = array('total' => $total, 'mensagem' => "Cliente não Selecionado");
						$this -> my_load_view('vendaConsig', $data);
					}
				}
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
			session_start();
			session_destroy();
			session_write_close();
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
			session_start();
			$produtos = $_SESSION['produtos'];
			$total -= $produtos[$i] -> valor_produto * $produtos[$i] -> estoque_produto;
			unset($produtos[$i]);
			$produtos = array_values($produtos);
			unset($_SESSION['produtos']);
			$_SESSION['produtos'] = $produtos;
			session_write_close();
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
			session_start();
			if (isset($_SESSION['produtos'])) {
				$produtos = $_SESSION['produtos'];
				session_write_close();
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

	public function verificaItem($total, $idCliente, $id, $valorMim) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			session_start();
			if (isset($_SESSION['produtos'])) {
				$cliente = $this -> usuario_model -> getCliente($idCliente, 0);
				$produtos = $_SESSION['produtos'];
				$verifica = -1;
				$aux = $total;
				for ($i = 0; $i < count($produtos); $i++) {
					if (strcmp($produtos[$i] -> cod_barra_produto, trim($this -> input -> post('codigoP', TRUE))) == 0) {
						if ($produtos[$i] -> estoque_produto >= $this -> input -> post('quantP', TRUE)) {
							$aux -= $this -> input -> post('quantP', TRUE) * $produtos[$i] -> valor_produto;
							if ($produtos[$i] -> tipo_produto != 1) {
								if ($aux >= $valorMim) {
									$produtos[$i] -> modelo_produto = $this -> input -> post('quantP', TRUE);
									$produtos[$i] -> tipo_produto = 1;
									$total = $aux;
									$verifica = 0;
									break;
								} else {
									$verifica = -3;
									break;
								}
							} else {
								$verifica = -4;
								break;
							}
						} else {
							$verifica = -2;
							break;
						}
					}
				}
				if ($verifica == -1) {
					session_write_close();
					$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'mensagem' => "Produto não está na Lista", 'id' => $id, 'valorMim' => $valorMim);
					$this -> my_load_view('vendaRetorno', $data);
				} else if ($verifica == -2) {
					session_write_close();
					$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade de produto Devolvido é Superior a Quantidade Levada ", 'id' => $id, 'valorMim' => $valorMim);
					$this -> my_load_view('vendaRetorno', $data);
				} else if ($verifica == -3) {
					session_write_close();
					$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'mensagem' => "A Fatura já Chegou no Limite de Devolução que é de " . $valorMim . " Reais", 'id' => $id, 'valorMim' => $valorMim);
					$this -> my_load_view('vendaRetorno', $data);
				} else if ($verifica == -4) {
					session_write_close();
					$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'mensagem' => "Esse Produto já foi Conferido. Para Conferir Novamente Selecione o Botão Desfazer Ação", 'id' => $id, 'valorMim' => $valorMim);
					$this -> my_load_view('vendaRetorno', $data);
				} else {
					unset($_SESSION['produtos']);
					$_SESSION['produtos'] = $produtos;
					session_write_close();
					$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'id' => $id, 'valorMim' => $valorMim);
					$this -> my_load_view('vendaRetorno', $data);
				}
			} else {
				session_write_close();
				$vendas1 = $this -> usuario_model -> getVendaC();
				if ($vendas1 != FALSE) {
					for ($i = 0; $i < count($vendas1); $i++) {
						$venda = $this -> usuario_model -> getVenda($vendas1[$i]['id_venda_inicio']);
						$cliente = $this -> usuario_model -> getCliente($venda -> cliente_fk, 0);
						$data1 = explode(" ", $venda -> data_venda);
						$data1 = explode("-", $data1[0]);
						$data = "" . $data1[2];
						$data = $data . "-" . $data1[1];
						$data = $data . "-" . $data1[0];
						$venda -> data_venda = $data;
						$venda -> cliente_fk = $cliente[0]['nome_cliente'];
						$vendas[$i] = $venda;
					}
					$data = array('vendas' => $vendas, 'mensagem' => "Erro ao na criação da lista de produto");
					$this -> my_load_view('consignado', $data);
				} else {
					$this -> my_load_view('consignado', NULL);
				}
			}

		} else {
			redirect('login');
		}
	}

	public function retornoCom($id) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			session_start();
			if (isset($_SESSION['produtos'])) {
				unset($_SESSION['produtos']);
			}
			$compras = $this -> usuario_model -> getCompras($id);
			$venda = $this -> usuario_model -> getVenda($id);
			$cliente = $this -> usuario_model -> getCliente($venda -> cliente_fk, 0);
			for ($i = 0; $i < count($compras); $i++) {
				$produto = $this -> usuario_model -> getProduto($compras[$i]['produto_fk'], 0);
				$produto -> estoque_produto = $compras[$i]['quantidade_produto'];
				$produto -> modelo_produto = 0;
				$produto -> tipo_produto = 0;
				$produtos[$i] = $produto;
			}
			$_SESSION['produtos'] = $produtos;
			session_write_close();
			$total = $venda -> valor_venda;
			$valorMim = $total * 0.25;
			$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'id' => $id, 'valorMim' => $valorMim);
			$this -> my_load_view('vendaRetorno', $data);
		} else {
			redirect('login');
		}
	}

	public function voltarCom($i, $total, $idCliente, $id, $valorMim) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$cliente = $this -> usuario_model -> getCliente($idCliente, 0);
			session_start();
			$produtos = $_SESSION['produtos'];
			$total += $produtos[$i] -> modelo_produto * $produtos[$i] -> valor_produto;
			$produtos[$i] -> modelo_produto = 0;
			$produtos[$i] -> tipo_produto = 0;
			unset($_SESSION['produtos']);
			$_SESSION['produtos'] = $produtos;
			$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'id' => $id, 'valorMim' => $valorMim);
			$this -> my_load_view('vendaRetorno', $data);
		} else {
			redirect('login');
		}
	}

	public function finalizarRetorno($total, $idCliente, $idVenda) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			session_start();
			$produtos = $_SESSION['produtos'];
			$cliente = $this -> usuario_model -> getCliente($idCliente, 0);
			$vendaRtorno = $this -> usuario_model -> setVenda($idCliente, $total);
			for ($i = 0; $i < count($produtos); $i++) {
				$produto = $this -> usuario_model -> getProduto($produtos[$i] -> id_produto, 0);
				$produto -> estoque_produto += $produtos[$i] -> modelo_produto;
				$this -> usuario_model -> updateVendaProduto($produto -> id_produto, $produto -> estoque_produto);
				if ($produtos[$i] -> modelo_produto != $produtos[$i] -> estoque_produto) {
					$this -> usuario_model -> setCompra($idCliente, $produtos[$i] -> estoque_produto - $produtos[$i] -> modelo_produto, $produto -> id_produto, $vendaRtorno);
				} else {
					$this -> usuario_model -> setCompra($idCliente, 0, $produto -> id_produto, $vendaRtorno);
				}
			}
			$vendasC = $this -> usuario_model -> getVendaC($idVenda);
			$this -> usuario_model -> updateVendaCom($vendasC[0]['id_venda_consignado'], $vendaRtorno);
			session_destroy();
			session_write_close();
			if ($total != 0) {
				$this -> usuario_model -> logs($this -> session -> userdata('id'), 9, $cliente[0]['id_cliente'], $total, $idVenda);
				redirect('venda/criaRomaneio/' . $vendasC[0]['id_venda_consignado'] . "/1");
			} else {
				$this -> usuario_model -> logs($this -> session -> userdata('id'), 9, $cliente[0]['id_cliente'], $total, $idVenda);
				redirect('venda');
			}
		} else {
			redirect('login');
		}
	}

	public function visualizaI($idProduto, $total, $tipo = 0, $idCliente = 0, $id = 0, $valorMim = 0) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($idProduto == -1) {
				session_start();
				$produtos = $_SESSION['produtos'];
				session_write_close();
				if ($tipo == 0) {
					$cliente = $this -> usuario_model -> getCliente($idCliente, 0);
					$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos, 'id' => $id, 'valorMim' => $valorMim);
					$this -> my_load_view('vendaRetorno', $data);
				} else if ($tipo == 1) {
					if ($idCliente != 0) {
						$cliente = $this -> usuario_model -> getCliente($idCliente, 0);
						$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos);
						$this -> my_load_view('vendaComum', $data);
					} else {
						$data = array('total' => $total, 'produtos' => $produtos);
						$this -> my_load_view('vendaComum', $data);
					}
				} else if ($tipo == 2) {
					if ($idCliente != 0) {
						$cliente = $this -> usuario_model -> getCliente($idCliente, 0);
						$data = array('cliente' => $cliente, 'total' => $total, 'produtos' => $produtos);
						$this -> my_load_view('vendaConsig', $data);
					} else {
						$data = array('total' => $total, 'produtos' => $produtos);
						$this -> my_load_view('vendaConsig', $data);
					}
				}
			} else {
				$produto = $this -> usuario_model -> getFoto(trim($idProduto));
				$data = array('idCliente' => $idCliente, 'tipo' => $tipo, 'total' => $total, 'produto' => $produto, 'id' => $id, 'valorMim' => $valorMim);
				$this -> my_load_view('vendaVerProduto', $data);
			}
		} else {
			redirect('login');
		}
	}

}
?>