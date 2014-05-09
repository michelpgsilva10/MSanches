<?php
class Cliente extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time).do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load')==$load) {
			$this -> my_load_view('novoCliente', NULL);
		} else {
			redirect('login');
		}
	}
	
	public function adicionar() {
		$nome_cliente = $this->input->post('nome_cliente');
		$cpf_cliente = $this->input->post('cpf_cliente');
		$ref_comercial_cliente = $this->input->post('ref_comercial_cliente');
		
		$data = array('nome_cliente' => $nome_cliente,
					  'cpf_cliente' => $cpf_cliente,
					  'ref_comercial' => $ref_comercial_cliente,
					  'endereco_fk' => 1);
		
		$this->db->insert('cliente', $data);
		redirect('cliente');
			
		}
		
}
?>