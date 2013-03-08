<?php
define('FPDF_FONTPATH','../../fpdf/font/');
require('../../fpdf/fpdf.php');

class verVagaPdf extends FPDF{
    function Header(){
        $this->SetFont('helvetica','B',15);
        $this->Image('../../imagens/ipeconPdf.jpg',5,10);
        $this->Cell(40,6,'');
        $this->Cell(160,6,'BANCO DE OPORTUNIDADES', 0, 1, 'C');
        $this->Ln(3);
        $this->Cell(40,6,'');
        $this->Cell(160,6,'Vaga de emprego', 0, 1, 'C');
        $this->Ln(6);
    }
    function conteudo(){
        require_once '../conexaoBdo.inc.php';
        require_once '../class/util.class.php';
        $util = new Util();

        $sql = "select 
                       VAG.ID
                      ,VAG.ID_EMPRESA
                      ,EMP.RAZAO_SOCIAL
                      ,VAG.TITULO
                      ,VAG.DESCRICAO
                      ,VAG.CARGO
                      ,VAG.CARGA_HORARIA
                      ,VAG.ATIVIDADES
                      ,VAG.PERFIL_DESEJADO
                      ,VAG.SALARIO
                      ,VAG.BENEFICIOS
                      ,VAG.DATA_INICIO_VIGENCIA
                      ,VAG.DATA_FINAL_VIGENCIA
                from
                       vagas VAG
                inner join empresas EMP on 
                       EMP.ID = VAG.ID_EMPRESA
                where
                       VAG.ID = ".$_REQUEST['ID_VAGA'];
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $registro = $consulta->fetch(PDO::FETCH_OBJ);

        $this->AddPage();
        
        $this->Cell(200,0,'', 1, 1);
        $this->Ln(10);
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->RAZAO_SOCIAL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Tнtulo: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->TITULO, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Cargo: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->CARGO, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Descriзгo: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,$registro->DESCRICAO, 0, 'J');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Carga horбria: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->CARGA_HORARIA, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Atividades: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,nl2br($registro->ATIVIDADES), 0, 'J');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Perfil desejado: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,nl2br($registro->PERFIL_DESEJADO), 0, 'J');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Salбrio: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,number_format($registro->SALARIO,2,',','.'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Benefнcios: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,nl2br($registro->BENEFICIOS), 0, 'J');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Inнcio de vigкncia: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registro->DATA_INICIO_VIGENCIA, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Final da vigкncia: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registro->DATA_FINAL_VIGENCIA, '-', '/'), 0, 1, 'L');
    }
    
    function Footer(){
        $this->SetY(-15);
        $this->Cell(200,4,' ', 'B', 1);
        $this->SetFont('arial','',7);
        $this->Cell(200,4,'IPECON - Consultoria e Treinamento', 0, 1, 'C');
        $this->Cell(200,4,'Sua pуs-graduaзгo com qualidade.', 0, 1, 'C');
    }
}// Fim classe

$pdf = new verVagaPdf('P','mm','A4'); // Cria um arquivo novo tipo A4, na vertical.
$pdf->Open(); // inicia documento
$pdf->SetLeftMargin(5);
$pdf->SetTopMargin(10);
$pdf->SetAuthor("Regis Andrade"); // Define o autor
$pdf->conteudo();
$pdf->Output();
?>