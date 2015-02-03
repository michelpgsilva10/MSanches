<?php

class Venda extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('venda_model');
    }

    public function index() {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $this->my_load_view('venda', NULL);
        } else {
            redirect('login');
        }
    }

    public function criaRomaneio($idvenda, $tipo = 0) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($tipo == 1) {
                $data = array('romaneio' => $idvenda, 'consig' => TRUE);
            } else {
                $data = array('romaneio' => $idvenda, 'tipo' => $tipo);
            }
            $this->my_load_view('venda', $data);
        } else {
            redirect('login');
        }
    }

    public function comum($desconto = 0) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $idLista = $this->venda_model->getExID($this->session->userdata('id'))->id_lista;
            if ($idLista != null) {
                $produtos = $this->venda_model->getLista($idLista, $this->session->userdata('id'));
                $total = $this->venda_model->getValor($idLista, $this->session->userdata('id'))->valor_pago;
                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idLista, 'desconto' => $desconto);
            } else {
                $data = array('total' => 0, 'desconto' => 0);
            }
            //print_r($data);
            $this->my_load_view('vendaComum', $data);
        } else {
            redirect('login');
        }
    }

    public function consignado() {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $vendas1 = $this->usuario_model->getVendaC();
            if ($vendas1 != NULL) {
                for ($i = 0; $i < count($vendas1); $i++) {
                    $venda = $this->usuario_model->getVenda($vendas1[$i]['id_venda_inicio']);
                    $cliente = $this->usuario_model->getCliente($venda->cliente_fk, 0,$this->session->userdata('nivel'));
                    if($cliente!=NULL){
                        $data1 = explode(" ", $venda->data_venda);
                        $data1 = explode("-", $data1[0]);
                        $data = "" . $data1[2];
                        $data = $data . "-" . $data1[1];
                        $data = $data . "-" . $data1[0];
                        $venda->data_venda = $data;
                        $venda->cliente_fk = $cliente[0]['nome_cliente'];
                        $vendas[] = $venda;
                    }
                }
                $data = array('vendas' => $vendas);
                $this->my_load_view('consignado', $data);
            } else {
                $this->my_load_view('consignado', NULL);
            }
        } else {
            redirect('login');
        }
    }

    public function novoitem($total = 0, $tipo = 0, $id = -1, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($id != -1) {
                $cliente = $this->usuario_model->getCliente($id, 0,$this->session->userdata('nivel'));
            }
            if ($idlista != -1) {//->Verifica se possui lista
                $desc = (int) $this->input->post('desconto', TRUE);
                $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                $produto = $this->usuario_model->getProduto(0, trim($this->input->post('codigoP', TRUE)), 0, $this->session->userdata('nivel')); // -> Pega o Produto
                if (($produto != FALSE) && (trim($this->input->post('quantP', TRUE)) != "")) {//Verifica se o produto Existe
                    $testeE = 0; // Flag de Erro
                    $quantidade = $this->venda_model->verificaItem($produto->id_produto, $idlista, $this->session->userdata('id'));
                    if ($quantidade != FALSE) {// -> verifica se o item já possui na lista
                        if (($this->input->post('quantP', TRUE) + $quantidade->quantidade) <= $produto->estoque_produto) {// -> Verifica se a quantidade já cadastrada mais a quantidade enviada possui no banco
                            $desconto = $produto->valor_produto * ( (int) $this->input->post('desconto', TRUE) / 100);
                            $nproduto = array(
                                'quantidade' => $quantidade->quantidade + $this->input->post('quantP', TRUE),
                                'desconto' => (int) $this->input->post('desconto', TRUE),
                                'valor_pago' => ($produto->valor_produto - $desconto) * ($quantidade->quantidade + $this->input->post('quantP', TRUE))
                            );
                            if ($this->venda_model->updateItem($produto->id_produto, $idlista, $this->session->userdata('id'), $nproduto)) {
                                $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id')); // -> Atualiza a lista produtos
                                $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                                $testeE = 1;
                            } else {
                                $testeE = 3;
                            }
                            $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago							
                        } else {
                            $testeE = 2;
                        }
                    }
                    if ($testeE == 0) {// -> Verifica se Foi encontrado Algum Item
                        if ($this->input->post('quantP', TRUE) <= $produto->estoque_produto) {
                            $desconto = $produto->valor_produto * ((int) $this->input->post('desconto', TRUE) / 100);
                            $nproduto = array(
                                'id_lista' => 1,
                                'id_user' => $this->session->userdata('id'),
                                'codbarras' => $produto->cod_barra_produto,
                                'id_produto' => $produto->id_produto,
                                'quantidade' => (int) $this->input->post('quantP', TRUE),
                                'valor_uni' => $produto->valor_produto,
                                'desconto' => (int) $this->input->post('desconto', TRUE),
                                'valor_pago' => ($produto->valor_produto - $desconto) * (int) trim($this->input->post('quantP', TRUE))
                            );
                            if ($this->venda_model->setitem($nproduto)) {//->Verifica se deu certo incerir o novo item da lista
                                $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id')); // -> Atualiza a lista produtos
                                $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                                //print_r($produtos);
                                if ($tipo == 0) {
                                    if ($id != -1) {
                                        $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                        $this->my_load_view('vendaComum', $data);
                                    } else {
                                        $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                        $this->my_load_view('vendaComum', $data);
                                    }
                                } else {
                                    if ($id != -1) {
                                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'cliente' => $cliente, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                        $this->my_load_view('vendaConsig', $data);
                                    } else {
                                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                        $this->my_load_view('vendaConsig', $data);
                                    }
                                }
                            } else {
                                if ($tipo == 0) {
                                    if ($id != -1) {
                                        $data = array('total' => $total, 'desconto' => $desc, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                        $this->my_load_view('vendaComum', $data);
                                    } else {
                                        $data = array('total' => $total, 'desconto' => $desc, 'idlista' => $idlista, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                        $this->my_load_view('vendaComum', $data);
                                    }
                                } else {
                                    if ($id != -1) {
                                        $data = array('total' => $total, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                        $this->my_load_view('vendaConsig', $data);
                                    } else {
                                        $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                        $this->my_load_view('vendaConsig', $data);
                                    }
                                }
                            }
                        } else {//Quando a quantidade pedida passa a quantidade existente
                            if ($tipo == 0) {
                                if ($id != -1) {
                                    $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                    $this->my_load_view('vendaComum', $data);
                                } else {
                                    $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                    $this->my_load_view('vendaComum', $data);
                                }
                            } else {
                                if ($id != -1) {
                                    $data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                    $this->my_load_view('vendaConsig', $data);
                                } else {
                                    $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                    $this->my_load_view('vendaConsig', $data);
                                }
                            }
                        }
                    } else if ($testeE == 2) {// -> Verifica se deu Erro na quantidade Existente do Produto
                        if ($tipo == 0) {
                            if ($id != -1) {
                                $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaComum', $data);
                            } else {
                                $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaComum', $data);
                            }
                        } else {
                            if ($id != -1) {
                                $data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaConsig', $data);
                            } else {
                                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaConsig', $data);
                            }
                        }
                    } else if ($testeE == 3) {// -> Verifica se deu Erro no Update da lista
                        if ($tipo == 0) {
                            if ($id != -1) {
                                $data = array('total' => $total, 'desconto' => $desc, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Erro ao Dar Update no Produto da Lista");
                                $this->my_load_view('vendaComum', $data);
                            } else {
                                $data = array('total' => $total, 'desconto' => $desc, 'idlista' => $idlista, 'mensagem' => "Erro ao Dar Update no Produto da Lista");
                                $this->my_load_view('vendaComum', $data);
                            }
                        } else {
                            if ($id != -1) {
                                $data = array('total' => $total, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Erro ao Dar Update no Produto da Lista");
                                $this->my_load_view('vendaConsig', $data);
                            } else {
                                $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Erro ao Dar Update no Produto da Lista");
                                $this->my_load_view('vendaConsig', $data);
                            }
                        }
                    } else {// Quando deu Certo ao dar Update na Lista
                        if ($tipo == 0) {
                            if ($id != -1) {
                                $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagemC' => "Foi Adicionado mais um na Quantidade do item: " . $produto->cod_barra_produto);
                                $this->my_load_view('vendaComum', $data);
                            } else {
                                $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagemC' => "Foi Adicionado mais um na Quantidade do item: " . $produto->cod_barra_produto);
                                $this->my_load_view('vendaComum', $data);
                            }
                        } else {
                            if ($id != -1) {
                                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'cliente' => $cliente, 'mensagemC' => "Foi Adicionado mais um na Quantidade do item: " . $produto->cod_barra_produto);
                                $this->my_load_view('vendaConsig', $data);
                            } else {
                                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagemC' => "Foi Adicionado mais um na Quantidade do item: " . $produto->cod_barra_produto);
                                $this->my_load_view('vendaConsig', $data);
                            }
                        }
                    }
                } else {//Quando o Produto nao é encontrado ou a quantidade solicitada é =0
                    if ($tipo == 0) {
                        if ($id != -1) {
                            $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => $idlista, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaComum', $data);
                        } else {
                            $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaComum', $data);
                        }
                    } else {
                        if ($id != -1) {
                            $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaConsig', $data);
                        } else {
                            $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaConsig', $data);
                        }
                    }
                }
            } else {// -> Quando a Lista não foi Criada
                $desc = (int) $this->input->post('desconto', TRUE);
                $produto = $this->usuario_model->getProduto(0, trim($this->input->post('codigoP', TRUE)), 0, $this->session->userdata('nivel'));
                if (($produto != FALSE) && (trim($this->input->post('quantP', TRUE)) != "")) {//->Verifica se Possui o Produto e se foi passada uma quantidade
                    if ($this->input->post('quantP', TRUE) <= $produto->estoque_produto) {// -> Verifica se a quantidade passada é menor ou igual a que tem no estoque
                        $desconto = $produto->valor_produto * ((int) $this->input->post('desconto', TRUE) / 100); //->Calcula o desconto	
                        $nproduto = array(
                            'id_lista' => 1,
                            'id_user' => $this->session->userdata('id'),
                            'codbarras' => $produto->cod_barra_produto,
                            'id_produto' => $produto->id_produto,
                            'quantidade' => (int) $this->input->post('quantP', TRUE),
                            'valor_uni' => $produto->valor_produto,
                            'desconto' => (int) $this->input->post('desconto', TRUE),
                            'valor_pago' => ($produto->valor_produto - $desconto) * (int) trim($this->input->post('quantP', TRUE))
                        );
                        if ($this->venda_model->setitem($nproduto)) {//->Verifica se deu certo incerir o novo item da lista
                            $total = $this->venda_model->getValor(1, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                            $produtos = $this->venda_model->getLista(1, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                            if ($tipo == 0) {
                                if ($id != -1) {
                                    $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => 1, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                    $this->my_load_view('vendaComum', $data);
                                } else {
                                    $data = array('total' => $total, 'desconto' => $desc, 'produtos' => $produtos, 'idlista' => 1, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                    $this->my_load_view('vendaComum', $data);
                                }
                            } else {
                                if ($id != -1) {
                                    $data = array('total' => $total, 'produtos' => $produtos, 'cliente' => $cliente, 'idlista' => 1, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                    $this->my_load_view('vendaConsig', $data);
                                } else {
                                    $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => 1, 'mensagemC' => "Foi Adicionado o item: " . $produto->cod_barra_produto);
                                    $this->my_load_view('vendaConsig', $data);
                                }
                            }
                        } else {// -> Quando der erro ao inserir novo item da Lista
                            if ($tipo == 0) {
                                if ($id != -1) {
                                    $data = array('total' => $total, 'desconto' => $desc, 'cliente' => $cliente, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                    $this->my_load_view('vendaComum', $data);
                                } else {
                                    $data = array('total' => $total, 'desconto' => $desc, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                    $this->my_load_view('vendaComum', $data);
                                }
                            } else {
                                if ($id != -1) {
                                    $data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                    $this->my_load_view('vendaConsig', $data);
                                } else {
                                    $data = array('total' => $total, 'mensagem' => "Erro ao Inserir Produto na Lista");
                                    $this->my_load_view('vendaConsig', $data);
                                }
                            }
                        }
                    } else {// -> Quando a quantidade pedida nao existe
                        if ($tipo == 0) {
                            if ($id != -1) {
                                $data = array('total' => $total, 'desconto' => $desc, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaComum', $data);
                            } else {
                                $data = array('total' => $total, 'desconto' => $desc, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaComum', $data);
                            }
                        } else {
                            if ($id != -1) {
                                $data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaConsig', $data);
                            } else {
                                $data = array('total' => $total, 'mensagem' => "Quantidade do Produto Inesistente. Só possui " . $produto->estoque_produto . " itens em  estoque");
                                $this->my_load_view('vendaConsig', $data);
                            }
                        }
                    }
                } else {// -> Quando nao existe o produto ou a quantidade é =0
                    if ($tipo == 0) {
                        if ($id != -1) {
                            $data = array('total' => $total, 'desconto' => $desc, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaComum', $data);
                        } else {
                            $data = array('total' => $total, 'desconto' => $desc, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaComum', $data);
                        }
                    } else {
                        if ($id != -1) {
                            $data = array('total' => $total, 'cliente' => $cliente, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaConsig', $data);
                        } else {
                            $data = array('total' => $total, 'mensagem' => "Produto não Encontrado ou Quantidade Invalida");
                            $this->my_load_view('vendaConsig', $data);
                        }
                    }
                }
            }
        } else {
            redirect('login');
        }
    }

    public function selCliente($id, $desconto = 0, $total, $tipo = 0, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($id < 0) {
                $data = array('total' => $total, 'desconto' => $desconto, 'tipo' => $tipo, 'idlista' => $idlista);
                $this->my_load_view('vendaCliente', $data);
            } else {
                $cliente = $this->usuario_model->getCliente($id, 0, $this->session->userdata('nivel'));
                $idLista = $this->venda_model->getExID($this->session->userdata('id'))->id_lista;
                if ($idLista != null) {
                    $produtos = $this->venda_model->getLista($idLista, $this->session->userdata('id'));
                    $total = $this->venda_model->getValor($idLista, $this->session->userdata('id'))->valor_pago;
                    if ($total == null) {
                        $total = 0;
                    }
                    $data = array('total' => $total, 'desconto' => $desconto, 'cliente' => $cliente, 'produtos' => $produtos, 'idlista' => $idLista);
                } else {
                    $data = array('total' => $total, 'desconto' => $desconto, 'cliente' => $cliente, 'idlista' => $idLista);
                }
                if ($tipo == 0) {
                    $this->my_load_view('vendaComum', $data);
                } else {
                    $this->my_load_view('vendaConsig', $data);
                }
            }
        } else {
            redirect('login');
        }
    }

    public function buscaCliente($desconto = 0, $total, $tipo, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($this->input->post('tipo', TRUE) == 1) {
                $aux = str_split(trim($this->input->post('nome', TRUE)));
                if ((count($aux) > 14) || ((count($aux) < 14))) {
                    $data = array('total' => $total, 'desconto' => $desconto, 'mensagem' => "CPF Invalido", 'tipo' => $tipo, 'idlista' => $idlista);
                    $this->my_load_view('vendaCliente', $data);
                } else {
                    $dado = $this->input->post('nome');

                    $cliente = $this->usuario_model->getCliente(trim($dado), $this->input->post('tipo', TRUE), $this->session->userdata('nivel'));
                    if ($cliente == FALSE) {
                        $data = array('total' => $total, 'desconto' => $desconto, 'mensagem' => "Cliente não Cadastrado", 'tipo' => $tipo, 'idlista' => $idlista);
                        $this->my_load_view('vendaCliente', $data);
                    } else {
                        $data = array('total' => $total, 'desconto' => $desconto, 'cliente' => $cliente, 'tipo' => $tipo, 'idlista' => $idlista);
                        $this->my_load_view('vendaCliente', $data);
                    }
                }
            } else {
                $dado = trim($this->input->post('nome', TRUE));
                $dado = $this->usuario_model->getCliente($dado, $this->input->post('tipo', TRUE), $this->session->userdata('nivel'));
                if ($dado == FALSE) {
                    $data = array('total' => $total, 'desconto' => $desconto, 'mensagem' => "Cliente não Cadastrado", 'tipo' => $tipo, 'idlista' => $idlista);
                    $this->my_load_view('vendaCliente', $data);
                } else {
                    $data = array('total' => $total, 'desconto' => $desconto, 'cliente' => $dado, 'tipo' => $tipo, 'idlista' => $idlista);
                    $this->my_load_view('vendaCliente', $data);
                }
            }
        } else {
            redirect('login');
        }
    }

    public function finalizarCompra($total, $cliente = -1, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago;
            if ($total == null) {
                $total = 0;
            }
            if ($cliente != -1) {
                $cliente = $this->usuario_model->getCliente($cliente, 0, $this->session->userdata('nivel'));
                if ($total != 0) {
                    $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
                    $idVenda = $this->usuario_model->setVenda($cliente[0]['id_cliente'], $total, 0);
                    $sProduto = -1;
                    for ($i = 0; $i < count($produtos); $i++) {
                        $produto = $this->usuario_model->getProduto($produtos[$i]['id_produto'], 0, 0, $this->session->userdata('nivel'));
                        if ($produtos[$i]['quantidade'] <= $produto->estoque_produto) {
                            if ($produtos[$i]['quantidade'] == $produto->estoque_produto) {
                                $data = array(
                                    'quantidade' => 0
                                );
                                $this->usuario_model->updateLojaproduto($produtos[$i]['id_produto'], $this->session->userdata('nivel'), $data);
                            } else {
                                $data = array(
                                    'quantidade' => $produto->estoque_produto - $produtos[$i]['quantidade']
                                );
                                $this->usuario_model->updateLojaproduto($produtos[$i]['id_produto'], $this->session->userdata('nivel'), $data);
                            }
                            $this->usuario_model->setCompra($cliente[0]['id_cliente'], $produtos[$i]['quantidade'], $produtos[$i]['id_produto'], $idVenda, $produtos[$i]['desconto']);
                        } else {
                            $sProduto = $produtos[$i]['codbarras'];
                            break;
                        }
                    }
                    if ($sProduto != -1) {
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'cliente' => $cliente, 'mensagem' => "O produto " . $sProduto . " não possui essa quantidade mias ou Já foi vendido todos os itens");
                        $this->my_load_view('vendaComum', $data);
                    } else {
                        $this->usuario_model->logs($this->session->userdata('id'), 7, $cliente[0]['id_cliente'], $total);
                        if ($this->venda_model->deleteLista($idlista, $this->session->userdata('id'))) {
                            redirect('venda/criaRomaneio/' . $idVenda);
                        } else {
                            //Fazer um log de Erro aki---
                            redirect('venda/criaRomaneio/' . $idVenda);
                        }
                    }
                } else {
                    $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Nem um produto Selecionado ou erro no Sistema(Se for erro no Sistema ligue para o tecnico)", 'cliente' => $cliente);
                    $this->my_load_view('vendaComum', $data);
                }
            } else {
                if ($total != null) {
                    $produtos = $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
                    $data = array('total' => $total, 'idlista' => $idlista,'desconto' => 0, 'produtos' => $produtos, 'mensagem' => "Cliente não Selecionado");
                    $this->my_load_view('vendaComum', $data);
                } else {
                    $data = array('total' => $total, 'idlista' => $idlista,'desconto' => 0, 'mensagem' => "Cliente não Selecionado");
                    $this->my_load_view('vendaComum', $data);
                }
            }
        } else {
            redirect('login');
        }
    }

    public function finalizarCompraC($total, $cliente = -1, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($idlista != -1) {
                $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
            } else {
                $total = 0;
            }
            if ($this->input->post('data', TRUE)) {
                if ($cliente != -1) {//Verifica se Possui Cliente
                    $cliente = $this->usuario_model->getCliente($cliente, 0, $this->session->userdata('nivel')); //Pega o Cadastro do cliente
                    if ($total != 0) {//Verifica se possui produto
                        $idVenda = $this->usuario_model->setVenda($cliente[0]['id_cliente'], $total, 1, $this->input->post('data', TRUE)); //nova venda
                        $this->usuario_model->setVendaC($idVenda); //nova item da tabela consignato
                        $sProduto = -1;
                        for ($i = 0; $i < count($produtos); $i++) {
                            $produto = $this->usuario_model->getProduto($produtos[$i]['id_produto'], 0, 0, $this->session->userdata('nivel'));
                            if ($produtos[$i]->estoque_produto > $produto->estoque_produto) {
                                $sProduto = $produtos[$i]['codbarras'];
                                break;
                            }
                        }
                        if ($sProduto != -1) {
                            $data = array('total' => $total,
                                'idlista' => $idlista,
                                'produtos' => $produtos,
                                'cliente' => $cliente,
                                'mensagem' => "O produto " . $sProduto . " não possui essa quantidade mais ou Já foi vendido todos os itens");
                            $this->my_load_view('vendaConsig', $data);
                        } else {
                            for ($i = 0; $i < count($produtos); $i++) {
                                $produto = $this->usuario_model->getProduto($produtos[$i]['id_produto'], 0, 0, $this->session->userdata('nivel'));
                                if ($produtos[$i]['quantidade'] == $produto->estoque_produto) {
                                    $data = array(
                                        'quantidade' => 0
                                    );
                                    $this->usuario_model->updateLojaproduto($produtos[$i]['id_produto'], $this->session->userdata('nivel'), $data);
                                } else {
                                    $data = array(
                                        'quantidade' => $produto->estoque_produto - $produtos[$i]['quantidade']
                                    );
                                    $this->usuario_model->updateLojaproduto($produtos[$i]['id_produto'], $this->session->userdata('nivel'), $data);
                                }
                                $this->usuario_model->setCompra($cliente[0]['id_cliente'], $produtos[$i]['quantidade'], $produtos[$i]['id_produto'], $idVenda, $produtos[$i]['desconto']);
                            }
                            $this->usuario_model->logs($this->session->userdata('id'), 8, $cliente[0]['id_cliente'], $total, $idVenda);
                            if ($this->venda_model->deleteLista($idlista, $this->session->userdata('id'))) {
                                redirect('venda/criaRomaneio/' . $idVenda . '/2');
                            } else {
                                //->Colocar o log de erro aki
                                redirect('venda/criaRomaneio/' . $idVenda . '/2');
                            }
                        }
                    } else {
                        $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Nem um produto Selecionado ou erro no Sistema(Se for erro no Sistema ligue para o tecnico)", 'cliente' => $cliente);
                        $this->my_load_view('vendaConsig', $data);
                    }
                } else {
                    if ($total != 0) {
                        $data = array('total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'mensagem' => "Cliente não Selecionado");
                        $this->my_load_view('vendaConsig', $data);
                    } else {
                        $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Cliente não Selecionado");
                        $this->my_load_view('vendaConsig', $data);
                    }
                }
            } else {
                if ($cliente != -1) {
                    if ($total != 0) {
                        $data = array('total' => $total, 'cliente' => $cliente, 'idlista' => $idlista);
                        $this->my_load_view('vendaDateR', $data);
                    } else {
                        $cliente = $this->usuario_model->getCliente($cliente, 0);
                        $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Nem um produto Selecionado ou erro no Sistema(Se for erro no Sistema ligue para o tecnico)", 'cliente' => $cliente);
                        $this->my_load_view('vendaConsig', $data);
                    }
                } else {
                    if ($total != 0) {
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Cliente não Selecionado");
                        $this->my_load_view('vendaConsig', $data);
                    } else {
                        $data = array('total' => $total, 'idlista' => $idlista, 'mensagem' => "Cliente não Selecionado");
                        $this->my_load_view('vendaConsig', $data);
                    }
                }
            }
        } else {
            redirect('login');
        }
    }

    public function sair($tipo = 0, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($idlista != -1) {
                if ($this->venda_model->deleteLista($idlista, $this->session->userdata('id'))) {
                    if ($tipo == 0) {
                        redirect('venda');
                    } else {

                        redirect('venda/consignado');
                    }
                } else {
                    //log de erro aki---
                    if ($tipo == 0) {
                        $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
                        $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago;
                        $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idlista, 'mensagem' => "Erro ao Deletar a Lista");
                        $this->my_load_view('vendaComum', $data);
                    } else {

                        redirect('venda/consignado');
                    }
                }
            } else {
                if ($tipo == 0) {
                    redirect('venda');
                } else {
                    redirect('venda/consignado');
                }
            }
        } else {
            redirect('login');
        }
    }

    public function deletaItem($i, $desconto = 0, $total, $tipo = 0, $id = -1, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($id != -1) {
                $cliente = $this->usuario_model->getCliente($id, 0,$this->session->userdata('nivel'));
            }
            if ($idlista != -1) {
                if ($this->venda_model->deleteItem($i, $idlista, $this->session->userdata('id'))) {

                    $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                    if ($total == null) {
                        $total = 0;
                        $idlista=-1;
                    }
                    $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                    $produto = $this->usuario_model->getProduto($i, 0, 0, $this->session->userdata('nivel')); // -> Pega o Produto
                    if ($tipo == 0) {
                        if ($id != -1) {
                            $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagemC' => "Foi Deletado o item: " . $produto->cod_barra_produto);
                            $this->my_load_view('vendaComum', $data);
                        } else {
                            $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos, 'mensagemC' => "Foi Deletado o item: " . $produto->cod_barra_produto);
                            //print_r($data);
                            $this->my_load_view('vendaComum', $data);
                        }
                    } else {
                        if ($id != -1) {
                            $data = array('total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagemC' => "Foi Deletado o item: " . $produto->cod_barra_produto);
                            $this->my_load_view('vendaConsig', $data);
                        } else {
                            $data = array('total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'mensagemC' => "Foi Deletado o item: " . $produto->cod_barra_produto);
                            $this->my_load_view('vendaConsig', $data);
                        }
                    }
                } else {
                    $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                    $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                    if ($tipo == 0) {
                        if ($id != -1) {
                            $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Erro ao Deletar Produto na Lista");
                            $this->my_load_view('vendaComum', $data);
                        } else {
                            $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos, 'mensagem' => "Erro ao Deletar Produto na Lista");
                            $this->my_load_view('vendaComum', $data);
                        }
                    } else {
                        if ($id != -1) {
                            $data = array('total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Erro ao Deletar Produto na Lista");
                            $this->my_load_view('vendaConsig', $data);
                        } else {
                            $data = array('total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'mensagem' => "Erro ao Deletar Produto na Lista");
                            $this->my_load_view('vendaConsig', $data);
                        }
                    }
                }
            } else {
                $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                if ($tipo == 0) {
                    if ($id != -1) {
                        $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Erro não possui item Cadastrado");
                        $this->my_load_view('vendaComum', $data);
                    } else {
                        $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos, 'mensagem' => "Erro não possui item Cadastrado");
                        $this->my_load_view('vendaComum', $data);
                    }
                } else {
                    if ($id != -1) {
                        $data = array('total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'cliente' => $cliente, 'mensagem' => "Erro nem uma Lista");
                        $this->my_load_view('vendaConsig', $data);
                    } else {
                        $data = array('total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'mensagem' => "Erro nem uma Lista");
                        $this->my_load_view('vendaConsig', $data);
                    }
                }
            }
        } else {
            redirect('login');
        }
    }

    public function novoCom() {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $idLista = $this->venda_model->getExID($this->session->userdata('id'))->id_lista;
            if ($idLista != null) {
                $produtos = $this->venda_model->getLista($idLista, $this->session->userdata('id'));
                $total = $this->venda_model->getValor($idLista, $this->session->userdata('id'))->valor_pago;
                $data = array('total' => $total, 'produtos' => $produtos, 'idlista' => $idLista);
            } else {
                $data = array('total' => 0);
            }
            $this->my_load_view('vendaConsig', $data);
        } else {
            redirect('login');
        }
    }

    public function verificaItem($total, $idCliente, $id, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $produto = $this->usuario_model->getProduto(0, trim($this->input->post('codigoP', TRUE)),0,$this->session->userdata('nivel'));
            $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago;
            $idLista = $this->venda_model->getExID($this->session->userdata('id'))->id_lista;
            $cliente = $this->usuario_model->getCliente($idCliente, 0,$this->session->userdata('nivel'));
            $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
            if ($produto != FALSE) {
                if ($idLista != null) {
                    $verifica = -1;
                    $quantidade = $this->venda_model->verificaItem($produto->id_produto, $idlista, $this->session->userdata('id'));
                    if ($quantidade != FALSE) {//Verifica se já existe um produto
                        if ($quantidade->quantidade >= $quantidade->quantidade_D + 1) {//Verifica se a quantidade devolvida mais um é menor que a quantidade levada
                            if ($this->input->post('quantP', TRUE) != 1) {//verifica se a quantidade passada é != de 1
                                if ($quantidade->quantidade >= $quantidade->quantidade_D + $this->input->post('quantP', TRUE)) {//Verifica se a quantidade devolvida mais quantidade passada é menor que a quantidade levada
                                    $desconto = $produto->valor_produto * ($quantidade->desconto / 100); //->Calcula o desconto	
                                    $nproduto = array(
                                        'quantidade_D' => $quantidade->quantidade_D + $this->input->post('quantP', TRUE),
                                        'valor_pago' => ($produto->valor_produto - $desconto) * ($quantidade->quantidade - ($quantidade->quantidade_D + $this->input->post('quantP', TRUE)))
                                    );
                                    if ($this->venda_model->updateItem($produto->id_produto, $idlista, $this->session->userdata('id'), $nproduto)) {
                                        $total = $this->venda_model->getValor($idLista, $this->session->userdata('id'))->valor_pago;
                                        $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
                                        if ($quantidade->quantidade_D != 0) {//Verifica se já foi verificado
                                            $verifica = -4;
                                        } else {
                                            $verifica = 0;
                                        }
                                    } else {
                                        $verifica = -3;
                                    }
                                } else {
                                    $verifica = -2;
                                }
                            } else {
                                $desconto = $produto->valor_produto * ($quantidade->desconto / 100); //->Calcula o desconto	
                                $nproduto = array(
                                    'quantidade_D' => $quantidade->quantidade_D + 1,
                                    'valor_pago' => ($produto->valor_produto - $desconto) * ($quantidade->quantidade - ($quantidade->quantidade_D + 1))
                                );
                                if ($this->venda_model->updateItem($produto->id_produto, $idlista, $this->session->userdata('id'), $nproduto)) {
                                    if ($quantidade->quantidade_D != 0) {
                                        $verifica = -4;
                                    } else {
                                        $verifica = 0;
                                    }
                                    $total = $this->venda_model->getValor($idLista, $this->session->userdata('id'))->valor_pago;
                                    $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
                                } else {
                                    $verifica = -3;
                                }
                            }
                        } else {
                            $verifica = -2;
                        }
                    }
                    if ($verifica == -1) {
                        $data = array('cliente' => $cliente,
                            'total' => $total,
                            'produtos' => $produtos,
                            'mensagem' => "Produto não está na Lista",
                            'id' => $id,
                            'idlista' => $idlista);
                        $this->my_load_view('vendaRetorno', $data);
                    } else if ($verifica == -2) {
                        $data = array('cliente' => $cliente,
                            'total' => $total,
                            'produtos' => $produtos,
                            'mensagem' => "Quantidade de produto Devolvido é Superior a Quantidade Levada ",
                            'id' => $id,
                            'idlista' => $idlista);
                        $this->my_load_view('vendaRetorno', $data);
                    } else if ($verifica == -3) {
                        $data = array('cliente' => $cliente,
                            'total' => $total,
                            'produtos' => $produtos,
                            'mensagem' => "Erro ao dar Update no Item", 'id' => $id, 'idlista' => $idlista);
                        $this->my_load_view('vendaRetorno', $data);
                    } else if ($verifica == -4) {
                        $data = array('cliente' => $cliente,
                            'total' => $total,
                            'produtos' => $produtos,
                            'mensagemC' => "Foi adicionado mais um na quantidade devolvida do item " . $produto->cod_barra_produto,
                            'id' => $id,
                            'idlista' => $idlista);
                        $this->my_load_view('vendaRetorno', $data);
                    } else {
                        $data = array('cliente' => $cliente,
                            'total' => $total,
                            'mensagemC' => "Foi verificado o item " . $produto->cod_barra_produto . ", e adicionado mais um na quantidade devolvida.",
                            'produtos' => $produtos,
                            'id' => $id,
                            'idlista' => $idlista);
                        $this->my_load_view('vendaRetorno', $data);
                    }
                } else {
                    $vendas1 = $this->usuario_model->getVendaC();
                    if ($vendas1 != FALSE) {
                        for ($i = 0; $i < count($vendas1); $i++) {
                            $venda = $this->usuario_model->getVenda($vendas1[$i]['id_venda_inicio']);
                            $cliente = $this->usuario_model->getCliente($venda->cliente_fk, 0);
                            $data1 = explode(" ", $venda->data_venda);
                            $data1 = explode("-", $data1[0]);
                            $data = "" . $data1[2];
                            $data = $data . "-" . $data1[1];
                            $data = $data . "-" . $data1[0];
                            $venda->data_venda = $data;
                            $venda->cliente_fk = $cliente[0]['nome_cliente'];
                            $vendas[$i] = $venda;
                        }
                        $data = array('vendas' => $vendas, 'mensagem' => "Erro ao na criação da lista de produto");
                        $this->my_load_view('consignado', $data);
                    } else {
                        $this->my_load_view('consignado', NULL);
                    }
                }
            } else {
                $data = array('cliente' => $cliente,
                    'total' => $total,
                    'produtos' => $produtos,
                    'mensagem' => "Produto não está na Lista",
                    'id' => $id,
                    'idlista' => $idlista);
                $this->my_load_view('vendaRetorno', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function retornoCom($id) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $verifica = 1;
            $idLista = $this->venda_model->getExID($this->session->userdata('id'))->id_lista;
            if ($idLista != null) {
                if ($this->venda_model->deleteLista($idLista, $this->session->userdata('id'))) {
                    $verifica = 1;
                } else {
                    $verifica = 2;
                }
            }
            if ($verifica == 1) {
                $compras = $this->usuario_model->getCompras($id);
                $venda = $this->usuario_model->getVenda($id);
                $cliente = $this->usuario_model->getCliente($venda->cliente_fk, 0,$this->session->userdata('nivel'));
                for ($i = 0; $i < count($compras); $i++) {
                    $produto = $this->usuario_model->getProduto($compras[$i]['produto_fk'], 0, $this->session->userdata('nivel'));
                    $desconto = $produto->valor_produto * ($compras[$i]['desconto_compra'] / 100); //->Calcula o desconto	
                    $nproduto = array(
                        'id_lista' => 1,
                        'id_user' => $this->session->userdata('id'),
                        'codbarras' => $produto->cod_barra_produto,
                        'id_produto' => $produto->id_produto,
                        'quantidade' => $compras[$i]['quantidade_produto'],
                        'valor_uni' => $produto->valor_produto,
                        'desconto' => $compras[$i]['desconto_compra'],
                        'valor_pago' => ($produto->valor_produto - $desconto) * $compras[$i]['quantidade_produto']
                    );
                    if ($this->venda_model->setitem($nproduto)) {
                        $verifica = -1;
                    } else {
                        $verifica = 2;
                        break;
                    }
                }
                if ($verifica == -1) {
                    $produtos = $this->venda_model->getLista(1, $this->session->userdata('id')); // -> Atualiza a lista produtos
                    $total = $this->venda_model->getValor(1, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                    $data = array('cliente' => $cliente, 'idlista' => 1, 'total' => $total, 'produtos' => $produtos, 'id' => $id);
                    $this->my_load_view('vendaRetorno', $data);
                } else {
                    $vendas1 = $this->usuario_model->getVendaC();
                    if ($vendas1 != FALSE) {
                        for ($i = 0; $i < count($vendas1); $i++) {
                           $venda = $this->usuario_model->getVenda($vendas1[$i]['id_venda_inicio']);
                           $cliente = $this->usuario_model->getCliente($venda->cliente_fk, 0,$this->session->userdata('nivel'));
                           if($cliente!=NULL){
                               $data1 = explode(" ", $venda->data_venda);
                               $data1 = explode("-", $data1[0]);
                               $data = "" . $data1[2];
                               $data = $data . "-" . $data1[1];
                               $data = $data . "-" . $data1[0];
                               $venda->data_venda = $data;
                               $venda->cliente_fk = $cliente[0]['nome_cliente'];
                               $vendas[] = $venda;
                           }
                        }
                        $data = array('vendas' => $vendas, 'mensagem' => "Erro ao isserir na lista de produto");
                        $this->my_load_view('consignado', $data);
                    } else {
                        $data = array('mensagem' => "Erro ao Inserir na lista de produto");
                        $this->my_load_view('consignado', $data);
                    }
                }
            } else {
                $vendas1 = $this->usuario_model->getVendaC();
                if ($vendas1 != FALSE) {
                    for ($i = 0; $i < count($vendas1); $i++) {
                        $venda = $this->usuario_model->getVenda($vendas1[$i]['id_venda_inicio']);
                        $cliente = $this->usuario_model->getCliente($venda->cliente_fk, 0,$this->session->userdata('nivel'));
                        if($cliente!=NULL){
                            $data1 = explode(" ", $venda->data_venda);
                            $data1 = explode("-", $data1[0]);
                            $data = "" . $data1[2];
                            $data = $data . "-" . $data1[1];
                            $data = $data . "-" . $data1[0];
                            $venda->data_venda = $data;
                            $venda->cliente_fk = $cliente[0]['nome_cliente'];
                            $vendas[] = $venda;
                        }
                    }
                    $data = array('vendas' => $vendas, 'mensagem' => "Erro na criação da lista de produto");
                    $this->my_load_view('consignado', $data);
                } else {
                    $data = array('mensagem' => "Erro na criação da lista de produto");
                    $this->my_load_view('consignado', $data);
                }
            }
        } else {
            redirect('login');
        }
    }

    public function voltarCom($idproduto, $total, $idCliente, $id, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $cliente = $this->usuario_model->getCliente($idCliente, 0,$this->session->userdata('nivel'));
            $produto = $this->usuario_model->getProduto($idproduto, 0,0,$this->session->userdata('nivel'));
            $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago;
            $quantidade = $this->venda_model->verificaItem($produto->id_produto, $idlista, $this->session->userdata('id'));
            $desconto = $produto->valor_produto * ($quantidade->desconto / 100);
            $nproduto = array(
                'quantidade_D' => 0,
                'valor_pago' => ($produto->valor_produto - $desconto) * ($quantidade->quantidade - 0)
            );
            if ($this->venda_model->updateItem($produto->id_produto, $idlista, $this->session->userdata('id'), $nproduto)) {
                $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago;
                $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
                $data = array('cliente' => $cliente, 'total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'id' => $id);
                $this->my_load_view('vendaRetorno', $data);
            } else {
                $data = array('cliente' => $cliente, 'total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'id' => $id, 'mensagem' => "Erro dar Update na lista de produto");
                $this->my_load_view('vendaRetorno', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function finalizarRetorno($total, $idCliente, $idVenda, $idlista) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id'));
            $cliente = $this->usuario_model->getCliente($idCliente, 0,$this->session->userdata('nivel'));
            $vendaRtorno = $this->usuario_model->setVenda($idCliente, $total,2);
            for ($i = 0; $i < count($produtos); $i++) {
                $produto = $this->usuario_model->getProduto($produtos[$i]['id_produto'], 0,0,$this->session->userdata('nivel')); 
                $data = array(
                  'quantidade' => $produto->estoque_produto += $produtos[$i]['quantidade_D']
                 );  
                $this->usuario_model->updateLojaproduto($produtos[$i]['id_produto'], $this->session->userdata('nivel'), $data);
                if ($produtos[$i]['quantidade_D'] != $produtos[$i]['quantidade']) {
                    $this->usuario_model->setCompra($idCliente, $produtos[$i]['quantidade_D'] - $produtos[$i]['quantidade_D'], $produto->id_produto, $vendaRtorno, $produtos[$i]['desconto']);
                } else {
                    $this->usuario_model->setCompra($idCliente, 0, $produto->id_produto, $vendaRtorno, $produtos[$i]['desconto']);
                }
            }
            $vendasC = $this->usuario_model->getVendaC($idVenda);
            $this->usuario_model->updateVendaCom($vendasC[0]['id_venda_consignado'], $vendaRtorno);
            $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago;
            if ($total == null) {
                $total = 0;
            }
            if ($this->venda_model->deleteLista($idlista, $this->session->userdata('id'))) {
                if ($total != 0) {
                    $this->usuario_model->logs($this->session->userdata('id'), 9, $cliente[0]['id_cliente'], $total, $idVenda);
                    redirect('venda/criaRomaneio/' . $vendasC[0]['id_venda_consignado'] . "/1");
                } else {
                    $this->usuario_model->logs($this->session->userdata('id'), 9, $cliente[0]['id_cliente'], $total, $idVenda);
                    redirect('venda/criaRomaneio/' . $vendasC[0]['id_venda_consignado'] . "/1");
                }
            } else {
                //->Log de erro a Fazer
                if ($total != 0) {
                    $this->usuario_model->logs($this->session->userdata('id'), 9, $cliente[0]['id_cliente'], $total, $idVenda);
                    redirect('venda/criaRomaneio/' . $vendasC[0]['id_venda_consignado'] . "/1");
                } else {
                    $this->usuario_model->logs($this->session->userdata('id'), 9, $cliente[0]['id_cliente'], $total, $idVenda);
                    redirect('venda/criaRomaneio/' . $vendasC[0]['id_venda_consignado'] . "/1");
                }
            }
        } else {
            redirect('login');
        }
    }

    public function visualizaI($idProduto, $desconto = 0, $total, $tipo = 0, $idCliente = 0, $id = 0, $valorMim = 0, $idlista = -1) {
        $datestring = "%m%d";
        $time = time();
        $load = mdate($datestring, $time) . do_hash("MSanches", 'md5');
        if ($this->session->userdata('load') == $load) {
            if ($idProduto == -1) {
                $total = $this->venda_model->getValor($idlista, $this->session->userdata('id'))->valor_pago; // -> Pega o Valor Total da somatoria dos Valores pago
                $produtos = $this->venda_model->getLista($idlista, $this->session->userdata('id')); // -> Pega todos os Itens da Lista
                if ($tipo == 0) {
                    $cliente = $this->usuario_model->getCliente($idCliente, 0);
                    $data = array('cliente' => $cliente, 'desconto' => $desconto, 'total' => $total, 'idlista' => $idlista, 'produtos' => $produtos, 'id' => $id, 'valorMim' => $valorMim);
                    $this->my_load_view('vendaRetorno', $data);
                } else if ($tipo == 1) {
                    if ($idCliente != 0) {
                        $cliente = $this->usuario_model->getCliente($idCliente, 0,$this->session->userdata('nivel'));
                        $data = array('cliente' => $cliente, 'desconto' => $desconto, 'idlista' => $idlista, 'total' => $total, 'produtos' => $produtos);
                        $this->my_load_view('vendaComum', $data);
                    } else {
                        $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos);
                        $this->my_load_view('vendaComum', $data);
                    }
                } else if ($tipo == 2) {
                    if ($idCliente != 0) {
                        $cliente = $this->usuario_model->getCliente($idCliente, 0,$this->session->userdata('nivel'));
                        $data = array('cliente' => $cliente, 'desconto' => $desconto, 'idlista' => $idlista, 'total' => $total, 'produtos' => $produtos);
                        $this->my_load_view('vendaConsig', $data);
                    } else {
                        $data = array('total' => $total, 'desconto' => $desconto, 'idlista' => $idlista, 'produtos' => $produtos);
                        $this->my_load_view('vendaConsig', $data);
                    }
                }
            } else {
                $produto = $this->usuario_model->getFoto(trim($idProduto));
                $data = array('idCliente' => $idCliente, 'desconto' => $desconto, 'tipo' => $tipo, 'total' => $total, 'produto' => $produto, 'id' => $id, 'valorMim' => $valorMim, 'idlista' => $idlista);
                $this->my_load_view('vendaVerProduto', $data);
            }
        } else {
            redirect('login');
        }
    }

}

?>