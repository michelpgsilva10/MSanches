<?php

Class Usuario_model  extends CI_Model {

	function login($email, $senha) {
		$this -> db -> select('NOME_USER,ID_USER,NIVEL_USER');
		$this -> db -> from('user');
		$this -> db -> where('NOME_USER', $email);
		$this -> db -> where('SENHA_USER', $senha);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function getID() {
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> order_by("id_produto", "desc");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function getQantidade($tipo) {
		$this -> db -> select('COUNT(\'id_produto\') AS id');
		$this -> db -> from('produto');
		if ($tipo != 0) {
			$this -> db -> where('tipo_produto', $tipo);
		}
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}

	function getQantidadeItem($tipo) {
		$this -> db -> select('SUM(estoque_produto) AS total');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', $tipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}

	function deletarProduto($id) {

		$this -> db -> where('id_produto', $id);
		$this -> db -> delete('produto');

	}

	function logs($id, $tipo, $produto = 0) {

		if ($tipo == 0) {
			$data = array('logs' => "Logou no sistema", 'id_user_logs' => $id);
		} else if ($tipo == 1) {
			$data = array('logs' => "Criou um novo produto com o codigo: " . $produto, 'id_user_logs' => $id);
		} else if ($tipo == 2) {
			$data = array('logs' => "Adcionou a foto defu", 'id_user_logs' => $id);
		} else if ($tipo == 3) {
			$data = array('logs' => "Alterou o pruduto com o codigo: " . $produto, 'id_user_logs' => $id);
		} else if ($tipo == 4) {
			$data = array('logs' => "Deletou o pruduto com o codigo: " . $produto, 'id_user_logs' => $id);
		} else if ($tipo == 5) {
			$data = array('logs' => "Saiu do sistema", 'id_user_logs' => $id);
		} else if ($tipo == 6) {
			$data = array('logs' => "Imprimiu Etiqueta do produto com o codigo: " . $produto, 'id_user_logs' => $id);
		}
		$this -> db -> insert('logs', $data);
	}

	function setProduto($tipo, $valor, $quantidade, $model, $nome, $code) {
		$data = array('tipo_produto' => $tipo, 'valor_produto' => $valor, 'modelo_produto' => $model, 'estoque_produto' => $quantidade, 'foto_produto' => $nome, 'cod_barra_produto' => $code);
		$this -> db -> insert('produto', $data);
	}

	function updateProduto($id, $tipo, $valor, $quantidade, $model, $nome, $code) {
		$data = array('tipo_produto' => $tipo, 'valor_produto' => $valor, 'estoque_produto' => $quantidade, 'modelo_produto' => $model, 'foto_produto' => $nome, 'cod_barra_produto' => $code);
		$this -> db -> where('id_produto', $id);
		$this -> db -> update('produto', $data);
	}

	function getProdutos($inicio, $tipo) {
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('del_produto !=', '1');
		if ($tipo != 0) {
			$this -> db -> where('tipo_produto', $tipo);
		}
		$this -> db -> limit(12, $inicio);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}

	function getProduto($id, $code) {
		$this -> db -> select('*');
		$this -> db -> from('produto');
		if (strcmp($code, "0") == 0) {
			$this -> db -> where('id_produto', $id);
		} else {
			$this -> db -> where('cod_barra_produto', $code);
		}
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function getClientes($inicio) {
		$this -> db -> select('*');
		$this -> db -> from('cliente');
		$this -> db -> join('endereco', 'cliente.endereco_fk = endereco.id_endereco');
		$this -> db -> where('del_cliente', 0);

		//$this -> db -> limit($inicio, 15);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}

	function getVenda($id) {
		$this -> db -> select('*');
		$this -> db -> from('venda');
		$this -> db -> where('id_venda', $id);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function getVendaC($id=-1) {
		$this -> db -> select('*');
		$this -> db -> from('venda_consignado');
		if($id==-1){
			$this -> db -> where("id_venda_retorno IS NULL");
		}else{
			$this -> db -> where('id_venda_inicio', $id);
		}
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}

	function getCompras($id) {
		$this -> db -> select('*');
		$this -> db -> from('compra');
		$this -> db -> where("venda_fk",$id);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}

	function getCliente($dado, $tipo) {
		$this -> db -> select('*');
		$this -> db -> from('cliente');
		$this -> db -> join('endereco', 'cliente.endereco_fk = endereco.id_endereco');
		$this -> db -> where('del_cliente', 0);
		if ($tipo == 1) {
			$this -> db -> where('cpf_cliente', $dado);
		} else if ($tipo == 2) {
			$term = strtolower($dado);
			$this -> db -> where("(LOWER(nome_cliente) LIKE '%{$term}%')");
		} else if ($tipo == 0) {
			$this -> db -> where('id_cliente', $dado);
		}
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}

	function getCpf($cpf) {
		$this -> db -> select('cpf_cliente');
		$this -> db -> from('cliente');
		$this -> db -> where('del_cliente', 0);
		$this -> db -> where('cpf_cliente', $cpf);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return false;
		}
	}

	
	function getVendaConsig($idVenda) {
		$this -> db -> select('*');
		$this -> db -> from('venda');
		$this -> db -> join('compra', 'venda.id_venda = compra.venda_fk');
		$this -> db -> join('produto', 'compra.produto_fk = produto.id_produto');
		$this -> db -> join('cliente', 'compra.cliente_fk = cliente.id_cliente');
		$this -> db -> join('endereco', 'cliente.endereco_fk = endereco.id_endereco');
		
		$query = $this -> db -> get();
		
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
		
	}

	function setVenda($id_cliente, $valor, $data = 0) {
		if ($data != 0) {
			$data = array('cliente_fk' => $id_cliente, 'valor_venda' => $valor, 'data_retorno_venda' => $data);
		} else {
			$data = array('cliente_fk' => $id_cliente, 'valor_venda' => $valor);
		}
		$this -> db -> insert('venda', $data);

		return $this -> db -> insert_id();
	}

	function setCompra($id_cliente, $quantidade, $idProduto, $idVenda) {
		$data = array('cliente_fk' => $id_cliente, 'quantidade_produto' => $quantidade, 'produto_fk' => $idProduto, 'venda_fk' => $idVenda, );
		$this -> db -> insert('compra', $data);

	}

	function setVendaC($id) {
		$data = array('id_venda_inicio' => $id);
		$this -> db -> insert('venda_consignado', $data);

	}

	function updateVendaProduto($id, $quantidade) {
		$data = array('estoque_produto' => $quantidade);
		$this -> db -> where('id_produto', $id);
		$this -> db -> update('produto', $data);
	}
	function updatePosRet($id,$idProduto, $quantidade) {
		$data = array('quantidade_produto' => $quantidade);
		$this -> db -> where('venda_fk', $id);
		$this -> db -> where('produto_fk', $idProduto);
		$this -> db -> update('compra', $data);
	}
	
	function updateVendaCom($id, $idFinal) {
		$data = array('id_venda_retorno' => $idFinal);
		$this -> db -> where('id_venda_consignado', $id);
		$this -> db -> update('venda_consignado', $data);
	}
}
?>