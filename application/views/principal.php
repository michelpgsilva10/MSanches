<style>
    h1 {
        text-align: center;
        padding: 30px 0;
    }
    a.button {
        display: inline-block;
        width: 200px;
        padding: 15px 35px;
        text-decoration: none;
        color: white;
        text-transform: uppercase;
        font-weight: 700;
        margin: 0 auto 20px;
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
    }
    .blue {
        background: #6D9BCA;
    }
    .red {
        background: #CA3721;  
    }
    .green {
        background: #5ED64B; 
    }
    .orange {
        background: orange;
    }
    a.button:hover {
        margin-top: -5px;
        margin-bottom: 25px;
    }

</style>

<div class="row" style=" text-align: center">
    <?php
    if (isset($mensagem)) {
        ?>
        <br />
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;
            </button>
            <?php echo $mensagem; ?>
        </div>
    <?php
    } else if (isset($mensagemC)) {
        ?>
        <br />
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;
            </button>
            <?php echo $mensagemC; ?>
        </div>
    <?php }
	//echo $this->session->userdata('nivel');
    ?> 
    <br />
    <a href="<?php echo site_url("produtos") ?>" class="button blue">Produtos</a><br/>
    <a href="<?php echo site_url("venda") ?>" class="button green">Vendas</a><br/>
    <a href="<?php echo site_url("cliente") ?>" class="button red">Clientes</a><br/>
    <a href="<?php echo site_url("empresa") ?>" class="button orange">Empresas</a><br/>

</div>