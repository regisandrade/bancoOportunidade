<?php
require_once '../admin/bcoOportunidade/conexaoBdo.inc.php';
require_once '../admin/bcoOportunidade/class/util.class.php';
$util = new Util();

$sql = "SELECT
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
              ,ATIVIDADE_EMPRESA_1
              ,SALARIO_1
              ,NOME_EMPRESA_2
              ,ATIVIDADE_EMPRESA_2
              ,DATA_ADMISSAO_2
              ,DATA_DEMISSAO_2
              ,FUNCAO_EXERCIDA_2
              ,ATIVIDADE_EMPRESA_2
              ,SALARIO_2
        FROM
               curriculos
        WHERE
               CPF = ?";

$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $_SESSION['id_numero'], PDO::PARAM_STR,11);
$consulta->execute();
$registroCurriculo = $consulta->fetch(PDO::FETCH_OBJ);

$sqlAluno = "SELECT
                  TA.Sequencia,
                  TA.Ano,
                  TA.Id_Numero,
                  TA.Nome,
                  TA.Data_Nascimento,
                  TA.Naturalidade,
                  TA.UF_Naturalidade,
                  TA.Nacionalidade,
                  TA.Sexo,
                  TA.RG,
                  TA.Orgao,
                  TA.CPF,
                  TA.e_Mail,
                  TA.Status,
                  TA.Curso,
                  TE.Endereco,
                  TE.Bairro,
                  TE.CEP,
                  TE.Cidade,
                  TE.UF,
                  TE.Fone_Residencial,
                  TE.Fone_Comercial,
                  TE.Celular,
                  TG.Curso_Graduacao,
                  TG.Instituicao,
                  TG.Sigla,
                  TG.Ano_Conclusao,
                  TA.Curso,
                  TA.Data_Vencimento,
                  TA.twitter
            FROM
                  aluno TA
            LEFT OUTER JOIN endereco TE ON 
                  TE.Id_Numero = TA.Id_Numero
            LEFT OUTER JOIN graduacao TG ON 
                  TG.Id_Numero = TA.Id_Numero
            WHERE
                  TA.Id_Numero   = ?
              AND TA.Ano         = ?
              AND TE.Tipo_Pessoa = ?";
// echo "<pre>";
// print_r($sqlAluno);
// echo "</pre>";
$tipo_pessoa = 'A';
$consulta2 = $pdoSite->prepare($sqlAluno);
$consulta2->bindParam(1, $_SESSION['id_numero'], PDO::PARAM_STR,11);
$consulta2->bindParam(2, $_SESSION['ano'], PDO::PARAM_INT);
$consulta2->bindParam(3, $tipo_pessoa, PDO::PARAM_STR,1);
$consulta2->execute();
$registroAluno = $consulta2->fetch(PDO::FETCH_OBJ);
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../admin/bcoOportunidade/css/bo.css" type="text/css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script src="../admin/bcoOportunidade/js/jsGenerico.js"></script>

