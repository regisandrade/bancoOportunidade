<?php
/********************************************************************************
*  InstruÃ§Ãµes                                                                   *
*  ----------                                                                   *
*  1. Registrar na tabela aluno_x_vaga a opÃ§Ã£o do aluno (id_aluno e id_vaga);  *
*  2. Gerar o currÃ­culo e gravar na pasta /temp o arquivo .pdf                 *
*     Nome do arquivo: curriculo_nomeAluno.pdf;                                    *
*  3. Enviar um e-mail a empresa com currÃ­culo em anexo;                       *
*  4. Excluir o curriculo do aluno da pasta /temp;                             *
*  5. Enviar um e-mail para o IPECON informando que o aluno (X) enviou o       *
*      curriculo para a empresa (Z).                                            *
*********************************************************************************/
// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";
// die;

require_once $_SERVER['DOCUMENT_ROOT'].'/admin/bcoOportunidade/class/GerarCurriculo.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/bcoOportunidade/conexaoBdo.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/bcoOportunidade/class/util.class.php';
$util = new Util();

try {
	// Verificar se o aluno já se candidatou a vaga selecionada
	$sql = "select 
	 		       count(*) QTDE  
	 		from 
	 		       aluno_x_vaga  
	 		where 
	 		       ID_ALUNO = ?  
	 		   and ID_VAGA  = ?";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1, $_REQUEST['idAluno'], PDO::PARAM_STR, 11);
    $consulta->bindParam(2, $_REQUEST['idVaga'], PDO::PARAM_INT);
    $consulta->execute();
    $registro = $consulta->fetch(PDO::FETCH_OBJ);
    $registro->QTDE = 0;

	if($registro->QTDE > 0){
		$resposta['msgResposta'] = utf8_encode("Atenção, você ja se candidatou a esta vaga.<br>Obrigado.");
	    $resposta['caminho']     = "home.php?pag=15";
	    $resposta['sucesso']     = false;
	}else{
		$resposta['sucesso']    = true;
		
		// 1º) Gravar dados
		$sql = "INSERT INTO aluno_x_vaga (ID_ALUNO,ID_VAGA) VALUES (?,?)";
		$consulta = $pdo->prepare($sql);
		$consulta->bindValue(1, $_REQUEST['idAluno'], PDO::PARAM_STR);
		$consulta->bindValue(2, $_REQUEST['idVaga'], PDO::PARAM_INT);
		$consulta->execute();

		if($count === false){
		    $resposta['msgResposta'] = "Erro ao gravar os dados que relaciona a vaga ao aluno.";
		    $resposta['caminho']     = "home.php?pag=15";
		    $resposta['sucesso']     = false;
		}

		// 2. Gerar curriculo e gravar em uma pasta temporaria [temp/]
		$pdf = new GerarCurriculo('P','mm','A4');
		$pdf->idAluno = $_REQUEST['idAluno'];
		$pdf->AddPage();
		$pdf->SetAuthor("Regis Andrade");
		$pdf->conteudo();
		$arquivo = "../../../admin/bcoOportunidade/bcoCurriculo/temp/curriculo_".rand().".pdf";
		$pdf->Output($arquivo,"F");

		// 3. Enviar e-mail para empresa
		$sql = "select
		             VAG.*
		            ,EMP.RAZAO_SOCIAL
		            ,EMP.REPRESENTANTE_LEGAL
		            ,EMP.EMAIL AS EMAIL_EMPRESA
		            ,CUR.NOME
		            ,CUR.EMAIL AS EMAIL_ALUNO
		      from
		             vagas VAG
		      inner join empresas EMP on
		             EMP.ID = VAG.ID_EMPRESA
		      inner join aluno_x_vaga AV on
		             AV.ID_VAGA = VAG.ID
		      inner join curriculos CUR on
		             CUR.CPF = AV.ID_ALUNO
		      where
		             VAG.ID = ?";
		$consulta = $pdo->prepare($sql);
	    $consulta->bindParam(1, $_REQUEST['idVaga'], PDO::PARAM_INT);
	    $consulta->execute();
		$registro = $consulta->fetch(PDO::FETCH_OBJ);

		$param['html']      = true;
		//$param['nomePara']  = $registro->RAZAO_SOCIAL;
		//$param['emailPara'] = $registro->EMAIL_EMPRESA;
		$param['nomePara']  = "Regis Andrade";
		$param['emailPara'] = "regisandrade@gmail.com";
		//$param['replayTo']  = $registro->EMAIL_ALUNO;
		$param['assunto']   = "[Não responder] Currículo enviado através do banco de oportunidade - IPECON.";
		$msgHtml = "<html>
		            <head>
		              <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
		              <meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\" />
		            </head>
		            <body>
		              <h2 align=\"center\">Banco de Oportunidades<br>Currí­culo</h2>
		              <hr/>
		              <p>Um novo Currículo foi enviado através do Sistema de Banco de Oportunidades do IPECON.<br><br>
		                 O(A) aluno(a):&nbsp;<strong>".$registro->NOME."</strong>, esta se candidatando a vaga de <strong><i>".$registro->TITULO."</i></strong>.</p>
		              <br/>
		              <p>Obrigado,<br>IPECON - Ensino e Consultoria Ltda</p>
		              <p>Qualquer dúvida, por favor, entrar em contato com IPECON pelo e-mail <a href=\"mailto:ipecon@ipecon.com.br\">ipecon@ipecon.com.br</a> ou telefones: (62) 3214-3229 ou 3214-2563</p>
		            </body>
		          </html>";
		$param['mensagem']  = utf8_encode($msgHtml);

		/* Verificar se o arquivo existe para anexar ao e-mail */
		if(file_exists($arquivo)){
			$param['anexo']     = true;
			$param['arquivo']   = $arquivo;
		}
		

		if(!$util->enviarEmail($param)){
			$resposta['msgRespostaEmail_1'] = utf8_encode("E-mail não foi enviado para empresa.");
			$resposta['sucesso']          = false;
			$resposta['email_1']          = 'email 1';
		}
		unset($param);

		// 4. Excluir aquivo do curriculo
		if(file_exists($arquivo)){
			unlink($arquivo);
		}

		// 5. Enviar e-mail para o IPECON
		$param['html']      = true;
		//$param['nomePara']  = "IPECON";
		//$param['emailPara'] = "ipecon@ipecon.com.br";
		$param['nomePara']  = "Regis Andrade";
		$param['emailPara'] = "regisandrade@gmail.com";
		$param['assunto']   = "[Não responder] Currí­culo enviado para empresa: ".$registro->RAZAO_SOCIAL." através do Banco de Oportunidade";
		$msgHtml = "<html>
		            <head>
		              <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
		              <meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\" />
		            </head>
		            <body>
		              <h2 align=\"center\">Banco de Oportunidades<br>Currículo enviado</h2>
		              <hr/>
		              <p>O aluno(a):&nbsp;<strong>".$registro->NOME."</strong>, enviou seu currí­culo para empresa: <strong>".$registro->RAZAO_SOCIAL."</strong>.</p>
		            </body>
		          </html>";
		$param['mensagem']  = utf8_encode($msgHtml);
		$param['anexo']     = false;
		if(!$util->enviarEmail($param)){
			$resposta['msgRespostaEmail_2'] = utf8_encode("E-mail não foi enviado para IPECON.");
			$resposta['sucesso']          = false;
			$resposta['email_2']          = 'email 2';
		}
	}
} catch (Exception $e) {
	$resposta['msgResposta'] = $e->getMessage();
    $resposta['sucesso']    = false;
}

$pdo = null;
echo json_encode($resposta);
?>