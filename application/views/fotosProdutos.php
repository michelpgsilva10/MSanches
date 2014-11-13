<?php
class Pdf extends FPDF {

	function Header() {
		$cliente = new Cliente();
		// Logo
		$this -> Image($cliente -> config -> item('base_url') . 'css/MSanches-logo.png', 2, 2, 6);
		// Arial bold 15
		$this -> SetFont('Arial', 'B', 16);

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

$pdf = new PDF('P', 'cm', 'A4');
$pdf -> SetMargins(2, 2);
$pdf -> SetTitle("MSanches - Venda Comum");
$pdf -> Open();	
$pdf -> AddPage();
$pdf -> SetFont('Arial', '', 11);

$cliente = new Cliente();

$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 2, 4.5, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 7.6, 4.5, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 13.2, 4.5, 5.5);

$pdf -> Cell(5.55, 0.5, '', 1, 0, 'L');
$pdf -> Cell(5.6, 0.5, '', 1, 0, 'L');
$pdf -> Cell(5.55, 0.5, '', 1, 1, 'L');

$pdf -> Cell(5.55, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.6, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.55, 4.1, '', 1, 1, 'L');

$pdf -> Cell(5.55, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.6, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.55, 0.8, 'Nome', 1, 1, 'C');

$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 2, 9.4, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 7.6, 9.4, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 13.2, 9.4, 5.5);

$pdf -> Cell(5.55, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.6, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.55, 4.1, '', 1, 1, 'L');

$pdf -> Cell(5.55, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.6, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.55, 0.8, 'Nome', 1, 1, 'C');

$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 2, 14.3, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 7.6, 14.3, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 13.2, 14.3, 5.5);

$pdf -> Cell(5.55, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.6, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.55, 4.1, '', 1, 1, 'L');

$pdf -> Cell(5.55, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.6, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.55, 0.8, 'Nome', 1, 1, 'C');

$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 2, 19.2, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 7.6, 19.2, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 13.2, 19.2, 5.5);

$pdf -> Cell(5.55, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.6, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.55, 4.1, '', 1, 1, 'L');

$pdf -> Cell(5.55, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.6, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.55, 0.8, 'Nome', 1, 1, 'C');

$pdf -> AddPage();

$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 2, 4.5, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/10030.jpg', 7.6, 4.5, 5.5);
$pdf -> Image($cliente -> config -> item('base_url') . 'css/img/img_produto/defu.jpg', 13.2, 4.5, 5.5);

$pdf -> Cell(5.55, 0.5, '', 1, 0, 'L');
$pdf -> Cell(5.6, 0.5, '', 1, 0, 'L');
$pdf -> Cell(5.55, 0.5, '', 1, 1, 'L');

$pdf -> Cell(5.55, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.6, 4.1, '', 1, 0, 'L');
$pdf -> Cell(5.55, 4.1, '', 1, 1, 'L');

$pdf -> Cell(5.55, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.6, 0.8, 'Nome', 1, 0, 'C');
$pdf -> Cell(5.55, 0.8, 'Nome', 1, 1, 'C');

$pdf -> Output();

?>