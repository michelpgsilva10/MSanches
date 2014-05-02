<?php
class Login extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('form_validation');
		$this->load->library('session');
	}

	public function index() {
		$this -> form_validation -> set_rules('login', 'Login', 'required|xss_clean');
		$this -> form_validation -> set_rules('password', 'Senha', 'required|xss_clean');
		if ($this -> form_validation -> run() == FALSE) {
			$this -> form_validation -> set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>');
			$this -> my_load_view('login', NULL);
		} else {
			$email = $this -> input -> post('login', TRUE);
			$senha = $this -> input -> post('password', TRUE);
			$senha = do_hash($senha, 'md5');
			$aux = $this -> usuario_model -> login($email, $senha);
			if ($aux != FALSE) {
				$datestring = "%m%d";
				$time = time();
				$load= mdate($datestring, $time).do_hash("MSanches", 'md5');
				$result = array('nome' => $aux ->NOME_USER, 'id' => $aux ->ID_USER, 'nivel' => $aux ->NIVEL_USER);
				$this -> session -> set_userdata('load', $load);
				$this -> session -> set_userdata($result);
				redirect('home');
			} else {
				$data["mensagem"] = "Senha ou Email Incorretos, Tente Novamente";
				$this -> my_load_view('login', $data);
			}
		}
	}

	public function sair() {
		$this -> session -> sess_destroy();
		redirect('login');
	}

}
?>