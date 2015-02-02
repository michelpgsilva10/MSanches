<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('balanco_model');
        //$this->load->model('tranferencia_model');
    }

    public function index() {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $this->my_load_view('empresa', NULL);
        } else {
            redirect('login');
        }
    }

    public function balanco() {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $idLista = $this->balanco_model->getExID($this->session->userdata('id'))->id_lista;
            if ($idLista != null) {
                $total = $this->balanco_model->getValor($idLista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                $produtos = $this->balanco_model->getLista($idLista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idLista);
                $this->my_load_view('balanco', $data);
            } else {
                $data = array('total' => 0, 'idlista' => -1);
                $this->my_load_view('balanco', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function novoItem($idlista) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {

            if ($idlista != -1) {

                $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                $produto = $this->usuario_model->getProduto(0, trim($this->input->post('codigoP', TRUE))); // -> Pega o Produto
                $total = $this->balanco_model->getValor(1, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                if (($produto != FALSE) && (trim($this->input->post('quantP', TRUE)) != "")) {//Verifica se o produto Existe
                    $quantidade = $this->balanco_model->verificaItem($produto->id_produto, $idlista, $this->session->userdata('id'));
                    if ($quantidade != FALSE) {// -> verifica se o item já possui na lista
                        $nproduto = array(
                            'quantidade' => $quantidade->quantidade + $this->input->post('quantP', TRUE),
                            'valor_pago' => ($produto->valor_produto) * ($quantidade->quantidade + $this->input->post('quantP', TRUE))
                        );
                        if ($this->balanco_model->updateItem($produto->id_produto, $idlista, $this->session->userdata('id'), $nproduto)) {
                            $total = $this->balanco_model->getValor(1, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                            $produtos = $this->balanco_model->getLista(1, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                            $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagemC' => "Foi Adicionado mais um na Quantidade do item: " . $produto->cod_barra_produto);
                            $this->my_load_view('balanco', $data);
                        } else {
                            $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Erro ao Dar Update no Produto da Lista");
                            $this->my_load_view('balanco', $data);
                        }
                    } else {
                        $nproduto = array(
                            'id_lista' => $idlista,
                            'id_user' => $this->session->userdata('id'),
                            'codbarras' => $produto->cod_barra_produto,
                            'id_produto' => $produto->id_produto,
                            'quantidade' => (int) $this->input->post('quantP', TRUE),
                            'valor_uni' => $produto->valor_produto,
                            'desconto' => (int) $this->input->post('desconto', TRUE),
                            'valor_pago' => ($produto->valor_produto) * (int) trim($this->input->post('quantP', TRUE)),
                            'tipo_lista' => 2
                        );
                        if ($this->balanco_model->setitem($nproduto)) {//->Verifica se deu certo incerir o novo item da lista
                            $total = $this->balanco_model->getValor(1, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                            $produtos = $this->balanco_model->getLista(1, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                            $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => 1, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                            $this->my_load_view('balanco', $data);
                        } else {
                            $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Erro ao Inserir Produto na Lista");
                            $this->my_load_view('balanco', $data);
                        }
                    }
                } else {
                    $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Produto não Encontrado");
                    $this->my_load_view('balanco', $data);
                }
            } else {
                $produto = $this->usuario_model->getProduto(0, $this->input->post('codigoP', TRUE));
                if (($produto != FALSE) && (trim($this->input->post('quantP', TRUE)) != "")) {//->Verifica se Possui o Produto e se foi passada uma quantidade
                    $nproduto = array(
                        'id_lista' => 1,
                        'id_user' => $this->session->userdata('id'),
                        'codbarras' => $produto->cod_barra_produto,
                        'id_produto' => $produto->id_produto,
                        'quantidade' => (int) $this->input->post('quantP', TRUE),
                        'valor_uni' => $produto->valor_produto,
                        'desconto' => (int) $this->input->post('desconto', TRUE),
                        'valor_pago' => ($produto->valor_produto) * (int) trim($this->input->post('quantP', TRUE)),
                        'tipo_lista' => 2
                    );
                    if ($this->balanco_model->setitem($nproduto)) {//->Verifica se deu certo incerir o novo item da lista
                        $total = $this->balanco_model->getValor(1, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                        $produtos = $this->balanco_model->getLista(1, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => 1, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                        $this->my_load_view('balanco', $data);
                    } else {
                        $data = array('total' => 0, 'idlista' => $idlista, 'mensagem' => "Erro ao Inserir Produto na Lista");
                        $this->my_load_view('balanco', $data);
                    }
                } else {
                    $data = array('total' => 0, 'idlista' => $idlista, 'mensagem' => "Produto não Encontrado");
                    $this->my_load_view('balanco', $data);
                }
            }
        } else {
            redirect('login');
        }
    }

    public function deletaItem($idProduto, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {

            if ($this->balanco_model->deleteItem($idProduto, $idlista, $this->session->userdata('id'))) {
                $produto = $this->usuario_model->getProduto($idProduto, 0); // -> Pega o Produto
                $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagemC' => "Foi Deletado o item: " . $produto->cod_barra_produto);
                $this->my_load_view('balanco', $data);
            } else {
                $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Erro ao Deletar o produto");
                $this->my_load_view('balanco', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function visualizaI($idProduto, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {

            if ($idProduto != -1) {
                $produto = $this->usuario_model->getFoto(trim($idProduto));
                $data = array('tipo' => 4, 'produto' => $produto, 'idlista' => $idlista);
                $this->my_load_view('vendaVerProduto', $data);
            } else {
                $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista);
                $this->my_load_view('balanco', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function finalizaBalancao($idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($idlista != -1) {
                $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                if ($total != FALSE) {
                    $this->load->model('usuario_model');
                    $verifica = -1;
                    $idVenda = $this->usuario_model->setVenda($this->session->userdata('nivel'), $total, 4);
                    $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                    $lojas = $this->usuario_model->getLoja();
                    for ($i = 0; $i < count($produtos); $i++) {
                        $produto = $this->balanco_model->getProduto($this->session->userdata('nivel'), $produtos[$i]['id_produto']);
                        if ($produto == FALSE) {
                            for ($j = 0; $j < count($lojas); $j++) {
                                if ($this->session->userdata('nivel') == $lojas[$j]['id_loja']) {
                                    $data = array(
                                        'quantidade' => $produtos[$i]['quantidade'],
                                        'loja_fk' => $lojas[$j]['id_loja'],
                                        'produto_fk' =>  $produtos[$i]['id_produto']
                                    );
                                } else {
                                    $data = array(
                                        'quantidade' => 0,
                                        'loja_fk' => $lojas[$j]['id_loja'],
                                        'produto_fk' =>  $produtos[$i]['id_produto']
                                    );
                                }
                                if (!$this->balanco_model->setitemnovo($data)) {
                                    $verifica = 1;
                                    break;
                                }
                            }
                            if($verifica==1){
                                break;   
                            }else {
                                    $this->usuario_model->setCompra($this->session->userdata('nivel'), $produtos[$i]['quantidade'], $produtos[$i]['id_produto'], $idVenda, $produtos[$i]['desconto']);
                                    if ($this->balanco_model->deleteItem($produtos[$i]['id_produto'], $idlista, $this->session->userdata('id'))==0) {
                                        $verifica = 3;
                                        break;
                                    }
                                }
                        } else {
                            $data = array(
                                'quantidade' => $produtos[$i]['quantidade'] + $produto->quantidade
                            );
                            if (!$this->balanco_model->updateItemnovo($produtos[$i]['id_produto'], $this->session->userdata('nivel'), $data)) {
                                $verifica = 2;
                                break;
                            } else {
                                $this->usuario_model->setCompra($this->session->userdata('nivel'), $produtos[$i]['quantidade'], $produtos[$i]['id_produto'], $idVenda, $produtos[$i]['desconto']);
                                if (!$this->balanco_model->deleteItem($produtos[$i]['id_produto'], $idlista, $this->session->userdata('id'))) {
                                    $verifica = 3;
                                }
                            }
                        }
                    }
                    if ($verifica == -1) {
                     $data = array('mensagemC' => "Todos os Produtos Foram Adicionados no Estoque");
                     $this->my_load_view('principal', $data);
                     
                    } else if ($verifica == 1) {
                        $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                        $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'menssagen' => "Erro ao inserir novo item na loja");
                        $this->my_load_view('balanco', $data);
                    } else if ($verifica == 2) {
                        $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                        $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'menssagen' => "Erro ao fazer Update do item na loja");
                        $this->my_load_view('balanco', $data);
                    } else if ($verifica == 3) {
                        $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                        $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Erro ao Deletar o produto");
                        $this->my_load_view('balanco', $data);
                    } else {
                        $produtos = $this->balanco_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                        $total = $this->balanco_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'menssagen' => "Erro ao Efetuar a verificação");
                        $this->my_load_view('balanco', $data);
                    }
                } else {
                    $data = array('total' => 0, 'idlista' => -1, 'menssagen' => "Nem um Produto Selecionado");
                    $this->my_load_view('balanco', $data);
                }
            } else {
                $data = array('total' => 0, 'idlista' => -1, 'menssagen' => "Nem um Produto Selecionado");
                $this->my_load_view('balanco', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function sair() {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            redirect('home');
        } else {
            redirect('login');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */