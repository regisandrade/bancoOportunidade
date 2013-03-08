<?php
session_start();

if (isset($_SESSION['ID']) && $_SESSION['ID'] != '') {
    /* Conexao */
    require_once '../conexaoBdo.inc.php';

    $sql = "select 
                   *
            from
                   empresas
            where
                   ID = ".$_SESSION['ID'];
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $registro = $consulta->fetch(PDO::FETCH_OBJ);
}
?>
<html>
<head>
    <title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="css/bo.css" type="text/css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="js/jsComplementos.js"></script>
    <script src="js/jsGenerico.js"></script>

</head>
<body>
    <form name="formEmpresa" id="formEmpresa" method="post" action="">
        <input type="hidden" name="localCadastro" id="localCadastro" value="WEB" />
        <input type="hidden" name="status" id="status" value="<?php echo (isset($registro) && $registro->ID ? $registro->STATUS : '2'); ?>" />
        <input type="hidden" name="tipoAcao" id="tipoAcao" value="<?php echo (isset($registro) && $registro->ID ? '2' : '1'); ?>" />
        <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo (isset($registro) && $registro->ID ? $registro->ID : ''); ?>" />
        <p>Aten&ccedil;&atilde;o, campos em <span class="vermelho">vermelho</span> s&atilde;o obrigat&oacute;rios</p>
        <table border="0" width="100%" cellspacing="0" cellpadding="0" id="tabelaEmpresa">
            <tr>
                <td class="tdFormulario vermelho">C.N.P.J.:</td>
                <td><input type="text" id="cnpj" name="cnpj" maxlength="18" value="<?php echo (isset($registro) && $registro->CNPJ ? $registro->CNPJ : ''); ?>" class="txtMedio Mask" title="##.###.###/####-##" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Raz&atilde;o social:</td>
                <td><input type="text" id="razaoSocial" name="razaoSocial" value="<?php echo (isset($registro) && $registro->RAZAO_SOCIAL ? $registro->RAZAO_SOCIAL : ''); ?>" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Nome fantasia:</td>
                <td><input type="text" id="nomeFantasia" name="nomeFantasia" value="<?php echo (isset($registro) && $registro->NOME_FANTASIA ? $registro->NOME_FANTASIA : ''); ?>" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Endere&ccedil;o:</td>
                <td><textarea id="endereco" name="endereco" class="txtGrande"><?php echo (isset($registro) && $registro->ENDERECO? $registro->ENDERECO : ''); ?></textarea></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Bairro:</td>
                <td><input type="text" id="bairro" name="bairro" value="<?php echo (isset($registro) && $registro->BAIRRO ? $registro->BAIRRO : ''); ?>" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Cidade:</td>
                <td><input type="text" id="cidade" name="cidade" value="<?php echo (isset($registro) && $registro->CIDADE ? $registro->CIDADE : ''); ?>" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">UF:</td>
                <td><select name="uf" id="uf" class="uf">
                        <option value="0">Selecione o Estado</option>
                        <option value="AC" <?php echo (isset($registro) && $registro->UF == 'AC' ? 'selected' : ''); ?>>Acre</option>
                        <option value="AL" <?php echo (isset($registro) && $registro->UF == 'AL' ? 'selected' : ''); ?>>Alagoas</option>
                        <option value="AP" <?php echo (isset($registro) && $registro->UF == 'AP' ? 'selected' : ''); ?>>Amapá</option>
                        <option value="AM" <?php echo (isset($registro) && $registro->UF == 'AM' ? 'selected' : ''); ?>>Amazonas</option>
                        <option value="BA" <?php echo (isset($registro) && $registro->UF == 'BA' ? 'selected' : ''); ?>>Bahia</option>
                        <option value="CE" <?php echo (isset($registro) && $registro->UF == 'CE' ? 'selected' : ''); ?>>Ceará</option>
                        <option value="DF" <?php echo (isset($registro) && $registro->UF == 'DF' ? 'selected' : ''); ?>>Distrito Federal</option>
                        <option value="ES" <?php echo (isset($registro) && $registro->UF == 'ES' ? 'selected' : ''); ?>>Espirito Santo</option>
                        <option value="GO" <?php echo (isset($registro) && $registro->UF == 'GO' ? 'selected' : ''); ?>>Goiás</option>
                        <option value="MA" <?php echo (isset($registro) && $registro->UF == 'MA' ? 'selected' : ''); ?>>Maranhão</option>
                        <option value="MS" <?php echo (isset($registro) && $registro->UF == 'MS' ? 'selected' : ''); ?>>Mato Grosso do Sul</option>
                        <option value="MT" <?php echo (isset($registro) && $registro->UF == 'MT' ? 'selected' : ''); ?>>Mato Grosso</option>
                        <option value="MG" <?php echo (isset($registro) && $registro->UF == 'MG' ? 'selected' : ''); ?>>Minas Gerais</option>
                        <option value="PA" <?php echo (isset($registro) && $registro->UF == 'PA' ? 'selected' : ''); ?>>Pará</option>
                        <option value="PB" <?php echo (isset($registro) && $registro->UF == 'PB' ? 'selected' : ''); ?>>Paraíba</option>
                        <option value="PR" <?php echo (isset($registro) && $registro->UF == 'PR' ? 'selected' : ''); ?>>Paraná</option>
                        <option value="PE" <?php echo (isset($registro) && $registro->UF == 'PE' ? 'selected' : ''); ?>>Pernambuco</option>
                        <option value="PI" <?php echo (isset($registro) && $registro->UF == 'PI' ? 'selected' : ''); ?>>Piauí</option>
                        <option value="RJ" <?php echo (isset($registro) && $registro->UF == 'RJ' ? 'selected' : ''); ?>>Rio de Janeiro</option>
                        <option value="RN" <?php echo (isset($registro) && $registro->UF == 'RN' ? 'selected' : ''); ?>>Rio Grande do Norte</option>
                        <option value="RS" <?php echo (isset($registro) && $registro->UF == 'RS' ? 'selected' : ''); ?>>Rio Grande do Sul</option>
                        <option value="RO" <?php echo (isset($registro) && $registro->UF == 'RO' ? 'selected' : ''); ?>>Rondônia</option>
                        <option value="RR" <?php echo (isset($registro) && $registro->UF == 'RR' ? 'selected' : ''); ?>>Roraima</option>
                        <option value="SC" <?php echo (isset($registro) && $registro->UF == 'SC' ? 'selected' : ''); ?>>Santa Catarina</option>
                        <option value="SP" <?php echo (isset($registro) && $registro->UF == 'SP' ? 'selected' : ''); ?>>São Paulo</option>
                        <option value="SE" <?php echo (isset($registro) && $registro->UF == 'SE' ? 'selected' : ''); ?>>Sergipe</option>
                        <option value="TO" <?php echo (isset($registro) && $registro->UF == 'TO' ? 'selected' : ''); ?>>Tocantins</option>
                    </select></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">CEP:</td>
                <td><input type="text" id="cep" name="cep" maxlength="9" value="<?php echo (isset($registro) && $registro->CEP ? $registro->CEP : ''); ?>" class="txtPequeno Mask" title="#####-###" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Telefone comercial:</td>
                <td><input type="text" id="telefoneComercial" name="telefoneComercial" maxlength="14" value="<?php echo (isset($registro) && $registro->TELEFONE_COMERCIAL ? $registro->TELEFONE_COMERCIAL : ''); ?>" class="txtPequeno Mask" title="(##) ####-####" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">Telefone fax:</td>
                <td><input type="text" id="telefoneFax" name="telefoneFax" maxlength="14" value="<?php echo (isset($registro) && $registro->TELEFONE_FAX ? $registro->TELEFONE_FAX : ''); ?>" class="txtPequeno Mask" title="(##) ####-####" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Telefone celular:</td>
                <td><input type="text" id="telefoneCelular" name="telefoneCelular" maxlength="14" value="<?php echo (isset($registro) && $registro->TELEFONE_CELULAR ? $registro->TELEFONE_CELULAR : ''); ?>" class="txtPequeno Mask" title="(##) ####-####" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Representante legal:</td>
                <td><input type="text" id="representanteLegal" name="representanteLegal" value="<?php echo (isset($registro) && $registro->REPRESENTANTE_LEGAL ? $registro->REPRESENTANTE_LEGAL : ''); ?>" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">RG representante legal:</td>
                <td><input type="text" id="rg" name="rg" value="<?php echo (isset($registro) && $registro->RG_REPRESENTANTE_LEGAL ? $registro->RG_REPRESENTANTE_LEGAL : ''); ?>" class="txtPequeno" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">Org&atilde;o expedidor:</td>
                <td><input type="text" id="orgaoExpedidor" name="orgaoExpedidor" value="<?php echo (isset($registro) && $registro->ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL ? $registro->ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL : ''); ?>" class="txtPequeno" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">CPF:</td>
                <td><input type="text" id="cpf" name="cpf" maxlength="16" value="<?php echo (isset($registro) && $registro->CPF_REPRESENTANTE_LEGAL ? $registro->CPF_REPRESENTANTE_LEGAL : ''); ?>" class="txtPequeno Mask" title="###.###.###-##" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Cargo:</td>
                <td><input type="text" id="cargo" name="cargo" value="<?php echo (isset($registro) && $registro->CARGO_REPRESENTANTE_LEGAL ? $registro->CARGO_REPRESENTANTE_LEGAL : ''); ?>" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">E-mail:</td>
                <td><input type="text" id="email" name="email" value="<?php echo (isset($registro) && $registro->EMAIL ? $registro->EMAIL : ''); ?>" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">Tipo de empresa:</td>
                <td><input type="text" id="tipoEmpresa" name="tipoEmpresa" value="<?php echo (isset($registro) && $registro->TIPO_EMPRESA ? $registro->TIPO_EMPRESA : ''); ?>" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">Porte da empresa:</td>
                <td><input type="text" id="porteEmpresa" name="porteEmpresa" value="<?php echo (isset($registro) && $registro->PORTE ? $registro->PORTE : ''); ?>" /></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Benef&iacute;cios:</td>
                <td><textarea id="beneficio" name="beneficio" class="txtGrande"><?php echo (isset($registro) && $registro->BENEFICIOS_DISPONIVEIS ? $registro->BENEFICIOS_DISPONIVEIS : ''); ?></textarea></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Hor&aacute;rio a ser cumprido:</td>
                <td><input type="text" id="horarioSerCumprido" name="horarioSerCumprido" maxlength="8" value="<?php echo (isset($registro) && $registro->HORARIO_SER_CUMPRIDO ? $registro->HORARIO_SER_CUMPRIDO : ''); ?>" class="txtPequeno Mask" title="##:##:##" />&nbsp;<span class="vermelho">[hh:mm:ss]</span></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Horas di&aacute;rias:</td>
                <td><input type="text" id="horasDiaria" name="horasDiaria" maxlength="8" value="<?php echo (isset($registro) && $registro->HORAS_DIARIAS ? $registro->HORAS_DIARIAS : ''); ?>" class="txtPequeno Mask" title="##:##:##" />&nbsp;<span class="vermelho">[hh:mm:ss]</span></td>
            </tr>
            <tr>
                <td class="tdFormulario vermelho">Horas semanais:</td>
                <td><input type="text" id="horasSemanais" name="horasSemanais" maxlength="8" value="<?php echo (isset($registro) && $registro->HORAS_SEMANAIS ? $registro->HORAS_SEMANAIS : ''); ?>" class="txtPequeno Mask" title="##:##:##" />&nbsp;<span class="vermelho">[hh:mm:ss]</span></td>
            </tr>
        </table>
    </form>
    <?php
    if(isset($registro->ID)){
        echo '<button id="btnAlterarEmpresa">Gravar</button>';
    }
    ?>
</body>
</html>