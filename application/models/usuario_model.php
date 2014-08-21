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
		$this -> db -> select_max('id_produto');
		$this -> db -> from('produto');
		$this -> db -> order_by("id_produto", "desc");
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function getQProduto($tipo) {
		$this -> db -> select('modelo_produto');
		$this -> db -> from('produto');
		$this -> db -> where('del_produto !=', '1');
		$this -> db -> where('tipo_produto', $tipo);
		$this -> db -> order_by("modelo_produto", "ASC");
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
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
		$this -> db -> where('del_produto !=', '1');
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
		$this -> db -> where('del_produto !=', '1');
		$this -> db -> where('estoque_produto !=', 0);
		$this -> db -> where('tipo_produto', $tipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}

	function deletarProduto($id) {

		$data = array('del_produto' => 1);
		$this -> db -> where('id_produto', $id);
		$this -> db -> update('produto', $data);

	}

	function logs($id, $tipo, $produto = 0, $valor = 0, $idVenda = 0) {

		if ($tipo == 0) {
			$data = array('logs' => "Logou no sistema", 'id_user_logs' => $id);
		} else if ($tipo == 1) {
			$data = array('logs' => "Criou um novo produto com o codigo: " . $produto, 'id_user_logs' => $id);
		} else if ($tipo == 2) {
			$data = array('logs' => "Adcionou a foto", 'id_user_logs' => $id);
		} else if ($tipo == 3) {
			$data = array('logs' => "Alterou o pruduto com o codigo: " . $produto, 'id_user_logs' => $id);
		} else if ($tipo == 4) {
			$data = array('logs' => "Deletou o pruduto com o codigo: " . $produto, 'id_user_logs' => $id);
		} else if ($tipo == 5) {
			$data = array('logs' => "Saiu do sistema", 'id_user_logs' => $id);
		} else if ($tipo == 6) {
			$data = array('logs' => "Imprimiu Etiqueta do produto com o codigo: " . $produto, 'id_user_logs' => $id);
		} else if ($tipo == 7) {
			$data = array('logs' => "Efetuou um venda Comum para o cliente: " . $produto . " com o valor de " . $valor, 'id_user_logs' => $id);
		} else if ($tipo == 8) {
			$data = array('logs' => "Efetuou um venda Consignado para o cliente: " . $produto . " com o valor de " . $valor . " referente a venda de numero " . $idVenda, 'id_user_logs' => $id);
		} else if ($tipo == 9) {
			$data = array('logs' => "Efetuou o retorno do Consignado do cliente: " . $produto . " com o valor de " . $valor . " referente a venda de numero " . $idVenda, 'id_user_logs' => $id);
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
		$this -> db -> order_by("cod_barra_produto", "ASC");
		$this -> db -> limit(12, $inicio);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}

	function getFoto($idProduto) {
		$this -> db -> select('foto_produto,cod_barra_produto,id_produto');
		$this -> db -> from('produto');
		$this -> db -> where('id_produto', $idProduto);
		$this -> db -> where('del_produto !=', '1');
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function updatefoto($id, $fotoname) {
		$data = array('foto_produto' => $fotoname);
		$this -> db -> where('id_produto', $id);
		$this -> db -> update('produto', $data);
	}

	function getBusca($id, $code) {
		$this -> db -> select('*');
		$this -> db -> from('produto');
		if (strcmp($code, "0") == 0) {
			$this -> db -> where('id_produto', $id);
		} else {
			$this -> db -> where('del_produto !=', '1');
			$this -> db -> where('cod_barra_produto', $code);
		}
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function getProduto($id, $code,$add=0) {
		if($add != 0){
			$this -> db -> select('id_produto,valor_produto,estoque_produto,cod_barra_produto,modelo_produto,del_produto');
		}else{	
			$this -> db -> select('id_produto,valor_produto,estoque_produto,cod_barra_produto,modelo_produto');
		}
		$this -> db -> from('produto');
		if (strcmp($code, "0") == 0) {
			$this -> db -> where('id_produto', $id);
		} else {
			$this -> db -> where('del_produto !=', '1');
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
		$this -> db -> order_by('nome_cliente', 'asc');

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

	function getVendaC($id = -1) {
		$this -> db -> select('*');
		$this -> db -> from('venda_consignado');
		if ($id == -1) {
			$this -> db -> where("id_venda_retorno IS NULL");
		} else {
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
		$this -> db -> where("venda_fk", $id);
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

	function getIdVendasConsig($id_venda_consig) {
		$this -> db -> select('*');
		$this -> db -> from('venda_consignado');
		$this -> db -> where('id_venda_consignado', $id_venda_consig);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return false;
		}
	}

	function getDesconto($idVenda, $idProduto) {
		$this -> db -> select('desconto_compra');
		$this -> db -> from('compra');
		$this -> db -> where('produto_fk', $idProduto);
		$this -> db -> where('venda_fk', $idVenda);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return false;
		}
	}

	function getVendaConsigTipo($id_venda, $tipo) {
		$this -> db -> select('*');
		$this -> db -> from('venda_consignado');
		if ($tipo == 1)
			$this -> db -> join('venda', 'venda_consignado.id_venda_inicio = venda.id_venda');
		else
			$this -> db -> join('venda', 'venda_consignado.id_venda_retorno = venda.id_venda');
		$this -> db -> join('compra', 'venda.id_venda = compra.venda_fk');
		$this -> db -> join('produto', 'compra.produto_fk = produto.id_produto');
		$this -> db -> join('cliente', 'compra.cliente_fk = cliente.id_cliente');
		$this -> db -> join('endereco', 'cliente.endereco_fk = endereco.id_endereco');
		if ($tipo == 1)
			$this -> db -> where('venda_consignado.id_venda_inicio', $id_venda);
		else
			$this -> db -> where('venda_consignado.id_venda_retorno', $id_venda);
		$this -> db -> order_by('produto.cod_barra_produto', 'asc');

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			return $query -> result_array();
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
		$this -> db -> where('id_venda', $idVenda);

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

	function setCompra($id_cliente, $quantidade, $idProduto, $idVenda, $desconto) {
		$data = array('cliente_fk' => $id_cliente, 'quantidade_produto' => $quantidade, 'produto_fk' => $idProduto, 'venda_fk' => $idVenda, 'desconto_compra' => $desconto);
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

	function updatePosRet($id, $idProduto, $quantidade) {
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

	function getComprasCliente($id_cliente) {
		$this -> db -> select("CASE WHEN vc.id_venda_consignado IS NULL THEN 0 ELSE 1 END AS tipo_venda, v1.id_venda, v1.data_venda, v1.data_retorno_venda, v1.valor_venda, c.nome_cliente, v2.data_venda AS data_venda2, v2.valor_venda AS valor_venda2", FALSE);
		$this -> db -> from("venda v1");
		$this -> db -> join("venda_consignado vc", "v1.id_venda = vc.id_venda_inicio", "left");
		$this -> db -> join("venda v2", "vc.id_venda_retorno = v2.id_venda", "left");
		$this -> db -> join("cliente c", "c.id_cliente = v1.cliente_fk");
		$this -> db -> where("v1.cliente_fk", $id_cliente);	
		$this -> db -> where("v1.id_venda NOT IN (SELECT id_venda_retorno FROM venda_consignado WHERE id_venda_retorno IS NOT NULL)");	
		$this -> db -> order_by("v1.data_venda", "desc");

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0)
			return $query -> result_array();
		else
			return false;
	}

	function getCompraDetalhes($id_venda, $tipo_venda) {
		if (trim($tipo_venda) == 1) {
			$this -> db -> select('b.id_venda, c.quantidade_produto quant_pegou, e.quantidade_produto quant_dev,c.desconto_compra as desconto , f.cod_barra_produto, f.valor_produto, b.valor_venda, h.nome_cliente, h.id_cliente, a.id_venda_consignado, 1 tipo_venda, d.valor_venda AS valor_venda2', FALSE);
			$this -> db -> from('venda_consignado a');
			$this -> db -> join('venda b', 'a.id_venda_inicio = b.id_venda');
			$this -> db -> join('compra c', 'b.id_venda = c.venda_fk');
			$this -> db -> join('produto f', 'c.produto_fk = f.id_produto');
			$this -> db -> join('venda d', 'a.id_venda_retorno = d.id_venda', 'left');
			$this -> db -> join('compra e', 'd.id_venda = e.venda_fk AND e.produto_fk = f.id_produto', 'left');
			$this -> db -> join('cliente h', 'b.cliente_fk = h.id_cliente');
			$this -> db -> where('a.id_venda_inicio', $id_venda);
		} else {
			$this -> db -> select("a.id_venda, a.valor_venda, b.quantidade_produto, c.cod_barra_produto,b.desconto_compra as desconto, c.valor_produto, d.nome_cliente, d.id_cliente, 0 tipo_venda", FALSE);
			$this -> db -> from('venda a');
			$this -> db -> join('compra b', 'a.id_venda = b.venda_fk');
			$this -> db -> join('produto c', 'b.produto_fk = c.id_produto');
			$this -> db -> join('cliente d', 'a.cliente_fk = d.id_cliente');
			$this -> db -> where('a.id_venda', $id_venda);
		}

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0)
			return $query -> result_array();
		else
			return false;
	}

}
?>