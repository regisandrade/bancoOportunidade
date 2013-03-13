<?php
/* Conexao */
require_once '../conexaoBdo.inc.php';
require_once '../class/util.class.php';
$util = new Util();

/* Tipo de Acao
 * 1 - Incluir
 * 2 - Alterar
 * 3 - Excluir
 * 4 - Alterar status
 */
$resposta = array();
switch ($_REQUEST['tipoAcao']) {
	case '1':
	    try {
            $sql = "insert into
                    vagas(
                            ID_EMPRESA
                           ,TITULO
                           ,DESCRICAO
                           ,CARGO
                           ,CARGA_HORARIA
                           ,ATIVIDADES
                           ,PERFIL_DESEJADO
                           ,SALARIO
                           ,BENEFICIOS
                           ,DATA_CADASTRO
                           ,DATA_INICIO_VIGENCIA
                           ,DATA_FINAL_VIGENCIA
                           ,STATUS
                    ) values (
                           :idEmpresa
                          ,:titulo
                          ,:descricao
                          ,:cargo
                          ,:cargaHoraria
                          ,:atividades
                          ,:perfilDesejado
                          ,:salario
                          ,:beneficios
                          ,:dataCadastro
                          ,:dataInicioVigencia
                          ,:dataFinalVigencia
                          ,:status)";
            $rs = $pdo->prepare($sql);

            $dtInicio = Util::formataData($_REQUEST['dtInicioVigencia'],'/','-','USA');
            $dtFinal = Util::formataData($_REQUEST['dtFinalVigencia'],'/','-','USA');
            /* @var $salario float */
            $salario = str_replace(',','.',str_replace('.','',$_REQUEST['salario']));

            $count = $rs->execute(array(':idEmpresa'=>$_REQUEST['idEmpresa'],
                                        ':titulo'=>$_REQUEST['titulo'],
                                        ':descricao'=>$_REQUEST['descricao'],
                                        ':cargo'=>$_REQUEST['cargo'],
                                        ':cargaHoraria'=>$_REQUEST['cargaHoraria'],
                                        ':atividades'=>$_REQUEST['atividade'],
                                        ':perfilDesejado'=>$_REQUEST['perfilDesejado'],
                                        ':salario'=>$salario,
                                        ':beneficios'=>$_REQUEST['beneficio'],
                                        ':dataCadastro'=>date('Y-m-d'),
                                        ':dataInicioVigencia'=>$dtInicio,
                                        ':dataFinalVigencia'=>$dtFinal.' 23:59:59',
                                        ':status'=>'I'));
            if($count === false){
              $resposta['msgResposta'] = "Erro ao gravar os dados da vaga.";
              $resposta['caminho']     = "cadVaga.php";
              $resposta['sucesso']     = false;
            }else{
              /* Enviar e-mail para o ipecon */
              $param['html']      = true;
              $param['nomePara']  = 'IPECON';
              $param['emailPara'] = 'ipecon@ipecon.com.br';
              $param['assunto']   = "[N�o responder] Vaga cadastrada no banco de oportunidade.";
              $msgHtml = "<html>
                            <head>
                                <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
                                <meta content=\"text/html;charset=ISO-8859-1\" http-equiv=\"Content-Type\" />
                            </head>
                            <body>
                                    <h2 align=\"center\">Vaga - Banco de Oportunidades</h2>
                                    <hr>
                                    <table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                    <td width=\"20%\" height=\"20px\"><strong>T�tulo:</strong><td>
                                                    <td>".utf8_decode($_REQUEST['titulo'])."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Descri��o:</strong><td>
                                                    <td>".nl2br(utf8_decode($_REQUEST['descricao']))."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Cargo:</strong><td>
                                                    <td>".utf8_decode($_REQUEST['cargo'])."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Carga Hor�ria:</strong><td>
                                                    <td>".$_REQUEST['cargaHoraria']."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Atividades:</strong><td>
                                                    <td>".nl2br(utf8_decode($_REQUEST['atividade']))."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Perfil desejado:</strong><td>
                                                    <td>".nl2br(utf8_decode($_REQUEST['perfilDesejado']))."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Sal�rio:</strong><td>
                                                    <td>".$_REQUEST['salario']."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Benef�cio:</strong><td>
                                                    <td>".nl2br(utf8_decode($_REQUEST['beneficio']))."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>In�cio de vig�ncia:</strong><td>
                                                    <td>".$_REQUEST['dtInicioVigencia']."<td>
                                            </tr>
                                            <tr>
                                                    <td height=\"20px\"><strong>Final de vig�ncia:</strong><td>
                                                    <td>".$_REQUEST['dtFinalVigencia']."<td>
                                            </tr>
                                    </table>
                                    <hr>
                            </body>
                            </html>";
              $param['mensagem']  = $msgHtml;

              if(!$util->enviarEmail($param)){
                  $resposta['msgRespostaEmail'] = "E-mail n�o foi enviado.";
              }

              $resposta['msgResposta'] = "Vaga cadastrada com sucesso.";
              $resposta['caminho']     = "cadVaga.php";
              $resposta['sucesso']     = true;
            }
        } catch (Exception $e) {
          $resposta['msgResposta'] = $e->getMessage();
          $resposta['sucesso']    = false;
        }
        break;
    case '2':
	    try {
            $sql = "update
                           vagas
                    set
                           ID_EMPRESA           = ?
                          ,TITULO               = ?
                          ,DESCRICAO            = ?
                          ,CARGO                = ?
                          ,CARGA_HORARIA        = ?
                          ,ATIVIDADES           = ?
                          ,PERFIL_DESEJADO      = ?
                          ,SALARIO              = ?
                          ,BENEFICIOS           = ?
                          ,DATA_INICIO_VIGENCIA = ?
                          ,DATA_FINAL_VIGENCIA  = ?
                    where
                           ID = ?";
            $rs = $pdo->prepare($sql);

            $dtInicio = Util::formataData($_REQUEST['dtInicioVigencia'],'/','-','USA');
            $dtFinal = Util::formataData($_REQUEST['dtFinalVigencia'],'/','-','USA');
            /* @var $salario float */
            $salario = str_replace(',','.',str_replace('.','',$_REQUEST['salario']));

            $count = $rs->execute(array($_REQUEST['idEmpresa']
                                       ,$_REQUEST['titulo']
                                       ,$_REQUEST['descricao']
                                       ,$_REQUEST['cargo']
                                       ,$_REQUEST['cargaHoraria']
                                       ,$_REQUEST['atividade']
                                       ,$_REQUEST['perfilDesejado']
                                       ,$salario
                                       ,$_REQUEST['beneficio']
                                       ,$dtInicio
                                       ,$dtFinal
                                       ,$_REQUEST['idVaga']));

            if($count === false){
              $resposta['msgResposta'] = "Erro ao alterar os dados da vaga.";
              $resposta['caminho']     = "cadVaga.php";
              $resposta['sucesso']     = false;
            }else{
              $resposta['msgResposta'] = "Vaga alterada com sucesso.";
              $resposta['caminho']     = "listVaga.php";
              $resposta['sucesso']     = true;
            }
	    } catch (Exception $e) {
	    	$resposta['msgResposta'] = $e->getMessage();
        $resposta['sucesso']     = false;
	    }
		break;

    case '3':
        try {
            $sql = "delete from vagas where ID = ?";
            $rs = $pdo->prepare($sql);
            $count = $rs->execute(array($_REQUEST['idVaga']));

            if($count === false){
              $resposta['msgResposta'] = "Erro ao excluir a vaga.";
              $resposta['caminho']     = "listVaga.php";
              $resposta['sucesso']     = false;
            }else{
              $resposta['msgResposta'] = "Vaga exclu&iacute;da com sucesso.";
              $resposta['caminho']     = "listVaga.php";
              $resposta['sucesso']     = true;
            }
        } catch (Exception $e) {
            $resposta['msgResposta'] = $e->getMessage();
            $resposta['sucesso']     = false;
        }
        break;

    case '4':
        try {
            $sql = "update vagas set STATUS = ? where ID = ?";
            $rs = $pdo->prepare($sql);
            $count = $rs->execute(array($_REQUEST['status']
                                       ,$_REQUEST['idVaga']));

            if($count === false){
                $resposta['msgResposta'] = "Erro ao alterar o status da vaga.";
                $resposta['caminho']     = "listVaga.php";
                $resposta['sucesso']     = false;
            }else{
                if($_REQUEST['status'] == 'A'){
                  /* Enviar e-mail para a empresa */

                  /* Consultar os dados da vaga */
                  $sql = "select
                                 VAG.*
                                ,EMP.RAZAO_SOCIAL
                                ,EMP.REPRESENTANTE_LEGAL
                                ,EMP.EMAIL
                          from
                                 vagas VAG
                          inner join empresas EMP on
                                 EMP.ID = VAG.ID_EMPRESA
                          where
                                 VAG.ID = ".$_REQUEST['idVaga'];
                  $consulta = $pdo->prepare($sql);
                  $consulta->execute();
                  $registro = $consulta->fetch(PDO::FETCH_OBJ);

                  //$util->enviarEmail($param);
                  $param['html']      = true;
                  //$param['nomePara']  = $registro->RAZAO_SOCIAL;
                  //$param['emailPara'] = $registro->EMAIL;
                  $param['nomePara']  = 'Regis';
              	  $param['emailPara'] = 'regisandrade@gmail.com';
                  $param['assunto']   = "[N�o responder] Vaga aceita no banco de oportunidade - IPECON.";
                  $msgHtml = "<html>
                                <head>
                                  <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
                                  <meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\" />
                                </head>
                                <body>
                                  <h2 align=\"center\">Banco de Oportunidades<br>Vaga Aprovada</h2>
                                  <hr/>
                                  <p>Sua vaga:".$registro->TITULO." foi aprovada pelo IPECON, a mesma j� esta dispon�vel para os alunos.</p>
                                  <p><strong>Inicio de Vig�ncia:</strong> ".$registro->DATA_INICIO_VIGENCIA." � ".$registro->DATA_FINAL_VIGENCIA."</p>
                                  <br/>
                                  <p>Obrigado,<br>IPECON - Ensino e Consultoria Ltda</p>
                                </body>
                              </html>";
                  $param['mensagem']  = $msgHtml;
                  if(!$util->enviarEmail($param)){
                    $resposta['msgRespostaEmail'] = "E-mail n�o foi enviado.";
                  }
                }
                $resposta['msgResposta'] = "Vaga ".($_REQUEST['status'] == 'A' ? 'ativada' : '')." com sucesso!";
                $resposta['caminho']     = "listVaga.php";
                $resposta['sucesso']     = true;
            }
        } catch (Exception $e) {
              $resposta['msgResposta'] = $e->getMessage();
              $resposta['sucesso']     = false;
        }
        break;
}
echo json_encode($resposta);
?>