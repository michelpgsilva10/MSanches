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
	function getLojaUser($idUser) {
		$this -> db -> select('NOME_USER,ID_USER,NIVEL_USER');
		$this -> db -> from('user');
		$this -> db -> where('ID_USER', $idUser);
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

	function getQantidade($tipo,$menor=0,$maior=0,$quali=0) {
		$this -> db -> select('COUNT(\'id_produto\') AS id');
		$this -> db -> from('produto p');
		if ($tipo != 0) {
			$this -> db -> where('tipo_produto', $tipo);
		}
		if ($quali !=0){
			$this -> db -> where('quali_produto', $quali);
		}
		if($menor !=0 && $maior==0){
			$this -> db -> where('valor_produto <=', $menor);
		}else if($menor !=0 && $maior!=0){
			$this -> db -> where('valor_produto <=', $menor);
			$this -> db -> where('valor_produto >=', $maior);
		}else if($maior !=0 && $menor==0){
			$this -> db -> where('valor_produto >=', $maior);
		}
		$this -> db -> where('del_produto !=', '1');
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}

	function getQantidadeItem($tipo, $idloja) {
		$this -> db -> select('SUM(lp.quantidade) AS total');
		$this -> db -> from('produto p');
        $this -> db -> join('loja_produto lp', 'lp.produto_fk = p.id_produto');
		$this -> db -> where('del_produto !=', '1');
		if($idloja <> 0)
        	$this -> db -> where('lp.loja_fk', $idloja);
		$this -> db -> where('estoque_produto !=', 0);
		$this -> db -> where('tipo_produto', $tipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return 0;
		}
	}
	
	function getQuantidadeItem2($id_loja) {
		$this -> db -> select("CASE p.tipo_produto WHEN 1 THEN 'Anel' WHEN 2 THEN 'Bracelete' WHEN 3 THEN 'Brinco' WHEN 4 THEN 'Colar' WHEN 5 THEN 'Conjunto' WHEN 6 THEN 'Pulseira' WHEN 7 THEN 'Tornozeleira' END nome_produto, SUM(lp.quantidade) quantidade, lp.loja_fk, p.tipo_produto", false);
		$this -> db -> from("produto p");
		$this -> db -> join("loja_produto lp", "p.id_produto = lp.produto_fk");
		$this -> db -> where("p.del_produto !=", "1");
		if ($id_loja <> 0) 
			$this -> db -> where("lp.loja_fk", $id_loja);
		$this -> db -> group_by("lp.loja_fk, p.tipo_produto");
		
		$query = $this -> db -> get();
		
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	
	function getQuantidadeItemTotal() {
		$this -> db -> select("CASE p.tipo_produto WHEN 1 THEN 'Anel' WHEN 2 THEN 'Bracelete' WHEN 3 THEN 'Brinco' WHEN 4 THEN 'Colar' WHEN 5 THEN 'Conjunto' WHEN 6 THEN 'Pulseira' WHEN 7 THEN 'Tornozeleira' END nome_produto, SUM(lp.quantidade) quantidade, p.tipo_produto", false);
		$this -> db -> from("produto p");
		$this -> db -> join("loja_produto lp", "p.id_produto = lp.produto_fk");
		$this -> db -> where("p.del_produto !=", "1");
		$this -> db -> group_by("p.tipo_produto");
		
		$query = $this -> db -> get();
		
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	
	function getQuantidade2($id_loja) {
		$this -> db -> select("p.tipo_produto, COUNT(p.modelo_produto) modelo_produto", false);
		$this -> db -> from("produto p");
		$this -> db -> join("loja_produto lp", "p.id_produto = lp.produto_fk");
		$this -> db -> where("p.del_produto !=", "1");
		
		if ($id_loja <> 0)
			$this -> db -> where("lp.loja_fk", $id_loja);
		
		$this -> db -> group_by("lp.loja_fk, p.tipo_produto");
		$this -> db -> order_by("lp.loja_fk, p.tipo_produto");
		
		$query = $this -> db -> get();
		
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	
	function getQuantidadeTotal() {
		$this -> db -> select("p.tipo_produto, COUNT(p.modelo_produto) modelo_produto", false);
		$this -> db -> from("produto p");
		$this -> db -> join("loja_produto lp", "p.id_produto = lp.produto_fk");
		$this -> db -> where("p.del_produto !=", "1");		
		$this -> db -> group_by("p.tipo_produto");
		$this -> db -> order_by("p.tipo_produto");
		
		$query = $this -> db -> get();
		
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	
	function getIdLojas($id_loja) {
		$this -> db -> distinct();
		$this -> db -> select("id_loja");
		$this -> db -> from("loja");
		
		if ($id_loja <> 0)
			$this -> db -> where("id_loja", $id_loja);
		
		$this -> db -> order_by("id_loja");
		
		$query = $this -> db -> get();
		
		if ($query -> num_rows() > 0)
			return $query -> result_array();
		else
			return 0;
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
			$data = array('logs' => "Criou um novo produto com o codigo: " . $produto, 'id_user_logs' => $id,'codBarra_produto'=>$produto);
		} else if ($tipo == 2) {
			$data = array('logs' => "Adcionou a foto", 'id_user_logs' => $id);
		} else if ($tipo == 3) {
			$data = array('logs' => "Alterou o pruduto com o codigo: " . $produto, 'id_user_logs' => $id,'codBarra_produto'=>$produto);
		} else if ($tipo == 4) {
			$data = array('logs' => "Deletou o pruduto com o codigo: " . $produto, 'id_user_logs' => $id,'codBarra_produto'=>$produto);
		} else if ($tipo == 5) {
			$data = array('logs' => "Saiu do sistema", 'id_user_logs' => $id);
		} else if ($tipo == 6) {
			$data = array('logs' => "Imprimiu Etiqueta do produto com o codigo: " . $produto, 'id_user_logs' => $id,'codBarra_produto'=>$produto);
		} else if ($tipo == 7) {
			$data = array('logs' => "Efetuou um venda Comum para o cliente: " . $produto . " com o valor de " . $valor, 
					      'id_user_logs' => $id,
					      'venda_tipo'=>'Comum',
					      'id_cliente'=>$produto);
		} else if ($tipo == 8) {
			$data = array('logs' => "Efetuou um venda Consignado para o cliente: " . $produto . " com o valor de " . $valor . " referente a venda de numero " . $idVenda,
						  'id_user_logs' => $id,
						  'id_venda'=>$idVenda,
						  'venda_tipo'=>'Consignado',
						  'id_cliente'=>$produto);
		} else if ($tipo == 9) {
			$data = array('logs' => "Efetuou o retorno do Consignado do cliente: " . $produto . " com o valor de " . $valor . " referente a venda de numero " . $idVenda, 
						  'id_user_logs' => $id,
						  'id_venda'=>$idVenda,
						  'venda_tipo'=>'Consignado',
						  'id_cliente'=>$produto);
		}

		$this -> db -> insert('logs', $data);
	}

	function setProduto($tipo, $valor, $model, $nome, $codel,$detalhe) {
		$data = array('tipo_produto' => $tipo,
					  'valor_produto' => $valor,
					  'modelo_produto' => $model,
					  'foto_produto' => $nome,
					  'cod_barra_produto' => $codel,
					  'quali_produto' => $detalhe);
					  
		$this -> db -> insert('produto', $data);
                return $this -> db -> insert_id();
	}

	function updateProduto($id, $tipo, $valor,  $model, $nome, $code,$detalhe) {
		$data = array('tipo_produto' => $tipo,
					  'valor_produto' => $valor,
					  'modelo_produto' => $model,
					  'foto_produto' => $nome,
					  'cod_barra_produto' => $code,
					  'quali_produto' => $detalhe);
		$this -> db -> where('id_produto', $id);
		$this -> db -> update('produto', $data);
	}

		function getAllProdutos() {
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('del_produto !=', '1');
		$this -> db -> order_by("id_produto", "ASC");
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}
	
	function getProdutos($inicio, $tipo,$quali=0,$menor=0,$maior=0) {
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('del_produto !=', '1');
		if ($tipo != 0) {
			$this -> db -> where('tipo_produto', $tipo);
		}
		if ($quali !=0){
			$this -> db -> where('quali_produto', $quali);
		}
		if($menor !=0 && $maior==0){
			$this -> db -> where('valor_produto <=', $menor);
		}else if($menor !=0 && $maior!=0){
			$this -> db -> where('valor_produto <=', $menor);
			$this -> db -> where('valor_produto >=', $maior);
		}else if($maior !=0 && $menor==0){
			$this -> db -> where('valor_produto >=', $maior);
		}
		$this -> db -> order_by("cod_barra_produto", "ASC");
		$this -> db -> limit(42, $inicio);
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
        
        function getQuantidadeProduto($idproduto, $idloja=0) {
		$this -> db -> select('*');
		$this -> db -> from('loja_produto');
		if ($idloja != 0) {
			$this -> db -> where('loja_fk', $idloja);
			$this -> db -> where('produto_fk', $idproduto);
		} else {
			$this -> db -> where('produto_fk', $idproduto);
		}
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}
          function getProdutoLoja($idloja, $idproduto) {
		$this -> db -> select('*');
		$this -> db -> from('loja_produto');
		$this -> db -> where('loja_fk', $idloja);
		$this -> db -> where('produto_fk', $idproduto);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}
        
	function getBusca($id, $code) {
		$this -> db -> select('*');
		$this -> db -> from('produto p');
		if (strcmp($code, "0") == 0) {
			$this -> db -> where('id_produto', $id);
		} else {
			$this -> db -> where('cod_barra_produto', $code);
		}
		$this -> db -> where('del_produto !=', '1');
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}
        
        public function updateItemnovo($idProduto,$idloja,$data) {
		$this -> db -> where('loja_fk', $idloja);
		$this -> db -> where('produto_fk', $idProduto);
		$this -> db -> update('loja_produto', $data);
		return $this -> db -> affected_rows();
	}
        public function setitemnovo($data) {

		$str = $this -> db -> insert_string('loja_produto', $data);
		$this -> db -> query($str);
		return $this -> db -> affected_rows();
	}

	function getProduto($id, $code,$add=0,$idloja=-1) {
		if($add != 0){
            if($idloja!=-1){
				$this -> db -> select('p.id_produto,p.valor_produto,lp.quantidade as estoque_produto,p.cod_barra_produto,p.modelo_produto,p.del_produto');
            }else{
                $this -> db -> select('p.id_produto,p.valor_produto,p.cod_barra_produto,p.modelo_produto,p.del_produto');
            }
		}else{	
          if($idloja!=-1){
			  $this -> db -> select('p.id_produto,p.valor_produto,lp.quantidade as estoque_produto,p.cod_barra_produto,p.modelo_produto');
          }else{
              $this -> db -> select('p.id_produto,p.valor_produto,p.cod_barra_produto,p.modelo_produto');
          }
		}
		$this -> db -> from('produto p');
        if($idloja!=-1){
            $this->db->join('loja_produto lp', 'lp.produto_fk=p.id_produto and lp.loja_fk = '.$idloja);
        }
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

	function getClientes($inicio,$idloja) {
		$this -> db -> select('*');
		$this -> db -> from('cliente');
		$this -> db -> join('endereco', 'cliente.endereco_fk = endereco.id_endereco');
		$this -> db -> where('del_cliente', 0);
		if ($idloja <> 0)
        	$this -> db -> where('loja_fk', $idloja);
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
        
    function getLoja() {
		$this -> db -> select('id_loja, nome_loja');
		$this -> db -> from('loja');
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
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

	function getCliente($dado, $tipo,$idloja) {
		$this -> db -> select('*');
		$this -> db -> from('cliente');
		$this -> db -> join('endereco', 'cliente.endereco_fk = endereco.id_endereco');
		$this -> db -> where('del_cliente', 0);
		if ($idloja <> 0)
        	$this -> db -> where('loja_fk', $idloja);
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
         public function updateLojaproduto($idProduto,$idloja,$data) {
		$this -> db -> where('loja_fk', $idloja);
		$this -> db -> where('produto_fk', $idProduto);
		$this -> db -> update('loja_produto', $data);
		return $this -> db -> affected_rows();
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

	function setVenda($id_cliente, $valor,$Tipo,$data = 0) {
		if ($data != 0) {
			$data = array('cliente_fk' => $id_cliente, 'valor_venda' => $valor, 'data_retorno_venda' => $data,'tipo_venda'=>$Tipo);
		} else {
			$data = array('cliente_fk' => $id_cliente, 'valor_venda' => $valor,'tipo_venda'=>$Tipo);
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
		$this -> db -> select("CASE WHEN vc.id_venda_consignado IS NULL THEN 0 ELSE 1 END AS tipo_venda, v1.id_venda, v1.data_venda, v1.data_retorno_venda, v1.valor_venda,v1.tipo_venda as tipo_venda0, c.nome_cliente, v2.data_venda AS data_venda2, v2.valor_venda AS valor_venda2", FALSE);
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