<?php

define('FPDF_FONTPATH','../../fpdf/font/');
require('../../fpdf/fpdf.php');

class verVagaPdf extends FPDF{
    
    private $nomeArquivo;
    
    function Header(){
        $this->SetFont('helvetica','B',15);
        $this->Image('../../imagens/ipeconPdf.jpg',5,10);
        $this->Cell(40,6,'');
        $this->Cell(160,6,'BANCO DE OPORTUNIDADES', 0, 1, 'C');
        $this->Ln(3);
        $this->Cell(40,6,'');
        $this->Cell(160,6,'Informações da empresa', 0, 1, 'C');
        $this->Ln(6);
    }
    function conteudo(){
        require_once '../conexaoBdo.inc.php';
        require_once '../class/util.class.php';
        $util = new Util();

        $sql = "select 
               *
        from
               empresas
        where
               ID = ".$_REQUEST['idEmpresa'];
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $registro = $consulta->fetch(PDO::FETCH_OBJ);
        
        $this->nomeArquivo = "pdf_".$registro->RAZAO_SOCIAL.".pdf";
        $this->AddPage();
        
        $this->Cell(200,0,'', 1, 1);
        $this->Ln(10);
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'CNPJ: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->CNPJ, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,iconv('UTF-8', 'ISO-8859-1', $registro->RAZAO_SOCIAL), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Nome Fantasia: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->NOME_FANTASIA, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Endereço: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,$registro->ENDERECO, 0, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Bairro: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->BAIRRO, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Cidade: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->CIDADE.' / '.$registro->UF, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'CEP: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->CEP, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Telefone Comercial: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->TELEFONE_COMERCIAL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Fax: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->TELEFONE_FAX, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Representante Legal: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->REPRESENTANTE_LEGAL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'RG representante legal: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->RG_REPRESENTANTE_LEGAL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Orgão expedidor: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'CPF: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->CPF_REPRESENTANTE_LEGAL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Cargo: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->CARGO_REPRESENTANTE_LEGAL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'E-mail: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->EMAIL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Tipo de empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->TIPO_EMPRESA, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Porte da empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->PORTE, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Benefícios: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->BENEFICIOS_DISPONIVEIS, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Horário a ser cumprido: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->HORARIO_SER_CUMPRIDO, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Horas diárias: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->HORAS_DIARIAS, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(45,7,'Horas semanais: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(155,7,$registro->HORAS_SEMANAIS, 0, 1, 'L');
        //$this->Ln(10);
        //$this->Cell(200,0,'', 1, 1);
    }
    
    function Footer(){
        $this->SetY(-15);
        $this->Cell(200,4,' ', 'B', 1);
        $this->SetFont('arial','',7);
        $this->Cell(200,4,'IPECON - Consultoria e Treinamento', 0, 1, 'C');
        $this->Cell(200,4,'Sua pós-graduação com qualidade.', 0, 1, 'C');
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