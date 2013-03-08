<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/bcoOportunidade/class/GerarCurriculo.class.php';

$pdf = new GerarCurriculo('P','mm','A4');
$pdf->idCurriculo = $_REQUEST['ID_CURRICULO'];
$pdf->Open(); // inicia documento
$pdf->SetLeftMargin(5);
$pdf->SetTopMargin(10);
$pdf->SetAuthor("Regis Andrade"); // Define o autor
$pdf->conteudo();
$pdf->Output();
?>