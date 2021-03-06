<?php

class Pdf extends FPDF {

	function Header() {
		$cliente = new Cliente();
		// Logo
		$this -> Image($cliente -> config -> item('base_url') . 'css/MSanches-logo.png', 2, 2, 6);
		// Arial bold 15
		$this -> SetFont('Arial', 'B', 14);

		$this -> SetY(2);
		// Move to the right
		$this -> Cell(2);
		// Title
		$this -> Cell(0, 2, '', 0, 1, 'C');
		// Line break
		//$this -> Ln(20);
	}

	// Page footer
	function Footer() {
		// Position at 1.5 cm from bottom
		$this -> SetY(-15);
		// Arial italic 8
		$this -> SetFont('Arial', 'I', 8);
		// Page number
		$this -> Cell(0, 29, utf8_decode('Página ') . $this -> PageNo() . '', 0, 0, 'C');
	}

}

if ($vendas) {

	$total = 0;

	for ($i = 0; $i < count($vendas); $i++) {
		$total += $vendas[$i]["quantidade_produto"] * ($vendas[$i]["valor_produto"]-($vendas[$i]["desconto_compra"]/100)*$vendas[$i]["valor_produto"]);
	}

	$pdf = new PDF('P', 'cm', 'A4');
	$pdf -> SetMargins(2, 2);
	$pdf -> SetTitle("MSanches - Romaneio Entrada");
	$pdf -> Open();	
	$pdf -> AddPage();
	$pdf -> SetFont('Arial', '', 11);
	$pdf -> Cell(2, 0.8, 'Nome', 1, 0, 'L');
	$pdf -> SetFont('Arial', 'B', 11);
	$pdf -> Cell(10, 0.8, $vendas[0]["nome_cliente"], 1, 0, 'L');
	$pdf -> SetFont('Arial', '', 11);
	$pdf -> Cell(2, 0.8, 'Total', 1, 0, 'L');
	$pdf -> SetFont('Arial', 'B', 11);
	$pdf -> Cell(3, 0.8, 'R$ ' . number_format($total, 2, ',', '.'), 1, 1, 'L');

	$pdf -> SetFont('Arial', '', 11);
	$pdf -> Cell(2, 0.8, 'CPF', 1, 0, 'L');
	$pdf -> Cell(9, 0.8, $vendas[0]["cpf_cliente"], 1, 0, 'L');
	$pdf -> Cell(2, 0.8, 'Data', 1, 0, 'L');
	$pdf -> Cell(4, 0.8, date('d/m/Y', strtotime($vendas[0]["data_venda"])), 1, 1, 'L');

	$pdf -> Cell(3, 0.8, utf8_decode('Endereço'), 1, 0, 'L');
	$pdf -> Cell(14, 0.8, utf8_decode($vendas[0]["rua_endereco"] . ', Nº.' . $vendas[0]["numero_endereco"] . ', ' . $vendas[0]["bairro_endereco"] . ', ' . $vendas[0]["cidade_endereco"] . ' - ' . $vendas[0]["uf_endereco"]), 1, 1, 'L');

	$pdf -> Cell(3, 0.8, 'Telefone', 1, 0, 'L');
	$pdf -> Cell(14, 0.8, $vendas[0]["tel_cliente"], 1, 1, 'L');

	$pdf -> Cell(17, 0.8, '', 0, 1, '');

	$pdf -> SetFont('Arial', 'B', 11);
	$pdf -> Cell(4, 0.8, 'Item', 1, 0, 'C');
	$pdf -> Cell(3, 0.8, 'Pegou', 1, 0, 'C');
	$pdf -> Cell(3, 0.8, 'DEV', 1, 0, 'C');
	$pdf -> Cell(2, 0.8, 'Desc', 1, 0, 'C');
	$pdf -> Cell(2, 0.8, 'Valor Un.', 1, 0, 'C');
	$pdf -> Cell(3, 0.8, 'Subtotal', 1, 1, 'C');

	$pdf -> SetFont('Arial', '', 11);

	for ($i = 0; $i < count($vendas); $i++) {
		$pdf -> Cell(4, 0.8, $vendas[$i]["cod_barra_produto"], 1, 0, 'C');
		$pdf -> Cell(3, 0.8, $vendas[$i]["quantidade_produto"], 1, 0, 'C');
		$pdf -> Cell(3, 0.8, '', 1, 0, 'C');
		$pdf -> Cell(2, 0.8,$vendas[$i]["desconto_compra"]."%", 1, 0, 'C');
		$pdf -> Cell(2, 0.8, 'R$ ' . number_format($vendas[$i]["valor_produto"], 2, ',', '.'), 1, 0, 'C');
		$pdf -> Cell(3, 0.8, 'R$ ' . number_format(($vendas[$i]["valor_produto"]-(($vendas[$i]["desconto_compra"]/100)*$vendas[$i]["valor_produto"])) * $vendas[$i]["quantidade_produto"], 2, ',', '.'), 1, 1, 'C');
	}

	$pdf -> SetFont('Arial', 'B', 11);

	$pdf -> Cell(10, 0.8, '', 0, 0, 'C');
	$pdf -> Cell(3, 0.8, 'Total', 1, 0, 'C');
	$pdf -> Cell(4, 0.8, 'R$ ' . number_format($total, 2, ',', '.'), 1, 1, 'C');

	$pdf -> Cell(3, 4 * 0.8, '', 0, 1, 'L');
	
	$pdf -> Cell(7, 0, '', 1, 0, 'L');
	$pdf -> Cell(3, 0, '', 0, 0, 'L');
	$pdf -> Cell(7, 0, '', 1, 1, 'L');

	$pdf -> SetFont('Arial', '', 11);

	$pdf -> Cell(7, 0.8, 'Assinatura do Vendedor', 0, 0, 'C');
	$pdf -> Cell(3, 0, '', 0, 0, 'L');
	$pdf -> Cell(7, 0.8, 'Assinatura do Cliente', 0, 0, 'C');
	
	$pdf -> SetMargins(1.1, 0);
	$pdf -> SetFont('Arial', '', 10);
	$pdf -> AddPage();
	
	$cliente = new Cliente();
	
	$altura = 0;
	$largura = 0;
	$fotos_fim = 0;
	
	for ($i = 1; $i <= count($vendas); $i++) {
		
		if (file_exists('css/img/img_produto/' . trim($vendas[$i - 1]['foto_produto']))) 
			$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/' . $vendas[$i - 1]['foto_produto'], 1.15 + ($largura * 3.75), 4.0 + ($altura * 3.9), 3.6, 3.1);
		else
			$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_sistema/cinza.jpg', 1.15 + ($largura * 3.75), 4.0 + ($altura * 3.9), 3.6, 3.1);
		
		$largura++;
		
		if ($i % 5 == 0) {
			$largura = 0;
			$altura++;
			
			if ($altura - 1 <> 0) {
				$pdf -> Cell(3.73, 0.2, '', 0, 0, 'L');
				$pdf -> Cell(3.75, 0.2, '', 0, 0, 'L');
				$pdf -> Cell(3.75, 0.2, '', 0, 0, 'L');
				$pdf -> Cell(3.75, 0.2, '', 0, 0, 'L');
				$pdf -> Cell(3.74, 0.2, '', 0, 1, 'L');
			}
			
			$pdf -> Cell(3.73, 3.1, '', 1, 0, 'L');
			$pdf -> Cell(3.75, 3.1, '', 1, 0, 'L');
			$pdf -> Cell(3.75, 3.1, '', 1, 0, 'L');
			$pdf -> Cell(3.75, 3.1, '', 1, 0, 'L');
			$pdf -> Cell(3.74, 3.1, '', 1, 1, 'L');
			
			$pdf -> Cell(3.73, 0.6, $vendas[$i - 5]['cod_barra_produto'], 1, 0, 'C');
			$pdf -> Cell(3.75, 0.6, $vendas[$i - 4]['cod_barra_produto'], 1, 0, 'C');
			$pdf -> Cell(3.75, 0.6, $vendas[$i - 3]['cod_barra_produto'], 1, 0, 'C');
			$pdf -> Cell(3.75, 0.6, $vendas[$i - 2]['cod_barra_produto'], 1, 0, 'C');
			$pdf -> Cell(3.74, 0.6, $vendas[$i - 1]['cod_barra_produto'], 1, 1, 'C');
			
			$fotos_fim = count($vendas) - $i; 
		}		
		
		if ($i % 30 == 0) {
			$pdf -> AddPage();
			$altura = 0;
		}	
	}	

	if ($fotos_fim <> 0) {
		for ($k = 1; $k <= 5; $k++) {
			if ($altura <> 0 ) {
				if($fotos_fim >= $k) {				
					$pdf -> Cell(3.745, 0.2, '', 0, 0, 'L');
				} else {
					if ($k < 5)
						$pdf -> Cell(3.738, 0.2, '', 0, 0, 'L');
					else
						$pdf -> Cell(3.738, 0.2, '', 0, 1, 'L');
				}
			}			
		}
		
		for ($k = 1; $k <= 5; $k++) {
			if($fotos_fim >= $k) 
				$pdf -> Cell(3.745, 3.1, '', 1, 0, 'L');
			else {
				if ($k < 5)
					$pdf -> Cell(3.745, 3.1, '', 0, 0, 'L');
				else
					$pdf -> Cell(3.74, 3.1, '', 0, 1, 'L');
			}
		}

		for ($k = 1; $k <= 5; $k++) {
			if ($fotos_fim >= $k)
				$pdf -> Cell(3.74, 0.6, $vendas[count($vendas) - ($fotos_fim + 1 - $k)]['cod_barra_produto'], 1, 0, 'C');
			else {
				if ($k < 5)
					$pdf -> Cell(3.74, 0.6, '', 0, 0, 'C');
			}
		}
		
	}
	/*
	if ($fotos_fim == 2) {
		$pdf -> Cell(5.55, 0.5, '', 0, 0, 'L');
		$pdf -> Cell(5.6, 0.5, '', 0, 0, 'L');
		$pdf -> Cell(5.55, 0.5, '', 0, 1, 'L');
		
		$pdf -> Cell(5.55, 4.1, '', 1, 0, 'L');
		$pdf -> Cell(5.6, 4.1, '', 1, 0, 'L');
		$pdf -> Cell(5.55, 4.1, '', 0, 1, 'L');
		
		$pdf -> Cell(5.55, 0.8, $vendas[count($vendas) - 2]['cod_barra_produto'], 1, 0, 'C');
		$pdf -> Cell(5.55, 0.8, $vendas[count($vendas) - 1]['cod_barra_produto'], 1, 0, 'C');
		$pdf -> Cell(5.55, 0.8, '', 0, 0, 'C');
	} 
	
	if ($fotos_fim == 1) {
		$pdf -> Cell(5.55, 0.5, '', 0, 0, 'L');
		$pdf -> Cell(5.6, 0.5, '', 0, 0, 'L');
		$pdf -> Cell(5.55, 0.5, '', 0, 1, 'L');
		
		$pdf -> Cell(5.55, 4.1, '', 1, 0, 'L');
		$pdf -> Cell(5.6, 4.1, '', 0, 0, 'L');
		$pdf -> Cell(5.55, 4.1, '', 0, 1, 'L');
		
		$pdf -> Cell(5.55, 0.8, $vendas[count($vendas) - 1]['cod_barra_produto'], 1, 0, 'C');
		$pdf -> Cell(5.6, 0.8, '', 0, 0, 'C');
		$pdf -> Cell(5.55, 0.8, '', 0, 1, 'C'); 
	}*/

	$pdf -> Output('romaneio.pdf', 'I');
	$pdf -> Output('romaneio.pdf', 'D');
}?>