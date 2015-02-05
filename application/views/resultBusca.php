<script language='JavaScript'>
	function SomenteNumero(e) {
		var tecla = (window.event) ? event.keyCode : e.which;
		if ((tecla > 47 && tecla < 58))
			return true;
		else {
			if (tecla == 8 || tecla == 0)
				return true;
			else
				return false;
		}
	}
</script>
<div class="panel panel-default">
    <div class="panel-body">
            <div class="row">
                    <div class="col-md-9 col-md-push-3">
                            <div class="container-fluid">
                                    <div  class="panel panel-default">
                                            <?php if (isset($mensagem))
    {
                                            ?>
                                            <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                            &times;
                                                    </button>
                                                    <?php	echo $mensagem; ?>
                                            </div>
                                            <?php } ?>
                                            <form class="form-horizontal" role="form"  method="post">
                                                    <div class="row" style="margin-left: 3%">
                                                            <div style="margin-left: 30%;" >
                                                                    <h3><b> Código: <?php echo $produto->cod_barra_produto?>
                                                                    </b></h3>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                    <br />
                                                                    <br />
                                                                    <div class="form-group">
                                                                            <label for="inputEmail3" class="col-sm-3 control-label">Valor</label>
                                                                            <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $produto -> valor_produto; ?>" style="text-align: center" required maxlength="4" onkeypress="return SomenteNumero(event);" disabled>
                                                                            </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label for="inputEmail3" class="col-sm-3 control-label">Tipo</label>
                                                                            <div class="col-sm-7">
                                                                                    <select class="form-control" name="tipo" style="text-align: center" id="tipo" required  disabled>
                                                                                            <option value=""></option>
                                                                                            <option value="3" <?php
                                                                                                    if ($produto -> tipo_produto == 3) {echo "selected";
                                                                                                    }
    ?>>Brinco</option>
                                                                                            <option value="1" <?php
                                                                                                    if ($produto -> tipo_produto == 1) {echo "selected";
                                                                                                    }
    ?>>Anel</option>
                                                                                            <option value="4" <?php
                                                                                                    if ($produto -> tipo_produto == 4) {echo "selected";
                                                                                                    }
    ?>>Colar</option>
                                                                                            <option value="6" <?php
                                                                                                    if ($produto -> tipo_produto == 6) {echo "selected";
                                                                                                    }
    ?>>Pulceira</option>
                                                                                            <option value="2" <?php
                                                                                                    if ($produto -> tipo_produto == 2) {echo "selected";
                                                                                                    }
    ?>>Bracelete</option>
                                                                                            <option value="7" <?php
                                                                                                    if ($produto -> tipo_produto == 7) {echo "selected";
                                                                                                    }
    ?>>Tornozeleira</option>
                                                                                            <option value="5" <?php
                                                                                                    if ($produto -> tipo_produto == 5) {echo "selected";
                                                                                                    }
    ?>>Conjunto</option>
                                                                                    </select>
                                                                            </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label for="inputEmail3" class="col-sm-3 control-label">Qualidade:</label>
                                                                            <div class="col-sm-7">
                                                                                    <select class="form-control" name="detalhe" id="detalhe" style="text-align: center;" required disabled>
                                                                                            <option value="0" <?php if($produto->quali_produto==0){echo "selected"; } ?>></option>
                                                                                            <option value="1" <?php if($produto->quali_produto==1){echo "selected"; } ?>>Só Dourado</option>
                                                                                            <option value="2" <?php if($produto->quali_produto==2){echo "selected"; } ?>>Dourado c/ Pedra Natural</option>
                                                                                            <option value="3" <?php if($produto->quali_produto==3){echo "selected"; } ?>>Dourado c/ Pedra Sintético</option>
                                                                                            <option value="4" <?php if($produto->quali_produto==4){echo "selected"; } ?>>Dourado c/ Zirconia G</option>
                                                                                            <option value="5" <?php if($produto->quali_produto==5){echo "selected"; } ?>>Dourado c/ Zirconia Cravejado</option>
                                                                                            <option value="6" <?php if($produto->quali_produto==6){echo "selected"; } ?>>Só Proata</option>
                                                                                            <option value="7" <?php if($produto->quali_produto==7){echo "selected"; } ?>>Prata c/ Pedra</option>
                                                                                    </select>
                                                                            </div> 
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="inputEmail3" class="col-sm-3 control-label">Quantidade:</label>
                                                                        <div class="col-sm-7">
                                                                            <div class=" scroll-tabela" style=" height: 100px;">
                                                                                <table style="width: 100%;">
                                                                                    <?php for($i=0;$i<count($lojas);$i++){ ?>
                                                                                    <tr>
                                                                                        <td style="width: 60%; padding-left: 10px; padding-top: 5px;">
                                                                                          <h6><?php echo $lojas[$i]['nome_loja']; ?>:</h6>
                                                                                        </td> 
                                                                                        <td style="width: 20%; padding-right: 10px; padding-top: 5px;">
                                                                                              <input type="text" class="form-control" id="quant" <?php if($loja == $lojas[$i]['id_loja'] ){  ?>name="quant"  <?php }?>
                                                                                                 value="<?php if($quantidade!=FALSE){
                                                                                                               $verifica=1;
                                                                                                                for($j=0;$j<count($quantidade);$j++){
                                                                                                                          if($lojas[$i]['id_loja']==$quantidade[$j]['loja_fk']){
                                                                                                                             echo $quantidade[$j]['quantidade'];
                                                                                                                             $verifica=0;
                                                                                                                             break;
                                                                                                                          }
                                                                                                                 }
                                                                                                                 if($verifica==1){
                                                                                                                    echo '0';
                                                                                                                 }
                                                                                                            }else {
                                                                                                              echo '0';
                                                                                                            }?>" style="text-align: center" onkeypress="return SomenteNumero(event);" required disabled>
                                                                                                </td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                            <div class="col-xs-5">
                                                                    <div class="thumbnail">
                                                                            <div id="img">
                                                                                    <img src="<?php echo $this->config->item('base_url')."css/img/img_produto/".$produto->foto_produto."\""?> data-src="holder.js/100%x180" class="img-responsive" alt="Responsive image">
                                                                            </div>
                                                                            <div id="trocaImg" class="caption" align="center" style=" display: none">
                                                                                    <ul class="pager" >
                                                                                            <li>
                                                                                                    <a href="<?php echo site_url("produtos/novaFoto")?>" >Selecionar</a>
                                                                                            </li>
                                                                                    </ul>
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="form-group" align="center">
                                                                    <p>
                                                                            <a  href="<?php echo site_url("produtos/alterar/".$produto->id_produto)?>" class="btn btn-primary" role="button"> Alterar </a>
                                                                            <a  href="<?php echo site_url("produtos/deletar/" . $produto -> foto_produto . "/" . $produto -> id_produto . "/" . $produto -> cod_barra_produto); ?>" class="btn btn-danger" role="button"> Deletar </a>
                                                                            <a href="<?php echo site_url("produtos/busca")?>" class="btn btn-default" role="button"> Voltar </a>
                                                                    </p>
                                                            </div>
                                                    </div>
                                            </form>
                                    </div>
                            </div>
                    </div>
                    <div class="col-md-3 col-md-pull-9">
                            <ul class="nav nav-pills nav-stacked">
                                    <li>
                                            <a href="<?php echo site_url("produtos")?>"> Produtos </a>
                                    </li>

                                    <li class="active">
                                            <a href="<?php echo site_url("produtos/busca")?>">Buscar Produto</a>

                                    </li>
                                    <li>
                                            <a href="<?php echo site_url("produtos/novo")?>">Novo Produto</a>
                                    </li>
                                    <li>
                                            <a href="<?php echo site_url("produtos/etiquetas")?>">Etiquetas</a>
                                    </li>
                                    <li>
                                            <a href="<?php echo site_url("produtos/estoque")?>">Estoque</a>
                                    </li>
                                    <li >
                                            <a href="<?php echo site_url("home")?>">Voltar</a>
                                    </li>
                            </ul>

                    </div>
            </div>

    </div>
</div>
