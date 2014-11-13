<?php
class Bugs extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
	}

	function fotoErro($proxima = 0) {
		$maxId = $this -> usuario_model -> getID();
		$aux = $this -> usuario_model -> getFoto(1);
		$cont = 0;
		$cont2 = 0;
		for ($i = 1; $i <= $maxId -> id_produto; $i++) {
			$prox = $this -> usuario_model -> getFoto($i + 1);
			if ($prox != FALSE) {
				if (strcmp($prox -> foto_produto, $aux -> foto_produto) == 0) {
					//echo "<br/>";
					//echo "---------Entrou------------";
					//echo "<br/>";
					//echo "Cont2 = ".$cont2;
					//echo "<br/>";
					//echo "DENTRO-- id= ".$i." aux= ".$aux->foto_produto." prox= ".$prox->foto_produto;
					// "<br/>";
					//echo "---------------------------";
					//echo "<br/>";
					if ($cont2 == 0) {
						$produtos[$cont][$cont2] = $aux;
						$produtos[$cont][$cont2 + 1] = $prox;
						$cont2++;
					} else {
						$produtos[$cont][$cont2] = $prox;
					}
					$cont2++;
				} else {
					//echo "<br/>";
					//echo "id= ".$i." aux= ".$aux->foto_produto." prox= ".$prox->foto_produto;
					$cont++;
					$cont2 = 0;
					$aux = $prox;
				}
			}
		}
		if (isset($produtos)) {
			session_start();
			$produtos = array_values($produtos);
			$_SESSION['produtos'] = $produtos;
			session_write_close();
			$data = array('produtos' => $produtos[0], 'posicao' => 0);
		} else {
			$data = array('posicao' => 0);
		}
		
		$this -> my_load_view('bugsFoto', $data);
	}

	function corrigir($posicaoVP, $idItemP) {
		session_start();
		$produtos = $_SESSION['produtos'];
		session_write_close();
		for ($i = 0; $i < count($produtos[$posicaoVP]); $i++) {
			if ($i == $idItemP) {
				$nome = $produtos[$posicaoVP][$i] -> id_produto;
				if ($nome < 10) {
					$nome = "000" . $nome;
				} else if ($nome < 100) {
					$nome = "00" . $nome;
				} else if ($nome < 1000) {
					$nome = "0" . $nome;
				}
				$nome = $nome . ".jpg";
				$messagem = "Alterado com Sucesso";
				if (file_exists("/home/mmsan532/public_html/sistema/css/img/img_produto/" . $produtos[$posicaoVP][$i] -> foto_produto)) {
					if(rename("/home/mmsan532/public_html/sistema/css/img/img_produto/" . $produtos[$posicaoVP][$i] -> foto_produto,
							  "/home/mmsan532/public_html/sistema/css/img/img_produto/" . $nome)==FALSE){
						$messagem = "Erro ao Alterar o Nome da Foto";
						$erro=TRUE;
						break;
					}
				}
				$this -> usuario_model -> updatefoto($produtos[$posicaoVP][$i] -> id_produto,$nome);
			}else{
				$nome = $produtos[$posicaoVP][$i] -> id_produto;
				if ($nome < 10) {
					$nome = "000" . $nome;
				} else if ($nome < 100) {
					$nome = "00" . $nome;
				} else if ($nome < 1000) {
					$nome = "0" . $nome;
				}
				$nome = $nome . ".jpg";
				$this -> usuario_model -> updatefoto($produtos[$posicaoVP][$i] -> id_produto,$nome);
			}
		}
		if($posicaoVP < count($produtos)){
			$posicaoVP++;	
			if(isset($erro)){
				$data = array('produtos' => $produtos[$posicaoVP], 'posicao' => $posicaoVP,'mensagem'=>$messagem);
			}else{
				$data = array('produtos' => $produtos[$posicaoVP], 'posicao' => $posicaoVP,'mensagemC'=>$messagem);
			}
			$this -> my_load_view('bugsFoto', $data);
		}else{
			$posicaoVP++;
			if(isset($erro)){
				$data = array('posicao' => $posicaoVP,'mensagem'=>$messagem);
			}else{
				$data = array('posicao' => $posicaoVP,'mensagemC'=>$messagem);
			}
			$this -> my_load_view('bugsFoto', $data);
		}

	}

}
?>