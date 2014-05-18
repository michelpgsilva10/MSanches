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
			return 0;
		}
	}
	function getQantidadeItem($tipo) {
		$this -> db -> select('SUM(estoque_produto) AS total');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', $tipo);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->row(); 
		} else {
			return 0;
		}
	}
	function deletarProduto($id){
		
		$this->db->where('id_produto', $id);
		$this->db->delete('produto'); 
		
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
	
	function updateProduto($id,$tipo,$valor,$quantidade,$nome,$code) {
		$data = array(
		'tipo_produto' => $tipo,
		'valor_produto' =>$valor,
		'estoque_produto' => $quantidade,
		'foto_produto' => $nome,
		'cod_barra_produto' => $code
		);
		$this->db->where('id_produto', $id);
		$this->db->update('produto', $data); 
	}
	
	function getProdutos($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('estoque_produto !=', '0');
		$this -> db -> limit(12,$inicio);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getProduto($id,$code){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		if(strcmp ($code,"0")==0){
			$this -> db -> where('id_produto',$id);
		}else{
			$this -> db -> where('cod_barra_produto',$code);
		}
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->row();
		} else {
			return FALSE;
		}
	}	
	function getBrinco($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', 'Br');
		$this->db->limit($inicio,6);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getAnel($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', 'An');
		$this->db->limit($inicio,6);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getColar($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', 'Cl');
		$this->db->limit($inicio,6);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getPulceira($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', 'Pl');
		$this->db->limit($inicio,6);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getBracelete($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', 'Bl');
		$this->db->limit($inicio,6);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getConjunto($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', 'Cj');
		$this->db->limit($inicio,6);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getTornozeleira($inicio){
		$this -> db -> select('*');
		$this -> db -> from('produto');
		$this -> db -> where('tipo_produto', 'Tr');
		$this->db->limit($inicio,6);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query ->result_array();
		} else {
			return FALSE;
		}
	}
	function getCliente($inicio) {
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
	
}
?>