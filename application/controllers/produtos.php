<?php

class Produtos extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {//----------------------------------OK
        $this->load->library('pagination');
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $todos = $this->usuario_model->getProdutos(0, 0);
            $QItens = $this->usuario_model->getQantidade(0)->id;
            $ultima = $QItens % 42;
            if ($ultima == 0) {
                $ultima = $QItens / 42;
            } else {
                $ultima = (int) (($QItens / 42));
            }
            $data = array('todos' => $todos,
                'pagina' => 0,
                'tipo' => 0,
                'QItens' => $QItens,
                'proximo' => 1,
                'caminho' => "produtos/pagina/0",
                'anterior' => -1,
                'ultima' => $ultima,
                'detalhe' => 0,
                'vmaior' => 0,
                'vmenor' => 0);
            $this->my_load_view('produtos', $data);
        } else {
            redirect('login');
        }
    }

    public function pagina($inicio = 0, $tipo = 0, $maior = 0, $menor = 0, $quali = 0) {//------------------------Ok
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $QItens = $this->usuario_model->getQantidade($tipo, $menor, $maior, $quali)->id;
            $todos = $this->usuario_model->getProdutos($inicio * 42, $tipo, $quali, $menor, $maior);
            $ultima = $QItens % 42;
            if ($ultima == 0) {
                $ultima = ($QItens / 42) - 1;
            } else {
                $ultima = (int) (($QItens / 42));
            }
            if ($inicio > 0) {
                $data = array('todos' => $todos,
                    'anterior' => 1,
                    'proximo' => $inicio + 1,
                    'QItens' => $QItens,
                    'tipo' => $tipo,
                    'caminho' => "produtos/pagina/0",
                    'anterior' => $inicio - 1,
                    'ultima' => $ultima,
                    'detalhe' => $quali,
                    'vmaior' => $maior,
                    'vmenor' => $menor);
            } else {
                $data = array('todos' => $todos,
                    'tipo' => $tipo,
                    'proximo' => $inicio + 1,
                    'QItens' => $QItens,
                    'caminho' => "produtos/pagina/0",
                    'anterior' => $inicio - 1,
                    'ultima' => $ultima,
                    'detalhe' => $quali,
                    'vmaior' => $maior,
                    'vmenor' => $menor);
            }
            $this->my_load_view('produtos', $data);
        } else {
            redirect('login');
        }
    }

    public function Deletar($foto, $id, $code) {//----------------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $todos = $this->usuario_model->logs($this->session->userdata('id'), 4, $code);
            $this->usuario_model->deletarProduto($id);
            redirect('produtos');
        } else {
            redirect('login');
        }
    }

    public function alterar($id) {//----------------------OK 
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($this->input->post('valor', TRUE)) {
                $tipo = $this->input->post('tipo', TRUE);
                $produto = $this->usuario_model->getBusca(trim($id), 0);
                if ($tipo == "") {
                    $data = array('produto' => $produto);
                    $this->my_load_view('alterarProduto.php', $data);
                } else {
                    if ($tipo != $produto->tipo_produto) {
                        $modelos = $this->usuario_model->getQProduto($tipo);
                        $aux = 0;
                        $verifica = -1;
                        for ($i = 0; $i < count($modelos); $i++) {
                            $aux++;
                            if ($modelos[$i]['modelo_produto'] != $aux) {
                                $model = $aux;
                                $verifica = 0;
                                break;
                            }
                        }
                        if ($verifica == -1) {
                            $model = $aux + 1;
                        }
                        if ($model < 10) {
                            $model = "000" . $model;
                        } else if ($model < 100) {
                            $model = "00" . $model;
                        } else if ($model < 1000) {
                            $model = "0" . $model;
                        } else if ($model > 10000) {
                            $data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
                            $this->my_load_view('alterarProduto', $data);
                        }
                    } else {
                        $model = $produto->modelo_produto;
                        if ($model < 10) {
                            $model = "000" . $model;
                        } else if ($model < 100) {
                            $model = "00" . $model;
                        } else if ($model < 1000) {
                            $model = "0" . $model;
                        } else if ($model > 10000) {
                            $data = array('foto' => TRUE, '$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
                            $this->my_load_view('alterarProduto', $data);
                        }
                    }
                    $valor = $this->input->post('valor', TRUE);
                    if ($valor < 10) {
                        $valor = "000" . $valor;
                    } else if ($valor < 100) {
                        $valor = "00" . $valor;
                    } else if ($valor < 1000) {
                        $valor = "0" . $valor;
                    } else if ($valor > 10000) {
                        $data = array('foto' => TRUE, '$mensagem' => "Valor Superior que 10.000");
                        $this->my_load_view('novoProduto', $data);
                    }
                    $code = $tipo . $model . $valor;
                    $nome = $produto->foto_produto;
                    $detalhe = $this->input->post('detalhe', TRUE);
                    $lojas = $this->usuario_model->getLoja();
                    for ($i = 0; $i < count($lojas); $i++) {
                        if ($this->session->userdata('nivel') == $lojas[$i]['id_loja']) {
                            $data = array(
                                'quantidade' => $this->input->post('quant'.$lojas[$i]['id_loja'], TRUE),
                            );
                        } else {
                            $data = array(
                                'quantidade' => $this->input->post('quant'.$lojas[$i]['id_loja'], TRUE),
                            );
                        }
                        $this->usuario_model->updateItemnovo($id,$lojas[$i]['id_loja'],$data);
                    }
                    $todos = $this->usuario_model->logs($this->session->userdata('id'), 3, $code);
                    $this->usuario_model->updateProduto($id, $tipo, $valor, $model, $nome, $code, $detalhe);
                    redirect('produtos/perEtiqueta/' . $code);
                }
            } else {
                $produto = $this->usuario_model->getBusca(trim($id), 0);
                $loja = $this->session->userdata('nivel');
                $QProduto = $this->usuario_model->getQuantidadeProduto($produto->id_produto);
                $lojas = $this->usuario_model->getLoja();
                $data = array('produto' => $produto, 'quantidade' => $QProduto, 'lojas' => $lojas, 'loja' => $loja);
                $this->my_load_view('alterarProduto.php', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function busca2($code, $tipo = 0) {///------------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($tipo == 0) {
                $produto = $this->usuario_model->getBusca(trim($code), 0);
            } else {
                $produto = $this->usuario_model->getBusca(0, trim($code));
            }
            $loja = $this->session->userdata('nivel');
            $QProduto = $this->usuario_model->getQuantidadeProduto($produto->id_produto);
            $lojas = $this->usuario_model->getLoja();
            $data = array('produto' => $produto, 'quantidade' => $QProduto, 'lojas' => $lojas, 'loja' => $loja);
            $this->my_load_view('resultBusca.php', $data);
        } else {
            redirect('login');
        }
    }

    public function busca() {//-----------------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($this->input->post('codigo', TRUE) != "") {
                $cod = $this->input->post('codigo', TRUE);
                $produto = $this->usuario_model->getBusca(0, trim($cod));
                if ($produto != FALSE) {
                    $QProduto = $this->usuario_model->getQuantidadeProduto($produto->id_produto);
                    $loja = $this->session->userdata('nivel');
                    $lojas = $this->usuario_model->getLoja();
                    $data = array('produto' => $produto, 'quantidade' => $QProduto, 'lojas' => $lojas, 'loja' => $loja);
                    $this->my_load_view('resultBusca.php', $data);
                } else {
                    $data = array('mensagem' => "Produto não encontrado");
                    $this->my_load_view('buscaProduto.php', $data);
                }
            } else {
                $this->my_load_view('buscaProduto', NULL);
            }
        } else {
            redirect('login');
        }
    }

    public function novo() {///----------------------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($this->input->post('valor', TRUE)) {
                $data = array('mensagem' => " A Foto não Foi Selecionada");
                $this->my_load_view('novoProduto', $data);
            } else {
            	$lojas = $this->usuario_model->getLoja();
				$data = array('lojas' => $lojas,'loja'=>$this->session->userdata('nivel'));
                $this->my_load_view('novoProduto', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function etiquetas() {///--------------------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $this->my_load_view('etiquetas', NULL);
        } else {
            redirect('login');
        }
    }

    public function estoque() {//A Arrumar
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            /*$data = array('brinco' => $this->usuario_model->getQantidade(3)->id,
                'anel' => $this->usuario_model->getQantidade(1)->id,
                'colar' => $this->usuario_model->getQantidade(4)->id,
                'pulceira' => $this->usuario_model->getQantidade(6)->id,
                'bracelete' => $this->usuario_model->getQantidade(2)->id,
                'conjunto' => $this->usuario_model->getQantidade(5)->id,
                'tornozeleira' => $this->usuario_model->getQantidade(7)->id,
                'brinco2' => $this->usuario_model->getQantidadeItem(3, $this->session->userdata('nivel'))->total,
                'anel2' => $this->usuario_model->getQantidadeItem(1, $this->session->userdata('nivel'))->total,
                'colar2' => $this->usuario_model->getQantidadeItem(4, $this->session->userdata('nivel'))->total,
                'pulceira2' => $this->usuario_model->getQantidadeItem(6, $this->session->userdata('nivel'))->total,
                'bracelete2' => $this->usuario_model->getQantidadeItem(2, $this->session->userdata('nivel'))->total,
                'conjunto2' => $this->usuario_model->getQantidadeItem(5, $this->session->userdata('nivel'))->total,
                'tornozeleira2' => $this->usuario_model->getQantidadeItem(7, $this->session->userdata('nivel'))->total,
				'lojas' => $this->usuario_model->getLoja()); */
				
			$data["quantidade_item"] = $this -> usuario_model -> getQuantidadeItem2($this -> session -> userdata('nivel'));
			$data["quantidade_modelo"] = $this -> usuario_model -> getQuantidade2($this -> session -> userdata('nivel'));
			$data["total_produto"] = $this -> usuario_model -> getTotalProdutos($this -> session -> userdata('nivel')) -> quantidade;
			$data["total_modelo"] = $this -> usuario_model -> getTotalModelos($this -> session -> userdata('nivel'));
            $this->my_load_view('estoque', $data);
        } else {
            redirect('login');
        }
    }

    public function uloadFA() {//---------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $produto = $this->usuario_model->getBusca($this->input->post('id', TRUE), 0);
            $config['upload_path'] = "C:/Users/kaue/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/";
            $config['file_name'] = $produto->foto_produto;
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = '2048';
            $this->load->library('upload', $config);
            if (file_exists("C:/Users/kaue/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $produto->foto_produto)) {
                unlink("C:/Users/kaue/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $produto->foto_produto);
            }
            if (!$this->upload->do_upload("fileF")) {
                $data = array('id' => $this->input->post('id', TRUE),'mensagem' => $this->upload->display_errors());
                $this->my_load_view('alteraFoto', $data);
            } else {
                $this->usuario_model->logs($this->session->userdata('id'), 2);
                redirect('produtos/alterar/' . $this->input->post('id', TRUE));
            }
        } else {
            redirect('login');
        }
    }

    public function perEtiqueta($code) {//---------------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $data = array('code' => $code);
            $this->my_load_view('etiqueta', $data);
        } else {
            redirect('login');
        }
    }

    public function alteraFoto($id) {///-----------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $data = array('id' => $id);
            $this->my_load_view('alteraFoto', $data);
        } else {
            redirect('login');
        }
    }

    public function novaFoto() {//-----------------Ok
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $this->my_load_view('selFoto', NULL);
        } else {
            redirect('login');
        }
    }

    public function novo2($nome) {//-------------------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($this->input->post('valor', TRUE)) {
                $tipo = $this->input->post('tipo', TRUE);
                if ($tipo == "") {
                    $data = array('foto' => TRUE, '$mensagem' => "Tipo não Selecionado");
                    $this->my_load_view('novoProduto', $data);
                } else {
                    $modelos = $this->usuario_model->getQProduto($tipo);
                    $aux = 0;
                    $verifica = -1;
                    for ($i = 0; $i < count($modelos); $i++) {
                        $aux++;
                        if ($modelos[$i]['modelo_produto'] != $aux) {
                            $id = $aux;
                            $verifica = 0;
                            break;
                        }
                    }
                    if ($verifica == -1) {
                        $id = $aux + 1;
                    }
                    $valor = $this->input->post('valor', TRUE);
                    $quantidade = $this->input->post('quant', TRUE);
                    if ($id < 10) {
                        $id = "000" . $id;
                    } else if ($id < 100) {
                        $id = "00" . $id;
                    } else if ($id < 1000) {
                        $id = "0" . $id;
                    } else if ($id > 10000) {
                    	$lojas = $this->usuario_model->getLoja();
                        $data = array('foto' => TRUE, 'lojas' => $lojas,'$mensagem' => "Estouro de Tipo - Fale com o Tecnico");
                        $this->my_load_view('novoProduto', $data);
                    }
                    if ($valor < 10) {
                        $valor = "000" . $valor;
                    } else if ($valor < 100) {
                        $valor = "00" . $valor;
                    } else if ($valor < 1000) {
                        $valor = "0" . $valor;
                    } else if ($valor > 10000) {
                    	$lojas = $this->usuario_model->getLoja();
                        $data = array('foto' => TRUE,'lojas' => $lojas,'$mensagem' => "Valor Superior que 10.000");
                        $this->my_load_view('novoProduto', $data);
                    }

                    $code = $tipo . $id . $valor;
                    $detalhe = $this->input->post('detalhe', TRUE);
                    $this->usuario_model->logs($this->session->userdata('id'), 1, $code);
                    $idproduto = $this->usuario_model->setProduto($tipo, $valor, $id, $nome, $code, $detalhe);
                    $lojas = $this->usuario_model->getLoja();
                    for ($i = 0; $i < count($lojas); $i++) {
                            $data = array(
                                'quantidade' => $this->input->post('quant'.$lojas[$i]['id_loja'], TRUE),
                                'loja_fk' => $lojas[$i]['id_loja'],
                                'produto_fk' => $idproduto
                            );
                        $this->usuario_model->setitemnovo($data);
                    }
                    redirect('produtos/perEtiqueta/' . $code);
                }
            } else {
            	$lojas = $this->usuario_model->getLoja();
                $data = array('foto' => TRUE,'lojas' => $lojas,'loja'=>$this->session->userdata('nivel'),'nome' => $nome);
                $this->my_load_view('novoProduto', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function uloadF() {//-------OK
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $code = $this->usuario_model->getID();
            if ($code == FALSE) {
                $id = 1;
            } else {
                $id = $code->id_produto + 1;
            }
            if ($id < 10) {
                $id = "000" . $id;
            } else if ($id < 100) {
                $id = "00" . $id;
            } else if ($id < 1000) {
                $id = "0" . $id;
            }
            $nome = $id . ".jpg";
            $config['upload_path'] = "C:/Users/kaue/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto";
            $config['file_name'] = $nome;
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);
            if (file_exists("C:/Users/kaue/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome)) {
                unlink("C:/Users/kaue/Dropbox/Projetos Trabalho/MSanches/css/img/img_produto/" . $nome);
            }
            if (!$this->upload->do_upload("fileF")) {
                $data = array('mensagem' => $this->upload->display_errors());
                $this->my_load_view('selFoto', $data);
            } else {
                $this->usuario_model->logs($this->session->userdata('id'), 2);
                redirect('produtos/novo2/' . $nome);
            }
        } else {
            redirect('login');
        }
    }

}

?>