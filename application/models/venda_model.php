<?php

Class Venda_model  extends CI_Model {
	function getExID($iduser,$idtipo=0) {
		$this -> db -> select_max('id_lista');
		$this -> db -> from('venda_lista');
		$this -> db -> where("id_user", $iduser);
		$this -> db -> where('tipo_lista', $idtipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	function getLista($idlista, $iduser,$idtipo=0) {
		$this -> db -> select('codbarras,valor_uni,valor_pago,desconto,quantidade,quantidade_D,id_produto');
		$this -> db -> from('venda_lista');
		$this -> db -> where('id_lista', $idlista);
		$this -> db -> where('id_user', $iduser);
		$this -> db -> where('tipo_lista', $idtipo);
		$this -> db -> order_by("codbarras", "ASC");
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}

	function getValor($idlista, $iduser,$idtipo=0) {
		$this -> db -> select_sum('valor_pago');
		$this -> db -> from('venda_lista');
		$this -> db -> where('id_lista', $idlista);
		$this -> db -> where('id_user', $iduser);
		$this -> db -> where('tipo_lista',$idtipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

	public function setitem($data) {

		$str = $this -> db -> insert_string('venda_lista', $data);
		$this -> db -> query($str);
		return $this -> db -> affected_rows();
	}
	
	public function updateItem($idProduto,$idlista,$iduser,$data,$idtipo=0) {
		$this -> db ->where('id_produto', $idProduto);
		$this -> db -> where('id_lista', $idlista);
		$this -> db -> where('id_user', $iduser);
		$this -> db -> where('tipo_lista', $idtipo);
		$this -> db ->update('venda_lista', $data);
		return $this -> db -> affected_rows();
	}
	
	public function deleteItem($idProduto,$idlista,$iduser,$idtipo=0) {
		$this -> db ->where('id_produto', $idProduto);
		$this -> db -> where('id_lista', $idlista);
		$this -> db -> where('id_user', $iduser);
		$this -> db -> where('tipo_lista', $idtipo);
		$this -> db ->delete('venda_lista');
		return $this -> db -> affected_rows();
	}
	
	public function deleteLista($idlista,$iduser,$tipo_lista=0) {
		$this -> db -> where('id_lista', $idlista);
		$this -> db -> where('id_user', $iduser);
		if($tipo_lista==2){
			$this -> db -> where('tipo_lista', 1);
		}else{
			$this -> db -> where('tipo_lista !=', 2);
		}
		$this -> db ->delete('venda_lista');
		return $this -> db -> affected_rows();
	}
	
	public function verificaItem($idProduto,$idlista,$iduser,$idtipo=0) {
		$this -> db -> select('quantidade,desconto,quantidade_D');	
		$this -> db -> from('venda_lista');
		$this -> db ->where('id_produto', $idProduto);
		$this -> db -> where('id_lista', $idlista);
		$this -> db -> where('id_user', $iduser);
		$this -> db -> where('tipo_lista', $idtipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return FALSE;
		}
	}

}
?>
