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
		$this->db->order_by("id_produto", "desc");
		$this->db->limit(1);
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
		$this -> db -> where('tipo_produto', $tipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->row(); 
		} else {
			return FALSE;
		}
	}
	
	
	function setProduto($tipo,$valor,$quantidade,$nome,$code) {
		$data = array(
		'tipo_produto' => $tipo,
		'valor_produto' =>$valor,
		'estoque_produto' => $quantidade,
		'foto_produto' => $nome,
		'cod_barra_produto' => $code
		);
		$this->db->insert('produto', $data); 
	}
	
}
?>