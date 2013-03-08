<?php
/* Conexao */
require_once '../conexaoBdo.inc.php';
require_once '../class/util.class.php';
$util = new Util();

/* Tipo de Acao
 * 1 - Incluir
 * 2 - Alterar
 * 3 - Excluir
 * 4 - Alterar senha
 * 5 - Aprovar empresa
 */
$resposta = array();

switch ($_REQUEST['tipoAcao']) {

	case '1':
	    try {
          $sql = "insert into
                         empresas
                  (
                       CNPJ
                      ,NOME_FANTASIA
                      ,RAZAO_SOCIAL
                      ,ENDERECO
                      ,BAIRRO
                      ,CIDADE
                      ,UF
                      ,CEP
                      ,TELEFONE_COMERCIAL
                      ,TELEFONE_FAX
                      ,TELEFONE_CELULAR
                      ,REPRESENTANTE_LEGAL
                      ,RG_REPRESENTANTE_LEGAL
                      ,ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL
                      ,CPF_REPRESENTANTE_LEGAL
                      ,CARGO_REPRESENTANTE_LEGAL
                      ,EMAIL_REPRESENTANTE_LEGAL
                      ,TIPO_EMPRESA
                      ,PORTE
                      ,BENEFICIOS_DISPONIVEIS
                      ,HORARIO_SER_CUMPRIDO
                      ,HORAS_DIARIAS
                      ,HORAS_SEMANAIS
                      ,DATA_CADASTRO
                      ,EMAIL
                      ,SENHA
                      ,LOCAL_CADASTRO
                      ,STATUS)
                  values (
                         :cnpj
                        ,:nome_fantasia
                        ,:razao_social
                        ,:endereco
                        ,:bairro
                        ,:cidade
                        ,:uf
                        ,:cep
                        ,:telefone_comercial
                        ,:telefone_fax
                        ,:telefone_celular
                        ,:representante_legal
                        ,:rg_representante_legal
                        ,:orgao_expedidor_representante_legal
                        ,:cpf_representante_legal
                        ,:cargo_representante_legal
                        ,:email
                        ,:tipo_empresa
                        ,:porte
                        ,:beneficios_disponiveis
                        ,:horario_ser_cumprido
                        ,:horas_diarias
                        ,:horas_semanais
                        ,:data_cadastro
                        ,:email
                        ,:senha
                        ,:local_cadastro
                        ,:status)";

          $rs = $pdo->prepare($sql);
          $count = $rs->execute(array(':cnpj'=>$_REQUEST['cnpj'],
                                  ':nome_fantasia'=>$_REQUEST['nomeFantasia'],
                                  ':razao_social'=>$_REQUEST['razaoSocial'],
                                  ':endereco'=>$_REQUEST['endereco'],
                                  ':bairro'=>$_REQUEST['bairro'],
                                  ':cidade'=>$_REQUEST['cidade'],
                                  ':uf'=>$_REQUEST['uf'],
                                  ':cep'=>$_REQUEST['cep'],
                                  ':telefone_comercial'=>$_REQUEST['telefoneComercial'],
                                  ':telefone_fax'=>$_REQUEST['telefoneFax'],
                                  ':telefone_celular'=>$_REQUEST['telefoneCelular'],
                                  ':representante_legal'=>$_REQUEST['representanteLegal'],
                                  ':rg_representante_legal'=>$_REQUEST['rg'],
                                  ':orgao_expedidor_representante_legal'=>$_REQUEST['orgaoExpedidor'],
                                  ':cpf_representante_legal'=>$_REQUEST['cpf'],
                                  ':cargo_representante_legal'=>$_REQUEST['cargo'],
                                  ':tipo_empresa'=>$_REQUEST['tipoEmpresa'],
                                  ':porte'=>$_REQUEST['porteEmpresa'],
                                  ':beneficios_disponiveis'=>$_REQUEST['beneficio'],
                                  ':horario_ser_cumprido'=>$_REQUEST['horarioSerCumprido'],
                                  ':horas_diarias'=>$_REQUEST['horasDiaria'],
                                  ':horas_semanais'=>$_REQUEST['horasSemanais'],
                                  ':data_cadastro'=>date('Y-m-d'),
                                  ':email'=>$_REQUEST['email'],
                                  ':senha'=>$_REQUEST['senha'],
                                  ':local_cadastro'=>$_REQUEST['localCadastro'],
                                  ':status'=>$_REQUEST['status']));

          if($count === false){
              $resposta['msgResposta'] = "Erro ao gravar os dados da empresa.";
              $resposta['caminho']     = "cadEmpresa.php";
              $resposta['sucesso']     = false;
          }else{
              /* Enviar e-mail para o ipecon */
              $param['html']      = true;
              $param['nomePara']  = "IPECON";
              $param['emailPara'] = "ipecon@ipecon.com.br";
              $param['assunto']   = "[Não responder] Empresa cadastrada no banco de oportunidade";
              $msgHtml = "<html>
                            <head>
                              <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
                              <meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\" />
                            </head>
                            <body>
                              <h2 align=\"center\">Banco de Oportunidades</h2>
                              <hr/>
                              <p>Mais uma empresa cadastrada no banco de oportunidade:</p>
                              <p><strong>Empresa:</strong> ".$_REQUEST['razaoSocial']."<br/>
                              <strong>Cidade:</strong> ".$_REQUEST['cidade']."<br/>
                              <strong>Telefone comercial:</strong> ".$_REQUEST['telefoneComercial']."</p>
                            </body>
                          </html>";
              $param['mensagem']  = $msgHtml;

              if(!$util->enviarEmail($param)){
                  $resposta['msgRespostaEmail'] = "E-mail não foi enviado.";
              }

              $resposta['msgResposta'] = "Empresa cadastrada com sucesso.";
              $resposta['caminho']     = "listEmpresas.php";
              $resposta['sucesso']     = true;
          }
	    } catch (Exception $e) {
        $resposta['msgResposta'] = $e->getMessage();
        $resposta['sucesso']    = false;
	    }
      $pdo = null;
      echo json_encode($resposta);
		  break;

	case '2':
	    try {

          $sql = "update
                         empresas
                  set
                         CNPJ                                = '".$_REQUEST['cnpj']."'
                        ,NOME_FANTASIA                       = '".$_REQUEST['nomeFantasia']."'
                        ,RAZAO_SOCIAL                        = '".$_REQUEST['razaoSocial']."'
                        ,ENDERECO                            = '".$_REQUEST['endereco']."'
                        ,BAIRRO                              = '".$_REQUEST['bairro']."'
                        ,CIDADE                              = '".$_REQUEST['cidade']."'
                        ,UF                                  = '".$_REQUEST['uf']."'
                        ,CEP                                 = '".$_REQUEST['cep']."'
                        ,TELEFONE_COMERCIAL                  = '".$_REQUEST['telefoneComercial']."'
                        ,TELEFONE_FAX                        = '".$_REQUEST['telefoneFax']."'
                        ,TELEFONE_CELULAR                    = '".$_REQUEST['telefoneCelular']."'
                        ,REPRESENTANTE_LEGAL                 = '".$_REQUEST['representanteLegal']."'
                        ,RG_REPRESENTANTE_LEGAL              = '".$_REQUEST['rg']."'
                        ,ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL = '".$_REQUEST['orgaoExpedidor']."'
                        ,CPF_REPRESENTANTE_LEGAL             = '".$_REQUEST['cpf']."'
                        ,CARGO_REPRESENTANTE_LEGAL           = '".$_REQUEST['cargo']."'
                        ,EMAIL_REPRESENTANTE_LEGAL           = '".$_REQUEST['email']."'
                        ,TIPO_EMPRESA                        = '".$_REQUEST['tipoEmpresa']."'
                        ,PORTE                               = '".$_REQUEST['porteEmpresa']."'
                        ,BENEFICIOS_DISPONIVEIS              = '".$_REQUEST['beneficio']."'
                        ,HORARIO_SER_CUMPRIDO                = '".$_REQUEST['horarioSerCumprido']."'
                        ,HORAS_DIARIAS                       = '".$_REQUEST['horasDiaria']."'
                        ,HORAS_SEMANAIS                      = '".$_REQUEST['horasSemanais']."'
                        ,EMAIL                               = '".$_REQUEST['email']."'
                  where
                         ID = ".$_REQUEST['idEmpresa'];

          $count = $pdo->exec($sql);

          if($count === false){
              $resposta['msgResposta'] = "Erro ao alterar os dados da empresa.";
              $resposta['caminho']     = "cadEmpresa.php";
              $resposta['sucesso']     = false;
          }else{
              $resposta['msgResposta'] = "Dados da empresa alterado com sucesso.";
              $resposta['caminho']     = "listEmpresas.php";
              $resposta['sucesso']     = true;
          }
      } catch (Exception $e) {
          $resposta['msgResposta'] = $e->getMessage();
          $resposta['sucesso']     = false;
      }
      $pdo = null;
      echo json_encode($resposta);
      break;

    case '3':
        try {

            $sql = "delete from empresas where ID = ".$_REQUEST['id'];
            $count = $rs->exec($sql);

            if($count === false){
                $resposta['msgResposta'] = "Erro ao excluir a empresa.";
                $resposta['caminho']     = "listEmpresas.php";
                $resposta['sucesso']     = false;
            }else{
                $resposta['msgResposta'] = "Empresa excluída com sucesso.";
                $resposta['caminho']     = "listEmpresas.php";
                $resposta['sucesso']     = true;
            }
        } catch (Exception $e) {
            $resposta['msgResposta'] = $e->getMessage();
            $resposta['sucesso']     = false;
        }
        $pdo = null;
        echo json_encode($resposta);
        break;

    case '4':
      try {
          $sql = "update
                         empresas
                  set
                         EMAIL   = ?
                        ,SENHA   = ?
                  where
                         ID = ?";
          $rs = $pdo->prepare($sql);
          $count = $rs->execute(array($_REQUEST['email']
                                     ,$_REQUEST['senha']
                                     ,$_REQUEST['idEmpresa']));

          if($count === false){
              $resposta['msgResposta'] = "Erro ao alterar senha da empresa.";
              $resposta['caminho']     = "cadEmpresa.php";
              $resposta['sucesso']     = false;
          }else{
              $resposta['msgResposta'] = "Senha da empresa alterada com sucesso.";
              $resposta['caminho']     = "listEmpresas.php";
              $resposta['sucesso']     = true;
          }
      } catch (Exception $e) {
          $resposta['msgResposta'] = $e->getMessage();
          $resposta['sucesso']     = false;
      }
      $pdo = null;
      echo json_encode($resposta);
      break;

    case '5':
      try {
          $sql = "update empresas set
                         STATUS   = ?
                  where
                         ID = ?";
          $rs = $pdo->prepare($sql);
          $count = $rs->execute(array($_REQUEST['status']
                                     ,$_REQUEST['idEmpresa']));

          if($count === false){
              $resposta['msgResposta'] = "Erro ao alterar status da empresa.";
              $resposta['caminho']     = "cadEmpresa.php";
              $resposta['sucesso']     = false;
          }else{
              /* Enviar e-mail para a empresa
                 Se o status for A "Ativo", enviar a mensagem
              */
              if($_REQUEST['status'] == 'A'){
                /* Consultar os dados da vaga */
                $sql = "select
                               *
                        from
                               empresas
                        where
                               ID = ".$_REQUEST['idEmpresa'];
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                $registro = $consulta->fetch(PDO::FETCH_OBJ);

                //$util->enviarEmail($param);
                $param['html']      = true;
                $param['nomePara']  = $registro->RAZAO_SOCIAL;
                $param['emailPara'] = $registro->EMAIL_REPRESENTANTE_LEGAL;
                $param['assunto']   = "[Não responder] Empresa aprovada no banco de oportunidade - IPECON.";
                $msgHtml = "<html>
                                <head>
                                  <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
                                  <meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\" />
                                </head>
                                <body>
                                  <h2 align=\"center\">Banco de Oportunidades :-: Empresa Aprovada</h2>
                                  <hr/>
                                  <p>Sua empresa ".$registro->RAZAO_SOCIAL." foi aceita pelo IPECON.</p>
                                  <p>Apartir de hoje você pode acessar nosso site atraver do endereço/link => <a href=\"http://www.ipecon.com.br/admin/bcoOportunidade/loginEmpresa.php\">Banco de Oportunidade [http://www.ipecon.com.br/admin/bcoOportunidade/loginEmpresa.php]</a>.</p>
                                  <p><strong>Dados para acesso:</strong><br>
                                     <strong>e-Mail: </strong>".$registro->EMAIL."<br>
                                     <strong>Senha: </strong>".$registro->SENHA."</p>
                                  <p>Qualquer dúvida, por favor, entrar em contato com IPECON pelo e-mail <a href=\"mailto:ipecon@ipecon.com.br\">ipecon@ipecon.com.br</a> ou telefones: (62) 3214-3229 ou 3214-2563</p>
                                  <br/>
                                  <p>Obrigado,<br>IPECON - Ensino e Consultoria Ltda</p>
                                </body>
                              </html>";
                $param['mensagem']  = $msgHtml;

                if(!$util->enviarEmail($param)){
                  $resposta['msgRespostaEmail'] = "E-mail não foi enviado.";
                }
              }

              $resposta['msgResposta'] = "Status da empresa alterado com sucesso.";
              $resposta['caminho']     = "listEmpresas.php";
              $resposta['sucesso']     = true;
          }
      } catch (Exception $e) {
          $resposta['msgResposta'] = $e->getMessage();
          $resposta['sucesso']     = false;
      }
      $pdo = null;
      echo json_encode($resposta);
      break;

}
?>