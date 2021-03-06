<?php
class Cliente extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this->load->library('form_validation');	
		$this->load->library('fpdf'); // Load library
		//define('FPDF_FONTPATH','/application/libraries/font/');
    	//$this->fpdf->fontpath = 'application/libraries/font/';
	}

	public function index() {//-----OK
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$data["cadastro_cliente"] = false;
			$data["clientes"] = $this -> usuario_model -> getClientes(0,$this -> session -> userdata('nivel'));
			$this -> my_load_view('clientes', $data);
		} else {
			redirect('login');
		}
	}
	
	public function novoCliente() {//-----OK
		$datestring = "%m%d";
		$time = time();
		$load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
		if ($this -> session -> userdata('load') == $load) {
			$this -> my_load_view('novoCliente', NULL);
		} else {
			redirect('login');
		}
	}

	public function adicionar() {//----OK
		#Validação para tabela Cliente
		$this -> form_validation -> set_rules('nome_cliente', 'Nome', 'required');
		$this -> form_validation -> set_rules('cpf_cliente', 'CPF', 'callback_validaCPF|callback_cpfExistente');
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
		$this->form_validation->set_message('validaCPF', 'O %s digitado não é válido!');
		$this->form_validation->set_message('cpfExistente', 'O %s digitado já foi cadastrado!');;
				
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
					'endereco_fk' => $endereco_fk,
                                        'loja_fk' => $this->session->userdata('nivel')
				);
				
				$this -> db -> insert('cliente', $cliente_insert);
				
				$data["cadastro_cliente"] = TRUE;
				$data["clientes"] = $this -> usuario_model -> getClientes(0, $this -> session -> userdata('nivel'));
				
				$this -> my_load_view('clientes', $data);
			}				
		}

	}

	function editar() {//--------OK
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
		$this->form_validation->set_message('validaCPF', 'O %s digitado não é válido!');
		$this->form_validation->set_message('cpfExistente', 'O %s digitado já foi cadastrado!');;
				
		$this->form_validation->set_error_delimiters('<div class="alert-danger alert-dismissable alert-space">', '</div>');
		
		if ($this->input->post('editar_cliente')) {
			if ($this->form_validation->run() == FALSE) {
				$this -> my_load_view('editarCliente', NULL);				
			} else {
				$endereco_update = array (
					'rua_endereco' => $this -> input -> post('rua_cliente'),
					'cidade_endereco' => $this -> input -> post('cidade_cliente'),
					'uf_endereco' => $this -> input -> post('uf_cliente'),
					'bairro_endereco' => $this -> input -> post('bairro_cliente'),
					'numero_endereco' => $this -> input -> post('num_endereco_cliente'),
					'complemento_endereco' => $this -> input -> post('complemento_cliente')
				);
				
				$this -> db -> where('id_endereco', $this -> input -> post('id_endereco'));
				$this -> db -> update('endereco', $endereco_update);
				
				$cliente_update = array(
					'nome_cliente' => $this -> input -> post('nome_cliente'),
					'cpf_cliente' => $this -> input -> post('cpf_cliente'),
					'ref_comercial' => $this -> input -> post('ref_comercial_cliente'),
					'tel_cliente' => $this -> input -> post('tel_cliente')
				);
				
				$this -> db -> where('id_cliente', $this -> input -> post('id_cliente'));
				$this -> db -> update('cliente', $cliente_update);
				
				redirect('cliente/infoCliente/' . $this -> input -> post('id_cliente') . '/1');
			}				
		}
	}

	function gerarPDF($id_venda) {
		$data["vendas"] = $this -> usuario_model -> getVendaConsig($id_venda);
		$this -> load -> view('romaneio', $data);
	}
	
	function gerarPDFInicio($id_venda) {
		$data["vendas"] = $this -> usuario_model -> getVendaConsig($id_venda);
		$this -> load -> view('romaneio-inicio', $data);
	}
	
	function gerarPDFVolta($id_venda_consig) {
		$venda_consig = $this -> usuario_model -> getIdVendasConsig($id_venda_consig);
	
		$data["vendas"] = $this -> usuario_model -> getVendaConsigTipo($venda_consig -> id_venda_inicio, 1);
		$data["vendas_retorno"] = $this -> usuario_model -> getVendaConsigTipo($venda_consig -> id_venda_retorno, 2);
		
		$this -> load -> view('romaneio-volta', $data);
	}
	
	function buscarCliente() {		
		
		$opt = $this -> input -> post('opcao_pesquisa_cliente');
		$this -> form_validation -> set_rules('opcao_pesquisa_cliente', 'Tipo de Pesquisa', '');
		
		if ($opt == 1) {
			$this -> form_validation -> set_rules('pesquisa_cliente', 'CPF', 'callback_validaCPF');
			$this -> form_validation -> set_message('validaCPF', 'O %s digitado é inválido.');
		} else {
			$this -> form_validation -> set_rules('pesquisa_cliente', 'Nome', 'required');
			$this -> form_validation -> set_message('required', 'Você deve digitar um %s.');
		}
		
		$this->form_validation->set_error_delimiters('<div class="alert-danger alert-dismissable alert-space " >', '</div>');
		
		if ($this -> input -> post('btn_pesquisa_cliente')) {
			$data["cadastro_cliente"] = false;
			if ($this -> form_validation -> run()) {
				$data["clientes"] = $this -> usuario_model -> getCliente($this -> input -> post('pesquisa_cliente'), $opt, $this -> session -> userdata('nivel'));
				$this -> my_load_view('clientes', $data);				
			} else {
				$data["cadastro_cliente"] = false;
				$data["clientes"] = NULL;
				$this -> my_load_view('clientes', $data);
			}		
		}
	}

	function detalhesCompra($id_venda, $tipo_compra) {
		$data["detalhes_compra"] = $this -> usuario_model -> getCompraDetalhes($id_venda, $tipo_compra);
		$this -> my_load_view('detalhesCompra', $data);
	}

	function comprasCliente($id_cliente) {
		$data["compras"] = $this -> usuario_model -> getComprasCliente($id_cliente);
		$data["cliente"] = $this -> usuario_model -> getCliente($id_cliente, 0, $this -> session -> userdata('nivel'));
		
		$this -> my_load_view('comprasCliente', $data);
	}

	function editarCliente($id_cliente) {
		$data["cliente"] = $this -> usuario_model -> getCliente($id_cliente, 0, $this -> session -> userdata('nivel'));
		$this -> my_load_view('editarCliente', $data);
	}

	function infoCliente($id_cliente, $edicao_cliente) {
		$data["cliente"] = $this -> usuario_model -> getCliente($id_cliente, 0, $this -> session -> userdata('nivel'));
		
		if ($edicao_cliente == 1)
			$data["atualizar_cliente"] = true;
		else
			$data["atualizar_cliente"] = false;
		
		$this -> my_load_view('infoCliente', $data);	
	}

	function validaCPF($cpf) {
		// Verifica se o número digitado contém todos os digitos
		$cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		$cpf = str_replace('.', '', $cpf);
		$cpf = str_replace('-', '', $cpf);
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
			return false;
		} else {// Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}

				$d = ((10 * $d) % 11) % 10;

				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}

	function cpfExistente($cpf) {
		$retorno = $this -> usuario_model -> getCpf($cpf);
		if ($retorno) {
			return false;
		}
		
		return true;
	}
	
	function fotosProdutos() {
		$this -> load -> view('fotosProdutos', NULL);
	}

}
?>