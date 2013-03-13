<?php
define('FPDF_FONTPATH',$_SERVER['DOCUMENT_ROOT'].'/admin/fpdf/font/');
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/fpdf/fpdf.php';

class GerarCurriculo extends FPDF{
	public $idAluno;
    public $idCurriculo;
	
    function Header(){
        $this->SetFont('helvetica','B',16);
        $this->Cell(200,12,'CURRÍCULO VITAE', 0, 1, 'C');
    }
    function conteudo(){
        global $pdo;
        global $pdoSite;

        require_once $_SERVER['DOCUMENT_ROOT'].'/admin/bcoOportunidade/conexaoBdo.inc.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/admin/bcoOportunidade/class/util.class.php';
		$util = new Util();
		
        $sql = "select
		               ID
		              ,NOME
		              ,SEXO
		              ,ENDERECO
		              ,BAIRRO
		              ,CIDADE
		              ,UF
		              ,CEP
		              ,TELEFONE_FIXO
		              ,TELEFONE_CELULAR
		              ,EMAIL
		              ,DATA_NASCIMENTO
		              ,CIDADE_NASCIMENTO
		              ,UF_NASCIMENTO
		              ,ESTADO_CIVIL
		              ,RG
		              ,ORGAO_EXPEDIDOR
		              ,DATA_EXPEDICAO_RG
		              ,CPF
		              ,CARTEIRA_RESERVISTA
		              ,PIS_PASEP
		              ,DATA_CADASTRO_PIS_PASEP
		              ,TITULO_ELEITOR
		              ,ZONA
		              ,SECAO
		              ,HABILITACAO
		              ,CATEGORIA
		              ,VALIDADE
		              ,AREA_INTERESSE
		              ,OBJETIVO_PROFISSIONAL
		              ,DISPONIBILIDADE_HORARIO
		              ,MSN
		              ,TWITTER
		              ,FACEBOOK
                      ,NOME_EMPRESA_1
                      ,ATIVIDADE_EMPRESA_1
                      ,DATA_ADMISSAO_1
                      ,DATA_DEMISSAO_1
                      ,FUNCAO_EXERCIDA_1
                      ,ATIVIDADE_EXERCIDA_1
                      ,SALARIO_1
                      ,NOME_EMPRESA_2
                      ,ATIVIDADE_EMPRESA_2
                      ,DATA_ADMISSAO_2
                      ,DATA_DEMISSAO_2
                      ,FUNCAO_EXERCIDA_2
                      ,ATIVIDADE_EXERCIDA_2
                      ,SALARIO_2
		        from
		               curriculos
		        where \n";
        if($this->idCurriculo){
            $sql .= " ID = ?";
        }elseif ($this->idAluno) {
            $sql .= " CPF = ?";
        }

        $consulta = $pdo->prepare($sql);

        if($this->idCurriculo){
            $consulta->bindParam(1, $this->idCurriculo, PDO::PARAM_INT);
        }elseif ($this->idAluno) {
            $consulta->bindParam(1, $this->idAluno, PDO::PARAM_STR, 11);
        }

        $consulta->execute();
        $registro = $consulta->fetch(PDO::FETCH_OBJ);
                
        $this->Cell(200,0,'', 1, 1);
        $this->Ln(10);
        $this->SetFont('helvetica','B',13);
        $this->Cell(200,7,'DADOS PESSOAIS', 'B', 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Nome: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,iconv('utf-8','iso-8859-1',$registro->NOME), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Sexo: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,($registro->SEXO == 'M' ? 'Masculino' : ($registro->SEXO == 'F' ? 'Feminino' : '')), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Data Nascimento: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registro->DATA_NASCIMENTO, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Natural: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,iconv('utf-8','iso-8859-1',$registro->CIDADE_NASCIMENTO).' / '.$registro->CIDADE_NASCIMENTO, 0, 1, 'L');

		$this->SetFont('helvetica','B',13);
        $this->Cell(200,7,'Documentos: ', 'B', 1, 'L');

        $this->SetFont('helvetica','',11);
        $this->Cell(35,7,'RG: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->RG, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,iconv('utf-8','iso-8859-1','OrgÃ£o Expedidor: '), 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->ORGAO_EXPEDIDOR, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,iconv('utf-8','iso-8859-1','Data ExpediÃ§Ã£o: '), 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registro->DATA_EXPEDICAO_RG, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'CPF: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->CPF, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Estado Civil: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->ESTADO_CIVIL, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,iconv('utf-8','iso-8859-1','EndereÃ§o: '), 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,iconv('utf-8','iso-8859-1',$registro->ENDERECO), 0, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Bairro: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,iconv('utf-8','iso-8859-1',$registro->BAIRRO), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Cidade: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,iconv('utf-8','iso-8859-1',$registro->CIDADE).' / '.$registro->UF, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'CEP: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->CEP, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Telefone Fixo: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->TELEFONE_FIXO, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Telefone Celular: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->TELEFONE_CELULAR, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'e-Mail: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->EMAIL, 0, 1, 'L');

        if($registro->SEXO == 'M'){
            $this->SetFont('helvetica','B',11);
            $this->Cell(35,7,'Reservista: ', 0, 0, 'L');
            $this->SetFont('helvetica','',11);
            $this->Cell(165,7,$registro->CARTEIRA_RESERVISTA, 0, 1, 'L');
        }
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'PIS/PASEP: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->PIS_PASEP, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Data Cadastro PIS/PASEP: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registro->DATA_CADASTRO_PIS_PASEP, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,iconv('utf-8','iso-8859-1','TÃ­tulo Eleitor: '), 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->TITULO_ELEITOR.' Zona: '.$registro->ZONA.iconv('utf-8','iso-8859-1',' SeÃ§Ã£o: ').$registro->SECAO, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,iconv('utf-8','iso-8859-1','Habilitação: '), 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registro->HABILITACAO.' Categoria: '.$registro->CATEGORIA.' Validade: '.Util::formataData($registro->VALIDADE, '-', '/'), 0, 1, 'L');

        $this->Ln(5);

        $this->SetFont('helvetica','B',13);
        $this->Cell(200,7,'OBJETIVO', 'B', 1, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,iconv('utf-8','iso-8859-1',$registro->OBJETIVO_PROFISSIONAL), 0, 'L');

        $this->Ln(5);

        $this->SetFont('helvetica','B',13);
        $this->Cell(200,7,'ÁREA DE INTERESSE', 'B', 1, 'L');
        $this->SetFont('helvetica','',11);
        $this->MultiCell(165,7,iconv('utf-8','iso-8859-1',$registro->AREA_INTERESSE), 0, 'L');

        $this->Ln(5);

        $this->SetFont('helvetica','B',13);
        $this->Cell(200,7,iconv('utf-8','iso-8859-1','FORMAÇÃO'), 'B', 1, 'L');
        
        unset($sql,$consulta);
        $sql = "SELECT * FROM graduacao WHERE Id_Numero = ?";
        $consulta = $pdoSite->prepare($sql);
        $consulta->bindParam(1, $this->idAluno, PDO::PARAM_STR, 11);        
        $consulta->execute();
        $registroGraduacao = $consulta->fetch(PDO::FETCH_OBJ);
        
        
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Curso: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registroGraduacao->Curso_Graduacao, 0, 0, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,iconv('utf-8','iso-8859-1','Instituição: '), 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registroGraduacao->Instituicao.' - '.$registroGraduacao->Sigla, 0, 0, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,iconv('utf-8','iso-8859-1','Conclusão: '), 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registroGraduacao->Ano_Conclusao, 0, 1, 'L');

