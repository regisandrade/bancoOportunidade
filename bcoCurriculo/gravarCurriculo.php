<?php
/* Conexao */
require_once '../conexaoBdo.inc.php';
require_once '../class/util.class.php';
$util = new Util();

/* Tipo de Acao
 * 1 - Incluir
 * 2 - Alterar
 * 3 - Excluir
 */
$resposta = array();

switch ($_REQUEST['tipoAcao']) {
    case '1':
        try {
            $sql = "insert into 
                        curriculos (
                           NOME
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
                          ,DATA_CADASTRO
                          ,ID_ALUNO
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
                    ) values (
                           :nome
                          ,:sexo
                          ,:endereco
                          ,:bairro
                          ,:cidade
                          ,:uf
                          ,:cep
                          ,:telefone_fixo
                          ,:telefone_celular
                          ,:email
                          ,:data_nascimento
                          ,:cidade_nascimento
                          ,:uf_nascimento
                          ,:estado_civil
                          ,:rg
                          ,:orgao_expedidor
                          ,:data_expedicao_rg
                          ,:cpf
                          ,:carteira_reservista
                          ,:pis_pasep
                          ,:data_cadastro_pis_pasep
                          ,:titulo_eleitor
                          ,:zona
                          ,:secao
                          ,:habilitacao
                          ,:categoria
                          ,:validade
                          ,:area_interesse
                          ,:objetivo_profissional
                          ,:disponibilidade_horario
                          ,:msn
                          ,:twitter
                          ,:facebook
                          ,:data_cadastro
                          ,:id_aluno
                          ,:nome_empresa_1
                          ,:atividade_empresa_1
                          ,:data_admissao_1
                          ,:data_demissao_1
                          ,:funcao_exercida_1
                          ,:atividade_exercida_1
                          ,:salario_1
                          ,:nome_empresa_2
                          ,:atividade_empresa_2
                          ,:data_admissao_2
                          ,:data_demissao_2
                          ,:funcao_exercida_2
                          ,:atividade_exercida_2
                          ,:salario_2)";
                $rs = $pdo->prepare($sql);

                /* @var $dataNascimento date */
                $dataNascimento = Util::formataData($_REQUEST['dataNascimento'],'/','-','USA');
                /* @var $dataExpedicaoRg date */
                $dataExpedicaoRg = Util::formataData($_REQUEST['dataExpedicaoRg'],'/','-','USA');
                /* @var $dataPisPasep date */
                $dataPisPasep = Util::formataData($_REQUEST['dataPisPasep'],'/','-','USA');
                /* @var $vencimentoHabilitacao date */
                $vencimentoHabilitacao = Util::formataData($_REQUEST['vencimentoHabilitacao'],'/','-','USA');
                /* @var $dataAdmissao_1 date */
                $dataAdmissao_1 = Util::formataData($_REQUEST['dataAdmissao_1'],'/','-','USA');
                /* @var $dataDemissao_1 date */
                $dataDemissao_1 = Util::formataData($_REQUEST['dataDemissao_1'],'/','-','USA');
                /* @var $dataAdmissao_2 date */
                $dataAdmissao_2 = Util::formataData($_REQUEST['dataAdmissao_2'],'/','-','USA');
                /* @var $dataDemissao_2 date */
                $dataDemissao_2 = Util::formataData($_REQUEST['dataDemissao_2'],'/','-','USA');
                /* @var $salario_1 float */
                $salario_1 = str_replace(',','.',str_replace('.','',$_REQUEST['salario_1']));
                /* @var $salario_2 float */
                $salario_2 = str_replace(',','.',str_replace('.','',$_REQUEST['salario_2']));

                $count = $rs->execute(array(':nome'=>$_REQUEST['nome'],
                                            ':sexo'=>$_REQUEST['sexo'],
                                            ':endereco'=>$_REQUEST['endereco'],
                                            ':bairro'=>$_REQUEST['bairro'],
                                            ':cidade'=>$_REQUEST['cidade'],
                                            ':uf'=>$_REQUEST['uf'],
                                            ':cep'=>$_REQUEST['cep'],
                                            ':telefone_fixo'=>$_REQUEST['telefoneFixo'],
                                            ':telefone_celular'=>$_REQUEST['telefoneCelular'],
                                            ':email'=>$_REQUEST['email'],
                                            ':data_nascimento'=>$dataNascimento,
                                            ':cidade_nascimento'=>$_REQUEST['cidadeNascimento'],
                                            ':uf_nascimento'=>$_REQUEST['ufNascimento'],
                                            ':estado_civil'=>$_REQUEST['estadoCivil'],
                                            ':rg'=>$_REQUEST['rg'],
                                            ':orgao_expedidor'=>$_REQUEST['orgaoExpedidor'],
                                            ':data_expedicao_rg'=>$dataExpedicaoRg,
                                            ':cpf'=>$_REQUEST['cpf'],
                                            ':carteira_reservista'=>$_REQUEST['carteiraReservista'],
                                            ':pis_pasep'=>$_REQUEST['numeroPisPasep'],
                                            ':data_cadastro_pis_pasep'=>$dataPisPasep,
                                            ':titulo_eleitor'=>$_REQUEST['numeroTituloEleitor'],
                                            ':zona'=>$_REQUEST['zona'],
                                            ':secao'=>$_REQUEST['secao'],
                                            ':habilitacao'=>$_REQUEST['numeroHabilitacao'],
                                            ':categoria'=>$_REQUEST['categoria'],
                                            ':validade'=>$vencimentoHabilitacao,
                                            ':area_interesse'=>$_REQUEST['areaInteresse'],
                                            ':objetivo_profissional'=>$_REQUEST['objetivoProfissional'],
                                            ':disponibilidade_horario'=>$_REQUEST['disponibilidadeHorario'],
                                            ':msn'=>$_REQUEST['msn'],
                                            ':twitter'=>$_REQUEST['twitter'],
                                            ':facebook'=>$_REQUEST['facebook'],
                                            ':data_cadastro'=>date('Y-m-d'),
                                            ':id_aluno'=>$_REQUEST['idAluno'],
                                            ':nome_empresa_1'=>$_REQUEST['nomeEmpresa_1'],
                                            ':atividade_empresa_1'=>$_REQUEST['atividadeEmpresa_1'],
                                            ':data_admissao_1'=>$dataAdmissao_1,
                                            ':data_demissao_1'=>$dataDemissao_1,
                                            ':funcao_exercida_1'=>$_REQUEST['funcaoExercida_1'],
                                            ':atividade_exercida_1'=>$_REQUEST['atividadeExercida_1'],
                                            ':salario_1'=>$salario_1,
                                            ':nome_empresa_2'=>$_REQUEST['nomeEmpresa_2'],
                                            ':atividade_empresa_2'=>$_REQUEST['atividadeEmpresa_2'],
                                            ':data_admissao_2'=>$dataAdmissao_2,
                                            ':data_demissao_2'=>$dataDemissao_2,
                                            ':funcao_exercida_2'=>$_REQUEST['funcaoExercida_2'],
                                            ':atividade_exercida_2'=>$_REQUEST['atividadeExercida_2'],
                                            ':salario_2'=>$salario_2));
                //var_dump($count, $rs->errorInfo());
                if($count === false){
                    $resposta['msgResposta'] = utf8_encode("Erro ao gravar os dados do curr&iacute;culo.");
                    $resposta['caminho']     = "cadCurriculoAluno.php";
                    $resposta['sucesso']     = false;
                }else{
                    $resposta['msgResposta'] = utf8_encode("Curr&iacute;culo gravado com sucesso.");
                    $resposta['caminho']     = "cadCurriculoAluno.php";
                    $resposta['sucesso']     = true;
                }
	    } catch (Exception $e) {
	    	$resposta['msgResposta'] = $e->getMessage();
        $resposta['sucesso']    = false;
	    }
      echo json_encode($resposta);
      break;
	case '2':
	    try {
            $sql = "update 
                           curriculos 
                    set 
                           NOME                     = ?
                          ,SEXO                     = ?
                          ,ENDERECO                 = ?
                          ,BAIRRO                   = ?
                          ,CIDADE                   = ?
                          ,UF                       = ?
                          ,CEP                      = ?
                          ,TELEFONE_FIXO            = ?
                          ,TELEFONE_CELULAR         = ?
                          ,EMAIL                    = ?
                          ,DATA_NASCIMENTO          = ?
                          ,CIDADE_NASCIMENTO        = ?
                          ,UF_NASCIMENTO            = ?
                          ,ESTADO_CIVIL             = ?
                          ,RG                       = ?
                          ,ORGAO_EXPEDIDOR          = ?
                          ,DATA_EXPEDICAO_RG        = ?
                          ,CPF                      = ?
                          ,CARTEIRA_RESERVISTA      = ?
                          ,PIS_PASEP                = ?
                          ,DATA_CADASTRO_PIS_PASEP  = ?
                          ,TITULO_ELEITOR           = ?
                          ,ZONA                     = ?
                          ,SECAO                    = ?
                          ,HABILITACAO              = ?
                          ,CATEGORIA                = ?
                          ,VALIDADE                 = ?
                          ,AREA_INTERESSE           = ?
                          ,OBJETIVO_PROFISSIONAL    = ?
                          ,DISPONIBILIDADE_HORARIO  = ?
                          ,MSN                      = ?
                          ,TWITTER                  = ?
                          ,FACEBOOK                 = ?
                          ,NOME_EMPRESA_1           = ?
                          ,ATIVIDADE_EMPRESA_1      = ?
                          ,DATA_ADMISSAO_1          = ?
                          ,DATA_DEMISSAO_1          = ?
                          ,FUNCAO_EXERCIDA_1        = ?
                          ,ATIVIDADE_EXERCIDA_1     = ?
                          ,SALARIO_1                = ?
                          ,NOME_EMPRESA_2           = ?
                          ,ATIVIDADE_EMPRESA_2      = ?
                          ,DATA_ADMISSAO_2          = ?
                          ,DATA_DEMISSAO_2          = ?
                          ,FUNCAO_EXERCIDA_2        = ?
                          ,ATIVIDADE_EXERCIDA_2     = ?
                          ,SALARIO_2                = ?
                    where
                           ID = ?";
            $rs = $pdo->prepare($sql);

            /* @var $dataNascimento date */
            $dataNascimento = Util::formataData($_REQUEST['dataNascimento'],'/','-','USA');
            /* @var $dataExpedicaoRg date */
            $dataExpedicaoRg = Util::formataData($_REQUEST['dataExpedicaoRg'],'/','-','USA');
            /* @var $dataPisPasep date */
            $dataPisPasep = Util::formataData($_REQUEST['dataPisPasep'],'/','-','USA');
            /* @var $vencimentoHabilitacao date */
            $vencimentoHabilitacao = Util::formataData($_REQUEST['vencimentoHabilitacao'],'/','-','USA');
            /* @var $dataAdmissao_1 date */
            $dataAdmissao_1 = Util::formataData($_REQUEST['dataAdmissao_1'],'/','-','USA');
            /* @var $dataDemissao_1 date */
            $dataDemissao_1 = Util::formataData($_REQUEST['dataDemissao_1'],'/','-','USA');
            /* @var $dataAdmissao_2 date */
            $dataAdmissao_2 = Util::formataData($_REQUEST['dataAdmissao_2'],'/','-','USA');
            /* @var $dataDemissao_2 date */
            $dataDemissao_2 = Util::formataData($_REQUEST['dataDemissao_2'],'/','-','USA');
            /* @var $salario_1 float */
            $salario_1 = str_replace(',','.',str_replace('.','',$_REQUEST['salario_1']));
            /* @var $salario_2 float */
            $salario_2 = str_replace(',','.',str_replace('.','',$_REQUEST['salario_2']));
            // echo "<pre>";
            // print_r($_REQUEST);
            // echo "<br>".$dataNascimento;
            // echo "<br>".$dataExpedicaoRg;
            // echo "<br>".$dataPisPasep;
            // echo "<br>".$vencimentoHabilitacao;
            // echo "<br>".$dataAdmissao_1;
            // echo "<br>".$dataDemissao_1;
            // echo "<br>".$dataAdmissao_2;
            // echo "<br>".$dataDemissao_2;
            // echo "</pre>";
            // die;
            $count = $rs->execute(array($_REQUEST['nome']
                                       ,$_REQUEST['sexo']
                                       ,$_REQUEST['endereco']
                                       ,$_REQUEST['bairro']
                                       ,$_REQUEST['cidade']
                                       ,$_REQUEST['uf']
                                       ,$_REQUEST['cep']
                                       ,$_REQUEST['telefoneFixo']
                                       ,$_REQUEST['telefoneCelular']
                                       ,$_REQUEST['email']
                                       ,$dataNascimento
                                       ,(!empty($_REQUEST['cidadeNascimento']) ? $_REQUEST['cidadeNascimento'] : null)
                                       ,(!empty($_REQUEST['ufNascimento']) ? $_REQUEST['ufNascimento'] : null)
                                       ,$_REQUEST['estadoCivil']
                                       ,$_REQUEST['rg']
                                       ,$_REQUEST['orgaoExpedidor']
                                       ,(!empty($dataExpedicaoRg) ? $dataExpedicaoRg : null)
                                       ,$_REQUEST['cpf']
                                       ,$_REQUEST['carteiraReservista']
                                       ,$_REQUEST['numeroPisPasep']
                                       ,$dataPisPasep
                                       ,$_REQUEST['numeroTituloEleitor']
                                       ,$_REQUEST['zona']
                                       ,$_REQUEST['secao']
                                       ,$_REQUEST['numeroHabilitacao']
                                       ,$_REQUEST['categoria']
                                       ,$vencimentoHabilitacao
                                       ,$_REQUEST['areaInteresse']
                                       ,$_REQUEST['objetivoProfissional']
                                       ,$_REQUEST['disponibilidadeHorario']
                                       ,(!empty($_REQUEST['msn']) ? $_REQUEST['msn'] : null)
                                       ,(!empty($_REQUEST['twitter']) ? $_REQUEST['twitter'] : null)
                                       ,(!empty($_REQUEST['facebook']) ? $_REQUEST['facebook'] : null)
                                       ,(!empty($_REQUEST['nomeEmpresa_1']) ? $_REQUEST['nomeEmpresa_1'] : null)
                                       ,(!empty($_REQUEST['atividadeEmpresa_1']) ? $_REQUEST['atividadeEmpresa_1'] : null)
                                       ,(!empty($dataAdmissao_1) ? $dataAdmissao_1 : null)
                                       ,(!empty($dataDemissao_1) ? $dataDemissao_1 : null)
                                       ,(!empty($_REQUEST['funcaoExercida_1']) ? $_REQUEST['funcaoExercida_1'] : null)
                                       ,(!empty($_REQUEST['atividadeExercida_1']) ? $_REQUEST['atividadeExercida_1'] : null)
                                       ,(!empty($salario_1) ? $salario_1 : null)
                                       ,(!empty($_REQUEST['nomeEmpresa_2']) ? $_REQUEST['nomeEmpresa_2'] : null)
                                       ,(!empty($_REQUEST['atividadeEmpresa_2']) ? $_REQUEST['atividadeEmpresa_2'] : null)
                                       ,(!empty($dataAdmissao_2) ? $dataAdmissao_2 : null)
                                       ,(!empty($dataDemissao_2) ? $dataDemissao_2 : null)
                                       ,(!empty($_REQUEST['funcaoExercida_2']) ? $_REQUEST['funcaoExercida_2'] : null)
                                       ,(!empty($_REQUEST['atividadeExercida_2']) ? $_REQUEST['atividadeExercida_2'] : null)
                                       ,(!empty($salario_2) ? $salario_2 : null)
                                       ,$_REQUEST['ID_CURRICULO']));

            if($count === false){
                $resposta['msgResposta'] = utf8_encode("Erro ao alterar os dados do curr&iacute;culo.");
                $resposta['caminho']     = "cadCurriculoAluno.php";
                $resposta['sucesso']     = false;
            }else{
                $resposta['msgResposta'] = utf8_encode("Curr&iacute;culo alterado com sucesso.");
                $resposta['caminho']     = "cadCurriculoAluno.php";
                $resposta['sucesso']     = true;
            }
	    } catch (Exception $e) {
	    	$resposta['msgResposta'] = $e->getMessage();
        $resposta['sucesso']    = false;
	    }
      echo json_encode($resposta);
		  break;
	case '3':
	    try {
            $sql = "delete from curriculos where ID = ?";
            $rs = $pdo->prepare($sql);
            $count = $rs->execute(array($_REQUEST['id']));

            if($count === false){
                $resposta['msgResposta'] = utf8_encode("Erro ao excluir o curr&iacute;culo.");
                $resposta['caminho']     = "listCurriculos.php";
                $resposta['sucesso']     = false;
            }else{
                $resposta['msgResposta'] = utf8_encode("Curr&iacute;culo exclu&iacute;do com sucesso.");
                $resposta['caminho']     = "listCurriculos.php";
                $resposta['sucesso']     = true;
            }
	    } catch (Exception $e) {
        $resposta['msgResposta'] = $e->getMessage();
        $resposta['sucesso']    = false;
	    }
      echo json_encode($resposta);
		  break;
}
?>