<h2>Atualizar seu curr&iacute;culo</h2>
<p class="txtCentralizado">Atenção, os campos em <span class="vermelho">vermelho</span> são obrigatórios.</p>
<form name="formCurriculo" id="formCurriculo" method="POST" action="">
    <input type="hidden" name="ID_CURRICULO" value="<?php echo ($registroCurriculo && $registroCurriculo->ID != '' ? $registroCurriculo->ID : ''); ?>" />
    <input type="hidden" name="tipoAcao" id="tipoAcao" value="<?php echo ($registroCurriculo && $registroCurriculo->ID != '' ? '2' : '1'); ?>"/>
    <input type="hidden" name="cpf" value="<?php echo $_SESSION['id_numero']; ?>" />
    <input type="hidden" name="idAluno" value="<?php echo ($registroCurriculo && $registroCurriculo->ID_ALUNO != '' ? $registroCurriculo->ID_ALUNO : $registroAluno->ID); ?>" />
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width: 33%" class="vermelho">Nome:</td>
            <td><input type="text" id="nome" name="nome" class="txtGrande" value="<?php echo ($registroCurriculo && $registroCurriculo->NOME != '') ? iconv('UTF-8','ISO-8859-1',$registroCurriculo->NOME) : ($registroAluno && $registroAluno->Nome != '' ? $registroAluno->Nome : ''); ?>" /></td>
        </tr>
        <tr>
            <td class="vermelho">Sexo:</td>
            <td><select id="sexo" name="sexo" class="">
                    <option value="">[Selecionar]</option>
                    <option value="F" <?php echo ($registroCurriculo && $registroCurriculo->SEXO == 'F' ? 'selected' : ($registroAluno && $registroAluno->Sexo == 'F' ? 'selected' : '')); ?>>Feminino</option>
                    <option value="M" <?php echo ($registroCurriculo && $registroCurriculo->SEXO == 'M' ? 'selected' : ($registroAluno && $registroAluno->Sexo == 'M' ? 'selected' : '')); ?>>Masculino</option>
            </select></td>
        </tr>
        <tr>
            <td class="vermelho">Endere&ccedil;o:</td>
            <td><textarea id="endereco" name="endereco" class="txtGrande"><?php echo ($registroCurriculo && $registroCurriculo->ENDERECO != '') ? iconv('UTF-8','ISO-8859-1',$registroCurriculo->ENDERECO) : ($registroAluno && $registroAluno->Endereco != '' ? iconv('UTF-8','ISO-8859-1',$registroAluno->Endereco) : ''); ?></textarea></td>
        </tr>
        <tr>
            <td class="vermelho">Bairro:</td>
            <td><input type="text" id="bairro" name="bairro" class="txtMedio" value="<?php echo ($registroCurriculo && $registroCurriculo->BAIRRO != '') ? iconv('UTF-8','ISO-8859-1',$registroCurriculo->BAIRRO) : ($registroAluno && $registroAluno->Bairro != '' ? iconv('UTF-8','ISO-8859-1',$registroAluno->Bairro) : ''); ?>" /></td>
        </tr>
        <tr>
            <td class="vermelho">Cidade:</td>
            <td><input type="text" id="cidade" name="cidade" class="txtMedio" value="<?php echo ($registroCurriculo && $registroCurriculo->CIDADE != '') ? iconv('UTF-8','ISO-8859-1',$registroCurriculo->CIDADE) : ($registroAluno && $registroAluno->Cidade != '' ? iconv('UTF-8','ISO-8859-1',$registroAluno->Cidade) : ''); ?>" /></td>
        </tr>
        <tr>
            <td class="vermelho">UF:</td>
            <td><select name="uf" id="uf" class="uf">
                    <option value="0">[Selecionar]</option>
                    <option value="AC" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'AC' ? 'selected' : ($registroAluno && $registroAluno->UF == 'AC' ? 'selected' : '')); ?>>Acre</option>
                    <option value="AL" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'AL' ? 'selected' : ($registroAluno && $registroAluno->UF == 'AL' ? 'selected' : '')); ?>>Alagoas</option>
                    <option value="AP" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'AP' ? 'selected' : ($registroAluno && $registroAluno->UF == 'AP' ? 'selected' : '')); ?>>Amap&aacute;</option>
                    <option value="AM" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'AM' ? 'selected' : ($registroAluno && $registroAluno->UF == 'AM' ? 'selected' : '')); ?>>Amazonas</option>
                    <option value="BA" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'BA' ? 'selected' : ($registroAluno && $registroAluno->UF == 'BA' ? 'selected' : '')); ?>>Bahia</option>
                    <option value="CE" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'CE' ? 'selected' : ($registroAluno && $registroAluno->UF == 'CE' ? 'selected' : '')); ?>>Cear&aacute;</option>
                    <option value="DF" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'DF' ? 'selected' : ($registroAluno && $registroAluno->UF == 'DF' ? 'selected' : '')); ?>>Distrito Federal</option>
                    <option value="ES" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'ES' ? 'selected' : ($registroAluno && $registroAluno->UF == 'ES' ? 'selected' : '')); ?>>Espirito Santo</option>
                    <option value="GO" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'GO' ? 'selected' : ($registroAluno && $registroAluno->UF == 'GO' ? 'selected' : '')); ?>>Goi&aacute;s</option>
                    <option value="MA" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'MA' ? 'selected' : ($registroAluno && $registroAluno->UF == 'MA' ? 'selected' : '')); ?>>Maranh&atilde;o</option>
                    <option value="MS" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'MS' ? 'selected' : ($registroAluno && $registroAluno->UF == 'MS' ? 'selected' : '')); ?>>Mato Grosso do Sul</option>
                    <option value="MT" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'MT' ? 'selected' : ($registroAluno && $registroAluno->UF == 'MT' ? 'selected' : '')); ?>>Mato Grosso</option>
                    <option value="MG" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'MG' ? 'selected' : ($registroAluno && $registroAluno->UF == 'MG' ? 'selected' : '')); ?>>Minas Gerais</option>
                    <option value="PA" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'PA' ? 'selected' : ($registroAluno && $registroAluno->UF == 'PA' ? 'selected' : '')); ?>>Par&aacute;</option>
                    <option value="PB" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'PB' ? 'selected' : ($registroAluno && $registroAluno->UF == 'PB' ? 'selected' : '')); ?>>Para&iacute;ba</option>
                    <option value="PR" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'PR' ? 'selected' : ($registroAluno && $registroAluno->UF == 'PR' ? 'selected' : '')); ?>>Paran&aacute;</option>
                    <option value="PE" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'PE' ? 'selected' : ($registroAluno && $registroAluno->UF == 'PE' ? 'selected' : '')); ?>>Pernambuco</option>
                    <option value="PI" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'PI' ? 'selected' : ($registroAluno && $registroAluno->UF == 'PI' ? 'selected' : '')); ?>>Piau&iacute;</option>
                    <option value="RJ" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'RJ' ? 'selected' : ($registroAluno && $registroAluno->UF == 'RJ' ? 'selected' : '')); ?>>Rio de Janeiro</option>
                    <option value="RN" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'RN' ? 'selected' : ($registroAluno && $registroAluno->UF == 'RN' ? 'selected' : '')); ?>>Rio Grande do Norte</option>
                    <option value="RS" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'RS' ? 'selected' : ($registroAluno && $registroAluno->UF == 'RS' ? 'selected' : '')); ?>>Rio Grande do Sul</option>
                    <option value="RO" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'RO' ? 'selected' : ($registroAluno && $registroAluno->UF == 'RO' ? 'selected' : '')); ?>>Rond&ocirc;nia</option>
                    <option value="RR" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'RR' ? 'selected' : ($registroAluno && $registroAluno->UF == 'RR' ? 'selected' : '')); ?>>Roraima</option>
                    <option value="SC" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'SC' ? 'selected' : ($registroAluno && $registroAluno->UF == 'SC' ? 'selected' : '')); ?>>Santa Catarina</option>
                    <option value="SP" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'SP' ? 'selected' : ($registroAluno && $registroAluno->UF == 'SP' ? 'selected' : '')); ?>>S&atilde;o Paulo</option>
                    <option value="SE" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'SE' ? 'selected' : ($registroAluno && $registroAluno->UF == 'SE' ? 'selected' : '')); ?>>Sergipe</option>
                    <option value="TO" <?php echo ($registroCurriculo && $registroCurriculo->UF == 'TO' ? 'selected' : ($registroAluno && $registroAluno->UF == 'TO' ? 'selected' : '')); ?>>Tocantins</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="vermelho">C.E.P.:</td>
            <td><input type="text" id="cep" name="cep" class="txtPequeno Mask" title="#####-###" maxlength="9" value="<?php echo ($registroCurriculo && $registroCurriculo->CEP != '') ? $registroCurriculo->CEP : ($registroAluno && $registroAluno->CEP !== '' ? $registroAluno->CEP : ''); ?>" />&nbsp;<span class="vermelho">9999-999</span></td>
        </tr>
        <tr>
            <td class="vermelho">Telefone Fixo:</td>
            <td><input type="text" id="telefoneFixo" name="telefoneFixo" class="txtMedio Mask" title="(##) ####-####" maxlength="14" value="<?php echo ($registroCurriculo && $registroCurriculo->TELEFONE_FIXO != '') ? $registroCurriculo->TELEFONE_FIXO : ($registroAluno && $registroAluno->Fone_Residencial !== '' ? $registroAluno->Fone_Residencial : ''); ?>" />&nbsp;<span class="vermelho">(99) 9999-9999</span></td>
        </tr>
        <tr>
            <td class="vermelho">Telefone Celular:</td>
            <td><input type="text" id="telefoneCelular" name="telefoneCelular" class="txtMedio Mask" title="(##) ####-####" maxlength="14" value="<?php echo ($registroCurriculo && $registroCurriculo->TELEFONE_CELULAR != '') ? $registroCurriculo->TELEFONE_CELULAR : ($registroAluno && $registroAluno->Celular !== '' ? $registroAluno->Celular : ''); ?>" />&nbsp;<span class="vermelho">(99) 9999-9999</span></td>
        </tr>
        <tr>
            <td class="vermelho">E-mail:</td>
            <td><input type="text" id="email" name="email" class="txtGrande" value="<?php echo ($registroCurriculo && $registroCurriculo->EMAIL != '') ? $registroCurriculo->EMAIL : ($registroAluno && $registroAluno->e_Mail !== '' ? $registroAluno->e_Mail : ''); ?>" /></td>
        </tr>
        <tr>
            <td class="vermelho">Data de Nascimento:</td>
            <td><input type="text" id="dataNascimento" name="dataNascimento" class="txtPequeno" maxlength="10" value="<?php echo ($registroCurriculo && $registroCurriculo->DATA_NASCIMENTO != '') ? Util::formataData($registroCurriculo->DATA_NASCIMENTO, '-', '/') : ($registroAluno && $registroAluno->Data_Nascimento !== '' ? Util::formataData($registroAluno->Data_Nascimento, '-', '/') : ''); ?>" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td>Cidade de Nascimento:</td>
            <td><input type="text" id="cidadeNascimento" name="cidadeNascimento" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->CIDADE_NASCIMENTO != '') ? $registroCurriculo->CIDADE_NASCIMENTO : ''; ?>" /></td>
        </tr>
        <tr>
            <td>UF de Nascimento:</td>
            <td><select name="ufNascimento" id="ufNascimento" class="uf">
                    <option value="0">[Selecionar]</option>
                    <option value="AC" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'AC' ? 'selected' : ''); ?>>Acre</option>
                    <option value="AL" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'AL' ? 'selected' : ''); ?>>Alagoas</option>
                    <option value="AP" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'AP' ? 'selected' : ''); ?>>Amap&aacute;</option>
                    <option value="AM" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'AM' ? 'selected' : ''); ?>>Amazonas</option>
                    <option value="BA" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'BA' ? 'selected' : ''); ?>>Bahia</option>
                    <option value="CE" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'CE' ? 'selected' : ''); ?>>Cear&aacute;</option>
                    <option value="DF" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'DF' ? 'selected' : ''); ?>>Distrito Federal</option>
                    <option value="ES" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'ES' ? 'selected' : ''); ?>>Espirito Santo</option>
                    <option value="GO" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'GO' ? 'selected' : ''); ?>>Goi&aacute;s</option>
                    <option value="MA" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'MA' ? 'selected' : ''); ?>>Maranh&atilde;o</option>
                    <option value="MS" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'MS' ? 'selected' : ''); ?>>Mato Grosso do Sul</option>
                    <option value="MT" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'MT' ? 'selected' : ''); ?>>Mato Grosso</option>
                    <option value="MG" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'MG' ? 'selected' : ''); ?>>Minas Gerais</option>
                    <option value="PA" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'PA' ? 'selected' : ''); ?>>Par&aacute;</option>
                    <option value="PB" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'PB' ? 'selected' : ''); ?>>Para&iacute;ba</option>
                    <option value="PR" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'PR' ? 'selected' : ''); ?>>Paran&aacute;</option>
                    <option value="PE" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'PE' ? 'selected' : ''); ?>>Pernambuco</option>
                    <option value="PI" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'PI' ? 'selected' : ''); ?>>Piau&iacute;</option>
                    <option value="RJ" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'RJ' ? 'selected' : ''); ?>>Rio de Janeiro</option>
                    <option value="RN" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'RN' ? 'selected' : ''); ?>>Rio Grande do Norte</option>
                    <option value="RS" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'RS' ? 'selected' : ''); ?>>Rio Grande do Sul</option>
                    <option value="RO" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'RO' ? 'selected' : ''); ?>>Rond&ocirc;nia</option>
                    <option value="RR" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'RR' ? 'selected' : ''); ?>>Roraima</option>
                    <option value="SC" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'SC' ? 'selected' : ''); ?>>Santa Catarina</option>
                    <option value="SP" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'SP' ? 'selected' : ''); ?>>S&atilde;o Paulo</option>
                    <option value="SE" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'SE' ? 'selected' : ''); ?>>Sergipe</option>
                    <option value="TO" <?php echo ($registroCurriculo && $registroCurriculo->UF_NASCIMENTO == 'TO' ? 'selected' : ''); ?>>Tocantins</option>
                </select></td>
        </tr>
        <tr>
            <td class="vermelho">Estado Civil:</td>
            <td><input type="text" id="estadoCivil" name="estadoCivil" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->ESTADO_CIVIL != '') ? $registroCurriculo->ESTADO_CIVIL : ''; ?>" /></td>
        </tr>
        <tr>
            <td class="vermelho">RG:</td>
            <td><input type="text" id="rg" name="rg" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->RG != '') ? $registroCurriculo->RG : ($registroAluno && $registroAluno->RG !== '' ? $registroAluno->RG : ''); ?>" /></td>
        </tr>
        <tr>
            <td class="vermelho">Org&atilde;o Expedidor:</td>
            <td><input type="text" id="orgaoExpedidor" name="orgaoExpedidor" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->ORGAO_EXPEDIDOR != '') ? $registroCurriculo->ORGAO_EXPEDIDOR : ($registroAluno && $registroAluno->Orgao !== '' ? $registroAluno->Orgao : ''); ?>" /></td>
        </tr>
        <tr>
            <td>Data de Expedi&ccedil;&atilde;o do RG:</td>
            <td><input type="text" id="dataExpedicaoRg" name="dataExpedicaoRg" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->DATA_EXPEDICAO_RG != '') ? $registroCurriculo->DATA_EXPEDICAO_RG : ''; ?>" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td class="vermelho">C.P.F.:</td>
            <td><strong><?php echo $_SESSION['id_numero']; ?></strong></td>
        </tr>
        <tr>
            <td>Carteira de Reservista:</td>
            <td><input type="text" id="carteiraReservista" name="carteiraReservista" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->CARTEIRA_RESERVISTA != '') ? $registroCurriculo->CARTEIRA_RESERVISTA : ''; ?>" /></td>
        </tr>
        <tr>
            <td>N&uacute;mero do PIS-PASEP:</td>
            <td><input type="text" id="numeroPisPasep" name="numeroPisPasep" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->PIS_PASEP != '') ? $registroCurriculo->PIS_PASEP : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Data de Cadastro do PIS-PASEP:</td>
            <td><input type="text" id="dataPisPasep" name="dataPisPasep" class="txtPequeno" maxlength="10" value="<?php echo ($registroCurriculo && $registroCurriculo->DATA_CADASTRO_PIS_PASEP != '') ? $registroCurriculo->DATA_CADASTRO_PIS_PASEP : ''; ?>" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td>N&uacute;mero do T&iacute;tulo de Eleitor:</td>
            <td><input type="text" id="numeroTituloEleitor" name="numeroTituloEleitor" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->TITULO_ELEITOR != '') ? $registroCurriculo->TITULO_ELEITOR : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Zona:</td>
            <td><input type="text" id="zona" name="zona" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->ZONA != '') ? $registroCurriculo->ZONA : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Se&ccedil;&atilde;o:</td>
            <td><input type="text" id="secao" name="secao" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->SECAO != '') ? $registroCurriculo->SECAO : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Habilita&ccedil;&atilde;o:</td>
            <td><input type="text" id="numeroHabilitacao" name="numeroHabilitacao" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->HABILITACAO != '') ? $registroCurriculo->HABILITACAO : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Categoria:</td>
            <td><input type="text" id="categoria" name="categoria" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->CATEGORIA != '') ? $registroCurriculo->CATEGORIA : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Vencimento:</td>
            <td><input type="text" id="vencimentoHabilitacao" name="vencimentoHabilitacao" maxlength="10" class="txtPequeno" value="<?php echo ($registroCurriculo && $registroCurriculo->VALIDADE != '') ? $registroCurriculo->VALIDADE : ''; ?>" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td class="vermelho">&Aacute;rea de Interesse:</td>
            <td><textarea id="areaInteresse" name="areaInteresse" class="txtGrande"><?php echo ($registroCurriculo && $registroCurriculo->AREA_INTERESSE != '') ? iconv('UTF-8','ISO-8859-1',$registroCurriculo->AREA_INTERESSE) : ''; ?></textarea></td>
        </tr>
        <tr>
            <td class="vermelho">Objetivo Profissional:</td>
            <td><textarea id="objetivoProfissional" name="objetivoProfissional" class="txtGrande"><?php echo ($registroCurriculo && $registroCurriculo->OBJETIVO_PROFISSIONAL != '') ? iconv('UTF-8','ISO-8859-1',$registroCurriculo->OBJETIVO_PROFISSIONAL) : ''; ?></textarea></td>
        </tr>
        <tr>
            <td class="vermelho">Disponibilidade de Hor&aacute;rio:</td>
            <td><select id="disponibilidadeHorario" name="disponibilidadeHorario">
                <option value="">[Selecionar]</option>
                <option value="M" <?php echo ($registroCurriculo && $registroCurriculo->DISPONIBILIDADE_HORARIO == 'M' ? 'selected' : ''); ?>>Manh&atilde;</option>
                <option value="T" <?php echo ($registroCurriculo && $registroCurriculo->DISPONIBILIDADE_HORARIO == 'T' ? 'selected' : ''); ?>>Tarde</option>
                <option value="N" <?php echo ($registroCurriculo && $registroCurriculo->DISPONIBILIDADE_HORARIO == 'N' ? 'selected' : ''); ?>>Noite</option>
                <option value="I" <?php echo ($registroCurriculo && $registroCurriculo->DISPONIBILIDADE_HORARIO == 'I' ? 'selected' : ''); ?>>Integral</option>
        </select></td>
        </tr>
        <tr>
            <td>MSN:</td>
            <td><input type="text" id="msn" name="msn" class="txtMedio" value="<?php echo ($registroCurriculo && $registroCurriculo->MSN != '') ? $registroCurriculo->MSN : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Twitter:</td>
            <td><input type="text" id="twitter" name="twitter" class="txtMedio" value="<?php echo ($registroCurriculo && $registroCurriculo->TWITTER != '') ? $registroCurriculo->TWITTER : ''; ?>" /></td>
        </tr>
        <tr>
            <td>Facebook:</td>
            <td><input type="text" id="facebook" name="facebook" class="txtMedio" value="<?php echo ($registroCurriculo && $registroCurriculo->FACEBOOK != '') ? $registroCurriculo->FACEBOOK : ''; ?>" /></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Experiência Profissional</strong></td>
        </tr>
        <tr>
            <td colspan="2"><u>Ultima empresa</u>:</td>
        </tr>
        <tr>
            <td>Nome da empresa:</td>
            <td><input type="text" id="nomeEmpresa_1" name="nomeEmpresa_1" class="txtMedio" value="" /></td>
        </tr>
        <tr>
            <td>Atividade da empresa:</td>
            <td><textarea id="atividadeEmpresa_1" name="atividadeEmpresa_1" class="txtGrande"></textarea></td>
        </tr>
        <tr>
            <td>Data de admissão:</td>
            <td><input type="text" id="dataAdmissao_1" name="dataAdmissao_1" class="txtPequeno" maxlength="10" value="" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td>Data de demissão:</td>
            <td><input type="text" id="dataDemissao_1" name="dataDemissao_1" class="txtPequeno" maxlength="10" value="" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td>Função exercida:</td>
            <td><input type="text" id="funcaoExercida_1" name="funcaoExercida_1" class="txtMedio" value="" /></td>
        </tr>
        <tr>
            <td>Atividades exercida:</td>
            <td><textarea id="atividadeExercida_1" name="atividadeExercida_1" class="txtGrande"></textarea></td>
        </tr>
        <tr>
            <td>Último salário:</td>
            <td><textarea id="salario_1" name="salario_1" class="txtGrande"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><u>Penúltima empresa</u>:</td>
        </tr>
        <tr>
            <td>Nome da empresa:</td>
            <td><input type="text" id="nomeEmpresa_2" name="nomeEmpresa_2" class="txtMedio" value="" /></td>
        </tr>
        <tr>
            <td>Atividade da empresa:</td>
            <td><textarea id="atividadeEmpresa_2" name="atividadeEmpresa_2" class="txtGrande"></textarea></td>
        </tr>
        <tr>
            <td>Data de admissão:</td>
            <td><input type="text" id="dataAdmissao_2" name="dataAdmissao_2" class="txtPequeno" maxlength="10" value="" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td>Data de demissão:</td>
            <td><input type="text" id="dataDemissao_2" name="dataDemissao_2" class="txtPequeno" maxlength="10" value="" />&nbsp;<img src="../admin/bcoOportunidade/imagens/icone-calendario.png" class="imgCalendario" border="0"></td>
        </tr>
        <tr>
            <td>Função exercida:</td>
            <td><input type="text" id="funcaoExercida_2" name="funcaoExercida_2" class="txtMedio" value="" /></td>
        </tr>
        <tr>
            <td>Atividades exercida:</td>
            <td><textarea id="atividadeExercida_2" name="atividadeExercida_2" class="txtGrande"></textarea></td>
        </tr>
        <tr>
            <td>último salário:</td>
            <td><textarea id="salario_2" name="salario_2" class="txtGrande"></textarea></td>
        </tr>
    </table>
</form>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width: 33%"></td>
        <td><button id="btnGravarCurriculo">Gravar</button></td>
    </tr>
</table>       
</body>
</html>