        $this->Ln(5);

        $this->SetFont('helvetica','B',13);
        $this->Cell(200,7,iconv('utf-8','iso-8859-1','EXPERIÊNCIA PROFISSIONAL'), 'B', 1, 'L');
        $this->SetFont('helvetica','B',12);
        $this->Cell(200,7,iconv('utf-8','iso-8859-1','Última empresa'), 'B', 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registroExperiencia->NOME_EMPRESA_1, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Atividade da empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,nl2br($registroExperiencia->ATIVIDADE_EMPRESA_1), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Data admissão: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registroExperiencia->DATA_ADMISSAO_1, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Data demissão: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registroExperiencia->DATA_DEMISSAO_1, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Função que exercia: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registroExperiencia->FUNCAO_EXERCIDA_1, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Atividades que exercia: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,nl2br($registroExperiencia->ATIVIDADES_EXERCIDAS_1), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Salário: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,number_format($registroExperiencia->SALARIO_1,2,',','.'), 0, 1, 'L');

        $this->Ln(3);

        $this->SetFont('helvetica','B',12);
        $this->Cell(200,7,iconv('utf-8','iso-8859-1','Penúltima empresa'), 'B', 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registroExperiencia->NOME_EMPRESA_2, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Atividade da empresa: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,nl2br($registroExperiencia->ATIVIDADE_EMPRESA_2), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Data admissão: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registroExperiencia->DATA_ADMISSAO_2, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Data demissão: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,Util::formataData($registroExperiencia->DATA_DEMISSAO_2, '-', '/'), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Função que exercia: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,$registroExperiencia->FUNCAO_EXERCIDA_2, 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Atividades que exercia: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,nl2br($registroExperiencia->ATIVIDADES_EXERCIDAS_2), 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(35,7,'Salário: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(165,7,number_format($registroExperiencia->SALARIO_2,2,',','.'), 0, 1, 'L');

    }// Fim função conteudo

}// Fim classe
?>