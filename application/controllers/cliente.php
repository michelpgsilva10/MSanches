<?php
class Cliente extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this->load->library('form_validation');		
	}

	public function index() {
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> my_load_view('novoCliente', NULL);
		} else {
			redirect('login');
		}
	}

	public function adicionar() {
		#Validação para tabela Cliente
		$this -> form_validation -> set_rules('nome_cliente', 'Nome', 'required');
		$this -> form_validation -> set_rules('cpf_cliente', 'CPF', 'callback_validaCPF');
		$this -> form_validation -> set_rules('tel_cliente', 'Telefone', 'required');
		$this -> form_validation -> set_rules('ref_comercial_cliente', 'Ref. Comercial', '');

		#Validação para tabela Endereço
		$this -> form_validation -> set_rules('rua_cliente', 'Rua', 'required');
		$this -> form_validation -> set_rules('num_endereco_cliente', 'Número', 'required');
		$this -> form_validation -> set_rules('bairro_cliente', 'Bairro', 'required');
		$this -> form_validation -> set_rules('cidade_cliente', 'Cidade', 'required');
		$this -> form_validation -> set_rules('complemento_cliente', 'Complemento', '');
		$this -> form_validation -> set_rules('uf_cliente', 'Estado', '');	
				
		$this->form_validation->set_message('required', 'O campo %s é obrigatório.');
				
		$this->form_validation->set_error_delimiters('<div class="alert-danger alert-dismissable alert-space">', '</div>');
		
		if ($this->input->post('cadastrar_cliente')) {
			if ($this->form_validation->run() == FALSE) {
				$this -> my_load_view('novoCliente', NULL);				
			} else {
				$endereco_insert = array (
					'rua_endereco' => $this -> input -> post('rua_cliente'),
					'cidade_endereco' => $this -> input -> post('cidade_cliente'),
					'uf_endereco' => $this -> input -> post('uf_cliente'),
					'bairro_endereco' => $this -> input -> post('bairro_cliente'),
					'numero_endereco' => $this -> input -> post('num_endereco_cliente'),
					'complemento_endereco' => $this -> input -> post('complemento_cliente')
				);
				
				$this -> db -> insert('endereco', $endereco_insert);
				
				$endereco_fk = $this -> db -> insert_id();
				
				$cliente_insert = array(
					'nome_cliente' => $this -> input -> post('nome_cliente'),
					'cpf_cliente' => $this -> input -> post('cpf_cliente'),
					'ref_comercial' => $this -> input -> post('ref_comercial_cliente'),
					'tel_cliente' => $this -> input -> post('tel_cliente'),
					'endereco_fk' => $endereco_fk
				);
				
				$this -> db -> insert('cliente', $cliente_insert);
				
				$data["cadastro_cliente"] = TRUE;
				
				$this -> my_load_view('clientes', $data);
			}				
		}

	}

	function validaCPF($cpf) {
		// Verifica se o número digitado contém todos os digitos
		$cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
			$this->form_validation->set_message('validaCPF', 'O campo %s é obrigatório.');
			return false;
		} else {// Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}

				$d = ((10 * $d) % 11) % 10;

				if ($cpf{$c} != $d) {
					$this->form_validation->set_message('validaCPF', 'O campo %s é inválido.');
					return false;
				}
			}

			return true;
		}
	}

}
?>