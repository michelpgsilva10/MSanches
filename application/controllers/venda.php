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
			$data = array('total' => 0);
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

	public function novoitem($total) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			if ($this -> session -> userdata('produtos')) {
				$produtos = $this -> session -> userdata('produtos');
				$produto = $this -> usuario_model -> getProduto(0, $this -> input -> post('codigoP', TRUE));
				if ($produto != FALSE) {
					if ($this -> input -> post('quantP', TRUE) <= $produto -> estoque_produto) {
						$produto -> estoque_produto = $this -> input -> post('quantP', TRUE);
						$produtos[] = $produto;
						$total += $produto -> valor_produto * $this -> input -> post('quantP', TRUE);
						$this -> session -> set_userdata('produtos', $produtos);
						$data = array('total' => $total, 'produtos' => $produtos);
						$this -> my_load_view('vendaComum', $data);
					} else {
						$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade do Produto Inesistente");
						$this -> my_load_view('vendaComum', $data);
					}
				} else {
					$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Produto não Encontrado");
					$this -> my_load_view('vendaComum', $data);
				}
			} else {
				$produto = $this -> usuario_model -> getProduto(0, $this -> input -> post('codigoP', TRUE));
				if ($produto != FALSE) {
					if ($this -> input -> post('quantP', TRUE) <= $produto -> estoque_produto) {
						$produtos[0] = $produto;
						$total += $produto -> valor_produto * $this -> input -> post('quantP', TRUE);
						$this -> session -> set_userdata('produtos', $produtos);
						$data = array('total' => $total, 'produtos' => $produtos);
						$this -> my_load_view('vendaComum', $data);
					} else {
						$data = array('total' => $total, 'produtos' => $produtos, 'mensagem' => "Quantidade do Produto Inesistente");
						$this -> my_load_view('vendaComum', $data);
					}
				} else {
					$data = array('total' => $total, 'mensagem' => "Produto não Encontrado");
					$this -> my_load_view('vendaComum', $data);
				}
			}
		} else {
			redirect('login');
		}
	}

	public function finalizarCompra($total) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> session -> unset_userdata('produtos');
			redirect('venda');
		} else {
			redirect('login');
		}
	}

	public function sair() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> session -> unset_userdata('produtos');
			redirect('venda');
		} else {
			redirect('login');
		}
	}

	public function deletaItem($i, $total) {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$produtos = $this -> session -> userdata('produtos');
			$total -= $produtos[$i] -> valor_produto * $produtos[$i] -> estoque_produto;
			unset($produtos[$i]);
			$this -> session -> set_userdata('produtos', $produtos);
			$data = array('total' => $total, 'produtos' => $produtos);
			$this -> my_load_view('vendaComum', $data);
		} else {
			redirect('login');
		}
	}

}
?>