<style>
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
<a href="<?php echo site_url("venda/comum")?>" class="button blue">Venda Comum</a><br/>
<a href="#" class="button green">Venda Consignato</a><br/>
<a href="<?php echo site_url("home")?>" class="button orange">Voltar</a><br/>
</div>